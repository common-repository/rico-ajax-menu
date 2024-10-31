<?php
/*
Plugin Name: Rico Ajax Menu
Plugin URI: http://obaqblog.blogspot.com/2010/06/rico-ajax-menu-plugin-for-wordpress.html
Description: create a menu using Rico Ajax
Version: 2.1.7
Author: obaq
Author URI: http://obaqblog.blogspot.com/
*/
global $rico_ajax_menu_script_added, $rico_ajax_menu_tab_added,
$rico_ajax_menu_accordion_added, $rico_ajax_menu_pulldown_added, $ricopath, $ricotabid, $accordionid, $ricopulldownid,
$tabcount, $accordioncount, $pulldowncount, $RAMsettings, $tabheight;
$rico_ajax_menu_script_added=false;
$rico_ajax_menu_tab_added=false;
$rico_ajax_menu_accordion_added=false;
$rico_ajax_menu_pulldown_added=false;
$tabcount=0;
$accordioncount=0;
$pulldowncount=0;
$tabheight=array();
$ricotabid=array();
$accordionid=array();
$ricopulldownid=array();
require_once(dirname(__FILE__).'/config.php');
require_once('tabtemp.php');
require_once('ricotemp.php');
require_once('functions.php');
function rico_ajax_menu_on_page($text, $iswidget=false) {
    $regex = '#\[RICOAJAXMENU]((?:[^\[]|\[(?!/?RICOAJAXMENU])|(?R))+)\[/RICOAJAXMENU]#';
    if (is_array($text)) {
        global $rico_ajax_menu_script_added, $ricopath;
        $ricopath = RAMgetPathURL(RAMSITEPATH).(RAMGZIPDELIVER?"/gzipdeliver.php?file=":"/");
        $server=null;
        $dir=null;
        $menu = RAMregex($text[1],"TABMENU");
        if($menu) {
            global $ricotabid,$tabheight,$tabcount;
            $ricotabid[$tabcount]=rand();
            $RAMsettings=RAMSetting($menu, array("WIDTH","HEIGHT","TABWIDTH","TABCOLOR","TABTEXTCOLOR",
                    "SELECTEDTABCOLOR","SELECTEDTABTEXTCOLOR","CONTENTCOLOR","BORDERCOLOR","OPACITY"));
            if(!$rico_ajax_menu_script_added) {
                add_action('wp_footer', 'loadRicoBaseFooter');
                $rico_ajax_menu_script_added=true;
            }
            $tabheight[$tabcount]=$RAMsettings['HEIGHT'];
            add_action('wp_footer', 'RAMtabScriptFooter');

            $rico=RAMtabTemp($ricotabid[$tabcount], $RAMsettings['OPACITY']);
            $rico=preg_replace("/%%PATH%%/",$ricopath, $rico);
            $rico = preg_replace("/%%WIDTH%%/", (!preg_match("/%$/",$RAMsettings['WIDTH'])?$RAMsettings['WIDTH']."px":$RAMsettings['WIDTH']), $rico);
            $rico = preg_replace("/%%HEIGHT%%/", $RAMsettings['HEIGHT'], $rico);
            $tab_array=RAMComponents($menu,"TAB");
            $rico = preg_replace("/%%HEADERWIDTH%%/", ($RAMsettings['TABWIDTH']?
                    "width:".(is_numeric($RAMsettings['TABWIDTH'])?$RAMsettings['TABWIDTH']."px":$RAMsettings['TABWIDTH']).";"
                    :"width:".($iswidget?"32%;":(count($tab_array)<5?"24%":"19%").";")), $rico);
            $rico = preg_replace("/%%TABCOLOR%%/", $RAMsettings['TABCOLOR'], $rico);
            $rico = preg_replace("/%%TABTEXTCOLOR%%/", $RAMsettings['TABTEXTCOLOR'], $rico);
            $rico = preg_replace("/%%HOVERCOLOR%%/", $RAMsettings['HOVERTEXTCOLOR'], $rico);
            $rico = preg_replace("/%%SELECTEDTABCOLOR%%/", $RAMsettings['SELECTEDTABCOLOR'], $rico);
            $rico = preg_replace("/%%SELECTEDTABTEXTCOLOR%%/", $RAMsettings['SELECTEDTABTEXTCOLOR'], $rico);
            $rico = preg_replace("/%%CONTENTBG%%/", ($RAMsettings['CONTENTBGIMAGE']?"background-image:url('".$RAMsettings['CONTENTBGIMAGE']."');":($RAMsettings['CONTENTCOLOR']?"background-color:".$RAMsettings['CONTENTCOLOR'].";":"")), $rico);
            $rico = preg_replace("/%%BORDERCOLOR%%/", $RAMsettings['BORDERCOLOR'], $rico);
            $tabs="";
            $contents="";
            $tabs=RAMgetLink($tab_array,array(title=>'<div class="panelheader'.$ricotabid[$tabcount].'">%%TITLE%%</div>',
                    content=>'<div class="panelContent'.$ricotabid[$tabcount].'">%%CONTENT%%</div>'));
            $tab_array=null;
            $tabs['title']=preg_replace("/\\$/","\\\\$",$tabs['title']);
            $rico=preg_replace("/%%TABS%%/",$tabs['title'],$rico);
            $tabs['content']=preg_replace("/\\$/","\\\\$",$tabs['content']);
            $rico=preg_replace("/%%CONTENTS%%/",$tabs['content'],$rico);
            $tabs=null;
            $text=$rico;
            $rico=null;
            $tabcount++;
        } else {
            $menu = RAMregex($text[1],"ACCORDIONMENU");
            if($menu) {
                global $accordionid, $accordioncount;
                $accordionid[$accordioncount]['id']=rand();
                $RAMsettings=RAMSetting($menu, array("WIDTH","HEIGHT","PANELHEIGHT",
                        "BGSPRITE", "BGIMAGE", "TEXTCOLOR","BGCOLOR","TEXTCOLOR2",
                        "BGCOLOR2","BGIMAGE2","BORDERCOLOR","CONTENTCOLOR","OPACITY"));
                $accordion_array=RAMComponents($menu, "ACCORDION");
                $temp="";
                if(!$rico_ajax_menu_script_added) {
                    add_action('wp_footer', 'loadRicoBaseFooter');
                    $rico_ajax_menu_script_added=true;
                }
                $accordionid[$accordioncount]['height']=$RAMsettings['HEIGHT'];
                add_action('wp_footer', 'loadAccordionModuleFooter');
                $temp.=loadColor($accordionid[$accordioncount]['id'], $RAMsettings);
                $temp.=makeAccordion($accordionid[$accordioncount]['id'], $accordion_array,$RAMsettings['PANELHEIGHT'],$RAMsettings['BGSPRITE']);
                $text=$temp;
                $accordioncount++;
                $temp=null;
                $accordion_array=null;
            } else {
                $menu = RAMregex($text[1],"PULLDOWNMENU");
                if($menu) {
                    global $rico_ajax_menu_pulldown_added,$ricopulldownid, $pulldowncount;
                    $ricopulldownid[$pulldowncount]['id']=rand();
                    $RAMsettings=RAMSetting($menu, array("WIDTH", "PANELHEIGHT", "TEXTCOLOR",
                            "BGCOLOR", "BGSPRITE", "ARROWIMAGE", "BORDERCOLOR", "CONTENTCOLOR", "OPACITY"));
                    $pulldowns=RAMComponents($menu, "PULLDOWN");
                    $i=0;
                    $output="";
                    if(!$rico_ajax_menu_script_added) {
                        add_action('wp_footer', 'loadRicoBaseFooter');
                    }
                    $rico_ajax_menu_script_added=true;
                    $output.=pulldownCSS($ricopath);
                    add_action('wp_footer', 'loadPulldownModuleFooter');
                    $rico_ajax_menu_pulldown_added=true;
                    $ricopulldownid[$pulldowncount]['pulldowns']=count($pulldowns);
                    add_action('wp_footer', 'insertPulldownVarMultiFooter');
                    $output.=insertPulldownMulti($ricopulldownid[$pulldowncount], RAMgetPathURL(RAMSITEPATH)."/",
                            $RAMsettings, $pulldowns);
                    $pulldowncount++;
                    $pulldowns=null;
                    $text=$output;
                    $output=null;
                }
            }
        }
        $menu=null;
        add_action('wp_footer', 'RAMadditional');
    }
    if($iswidget) {
        return $text;
    }else {
        return preg_replace_callback($regex, 'rico_ajax_menu_on_page', $text);
    }
}
function rico_ajax_menu_widget_init() {
    wp_register_sidebar_widget(RICO_AJAX_MENU_WIDGET_ID,
            __('Rico Ajax Menu'),'rico_ajax_menu_widget');
    wp_register_widget_control(RICO_AJAX_MENU_WIDGET_ID,
            __('Rico Ajax Menu'),'rico_ajax_menu_widget_control');
}
function rico_ajax_menu_widget($args) {
    extract($args, EXTR_SKIP);
    $options = get_option(RICO_AJAX_MENU_WIDGET_ID);
    $output=array();
    $output[1]="[RICOAJAXMENU]\n";
    $menu=strtolower($options['menu']);
    switch($menu) {
        case "tab" :
            $output[1].="[TABMENU]\n";
            break;
        case "accordion":
            $output[1].="[ACCORDIONMENU]\n";
        case "pulldown":
            $output[1].="[PULLDOWNMENU]\n";
    }
    $output[1].="[WIDTH]".$options['width']."[/WIDTH]\n";
    $output[1].="[HEIGHT]".$options['height']."[/HEIGHT]\n";
    $output[1].="[CONTENTCOLOR]".$options['contentcolor']."[/CONTENTCOLOR]\n";
    $output[1].="[BORDERCOLOR]".$options['bordercolor']."[/BORDERCOLOR]\n";
    $output[1].="[OPACITY]".$options['opacity']."[/OPACITY]\n";
    switch(strtolower($options['menu'])) {
        case "tab" :
            $output[1].="[TABCOLOR]".$options['tabcolor']."[/TABCOLOR]\n";
            $output[1].="[TABTEXTCOLOR]".$options['tabtextcolor']."[/TABTEXTCOLOR]\n";
            $output[1].="[HOVERTEXTCOLOR]".$options['hovertextcolor']."[/HOVERTEXTCOLOR]\n";
            $output[1].="[SELECTEDTABCOLOR]".$options['selectedtabcolor']."[/SELECTEDTABCOLOR]\n";
            $output[1].="[SELECTEDTABTEXTCOLOR]".$options['selectedtabtextcolor']."[/SELECTEDTABTEXTCOLOR]\n";
            break;
        case "accordion" :
            $output[1].="[PANELHEIGHT]".$options['panelheight']."[/PANELHEIGHT]\n";
            $output[1].="[TEXTCOLOR]".$options['textcolor']."[/TEXTCOLOR]\n";
            $output[1].="[BGCOLOR]".$options['bgcolor']."[/BGCOLOR]\n";
            $output[1].="[BGCOLOR]".$options['bgcolor']."[/BGCOLOR]\n";
            $output[1].="[BGSPRITE]".$options['bgsprite']."[/BGSPRITE]\n";
            $output[1].="[TEXTCOLOR2]".$options['textcolor2']."[/TEXTCOLOR2]\n";
            $output[1].="[BGCOLOR2]".$options['bgcolor2']."[/BGCOLOR2]\n";
            $output[1].="[BGIMAGE2]".$options['bgimage2']."[/BGIMAGE2]\n";
            break;
        case "pulldown" :
            $output[1].="[PANELHEIGHT]".$options['panelheight']."[/PANELHEIGHT]\n";
            $output[1].="[TEXTCOLOR]".$options['textcolor']."[/TEXTCOLOR]";
            $output[1].="[BGCOLOR]".$options['bgcolor']."[/BGCOLOR]";
            $output[1].="[ARROWIMAGE]".$options['arrowimage']."[/ARROWIMAGE]";
            $output[1].="[BGSPRITE]".$options['bgsprite']."[/BGSPRITE]\n";
            break;
    }
    $c=1;
    $component=($menu=="tab"?"TAB":($menu=="accordion"?"ACCORDION":"PULLDOWN"));
    for($i=0;$i<7;$i++) {
        $sw=strtolower($options['menu'.($i+1)]);
        if($sw!="none") {
            switch($sw) {
                case "recent":
                    $m="RECENTPOSTS";
                    break;
                case "categories":
                    $m="CATEGORIES";
                    break;
                case "pages":
                    $m="PAGES";
                    break;
                case "archives":
                    $m="ARCHIVES";
                    break;
                case "links":
                    $m="LINKS";
                    break;
                case "calendar":
                    $m="CALENDAR";
                    break;
                case "comments":
                    $m="RECENTCOMMENTS";
                    break;
            }
            $output[1].="[".$component.$c."][".$m."][/".$component.$c."]\n";
            $output[1].="[CONTENT".$c."][".$m."][/CONTENT".$c."]\n";
            $c++;
        }
    }
    switch(strtolower($options['menu'])) {
        case "tab" :
            $output[1].="[/TABMENU]\n";
            break;
        case "accordion":
            $output[1].="[/ACCORDIONMENU]\n";
        case "pulldown":
            $output[1].="[/PULLDOWNMENU]\n";
    }
    $output[1].="[/RICOAJAXMENU]\n";
    echo $before_widget;
    echo rico_ajax_menu_on_page($output,true);
    echo $after_widget;
}
function rico_ajax_menu_widget_control() {
    $widget_data = $_POST[RICO_AJAX_MENU_WIDGET_ID];
    if($widget_data['submit']) {
        $options['menu'] = $widget_data['menu'];
        $options['width'] = $widget_data['width'];
        $options['height'] = $widget_data['height'];
        $options['bordercolor'] = $widget_data['bordercolor'];
        $options['contentcolor'] = $widget_data['contentcolor'];
        $options['opacity'] = $widget_data['opacity'];
        switch(strtolower($options['menu'])) {
            case "tab" :
                $options['tabcolor'] = $widget_data['tabcolor'];
                $options['tabtextcolor'] = $widget_data['tabtextcolor'];
                $options['selectedtabcolor'] = $widget_data['selectedtabcolor'];
                $options['selectedtabtextcolor'] = $widget_data['selectedtabtextcolor'];
                break;
            case "accordion" :
                $options['panelheight'] = $widget_data['panelheight'];
                $options['textcolor'] = $widget_data['textcolor'];
                $options['bgcolor'] = $widget_data['bgcolor'];
                $options['bgsprite'] = $widget_data['bgsprite'];
                $options['bgimage'] = $widget_data['bgimage'];
                $options['textcolor2'] = $widget_data['textcolor2'];
                $options['bgcolor2'] = $widget_data['bgcolor2'];
                $options['bgimage2'] = $widget_data['bgimage2'];
                break;
            case "pulldown" :
                $options['panelheight'] = $widget_data['pulldownpanelheight'];
                $options['textcolor'] = $widget_data['pulldowntextcolor'];
                $options['bgcolor'] = $widget_data['pulldownbgcolor'];
                $options['arrowimage'] = $widget_data['arrowimage'];
                $options['bgsprite'] = $widget_data['bgsprite'];
                break;
        }
        $options['menu1'] = $widget_data['menu1'];
        $options['menu2'] = $widget_data['menu2'];
        $options['menu3'] = $widget_data['menu3'];
        $options['menu4'] = $widget_data['menu4'];
        $options['menu5'] = $widget_data['menu5'];
        $options['menu6'] = $widget_data['menu6'];
        $options['menu7'] = $widget_data['menu7'];
        update_option(RICO_AJAX_MENU_WIDGET_ID, $options);
    }else {
        $options = get_option(RICO_AJAX_MENU_WIDGET_ID);
        if(!is_array($options)) {
            $options = array();
        }
    }
    RAMwidgetForm($options);
}

function loadRicoBaseFooter() {
    global $ricopath;
    echo loadRicoBase($ricopath);
}
function loadAccordionModuleFooter() {
    global $accordionid, $rico_ajax_menu_accordion_added;
    echo loadAccordionModule($accordionid, $rico_ajax_menu_accordion_added);
    $rico_ajax_menu_accordion_added=true;
}
function RAMtabScriptFooter() {
    global $ricotabid, $tabheight, $rico_ajax_menu_tab_added;
    echo RAMtabScript($ricotabid, $rico_ajax_menu_tab_added, $tabheight);
    $rico_ajax_menu_tab_added=true;
}
function loadPulldownModuleFooter() {
    global $ricopath;
    echo loadPulldownModule($ricopath);
}
function insertPulldownVarMultiFooter() {
    global $ricopulldownid, $pulldowncount;
    echo insertPulldownVarMulti($ricopulldownid);
}
add_action('plugins_loaded','rico_ajax_menu_widget_init');
add_filter('the_content', 'rico_ajax_menu_on_page');
?>