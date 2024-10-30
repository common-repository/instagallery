===  Instagallery ===
Contributors: evilripper
Tags: Plugin, instagram, images, gallery, pictures, photos
Requires at least: 3.0.1
Tested up to: 3.8.1
Stable tag: 1.0.2
License: GPLv3

This plugin lets you display your own Instagram last photos with likes and link instagram single photo. 

== Description ==

This plugin shows your Instagram photos with likes and link to instagram single photo. Actually do not need OAuth access token, but this plugin uses official Instagram API and you must create a Client Id from here http://instagram.com/developer/clients/manage 

PHP 5.3 and function allow_url_fopen = On is required!

You must write the short tag [instagallery] in the post or the page where you want show your instgram lastest photos.

Shortcode Samples: [instagallery] 

A gallery demo: http://www.evilripper.net/instagram/

Please use YOUR username. If you want to use photos of another user, you must first ask him for permission.

In the future maybe I'll do another plugin with jquery to load the gallery with ajax to not slow down the loading of the page.

Please rate the plugin Instagallery if you find it funny and useful, thanks.

== Installation ==

Through server:

1. Unzip and Upload all files in "/wp-content/plugins/".
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Choose your appropriate settings.
4. That's All (:


Through admin:

1. Upload zip and activate plugin.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Choose your appropriate settings.
4. That's All (:

== Frequently Asked Questions ==

= Where can I find my instagram client id  = 

You must register new Client ID from http://instagram.com/developer/clients/register/ accept the conditions select a random name, random description, your website url and your website url with token-access for ex: youblogurl/instagram-token-access and press register. Ok you have your ClientID.

= Where can I find my username = 

It is your instagram username!
Please use YOUR username. If you want to use photos of another user, you must first ask him for permission.

=  This plugin write data on the database? =

It will save only the option data on database

=  This plugin works fine with all browser? =

I tested it on Chrome and Firefox, it uses only php, css and html no javascript.

== Screenshots ==

1. Plugin options screen

2. Photo gallery 

== Changelog ==
= 1.0.2 =
* fix link instagallery plugin to wordpress directory
* removed instagallery at end of gallery
* move screenshot to assets folder
* add banner to assets folder
* fix readme.txt error

= 1.0.0 =
Initial Release

== Upgrade Notice ==
= 1.0.0 =
This version is the first of my plugin have fun :)