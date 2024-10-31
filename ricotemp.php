<?php
function accordionCSS($path) {
    return '<!-- adding accordion CSS --><link href="'.$path.'rico21/css/accordion.css" media="screen" rel="Stylesheet" type="text/css">';
}
function loadRicoBase($path) {
    return "<script src=\"".$path."rico21/src/rico.js\" type=\"text/javascript\"></script>";
}
function loadAccordionModule($id, $added) {
    $str = "<!-- load rico accordion settings --><script type='text/javascript'>".(!$added?"Rico.loadModule('Accordion');\n":"").
            "Rico.onLoad(function(){";
    for($i=0;$i<count($id);$i++) {
        $str.=($i==0?"var ":"")."options={panelHeight:".$id[$i]['height'].",hoverClass:'mdHover".$id[$i]['id']."',selectedClass:'mdSelected".$id[$i]['id']."'};new Rico.Accordion($$('div.panelheader".$id[$i]['id']."'),$$('div.panelContent".$id[$i]['id']."'),options);";
    }
    $str .="});</script>";
    return $str;
}
function loadColor($id, $settings) {
    if($settings['TEXTCOLOR']) {
        $str .= "<style type=\"text/css\">.panelheader$id {".
                ($settings['BGIMAGE2']?"background-image:url('".$settings['BGIMAGE2']."');":"background-color:".$settings['BGCOLOR2'].";")
                ."height:".(!preg_match("/%$/",$settings['PANELHEIGHT'])?($settings['PANELHEIGHT']-1)."px":($settings['PANELHEIGHT'])).";color:".$settings['TEXTCOLOR2'].";font-weight:normal;border-left:1px solid ".$settings['BORDERCOLOR'].";border-right:1px solid ".$settings['BORDERCOLOR'].";border-bottom:1px solid ".$settings['BORDERCOLOR'].";}.mdHover$id{font-weight:bold;".($settings['BGIMAGE']?"background-image:url('".$settings['BGIMAGE']."');":"background-color:".$settings['BGCOLOR'].";").
                "color:".$settings['TEXTCOLOR'].";}.mdSelected$id{".($settings['BGIMAGE']?"background-image:url('".$settings['BGIMAGE']."');":"background-color:".$settings['BGCOLOR'].";").
                "color:".$settings['TEXTCOLOR'].";font-weight:bold;}.panelContent$id{border-top-width:0px;border-bottom-width:0px;border-left:1px solid ".$settings['BORDERCOLOR'].";border-right:1px solid ".$settings['BORDERCOLOR'].";border-bottom:1px solid ".$settings['BORDERCOLOR'].";font-size:smaller;overflow:auto;";
        if($settings['CONTENTBGIMAGE']) {
            $str .= "background-image:url('".$settings['CONTENTBGIMAGE']."');";
        }else if($settings['CONTENTCOLOR']) {
            $str .= "background-color:".$settings['CONTENTCOLOR'].";";
        }
        $str .="}#accordion$id{".setOpacity($settings['OPACITY'])."border-top:1px solid ".$settings['BORDERCOLOR']
                .";width:".(!preg_match("/%$/",$settings['WIDTH'])?($settings['WIDTH']-2)."px":($settings['WIDTH'])).";}</style>";
    }
    $id=null;
    $settings=null;
    return $str;
}
function makeAccordion($id, $array,$pheight,$sprite) {
    $n=count($array);
    $array=RAMgetLink($array, array(title=>'%%TITLE%%',
            content=>'%%CONTENT%%'), true);
    $str = "<div style='clear:both;'><div id=\"accordion$id\">";
    for($i=0;$i<$n;$i++) {
        $str .= '<div><div class="panelheader'.$id.'" '.
                ($sprite?'style="background-image:url(\''.$sprite.'\');background-position:0px '.(0-$pheight*$i).'px;"':'')
                .'>';
        $str .= $array[$i]['title'];
        $str .= '</div><div class="panelContent'.$id.'">';
        $str .= $array[$i]['content'];
        $str .= "</div></div>";
    }
    $str .= "</div></div>";
    $id=null;
    $n=null;
    $array=null;
    return $str;
}
function loadPulldownModule($path) {
    return '<script src="'.$path.'rico21/src/ricoComponents.js" type="text/javascript"></script>'.
            "<script type='text/javascript'>Rico.loadModule('Accordion');</script>";
}
function pulldownCSS($path) {
    return '<style type="text/css" media="all">@import url("'.$path.'rico21/css/rico.css");</style>';
}
function insertPulldownVar($id) {
    return "<script type='text/javascript'>var panel$id;Rico.onLoad(function(){panel$id=Rico.SlidingPanel.top($('outerpanel$id'),$('innerpanel$id'));});</script>\n";
}
function insertPulldownVarMulti($id) {
    $str="<script type='text/javascript'>";
    for($n=0;$n<count($id);$n++) {
        for($i=0;$i<$id[$n]['pulldowns'];$i++) {
            $pulldownid=$id[$n]['id']."_".($i+1);
            $str.="var panel$pulldownid;Rico.onLoad(function(){panel$pulldownid=Rico.SlidingPanel.top($('outerpanel$pulldownid'),$('innerpanel$pulldownid'));});";
        }
    }
    $str.="</script>\n";
    $id=null;
    return $str;
}
function insertPulldown($id, $path, $settings, $pulldown, $i, $z=9999) {
    global $pdadjust;
    $pdadjust++;
    return '<div id="toppanel" style="height:'.(!preg_match("/%$/",$settings['PANELHEIGHT']-1)?($settings['PANELHEIGHT']-1)."px":$settings['PANELHEIGHT']).';color:'.
            $settings['TEXTCOLOR'].';background-color:'.$settings['BGCOLOR'].';'
            .($settings['BGSPRITE']?'background-image:url(\''.$settings['BGSPRITE'].'\');background-position:0px '.(0-$settings['PANELHEIGHT']*$i).'px;':'')
            .setOpacity($settings['OPACITY'])
            .'border-left: 1px solid '.$settings['BORDERCOLOR'].';'
            .'border-right: 1px solid '.$settings['BORDERCOLOR'].';'
            .'border-bottom: 1px solid '.$settings['BORDERCOLOR'].';'
            .'"><a href="javascript:void(0);" id="" style="color:'.$settings['TEXTCOLOR'].';text-decoration:none;padding:3px;" onclick="panel'.
            $id.'.toggle();return false;" title="PullDown"><img id="arrow" alt="arrow" src="'.$path.$settings['ARROWIMAGE'].'" style="border: 0px solid;">&nbsp;'.$pulldown['title'].'</a></div><div id="outerpanel'.$id.'" class="outerpanel" style="position:absolute;width:100%;'
            .setOpacity($settings['OPACITY']).'top:'.(!preg_match("/%$/",$settings['PANELHEIGHT'])?(($settings['PANELHEIGHT'])*$pdadjust-1)."px":$settings['PANELHEIGHT']).';'.
            'border-bottom:1px solid '.$settings['BORDERCOLOR'].';'.
            'z-index:'.$z.';"><div id="innerpanel'.$id.'" style="height:100%;'.($settings['CONTENTCOLOR']?'background-color:'.$settings['CONTENTCOLOR'].';':'').setOpacity($settings['OPACITY']).
            'border-top:1px solid '.$settings['BORDERCOLOR'].';'.
            'border-left:1px solid '.$settings['BORDERCOLOR'].';'.
            'border-right:1px solid '.$settings['BORDERCOLOR'].';'.
            '">'.$pulldown['content'].'</div></div>';
}
function insertPulldownMulti($id, $path, $settings, $pulldowns) {
    global $pdadjust;
    $pdadjust=0;
    $output="";
    $pulldowns=RAMgetLink($pulldowns, array(title=>'%%TITLE%%',content=>'%%CONTENT%%'), true);
    $n=count($pulldowns);
    $output.= '<div style="height:'.(($settings['PANELHEIGHT'])*$n).'px;"><div id="pulldownheader" style="clear:both;height:'
            .setOpacity($settings['OPACITY']).(!preg_match("/%$/",$settings['PANELHEIGHT'])?($settings['PANELHEIGHT'])."px":($settings['PANELHEIGHT'])).';'.
            'width:'.(!preg_match("/%$/",$settings['WIDTH'])?$settings['WIDTH']."px":$settings['WIDTH']).';'
            .'border-top:1px solid '.$settings['BORDERCOLOR'].';">';
    for($i=0;$i<$n;$i++) {
        $pulldownid=$id['id']."_".($i+1);
        $output.=insertPulldown($pulldownid, $path, $settings, $pulldowns[$i],$i,9999-$i);
    }
    $output.='</div></div>';
    $id=null;
    $path=null;
    $settings=null;
    $pulldowns=null;
    return $output;
}
function RAMwidgetForm($options) {
    ?>
<p>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menusettings"><b>Menu Settings</b></label><br>
    Style:
    <select class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[menu]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu">
            <?php $menu=strtolower($options['menu']);?>
        <option value="Tab" <?php echo ($menu == 'tab' ? 'selected' : '')?>>Tab</option>
        <option value="Accordion" <?php echo ($menu == 'accordion' ? 'selected':'')?>>Accordion</option>
        <option value="Pulldown" <?php echo ($menu == 'pulldown' ? 'selected':'')?>>Pulldown</option>
    </select>
</p>
<p>
    Width (px, %):<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[width]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-width" value="<?php echo $options['width']; ?>" size="3"><br>
    Height for Tab & Accordion Menu (px):<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[height]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-height" value="<?php echo ($menu != 'pulldown' ? $options['height'] : ''); ?>" size="3"><br>
    Sprite for Accordion & Pulldown header (URL):<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[bgsprite]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-bgsprite" value="<?php echo ($menu != 'tab' ? $options['bgsprite'] : ''); ?>" size="3"><br>
    Content Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[contentcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-contentcolor" value="<?php echo $options['contentcolor']; ?>" size="7"><br>
    Border Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[bordercolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-bordercolor" value="<?php echo $options['bordercolor']; ?>" size="7"><br>
    Opacity(0-1):<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[opacity]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-opacity" value="<?php echo $options['opacity']; ?>" size="7"><br>
</p>
<p>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-tabsettings"><b>Tab Settings</b></label><br>
    Tab Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[tabcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-tabcolor" value="<?php echo $options['tabcolor']; ?>" size="7"><br>
    Tab Text Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[tabtextcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-tabtextcolor" value="<?php echo $options['tabtextcolor']; ?>" size="7"><br>
    Selected Tab Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[selectedtabcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-selectedtabcolor" value="<?php echo $options['selectedtabcolor']; ?>" size="7"><br>
    Selected Tab Text Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[selectedtabtextcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-selectedtabtextcolor" value="<?php echo $options['selectedtabtextcolor']; ?>" size="7"><br>
</p>
<p>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-accordionsettings"><b>Accordion Settings</b></label><br>
    Panel Height:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[panelheight]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-panelheight" value="<?php echo ($menu == 'accordion' ? $options['panelheight'] : ''); ?>" size="3"><br>
    Panel Text Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[textcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-textcolor" value="<?php echo ($menu=="accordion"?$options['textcolor']:""); ?>" size="7"><br>
    Panel Background Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[bgcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-bgcolor" value="<?php echo ($menu=="accordion"?$options['bgcolor']:""); ?>" size="7"><br>
    Panel Background Image:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[bgimage]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-bgimage" value="<?php echo $options['bgimage']; ?>" size="7"><br>
    Inactive Panel Text Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[textcolor2]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-textcolor2" value="<?php echo $options['textcolor2']; ?>" size="7"><br>
    Inactive Panel Background Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[bgcolor2]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-bgcolor2" value="<?php echo $options['bgcolor2']; ?>" size="7"><br>
    Inactive Panel Background Image:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[bgimage2]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-bgimage2" value="<?php echo $options['bgimage2']; ?>" size="7"><br>
</p>
<p>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-pulldownsettings"><b>Pulldown Settings</b></label><br>
    Panel Height:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[pulldownpanelheight]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-pulldownpanelheight" value="<?php echo ($menu == 'pulldown' ? $options['panelheight'] : ''); ?>" size="3"><br>
    Text Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[pulldowntextcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-textcolor" value="<?php echo ($menu=="pulldown"?$options['textcolor']:""); ?>" size="7"><br>
    Background Color:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[pulldownbgcolor]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-bgcolor" value="<?php echo ($menu=="pulldown"?$options['bgcolor']:""); ?>" size="7"><br>
    Arrow Image:<input class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[arrowimage]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-arrowimage" value="<?php echo $options['arrowimage']; ?>" size="7"><br>
</p>
<p>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu1">Menu 1</label>
    <select class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[menu1]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu1">
            <?php $menu=strtolower($options['menu1']);?>
        <option value="None" <?php echo ($menu == 'none' ? 'selected' : '')?>>None</option>
        <option value="Recent" <?php echo ($menu == 'recent' ? 'selected' : '')?>>Recent Posts</option>
        <option value="Categories" <?php echo ($menu == 'categories' ? 'selected':'')?>>Categories</option>
        <option value="Pages" <?php echo ($menu == 'pages' ? 'selected':'')?>>Pages</option>
        <option value="Archives" <?php echo ($menu == 'archives' ? 'selected':'')?>>Archives</option>
        <option value="Links" <?php echo ($menu == 'links' ? 'selected':'')?>>Links</option>
        <option value="Calendar" <?php echo ($menu == 'calendar' ? 'selected':'')?>>Calendar</option>
        <option value="Recent Comments" <?php echo ($menu == 'comments' ? 'selected':'')?>>Recent Comments</option>
    </select>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu2">Menu 2</label>
    <select class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[menu2]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu2">
            <?php $menu=strtolower($options['menu2']);?>
        <option value="None" <?php echo ($menu == 'none' ? 'selected' : '')?>>None</option>
        <option value="Recent" <?php echo ($menu == 'recent' ? 'selected' : '')?>>Recent Posts</option>
        <option value="Categories" <?php echo ($menu == 'categories' ? 'selected':'')?>>Categories</option>
        <option value="Pages" <?php echo ($menu == 'pages' ? 'selected':'')?>>Pages</option>
        <option value="Archives" <?php echo ($menu == 'archives' ? 'selected':'')?>>Archives</option>
        <option value="Links" <?php echo ($menu == 'links' ? 'selected':'')?>>Links</option>
        <option value="Calendar" <?php echo ($menu == 'calendar' ? 'selected':'')?>>Calendar</option>
        <option value="Recent Comments" <?php echo ($menu == 'comments' ? 'selected':'')?>>Recent Comments</option>
    </select>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu3">Menu 3</label>
    <select class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[menu3]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu3">
            <?php $menu=strtolower($options['menu3']);?>
        <option value="None" <?php echo ($menu == 'none' ? 'selected' : '')?>>None</option>
        <option value="Recent" <?php echo ($menu == 'recent' ? 'selected' : '')?>>Recent Posts</option>
        <option value="Categories" <?php echo ($menu == 'categories' ? 'selected':'')?>>Categories</option>
        <option value="Pages" <?php echo ($menu == 'pages' ? 'selected':'')?>>Pages</option>
        <option value="Archives" <?php echo ($menu == 'archives' ? 'selected':'')?>>Archives</option>
        <option value="Links" <?php echo ($menu == 'links' ? 'selected':'')?>>Links</option>
        <option value="Calendar" <?php echo ($menu == 'calendar' ? 'selected':'')?>>Calendar</option>
        <option value="Recent Comments" <?php echo ($menu == 'comments' ? 'selected':'')?>>Recent Comments</option>
    </select>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu4">Menu 4</label>
    <select class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[menu4]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu4">
            <?php $menu=strtolower($options['menu4']);?>
        <option value="None" <?php echo ($menu == 'none' ? 'selected' : '')?>>None</option>
        <option value="Recent" <?php echo ($menu == 'recent' ? 'selected' : '')?>>Recent Posts</option>
        <option value="Categories" <?php echo ($menu == 'categories' ? 'selected':'')?>>Categories</option>
        <option value="Pages" <?php echo ($menu == 'pages' ? 'selected':'')?>>Pages</option>
        <option value="Archives" <?php echo ($menu == 'archives' ? 'selected':'')?>>Archives</option>
        <option value="Links" <?php echo ($menu == 'links' ? 'selected':'')?>>Links</option>
        <option value="Calendar" <?php echo ($menu == 'calendar' ? 'selected':'')?>>Calendar</option>
        <option value="Recent Comments" <?php echo ($menu == 'comments' ? 'selected':'')?>>Recent Comments</option>
    </select>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu5">Menu 5</label>
    <select class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[menu5]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu5">
            <?php $menu=strtolower($options['menu5']);?>
        <option value="None" <?php echo ($menu == 'none' ? 'selected' : '')?>>None</option>
        <option value="Recent" <?php echo ($menu == 'recent' ? 'selected' : '')?>>Recent Posts</option>
        <option value="Categories" <?php echo ($menu == 'categories' ? 'selected':'')?>>Categories</option>
        <option value="Pages" <?php echo ($menu == 'pages' ? 'selected':'')?>>Pages</option>
        <option value="Archives" <?php echo ($menu == 'archives' ? 'selected':'')?>>Archives</option>
        <option value="Links" <?php echo ($menu == 'links' ? 'selected':'')?>>Links</option>
        <option value="Calendar" <?php echo ($menu == 'calendar' ? 'selected':'')?>>Calendar</option>
        <option value="Recent Comments" <?php echo ($menu == 'comments' ? 'selected':'')?>>Recent Comments</option>
    </select>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu6">Menu 6</label>
    <select class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[menu6]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu6">
            <?php $menu=strtolower($options['menu6']);?>
        <option value="None" <?php echo ($menu == 'none' ? 'selected' : '')?>>None</option>
        <option value="Recent" <?php echo ($menu == 'recent' ? 'selected' : '')?>>Recent Posts</option>
        <option value="Categories" <?php echo ($menu == 'categories' ? 'selected':'')?>>Categories</option>
        <option value="Pages" <?php echo ($menu == 'pages' ? 'selected':'')?>>Pages</option>
        <option value="Archives" <?php echo ($menu == 'archives' ? 'selected':'')?>>Archives</option>
        <option value="Links" <?php echo ($menu == 'links' ? 'selected':'')?>>Links</option>
        <option value="Calendar" <?php echo ($menu == 'calendar' ? 'selected':'')?>>Calendar</option>
        <option value="Recent Comments" <?php echo ($menu == 'comments' ? 'selected':'')?>>Recent Comments</option>
    </select>
    <label for="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu7">Menu 7</label>
    <select class="widefat" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[menu7]" id="<?php echo RICO_AJAX_MENU_WIDGET_ID?>-menu7">
            <?php $menu=strtolower($options['menu7']);?>
        <option value="None" <?php echo ($menu == 'none' ? 'selected' : '')?>>None</option>
        <option value="Recent" <?php echo ($menu == 'recent' ? 'selected' : '')?>>Recent Posts</option>
        <option value="Categories" <?php echo ($menu == 'categories' ? 'selected':'')?>>Categories</option>
        <option value="Pages" <?php echo ($menu == 'pages' ? 'selected':'')?>>Pages</option>
        <option value="Archives" <?php echo ($menu == 'archives' ? 'selected':'')?>>Archives</option>
        <option value="Links" <?php echo ($menu == 'links' ? 'selected':'')?>>Links</option>
        <option value="Calendar" <?php echo ($menu == 'calendar' ? 'selected':'')?>>Calendar</option>
        <option value="Comments" <?php echo ($menu == 'comments' ? 'selected':'')?>>Recent Comments</option>
    </select>
</p>
<input type="hidden" name="<?php echo RICO_AJAX_MENU_WIDGET_ID?>[submit]" value="1" />
    <?php
}
?>