=== WPAmanuke PrettyPhoto WP Plugins ===
Contributors: iryono
Donate link: http://wpamanuke.com/donations
Tags: prettyPhoto, jQuery, ligthbox, image, wp prettyphoto, jquery lightbox,gallery,media,admin,post,photo,picture
Requires at least: 3.3.1
Tested up to: 3.3.1
Stable tag: 0.1

Add prettyPhoto support to your wordpress blogs. It will enable prettyPhoto jquery in image which you insert to post/page.

== Description ==
prettyPhoto is a jQuery lightbox clone. The feature is awesome. It support images, it also support for videos, flash, YouTube, iframes and ajax.  But when i try in wordpress theme and and give rel=”" on the href there is a problem on it. After i save the post and edit again the rel sometimes it become dissapear. So this prettyPhoto just change the rel to class and make it can work in wordpress smoothly. See <a href="http://wpamanuke.com/amanuke-wp-prettyphoto-plugins/"> how to use prettyPhoto plugins wordpress </a> for more information about using this plugins in wordpress.
= Related Links: =
* prettyPhoto Jquery <a href="http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/">prettyPhoto Jquery</a>

== Installation ==
= Install Plugins =
1. Download the plugin archive and expand it if you haven't already.
2. Put the `wpamanuke_prettyphoto` folder into your `wp-content/plugins/` directory.
3. Go to the Plugins page in your Administration Panel and click "Activate" for WPAmaNuke prettyPhoto
4. Change the settings from WPAmanuke prettyPhoto in the admin area 
5. Download PrettyPhoto from http://www.no-margin-for-errors.com/projects/prettyphoto-jquery-lightbox-clone/ 
6. Unzip then copy this structure on the plugins/wpamanuke_prettyphoto/ folder: 
- /js/jquery.prettyPhoto.js
- /css/prettyPhoto.css
- /images/prettyPhoto 
7. Have fun with your blog readers.

== Frequently Asked Questions ==
= How To Use =
1. Create New Post / Page
2. Insert Image from Media Uploader
3. Just Find Pretty Photo Property 
4. Save The Post
5. Just See the preview if it works or not

= From Step 3 =
* Choose Open Using PrettyPhoto = yes (if you want to use prettyPhoto)
* Url Lightbox Type = image (anything which you like)
* Fill url image / url link which you want to show
* Fill LinkGroup with example <i>group1</i> or <i>group2</i> etc if you want to make group with the images. Don't fill anything if you don't want to group it
* Click Save All Changes
* Insert Into Post

= Customize =
* Customize php file just open index.php and admin_page.php in the amanuke_prettyphoto folders
* Sending variable to javascipt file using wp_localize_script( 'amanuke_prettyPhoto_script', 'Amanuke_PP', $params ); so that's how the variable send works
* Customize javascript  /js/amanuke_prettyPhoto.js is the only javascript which can be modified . You can modified from there 

== Screenshots ==

1. WPAmaNuke prettyPhoto Admin Area
2. prettyPhoto Add Media Setting

== Support ==

Have questions or suggestions for this plugin?
= Blog Support = 
Just go to my website <a href="http://wpamanuke.com/amanuke-wp-prettyphoto-plugins/">WPAmaNuke</a> and give any suggestion in the comments
= Forum Support =
1. Please start a new thread for your question, problem, or suggestion. 
2. Please include as much information as possible like:
   WordPress version, Plugins version, a link to your web page
3. Most problems seem to be theme related so check to see if the plugin works in the default theme .

== Changelog ==
= 0.1 =
* Initial Release

== Upgrade Notice ==
= 0.1 =
* Initial Release
