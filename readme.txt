=== Plugin Name ===
Contributors: zeamedia
Tags: JSON
Requires at least: 3.5.1
Tested up to: 3.5.1
Stable tag: 0.3
License: GPLv3

Dieses Plugin gibt anstelle einer WordPress Seite ein JSON zurück. Sowohl Blog-Infos, als auch Posts werden ausgegeben.

== Description ==
Um die Ausgabe als JSON zu aktivieren, muss an eine beliebige Wordpress-URL nur der GET Parameter "json" angehängt werden:

?json

/category/news/?json  Posts innerhalb einer Kategorie auslesen. 
/hello-world/?json  Einen einzelnen Post auslesen. 


Es können optional zwei GET Parameter übergeben werden:

?json&count=3  Durch den Parameter "count" kann die Anzahl der Posts in der Rückgabe limitiert werden. 

?json&category=news  Möglicherweise ist ein Filtern nach Katagorie auch per GET Parameter gefragt.


Das JSON liefert allgemeine Informationen über den Blog:

* blog_title 
* blog_desc 
* blog_url 
* blog_rss 

...und Inhalte des Posts:

* id 
* slug  (Teil des Permalink ohne die Domain) 
* url  (Permalink) 
* title 
* excerpt 
* author 
* date  (wie in Wordpress konfiguriert) 
* categories  (Array aller Kategorien)


Das ist sehr nützlich, wenn beispielsweise auf einer anderen Webseite eine Vorschau auf einen oder mehrere Artikel des Blogs angezeigt werden soll.


=Beispiel JSON=

{ 
	"blog_title": "", 
	"blog_desc": "", 
	"blog_url": "", 
	"blog_rss": "", 
	"posts": [{ 
		"id": 1, 
		"slug": "", 
		"url": "", 
		"title": "", 
		"excerpt": "", 
		"author": "", 
		"date": "", 
		"categories": [] 
	}]
}

== Installation ==

1. Den Ordner simply-json auf den Server nach /wp-content/plugins/ hochladen - oder das Plugin direkt über den Wordpress Plugin Installer installieren.

2. Das Plugin im 'Plugins' Menu in WordPress aktivieren oder den Link im Plugin Installer anklicken.


== Frequently Asked Questions ==

Noch keine offenen Fragen.

== Screenshots ==

Noch keine Screenshots vorhanden.

== Changelog ==

= 0.3 =

* *04. April 2013* 
* Bislang fehlenden JSON-Header hinzugefügt. 
* Bugfix: Fehler beim Filter nach Kategorien korrigiert. 


= 0.2 =

* *19. März 2013* 
* Jetzt werden auch alle Kategorien eines Posts mit ausgegeben. 


= 0.1 =

* *25. Februar 2013* 
* Initial Public Release. 

== Upgrade Notice ==

Hier ist nichts zu beachten.