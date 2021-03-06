# Feature Post by ID

A little plugin written for Viewpoint Magazine. It displays posts in the sidebar of viewpointmag.com. 

## Installation

[Refer to Wordpress guide on installing Wordpress plugins](https://codex.wordpress.org/Managing_Plugins#Manual_Plugin_Installation)

## Usage

After activating the plugin, navigate to **Appearance > Widgets** in the WordPress Administration Screens. The plugin creates a widget area titled "Feature Posts by ID widget area" and a widget titled "Feature Post by ID". Drag the widget into the widget area. Title the featured post in the "Title" field and enter the post ID in the "Post ID" field. To get a post's ID, open the post up in the Wordpress editor and take a close look at your browser's URL bar. You'll see a URL which looks something like this: 
~~~~
https://viewpointmag.com/wp-admin/post.php?post=6613&action=edit
~~~~
The numbers after 
~~~~
post.php?post=
~~~~
are the post's ID. In this case, the post's ID is **6613**. Copy the post ID and paste it into the Feature Post by ID widget.

## History

**0.1.2**
* Tweaked CSS spacing
* Standardized widget title, widget now named "Feature Post By ID"

**0.1.1**
* Fixed css for mobile
* Credited tutorial in README.md
* Fixed ugly clump of PHP echoes

**0.1**
* First version committed!

## License

[CC by 2.0](https://creativecommons.org/licenses/by/2.0/). Thanks to WPExplorer.com for [the tutorial](http://www.wpexplorer.com/create-widget-plugin-wordpress/).
