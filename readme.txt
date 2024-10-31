=== Rico Ajax Menu ===
Contributors: obaq
Tags: ajax, rico, tabbed, tab, accordion, pulldown, menu, widget, sidebar, transparent, opacity, sprite, customised, customized
Requires at least: 2.7
Tested up to: 3.5.1
Stable tag: 2.1.7

== Description ==
This plugin will create a menu with tabs, accordions or pulldowns using Rico Ajax(http://openrico.org/).
Please have visit the below site for the details:
http://www.purekids.hk/blog/obaq/?p=236

May be useful to make a neat ‘About Me’, simple photo gallery and so on.

Now, you can create a widget with the menus of 'Recent Posts', 'Categories', 'Pages', 'Archives', 'Links', 'Calender' and 'Recent Comments'.

Now, the menu can have transparent effects.

Now, the accordion and pulldown menu can have sprites on the headers.

Now, the widget of accordion and pulldown menu can use a sprite image.

Now, you can set the width of a tab for Tab Menu.

Now, you can use customised header titles for [RECENTPOSTS], [CATEGORIES], [PAGES], [ARCHIVES], [LINKS], [CALENDAR] and [RECENTCOMMENTS] of the menus on the posts.

Now, you can use include a simple html file in the contents of a menu.

Now, background images can be better cached in the browsers for a faster load.

Please leave a commment at the below site if you have any problem, questions and suggestions.
http://www.purekids.hk/blog/obaq/?p=236#comment

== Installation ==
*after uploading the plugin folder, please try pointing to http://[your domain]/[your wordpress dir if any]/wp-content/plugins/rico-ajax-menu/accept.png in the browser. For example, if your domain is 'www.yourblog.com' and your wordpress directory is 'wp', it should be http://www.yourblog.com/wp/wp-content/plugins/rico-ajax-menu/accept.png. If you can't see an image and/or the plugin is not working, you need to figure out where the plugin folder is located and set up the RAMSITEPATH value in the config.php using your wordpress directory name. If your blog is under,say, "/site/", then you need to set as define("RAMSITEPATH", "/site/") in config.php;
Extract all folder and files.
Modify config.php for the site path(if you installed WordPress under subdirectory, say "/wordpress/",
then the RAMSITEPATH setting will be "/wordpress/". Normally, it is "/").
'RAMGZIPDELIVER' defines if the gzipped javascript and a style sheet will send to users' browsers.
Set 'true' to enable. (It may shorten the time to load the page but may not be necessary if the web server supports gzip deflates.)
Put your html files in 'includes' folder if you want them to be included in the menu contents.

Upload the 'rico-ajax-menu' folder and its contents to '/wp-content/plugins/'.
Go to the 'Plugins' menu of your admin area and activate the plugin.
Go to the 'Widget' menu and setup for the widget.
Please kindly let me know by posting at http://www.purekids.hk/blog/obaq/?p=236#comment
if you encounter any problem.


== Frequently Asked Questions ==
= How to set up the widget?
Go to the 'Widget' menu in the admin area and activate the 'Rico Ajax Menu' widget and set up for the colors and size. Where applicable, put images in the 'images' folder in the 'rico-ajax-menu' folder and input as, for example, 'images/yourimage.png' and so on.
Please have a look at screenshot5.png~screenshot10.png for a sample setup.

= How to insert a menu onto the post? =
You may try inserting one of the below codes and learn how the things work.
Basically, it is a simple tagging scheme. Default values will be used if the size or color settings are omitted.
If you use [RECENTPOSTS], [CATEGORIES], [PAGES], [ARCHIVES], [LINKS], [CALENDAR] or [RECENTCOMMENTS] for the contents, the according contents of at your blog will be displayed.
(If you use [RECENTPOSTS], [CATEGORIES], [PAGES], [ARCHIVES], [LINKS], [CALENDAR] or [RECENTCOMMENTS] for the titles, those could be translated if your wordpress has the translation.)
Place image files in the 'images' folder and they can be used for the background of the panels of accordion menus or the headers of pulldown menu.
You coudl make any number of [TAB*], [ACCORDION*], [PULLDOWN*] or [CONTENT*] but cannot skip the sequence, that is, you could have [TAB1], [TAB2], [TAB3] but not [TAB1], [TAB2], [TAB4]!
* from ver. 2.1.6, by using [INCLUDE]...[/INCLUDE] for the contents of a menu, you can include a simple html file placed in the 'includes' folder.
* from ver. 2.1.5, customised header titles can be used for the contents: [RECENTPOSTS], [CATEGORIES], [PAGES], [ARCHIVES], [LINKS], [CALENDAR] and [RECENTCOMMENTS] of the menus on the posts.
* from ver. 2.1.4, [TABWIDTH]...[/TABWIDTH] can set the width of a tab for Tab Menus.
* from ver. 2.1.2, by setting [BGSPRITE](the url for the sprite image)[/BGSPRITE], you can hava a sprite for the background image of the headers of accordion or pulldown menus. See the examples below.
* from ver. 2.0, the pulldown menu has [PANELHEIGHT]...[/PANELHEIGHT] and [CONTENTCOLOR]...[/CONTENTCOLOR] instead of [HEIGHT]...[/HEIGHT] and [CONTENTBGCOLOR]...[/CONTENTBGCOLOR], respectively. Please replace them accordingly.
* from ver. 2.1, all menus have a transparent settings, [OPACYTY]...[/OPACYTY](value:0~1).

Update Highlights
menujump.html, menujump4.html included
[RICOAJAXMENU]
[TABMENU]
[WIDTH][/WIDTH]
[HEIGHT]60[/HEIGHT]
[CONTENTCOLOR][/CONTENTCOLOR]
[TAB1]Jump Menu included[/TAB1]
[CONTENT1][INCLUDE]jumpmenu.html[/INCLUDE][/CONTENT1]
[TAB2]Jump Menu included(2)[/TAB2]
[CONTENT2][INCLUDE]jumpmenu4.html[/INCLUDE][/CONTENT2]
[/TABMENU]
[/RICOAJAXMENU]

menujump2.html, menujump4.html included
[RICOAJAXMENU]
[ACCORDIONMENU]
[WIDTH]300[/WIDTH]
[HEIGHT]60[/HEIGHT]
[PANELHEIGHT]23[/PANELHEIGHT]
[TEXTCOLOR]#4f4f4f[/TEXTCOLOR]
[TEXTCOLOR2]#4f4f4f[/TEXTCOLOR2]
[CONTENTCOLOR][/CONTENTCOLOR]
[BGIMAGE]images/panelbg.png[/BGIMAGE]
[BGIMAGE2]images/panelbg_hover.png[/BGIMAGE2]
[ACCORDION1]Jump Menu included[/ACCORDION1]
[CONTENT1][INCLUDE]jumpmenu2.html[/INCLUDE][/CONTENT1]
[ACCORDION2]Jump Menu included(2)[/ACCORDION2]
[CONTENT2][INCLUDE]jumpmenu4.html[/INCLUDE][/CONTENT2]
[/ACCORDIONMENU]
[/RICOAJAXMENU]

menujump3.html, menujump4.html included
[RICOAJAXMENU]
[PULLDOWNMENU]
[WIDTH][/WIDTH]
[PANELHEIGHT][/PANELHEIGHT]
[CONTENTCOLOR]white[/CONTENTCOLOR]
[PULLDOWN1]Jump Menu included[/PULLDOWN1]
[CONTENT1][INCLUDE]jumpmenu3.html[/INCLUDE][/CONTENT1]
[PULLDOWN2]Jump Menu included(2)[/PULLDOWN2]
[CONTENT2][INCLUDE]jumpmenu4.html[/INCLUDE][/CONTENT2]
[/PULLDOWNMENU]
[/RICOAJAXMENU]

Accordion Menu with the customized header titles and the standard contents:
[RICOAJAXMENU]
[ACCORDIONMENU]
[WIDTH]320[/WIDTH]
[HEIGHT]300[/HEIGHT]
[PANELHEIGHT]30[/PANELHEIGHT]
[TEXTCOLOR]lightblue[/TEXTCOLOR]
[TEXTCOLOR2]white[/TEXTCOLOR2]
[BGSPRITE]images/water.jpg[/BGSPRITE]
[CONTENTCOLOR]lightblue[/CONTENTCOLOR]
[ACCORDION1]My Posts[/ACCORDION1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[ACCORDION2]My Topics[/ACCORDION2]
[CONTENT2][CATEGORIES][/CONTENT2]
[ACCORDION3]My Pages[/ACCORDION3]
[CONTENT3][PAGES][/CONTENT3]
[ACCORDION4]Archived Materials[/ACCORDION4]
[CONTENT4][ARCHIVES][/CONTENT4]
[ACCORDION5]My Links[/ACCORDION5]
[CONTENT5][LINKS][/CONTENT5]
[ACCORDION6]Blog Calendar[/ACCORDION6]
[CONTENT6][CALENDAR][/CONTENT6]
[ACCORDION7]Comments[/ACCORDION7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/ACCORDIONMENU]
[/RICOAJAXMENU]

Pulldown Menu with the customized header titles and the standard contents:
[RICOAJAXMENU]
[PULLDOWNMENU]
[WIDTH]320[/WIDTH]
[PANELHEIGHT]34[/PANELHEIGHT]
[TEXTCOLOR]white[/TEXTCOLOR]
[BGCOLOR][/BGCOLOR]
[BORDERCOLOR][/BORDERCOLOR]
[CONTENTCOLOR]lightblue[/CONTENTCOLOR]
[BGSPRITE]images/scene.jpg[/BGSPRITE]
[CONTENTCOLOR]yellow[/CONTENTCOLOR]
[OPACITY]0.95[/OPACITY]
[PULLDOWN1]My Posts[/PULLDOWN1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[PULLDOWN2]My Topics[/PULLDOWN2]
[CONTENT2][CATEGORIES][/CONTENT2]
[PULLDOWN3]My Pages[/PULLDOWN3]
[CONTENT3][PAGES][/CONTENT3]
[PULLDOWN4]Archived Materials[/PULLDOWN4]
[CONTENT4][ARCHIVES][/CONTENT4]
[PULLDOWN5]My Links[/PULLDOWN5]
[CONTENT5][LINKS][/CONTENT5]
[PULLDOWN6]Blog Calendar[/PULLDOWN6]
[CONTENT6][CALENDAR][/CONTENT6]
[PULLDOWN7]Comments[/PULLDOWN7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/PULLDOWNMENU]
[/RICOAJAXMENU]

Tabbed Menu with the customized tab titles and the standard contents:
[RICOAJAXMENU]
[TABMENU]
[WIDTH]500[/WIDTH]
[HEIGHT]300[/HEIGHT]
[TABCOLOR]#ae0691[/TABCOLOR]
[TABTEXTCOLOR]#fdd8d3[/TABTEXTCOLOR]
[SELECTEDTABCOLOR]#7f0169[/SELECTEDTABCOLOR]
[SELECTEDTABTEXTCOLOR]#fd7cd1[/SELECTEDTABTEXTCOLOR]
[BORDERCOLOR]#4e0141[/BORDERCOLOR]
[CONTENTCOLOR]#fdd8d3[/CONTENTCOLOR]
[TAB1]My Posts[/TAB1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[TAB2]My Topics[/TAB2]
[CONTENT2][CATEGORIES][/CONTENT2]
[TAB3]My Pages[/TAB3]
[CONTENT3][PAGES][/CONTENT3]
[TAB4]Archives[/TAB4]
[CONTENT4][ARCHIVES][/CONTENT4]
[TAB5]My Links[/TAB5]
[CONTENT5][LINKS][/CONTENT5]
[TAB6]Calendar[/TAB6]
[CONTENT6][CALENDAR][/CONTENT6]
[TAB7]Comments[/TAB7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/TABMENU]
[/RICOAJAXMENU]

For a tabbed menu,
(1)
[RICOAJAXMENU]
[TABMENU]
[TAB1]Tab Name1[/TAB1]
[CONTENT1]Content1 Content1 Content1...[/CONTENT1]
[TAB2]Tab Name2[/TAB2]
[CONTENT2]Content2 Content2 Content2...[/CONTENT2]
[TAB3]Tab Name3[/TAB3]
[CONTENT3]Content3 Content3 Content3...[/CONTENT3]
[TAB4]Tab Name4[/TAB4]
[CONTENT4]Content4 Content4 Content4...[/CONTENT4]
[TAB5]Tab Name5[/TAB5]
[CONTENT5]Content5 Content5 Content5...[/CONTENT5]
[/TABMENU]
[/RICOAJAXMENU]

(2)
[RICOAJAXMENU]
[TABMENU]
[WIDTH]400[/WIDTH]
[HEIGHT]200[/HEIGHT]
[TABCOLOR]lightgreen[/TABCOLOR]
[TABTEXTCOLOR]green[/TABTEXTCOLOR]
[SELECTEDTABCOLOR]green[/SELECTEDTABCOLOR]
[SELECTEDTABTEXTCOLOR]white[/SELECTEDTABTEXTCOLOR]
[BORDERCOLOR]lime[/BORDERCOLOR]
[CONTENTCOLOR]lightgreen[/CONTENTCOLOR]
[TAB1]Tab Name1[/TAB1]
[CONTENT1]Content1 Content1 Content1...[/CONTENT1]
[TAB2]Tab Name2[/TAB2]
[CONTENT2]Content2 Content2 Content2...[/CONTENT2]
[TAB3]Tab Name3[/TAB3]
[CONTENT3]Content3 Content3 Content3...[/CONTENT3]
[TAB4]Tab Name4[/TAB4]
[CONTENT4]Content4 Content4 Content4...[/CONTENT4]
[TAB5]Tab Name5[/TAB5]
[CONTENT5]Content5 Content5 Content5...[/CONTENT5]
[/TABMENU]
[/RICOAJAXMENU]

(3)
[RICOAJAXMENU]
[TABMENU]
[WIDTH]100%[/WIDTH]
[HEIGHT]400[/HEIGHT]
[TABCOLOR]#ae0691[/TABCOLOR]
[TABTEXTCOLOR]#fdd8d3[/TABTEXTCOLOR]
[SELECTEDTABCOLOR]#7f0169[/SELECTEDTABCOLOR]
[SELECTEDTABTEXTCOLOR]#fd7cd1[/SELECTEDTABTEXTCOLOR]
[BORDERCOLOR]#4e0141[/BORDERCOLOR]
[CONTENTCOLOR]#fdd8d3[/CONTENTCOLOR]
[TAB1][RECENTPOSTS][/TAB1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[TAB2][CATEGORIES][/TAB2]
[CONTENT2][CATEGORIES][/CONTENT2]
[TAB3][PAGES][/TAB3]
[CONTENT3][PAGES][/CONTENT3]
[TAB4][ARCHIVES][/TAB4]
[CONTENT4][ARCHIVES][/CONTENT4]
[TAB5][LINKS][/TAB5]
[CONTENT5][LINKS][/CONTENT5]
[TAB6][CALENDAR][/TAB6]
[CONTENT6][CALENDAR][/CONTENT6]
[TAB7][RECENTCOMMENTS][/TAB7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/TABMENU]
[/RICOAJAXMENU]

For a according menu
(1)
[RICOAJAXMENU]
[ACCORDIONMENU]
[ACCORDION1]Accordion Name1[/ACCORDION1]
[CONTENT1]Content1 Content1 Content1...[/CONTENT1]
[ACCORDION2]Accordion Name2[/ACCORDION2]
[CONTENT2]Content2 Content2 Content2...[/CONTENT2]
[ACCORDION3]Accordion Name3[/ACCORDION3]
[CONTENT3]Content3 Content3 Content3...[/CONTENT3]
[ACCORDION4]Accordion Name4[/ACCORDION4]
[CONTENT4]Content4 Content4 Content4...[/CONTENT4]
[ACCORDION5]Accordion Name5[/ACCORDION5]
[CONTENT5]Content5 Content5 Content5...[/CONTENT5]
[/ACCORDIONMENU]
[/RICOAJAXMENU]

(2)
[RICOAJAXMENU]
[ACCORDIONMENU]
[WIDTH]400[/WIDTH]
[HEIGHT]200[/HEIGHT]
[TEXTCOLOR]red[/TEXTCOLOR]
[BGCOLOR]orange[/BGCOLOR]
[TEXTCOLOR2]white[/TEXTCOLOR2]
[BGCOLOR2]orange[/BGCOLOR2]
[CONTENTCOLOR]lightpink[/CONTENTCOLOR]
[ACCORDION1]Accordion Name1[/ACCORDION1]
[CONTENT1]Content1 Content1 Content1...[/CONTENT1]
[ACCORDION2]Accordion Name2[/ACCORDION2]
[CONTENT2]Content2 Content2 Content2...[/CONTENT2]
[ACCORDION3]Accordion Name3[/ACCORDION3]
[CONTENT3]Content3 Content3 Content3...[/CONTENT3]
[ACCORDION4]Accordion Name4[/ACCORDION4]
[CONTENT4]Content4 Content4 Content4...[/CONTENT4]
[ACCORDION5]Accordion Name5[/ACCORDION5]
[CONTENT5]Content5 Content5 Content5...[/CONTENT5]
[/ACCORDIONMENU]
[/RICOAJAXMENU]

(3)
[RICOAJAXMENU]
[ACCORDIONMENU]
[WIDTH]300[/WIDTH]
[HEIGHT]300[/HEIGHT]
[PANELHEIGHT]23[/PANELHEIGHT]
[TEXTCOLOR]#4f4f4f[/TEXTCOLOR]
[TEXTCOLOR2]#4f4f4f[/TEXTCOLOR2]
[CONTENTCOLOR][/CONTENTCOLOR]
[BGIMAGE]images/panelbg.png[/BGIMAGE]
[BGIMAGE2]images/panelbg_hover.png[/BGIMAGE2]
[ACCORDION1][RECENTPOSTS][/ACCORDION1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[ACCORDION2][CATEGORIES][/ACCORDION2]
[CONTENT2][CATEGORIES][/CONTENT2]
[ACCORDION3][PAGES][/ACCORDION3]
[CONTENT3][PAGES][/CONTENT3]
[ACCORDION4][ARCHIVES][/ACCORDION4]
[CONTENT4][ARCHIVES][/CONTENT4]
[ACCORDION5][LINKS][/ACCORDION5]
[CONTENT5][LINKS][/CONTENT5]
[ACCORDION6][CALENDAR][/ACCORDION6]
[CONTENT6][CALENDAR][/CONTENT6]
[ACCORDION7][RECENTCOMMENTS][/ACCORDION7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/ACCORDIONMENU]
[/RICOAJAXMENU]

Accordion Menu with Sprites
[RICOAJAXMENU]
[ACCORDIONMENU]
[WIDTH]164[/WIDTH]
[TEXTCOLOR]blue[/TEXTCOLOR]
[TEXTCOLOR2]purple[/TEXTCOLOR2]
[BGSPRITE]images/csssprite.gif[/BGSPRITE]
[CONTENTCOLOR]pink[/CONTENTCOLOR]
[ACCORDION1]Accordion1[/ACCORDION1]
[CONTENT1]Content1 Content1 Content1...[/CONTENT1]
[ACCORDION2]Accordion2[/ACCORDION2]
[CONTENT2]Content2 Content2 Content2...[/CONTENT2]
[ACCORDION3]Accordion3[/ACCORDION3]
[CONTENT3]Content3 Content3 Content3...[/CONTENT3]
[ACCORDION4]Accordion4[/ACCORDION4]
[CONTENT4]Content4 Content4 Content4...[/CONTENT4]
[ACCORDION5]Accordion5[/ACCORDION5]
[CONTENT5]Content5 Content5 Content5...[/CONTENT5]
[ACCORDION6]Accordion6[/ACCORDION6]
[CONTENT6]Content6 Content6 Content6...[/CONTENT6]
[ACCORDION7]Accordion7[/ACCORDION7]
[CONTENT7]Content7 Content7 Content7...[/CONTENT7]
[ACCORDION8]Accordion8[/ACCORDION8]
[CONTENT8]Content8 Content8 Content8...[/CONTENT8]
[/ACCORDIONMENU]
[/RICOAJAXMENU]


[RICOAJAXMENU]
[ACCORDIONMENU]
[WIDTH]205[/WIDTH]
[PANELHEIGHT]30[/PANELHEIGHT]
[TEXTCOLOR]blue[/TEXTCOLOR]
[TEXTCOLOR2]purple[/TEXTCOLOR2]
[BGSPRITE]images/orange_slice.jpg[/BGSPRITE]
[CONTENTCOLOR]orange[/CONTENTCOLOR]
[ACCORDION1][RECENTPOSTS][/ACCORDION1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[ACCORDION2][CATEGORIES][/ACCORDION2]
[CONTENT2][CATEGORIES][/CONTENT2]
[ACCORDION3][PAGES][/ACCORDION3]
[CONTENT3][PAGES][/CONTENT3]
[ACCORDION4][ARCHIVES][/ACCORDION4]
[CONTENT4][ARCHIVES][/CONTENT4]
[ACCORDION5][LINKS][/ACCORDION5]
[CONTENT5][LINKS][/CONTENT5]
[ACCORDION6][CALENDAR][/ACCORDION6]
[CONTENT6][CALENDAR][/CONTENT6]
[ACCORDION7][RECENTCOMMENTS][/ACCORDION7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/ACCORDIONMENU]
[/RICOAJAXMENU]


[RICOAJAXMENU]
[ACCORDIONMENU]
[WIDTH]205[/WIDTH]
[PANELHEIGHT]30[/PANELHEIGHT]
[TEXTCOLOR]blue[/TEXTCOLOR]
[TEXTCOLOR2]purple[/TEXTCOLOR2]
[BGSPRITE]images/lemon_slice.jpg[/BGSPRITE]
[CONTENTCOLOR]yellow[/CONTENTCOLOR]
[ACCORDION1][RECENTPOSTS][/ACCORDION1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[ACCORDION2][CATEGORIES][/ACCORDION2]
[CONTENT2][CATEGORIES][/CONTENT2]
[ACCORDION3][PAGES][/ACCORDION3]
[CONTENT3][PAGES][/CONTENT3]
[ACCORDION4][ARCHIVES][/ACCORDION4]
[CONTENT4][ARCHIVES][/CONTENT4]
[ACCORDION5][LINKS][/ACCORDION5]
[CONTENT5][LINKS][/CONTENT5]
[ACCORDION6][CALENDAR][/ACCORDION6]
[CONTENT6][CALENDAR][/CONTENT6]
[ACCORDION7][RECENTCOMMENTS][/ACCORDION7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/ACCORDIONMENU]
[/RICOAJAXMENU]



For a pulldown menu,
(1)
[RICOAJAXMENU]
[PULLDOWNMENU]
[CONTENTCOLOR]white[/CONTENTCOLOR]
[PULLDOWN1]Pulldown Name1[/PULLDOWN1]
[CONTENT1]Content1 Content1 Content1...[/CONTENT1]
[PULLDOWN2]Pulldown Name2[/PULLDOWN2]
[CONTENT2]Content2 Content2 Content2...[/CONTENT2]
[PULLDOWN3]Pulldown Name3[/PULLDOWN3]
[CONTENT3]Content3 Content3 Content3...[/CONTENT3]
[PULLDOWN4]Pulldown Name4[/PULLDOWN4]
[CONTENT4]Content4 Content4 Content4...[/CONTENT4]
[PULLDOWN5]Pulldown Name5[/PULLDOWN5]
[CONTENT5]Content5 Content5 Content5...[/CONTENT5]
[/PULLDOWNMENU]
[/RICOAJAXMENU]

(2)
[RICOAJAXMENU]
[PULLDOWNMENU]
[WIDTH]100%[/WIDTH]
[PANELHEIGHT]30[/PANELHEIGHT]
[TEXTCOLOR]lightblue[/TEXTCOLOR]
[BGCOLOR]navy[/BGCOLOR]
[BORDERCOLOR]lightblue[/BORDERCOLOR]
[CONTENTCOLOR]lightblue[/CONTENTCOLOR]
[PULLDOWN1]Pulldown Name1[/PULLDOWN1]
[CONTENT1]Content1 Content1 Content1...[/CONTENT1]
[PULLDOWN2]Pulldown Name2[/PULLDOWN2]
[CONTENT2]Content2 Content2 Content2...[/CONTENT2]
[PULLDOWN3]Pulldown Name3[/PULLDOWN3]
[CONTENT3]Content3 Content3 Content3...[/CONTENT3]
[PULLDOWN4]Pulldown Name4[/PULLDOWN4]
[CONTENT4]Content4 Content4 Content4...[/CONTENT4]
[PULLDOWN5]Pulldown Name5[/PULLDOWN5]
[CONTENT5]Content5 Content5 Content5...[/CONTENT5]
[/PULLDOWNMENU]
[/RICOAJAXMENU]

(3)
[RICOAJAXMENU]
[PULLDOWNMENU]
[WIDTH]300[/WIDTH]
[PANELHEIGHT]30[/PANELHEIGHT]
[OPACITY]0.95[/OPACITY]
[TEXTCOLOR]#fd7cd1[/TEXTCOLOR]
[BGCOLOR]#7f0169[/BGCOLOR]
[BORDERCOLOR]#4e0141[/BORDERCOLOR]
[CONTENTCOLOR]#fdd8d3[/CONTENTCOLOR]
[ARROWIMAGE]images/vNext.png[/ARROWIMAGE]
[PULLDOWN1][RECENTPOSTS][/PULLDOWN1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[PULLDOWN2][CATEGORIES][/PULLDOWN2]
[CONTENT2][CATEGORIES][/CONTENT2]
[PULLDOWN3][PAGES][/PULLDOWN3]
[CONTENT3][PAGES][/CONTENT3]
[PULLDOWN4][ARCHIVES][/PULLDOWN4]
[CONTENT4][ARCHIVES][/CONTENT4]
[PULLDOWN5][LINKS][/PULLDOWN5]
[CONTENT5][LINKS][/CONTENT5]
[PULLDOWN6][CALENDAR][/PULLDOWN6]
[CONTENT6][CALENDAR][/CONTENT6]
[PULLDOWN7][RECENTCOMMENTS][/PULLDOWN7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/PULLDOWNMENU]
[/RICOAJAXMENU]


Pulldown Menu with Sprites
[RICOAJAXMENU]
[PULLDOWNMENU]
[WIDTH]206[/WIDTH]
[PANELHEIGHT]34[/PANELHEIGHT]
[BGSPRITE]images/orange_slice.jpg[/BGSPRITE]
[CONTENTCOLOR]orange[/CONTENTCOLOR]
[PULLDOWN1]Pulldown1[/PULLDOWN1]
[PULLDOWN1][RECENTPOSTS][/PULLDOWN1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[PULLDOWN2][CATEGORIES][/PULLDOWN2]
[CONTENT2][CATEGORIES][/CONTENT2]
[PULLDOWN3][PAGES][/PULLDOWN3]
[CONTENT3][PAGES][/CONTENT3]
[PULLDOWN4][ARCHIVES][/PULLDOWN4]
[CONTENT4][ARCHIVES][/CONTENT4]
[PULLDOWN5][LINKS][/PULLDOWN5]
[CONTENT5][LINKS][/CONTENT5]
[PULLDOWN6][CALENDAR][/PULLDOWN6]
[CONTENT6][CALENDAR][/CONTENT6]
[PULLDOWN7][RECENTCOMMENTS][/PULLDOWN7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/PULLDOWNMENU]
[/RICOAJAXMENU]


[RICOAJAXMENU]
[PULLDOWNMENU]
[WIDTH]206[/WIDTH]
[PANELHEIGHT]34[/PANELHEIGHT]
[BGSPRITE]images/lemon_slice.jpg[/BGSPRITE]
[CONTENTCOLOR]yellow[/CONTENTCOLOR]
[PULLDOWN1][RECENTPOSTS][/PULLDOWN1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[PULLDOWN2][CATEGORIES][/PULLDOWN2]
[CONTENT2][CATEGORIES][/CONTENT2]
[PULLDOWN3][PAGES][/PULLDOWN3]
[CONTENT3][PAGES][/CONTENT3]
[PULLDOWN4][ARCHIVES][/PULLDOWN4]
[CONTENT4][ARCHIVES][/CONTENT4]
[PULLDOWN5][LINKS][/PULLDOWN5]
[CONTENT5][LINKS][/CONTENT5]
[PULLDOWN6][CALENDAR][/PULLDOWN6]
[CONTENT6][CALENDAR][/CONTENT6]
[PULLDOWN7][RECENTCOMMENTS][/PULLDOWN7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/PULLDOWNMENU]
[/RICOAJAXMENU]


[RICOAJAXMENU]
[PULLDOWNMENU]
[WIDTH]320[/WIDTH]
[PANELHEIGHT]34[/PANELHEIGHT]
[TEXTCOLOR]white[/TEXTCOLOR]
[CONTENTCOLOR]lightblue[/CONTENTCOLOR]
[BGSPRITE]images/scene.jpg[/BGSPRITE]
[CONTENTCOLOR]yellow[/CONTENTCOLOR]
[OPACITY]0.95[/OPACITY]
[PULLDOWN1][RECENTPOSTS][/PULLDOWN1]
[CONTENT1][RECENTPOSTS][/CONTENT1]
[PULLDOWN2][CATEGORIES][/PULLDOWN2]
[CONTENT2][CATEGORIES][/CONTENT2]
[PULLDOWN3][PAGES][/PULLDOWN3]
[CONTENT3][PAGES][/CONTENT3]
[PULLDOWN4][ARCHIVES][/PULLDOWN4]
[CONTENT4][ARCHIVES][/CONTENT4]
[PULLDOWN5][LINKS][/PULLDOWN5]
[CONTENT5][LINKS][/CONTENT5]
[PULLDOWN6][CALENDAR][/PULLDOWN6]
[CONTENT6][CALENDAR][/CONTENT6]
[PULLDOWN7][RECENTCOMMENTS][/PULLDOWN7]
[CONTENT7][RECENTCOMMENTS][/CONTENT7]
[/PULLDOWNMENU]
[/RICOAJAXMENU]


*You could edit the content of each menu in the 'Visual' editor in WordPress in most of the cases.
However, this plugin may not be flexible enogh to reflect the format of your post in some themes.
*The color customisation and the content formatting could mostly work. But please kindly understand that this plugin may not be confortable with some themes. Be flexible and you can take the most of Rico Ajax Menu plugin!


= The flash video may or may not be displayed in the pulldown menu? =
This may be due to the issue of html layer, video embedding method and browsers.

= The image and/or flash video won't be centered? =
Some themes may have this problem especially when inserting them using other plugins.
For positioning, formatting with <div> or <table> may help.

== Screenshots ==
1. screenshot-1.png: a customised tabbed menu.
2. screenshot-2.png: an accordion menu with customised panels.
3. screenshot-3.png: a customised pulldown menu.
4. screenshot-4.png: the settings for a widget.
5. screenshot-5.png: a resulting widget.
6. screenshot-6.png: a sample tab menu widget setting.
7. screenshot-7.png: the resulting tab menu.
8. screenshot-8.png: a sample accordion menu widget setting.
9. screenshot-9.png: a resulting accordion menu.
10. screenshot-10.png: a sample pulldown menu widget setting.
11. screenshot-11.png: a resulting pulldown menu.

== Changelog ==
= 2.1.7 =
* fixed bug relating '$', a feature to add Expires header to background images for browser cache.

= 2.1.6 =
* added a feature to be able to include a simple html file placed in 'includes' folder.

= 2.1.5 =
* allowed customised header titles for the contents: [RECENTPOSTS], [CATEGORIES], [PAGES], [ARCHIVES], [LINKS], [CALENDAR] and [RECENTCOMMENTS] of the menus on the posts.

= 2.1.4 =
* added the setting for the width of a tab for Tab Menus.

= 2.1.3 =
* added the sprite image feature to the widget.

= 2.1.2 =
* added a feature for [BGSPRITE]

= 2.1.1 =
* added a feature for [CALENDAR] and [RECENTCOMMENTS]

= 2.1 =
* added the opacity settings, changed the default color values.

= 2.0 =
* added a feature to create a widget in the sidebar.

= 1.0 =
* 1.0 is the beginning of the version.

== Upgrade Notice ==
= 2.1.7 =
* Please deactivate the previous version before activating the current version. Please clear the browser cache.

= 2.1.6 =
* Deactivate the previous version and activate the current version

= 2.1.5 =
* Deactivate the previous version and activate the current version

= 2.1.4 =
* Deactivate the previous version and activate the current version

= 2.1.3 =
* Deactivate the previous version and activate the current version

= 2.1.2 =
* Deactivate the previous version and activate the current version

= 2.1.1 =
* Deactivate the previous version and activate the current version

= 2.1 =
* Deactivate the previous version and activate the current version

= 2.0 =
* Deactivate the previous ver. and activate ver.2.0
* the pulldown menu has [PANELHEIGHT]...[/PANELHEIGHT] and [CONTENTCOLOR]...[/CONTENTCOLOR] instead of [HEIGHT]...[/HEIGHT] and [CONTENTBGCOLOR]...[/CONTENTBGCOLOR], respectively. Please replace them accordingly.

= 1.0 =
* 1.0 is the beginning of the version.
