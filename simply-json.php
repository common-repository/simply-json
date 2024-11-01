<?php
/**
 * Plugin Name: Simply JSON
 * Author: zeamedia
 * Version: 0.3
 * plugin uri: http://wordpress.org/extend/plugins/simply-json/
 * description: Dieses Plugin gibt anstelle einer WordPress Seite ein JSON zurück. Sowohl Blog-Infos, als auch Posts werden ausgegeben.
 * author uri: http://zeamedia.de
 */


/**
 * Simply JSON ;)
 */
function template_redirect_simply_json() {
	global $post, $query_string;
	$post_id = $post->ID;

	if(isset($_REQUEST['json'])) {
		$output['blog_title'] = get_bloginfo('name');
		$output['blog_desc'] = get_bloginfo('description');
		$output['blog_url'] = get_bloginfo('url');
		$output['blog_rss'] = get_bloginfo('rss2_url');
		
		if (isset($_REQUEST['category'])) {
			$category = trim(strip_tags($_REQUEST['category']));
		}

		if( have_posts() ) {
			$i = 0;
			while( have_posts() ) {
				the_post();
				if (!isset($category) || in_category($category)) {
					$permalink_array = explode('/', trim(get_permalink(),'/'));
					$output['posts'][$i]['id'] = get_the_ID();
					$output['posts'][$i]['slug'] = end($permalink_array);
					$output['posts'][$i]['url'] = get_permalink();
					$output['posts'][$i]['title'] = get_the_title();
					$output['posts'][$i]['excerpt'] = strip_tags_content_simply_json(get_the_excerpt());
					$output['posts'][$i]['author'] = get_the_author();
					$output['posts'][$i]['date'] = get_the_date();
					foreach(get_the_category() as $cat) {
						$output['posts'][$i]['categories'][] = $cat->cat_name;
					}
					$i++;
				}
				if (isset($_REQUEST['count']) && $_REQUEST['count'] == $i) {
					break;
				}
			}
		}
		die ( json_encode( $output ) );
	} else {
		return;
	}
}


/**
 * Hilfsfunktion, die alle HTML Tags und deren Inhalt aus einem String entfernt
 *
 * @param (string) $text  Zu durchsuchender String
 * @param (array) $tags  HTML Tags, die ausgelassen werden sollen
 */
function strip_tags_content_simply_json($text, $tags = '') {
	preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
	$tags = array_unique($tags[1]);
	if(is_array($tags) and count($tags) > 0) {
		return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
	} else {
		return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
	}
	return $text;
}


/**
 * Seiten-Header, damit das JSON auch als solches erkannt wird.
 */
function add_header_xua() {
	header('Content-Type: application/json');
}


/**
 * Wordpress Actions
 */
add_action('send_headers', 'add_header_xua');
add_action('template_redirect' , 'template_redirect_simply_json');
?>