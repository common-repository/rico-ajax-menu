<?php
function RAMgetPathURL($path="/") {
    $url="";
    if(get_bloginfo('home')) {
        $url=get_bloginfo('home')."/";
    }else {
        $url="http://".$_SERVER['HTTP_HOST'].$path;
    }
    preg_match("/wp-content.+/", dirname(__FILE__), $pluginpath);
    return $url.$pluginpath[0];
}
function RAMregex($text,$name,$returnarray=false) {
    $regex= '#\[%%NAME%%]((?:[^\[]|\[(?!/?%%NAME%%])|(?R))+)\[/%%NAME%%]#';
    $regex= preg_replace("/%%NAME%%/",$name,$regex);
    preg_match($regex,$text,$value);
    $name=null;
    $regex=null;
    $text=null;
    if($returnarray==true) {
        $returnarray=null;
        return $value;
    }
    $returnarray=null;
    return $value[1];
}
function RAMsanitize($string) {
    $value = preg_replace("/<a\s/", "<a target=\"blank\" ", $string );

    $value = preg_replace("/\/>/", ">", $value );
    $value = preg_replace("/\s+>/", ">", $value );

    $value = preg_replace("/<\/?script[^<>]*>/", "", $value );

    $value = preg_replace("/on[cC]lick=\"[^\"]+\"/", "", $value );
    $value = preg_replace("/on[cC]lick='[^']+'/", "", $value );
    $value = preg_replace("/on[mM]ouse[oO]ver=\"[^\"]+\"/", "", $value );
    $value = preg_replace("/on[mM]ouse[oO]ver='[^']+'/", "", $value );
    $value = preg_replace("/on[mM]ouse[oO]ut=\"[^\"]+\"/", "", $value );
    $value = preg_replace("/on[mM]ouse[oO]ut='[^']+'/", "", $value );
    $value = preg_replace("/on[mM]ouse[dD]own=\"[^\"]+\"/", "", $value );
    $value = preg_replace("/on[mM]ouse[dD]own='[^']+'/", "", $value );

    $value = preg_replace("/class=\"[^\"]+\"/", "", $value);
    $value = preg_replace("/class='[^']+'/", "", $value);
    $value = preg_replace("/align=\"[^\"]+\"/", "", $value);//<td align="right">
    $value = preg_replace("/align='[^']+'/", "", $value);
    $value = preg_replace("/style=\"[^\"]+\"/", "", $value);
    $value = preg_replace("/style='[^']+'/", "", $value);
    $value = preg_replace("/id=\"[^\"]+\"/", "", $value);
    $value = preg_replace("/id='[^']+'/", "", $value);
    $value = preg_replace("/title=\"[^\"]+\"/", "", $value);
    $value = preg_replace("/title='[^']+'/", "", $value);
    $value = preg_replace("/alt=\"[^\"]+\"/", "", $value);
    $value = preg_replace("/alt='[^']+'/", "", $value);
    $value = preg_replace("/comment=\"[^\"]+\"/", "", $value);
    $value = preg_replace("/comment='[^']+'/", "", $value);

    $value = preg_replace("/_src=/", "src=", $value );

    $value = preg_replace("/\/?<ul[^<>]*>/", "", $value );
    $value = preg_replace("/<\/?li[^<>]*>/", "", $value );
    $value = preg_replace("/<strong[^<>]*>/", "<b>", $value );
    $value = preg_replace("/<\/strong[^<>]*>/", "<\/b>", $value );
    $value = preg_replace("/<em[^<>]*>/", "<i>", $value );
    $value = preg_replace("/<\/em[^<>]*>/", "<\/i>", $value );
    $value = preg_replace("/<cite[^<>]*>/", "<i>", $value );
    $value = preg_replace("/<\/cite[^<>]*>/", "<\/i>", $value );
    $value = preg_replace("/<\/?p[^<>]*>/", "", $value );
    $value = preg_replace("/<small[^<>]*>/", "", $value );
    $value = preg_replace("/<\/small[^<>]*>/", "", $value );
    $value = preg_replace("/<\/?div[^<>]*>/", "", $value );
    $value = preg_replace("/<\/?span[^<>]*>/", "", $value );

    $value = preg_replace("/<\/?tr[^<>]*>/", "", $value );

    $value = preg_replace("/<a><a>/", "", $value);
    $value = preg_replace("/<a><a\s+target=\"blank\"\s*>/", "", $value);

    $value = preg_replace("/\/>/", ">", $value );
    $value = preg_replace("/\s+>/", ">", $value );
    $value = preg_replace("/\n[\n+]/", "", $value );
    $value = preg_replace("/\s+/", " ", $value );

    $value = preg_replace("/<\/td><td[^<>]*>/", ": ", $value );
    $value = preg_replace("/<\/?td>/", "", $value );
    $value = preg_replace("/<\/?td[^<>]*>/", "", $value );

    $value = preg_replace("/'/", "`", $value );
    $value = preg_replace("/,/", "，", $value );

    return $value;
}
function RAMgzipdeliver($file,$cacheonly=false) {
    /*
    #!/bin/bash
for file in `find . -name *js -type f`; do
        gzip -c $file >$file.gz
done
for file in `find . -name *css -type f`; do
        gzip -c $file >$file.gz
done
    */
    preg_match("/[^\.]+$/",$file,$ext);
    $type="text/javascript";
    switch($ext[0]) {
        case "js":$type="text/javascript";
            break;
        case "css":$type="text/css";
            break;
        case "gif":$type="image/gif";
            break;
        case "jpeg":
        case "jpg":$type="image/jpeg";
            break;
        case "png":$type="image/png";
            break;
        case "swf":$type="application/x-shockwave-flash";
            break;
    }
    $ext=null;
    define('RAMTIME_BROWSER_CACHE','315360000');//86400: 1day
    if(!$cacheonly&&!preg_match("/^http/",$file)){
        $file=$file.".gz";
    }elseif(preg_match("/^http/",$file)){
        header("Location:".$link['url']);
        /*
        header('Cache-Control:max-age='.RAMTIME_BROWSER_CACHE.', must-revalidate,public');
        header('Expires:'.gmdate('D,d M Y H:i:s', time() + RAMTIME_BROWSER_CACHE).' GMT');
        header("Content-Type:$type");
        //echo file_get_contents($file);
        echo file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        die();
        */
    }
    if(file_exists($file)) {
        $last_modified = filemtime($file);
        if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) AND
                strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])
                == $last_modified) {
            header($_SERVER['SERVER_PROTOCOL'].' 304 Not Modified',TRUE,304);
            $last_modified=null;
            die();
        } else {
            header('Cache-Control:max-age='.RAMTIME_BROWSER_CACHE.', must-revalidate,public');
            header('Last-Modified:'.gmdate('D, d M Y H:i:s',$last_modified).' GMT');
            $last_modified=null;
            header('Expires:'.gmdate('D,d M Y H:i:s', time() + RAMTIME_BROWSER_CACHE).' GMT');
            header("Content-Length:".filesize($file));
            header("Content-Type:$type");
            if(!$cacheonly) {
                header('Content-Encoding:gzip');
            }
            if($fp=fopen($file,"rb")) {
                while(!feof($fp)) {
                    echo fread($fp, filesize($file));
                }
                fclose($fp);
                $fp=null;
                $size=null;
            }
        }
        $file=null;
    }else {
        header($_SERVER['SERVER_PROTOCOL'].' 404 File Not Modified');
    }
}
function RAMadditional() {

}
function RAMComponents($menu,$component) {
    $i=1;
    while($temp=RAMregex($menu,$component.$i,true)) {
        $array[$i-1]['title']=$temp[1];
        $i++;
    }
    $i=1;
    while($temp=RAMregex($menu,"CONTENT".$i,true)) {
        $array[$i-1]['content']=$temp[1];
        $i++;
    }
    $i=null;
    $temp=null;
    $menu=null;
    $component=null;
    return $array;
}
function RAMSetting($menu,$setting) {
    $settings=array();
    foreach($setting as $value) {
        $temp = RAMregex($menu,$value);
        if($temp) {
            $settings[$value]=$temp;
        }
    }
    if(is_numeric($settings['WIDTH'])) {
        if(strlen($settings['WIDTH'])<1) {
            $settings['WIDTH']="400";
        }
    }else if(!preg_match("/%$/",$settings['WIDTH'])) {
        $settings['WIDTH']="400";
    }
    if(is_numeric($settings['TABWIDTH'])) {
        if($settings['TABWIDTH']==0) {
            $settings['TABWIDTH']=null;
        }
    }else if(!preg_match("/%$/",$settings['TABWIDTH'])) {
        $settings['TABWIDTH']=null;
    }
    if(!is_numeric($settings['HEIGHT'])) {
        $settings['HEIGHT']="300";
    }
    if(strlen($settings['TABCOLOR'])<2) {
        $settings['TABCOLOR']="#D8E0F2";
    }
    if(strlen($settings['TABTEXTCOLOR'])<2) {
        $settings['TABTEXTCOLOR']="#AAA";
    }
    if(strlen($settings['SELECTEDTABCOLOR'])<2) {
        $settings['SELECTEDTABCOLOR']="#AAA";
    }
    if(strlen($settings['SELECTEDTABTEXTCOLOR'])<2) {
        $settings['SELECTEDTABTEXTCOLOR']="#ffffff";
    }
    $settings['HOVERTEXTCOLOR']=$settings['SELECTEDTABTEXTCOLOR'];
    if(strlen($settings['CONTENTCOLOR'])<2) {
        $settings['CONTENTCOLOR']=false;
    }
    if(preg_match("/^images\//",$settings['CONTENTBGIMAGE'])) {
        $settings['CONTENTBGIMAGE']=RAMgetPathURL(RAMSITEPATH)."/".$settings['CONTENTBGIMAGE'];
    }
    if(strlen($settings['BORDERCOLOR'])<2) {
        $settings['BORDERCOLOR']="#4f4f4f";
    }
    if(!is_numeric($settings['OPACITY'])||$settings['OPACITY']>1) {
        $settings['OPACITY']=1;
    }
    if(!is_numeric($settings['PANELHEIGHT'])) {
        $settings['PANELHEIGHT']="30px";
    }
    if(strlen($settings['TEXTCOLOR'])<2) {
        $settings['TEXTCOLOR']="#666";
    }
    if(strlen($settings['BGCOLOR'])<2) {
        $settings['BGCOLOR']="#D8E0F2";
    }
    if(preg_match("/^images\//",$settings['BGSPRITE'])) {
        $settings['BGSPRITE']=RAMgetPathURL(RAMSITEPATH).
        "/gzipdeliver.php?file=".$settings['BGSPRITE']."&cacheonly=true";
    }elseif(preg_match("/^wp-content\//",$settings['BGSPRITE'])) {
        $settings['BGSPRITE']=RAMgetPathURL(RAMSITEPATH).
        "/gzipdeliver.php?file=../../../".$settings['BGSPRITE']."&cacheonly=true";
    }
    if(preg_match("/^images\//",$settings['BGIMAGE'])) {
        $settings['BGIMAGE']=RAMgetPathURL(RAMSITEPATH).
        "/gzipdeliver.php?file=".$settings['BGIMAGE']."&cacheonly=true";
    }elseif(preg_match("/^wp-content\//",$settings['BGIMAGE'])) {
        $settings['BGIMAGE']=RAMgetPathURL(RAMSITEPATH).
        "/gzipdeliver.php?file=../../../".$settings['BGIMAGE']."&cacheonly=true";
    }
    if(strlen($settings['TEXTCOLOR2'])<2) {
        $settings['TEXTCOLOR2']="white";
    }
    if(strlen($settings['BGCOLOR2'])<2) {
        $settings['BGCOLOR2']="#AAA";
    }
    if(preg_match("/^images\//",$settings['BGIMAGE2'])) {
        $settings['BGIMAGE2']=RAMgetPathURL(RAMSITEPATH).
        "/gzipdeliver.php?file=".$settings['BGIMAGE2']."&cacheonly=true";
    }elseif(preg_match("/^wp-content\//",$settings['BGIMAGE2'])) {
        $settings['BGIMAGE2']=RAMgetPathURL(RAMSITEPATH).
        "/gzipdeliver.php?file=../../../".$settings['BGIMAGE2']."&cacheonly=true";
    }
    if(strlen($settings['BORDERCOLOR'])<2) {
        $settings['BORDERCOLOR']="#4f4f4f";
    }
    if(preg_match("/^images\//",$settings['CONTENTBGIMAGE'])) {
        $settings['CONTENTBGIMAGE']=RAMgetPathURL(RAMSITEPATH).
        "/gzipdeliver.php?file=".$settings['CONTENTBGIMAGE']."&cacheonly=true";
    }elseif(preg_match("/^wp-content\//",$settings['CONTENTBGIMAGE'])) {
        $settings['CONTENTBGIMAGE']=RAMgetPathURL(RAMSITEPATH).
        "/gzipdeliver.php?file=../../../".$settings['CONTENTBGIMAGE']."&cacheonly=true";
    }
    if(is_numeric($settings['HEIGHT'])) {
        if(strlen($settings['HEIGHT'])<1) {
            $settings['HEIGHT']="300";
        }
    } else {
        $settings['HEIGHT']="300";
    }
    if(strlen($settings['TEXTCOLOR'])<2) {
        $settings['TEXTCOLOR']="white";
    }
    if(strlen($settings['BGCOLOR'])<2) {
        $settings['BGCOLOR']="#AAA";
    }
    if(!preg_match("/^images\//",$settings['ARROWIMAGE'])) {
        $settings['ARROWIMAGE']="gzipdeliver.php?file="."images/down_arrow.png"."&cacheonly=true";
    }elseif(preg_match("/^images\//",$settings['ARROWIMAGE'])) {
        $settings['ARROWIMAGE']="/gzipdeliver.php?file=".$settings['ARROWIMAGE']."&cacheonly=true";
    }
    if(strlen($settings['BORDERCOLOR'])<2) {
        $settings['BORDERCOLOR']="#4f4f4f";
    }
    if(strlen($settings['CONTENTBGCOLOR'])<2) {
        $settings['CONTENTBGCOLOR']="white";
    }
    $menu=null;
    $setting=null;
    $temp=null;
    $value=null;
    return $settings;
}
function RAMgetLink($array,$format,$returnarray=false) {
    $table_head_mc='<table style="text-align:center;width:100px;height:100%;margin-left:auto;margin-right:auto;"'.
'border="0" cellpadding="0" cellspacing="0"><tbody><tr><td style="vertical-align:middle;text-align:center;">';
    $table_foot='</td></tr></tbody></table>';
    $table_head_c='<table style="text-align:left;width:100%;height:100%;margin-left:auto;margin-right:auto;"'.
'border="0" cellpadding="0" cellspacing="0"><tbody><tr><td style="text-align: center;">';
    $table_head_m='<table style="text-align:left;width:100px;margin-left:auto;margin-right:auto;"'.
'border="0" cellpadding="0" cellspacing="0"><tbody><tr><td style="vertical-align: middle;">';
    $output=array();
    for($i=0;$i<count($array);$i++) {
        if(preg_match("/\[PAGES\]/",$array[$i]['title'])&&
                preg_match("/\[PAGES\]/",$array[$i]['content'])) {
            $title=__('Pages');
            $content='<ul>'.wp_list_pages(array('echo'=>0,'title_li'=>'',
                    link_before =>'',link_after=>'')).'</ul><br>&nbsp;';
        }else if(preg_match("/\[CATEGORIES\]/",$array[$i]['title'])&&
                preg_match("/\[CATEGORIES\]/",$array[$i]['content'])) {
            $title=__('Categories');
            $content='<ul>'.wp_list_categories(array('echo'=>0,orderby=>'name','title_li'=>''))
                    .'</ul><br>&nbsp;';
        }else if(preg_match("/\[RECENTPOSTS\]/",$array[$i]['title'])&&
                preg_match("/\[RECENTPOSTS\]/",$array[$i]['content'])) {
            $title=__('Recent Posts');
            $content='<ul>'.wp_get_archives(array('type'=>'postbypost',
                    'limit'=>5,'echo'=>0)).'</ul><br>&nbsp;';
        }else if(preg_match("/\[ARCHIVES\]/",$array[$i]['title'])&&
                preg_match("/\[ARCHIVES\]/",$array[$i]['content'])) {
            $title=__('Archives');
            $content='<ul>'.wp_get_archives(array('type'=>'monthly',
                    'limit'=>'','echo'=>0)).'</ul><br>&nbsp;';
        }else if(preg_match("/\[LINKS\]/",$array[$i]['title'])&&
                preg_match("/\[LINKS\]/",$array[$i]['content'])) {
            $title=__('Links');
            $content=wp_list_bookmarks(array('echo'=>0,'title_li'=>'',
                    'class'=>'', category_before =>'',category_after=>'',
                    title_before =>'',title_after=>'')).'<br>&nbsp;';
            $content=preg_replace("/<ul class=.+>/", "<ul>", $content);
        }else if(preg_match("/\[CALENDAR\]/",$array[$i]['title'])&&
                preg_match("/\[CALENDAR\]/",$array[$i]['content'])) {
            $title=__('Calendar');
            $content=$table_head_mc.RAMget_calendar().$table_foot;
        }else if(preg_match("/\[RECENTCOMMENTS\]/",$array[$i]['title'])&&
                preg_match("/\[RECENTCOMMENTS\]/",$array[$i]['content'])) {
            $title=__('Recent Comments');
            $content=''.RAMrecent_comments().'<br>&nbsp;';
        }else {
            if(preg_match("/\[PAGES\]/",$array[$i]['content'])) {
                $content='<ul>'.wp_list_pages(array('echo'=>0,'title_li'=>'',
                        link_before =>'',link_after=>'')).'</ul><br>&nbsp;';
            }else if(preg_match("/\[CATEGORIES\]/",$array[$i]['content'])) {
                $content='<ul>'.wp_list_categories(array('echo'=>0,orderby=>'name','title_li'=>''))
                        .'</ul><br>&nbsp;';
            }else if(preg_match("/\[RECENTPOSTS\]/",$array[$i]['content'])) {
                $content='<ul>'.wp_get_archives(array('type'=>'postbypost',
                        'limit'=>5,'echo'=>0)).'</ul><br>&nbsp;';
            }else if(preg_match("/\[ARCHIVES\]/",$array[$i]['content'])) {
                $content='<ul>'.wp_get_archives(array('type'=>'monthly',
                        'limit'=>'','echo'=>0)).'</ul><br>&nbsp;';
            }else if(preg_match("/\[LINKS\]/",$array[$i]['content'])) {
                $content=wp_list_bookmarks(array('echo'=>0,'title_li'=>'',
                        'class'=>'', category_before =>'',category_after=>'',
                        title_before =>'',title_after=>'')).'<br>&nbsp;';
                $content=preg_replace("/<ul class=.+>/", "<ul>", $content);
            }else if(preg_match("/\[CALENDAR\]/",$array[$i]['content'])) {
                $content=$table_head_mc.RAMget_calendar().$table_foot;
            }else if(preg_match("/\[RECENTCOMMENTS\]/",$array[$i]['content'])) {
                $content=''.RAMrecent_comments().'<br>&nbsp;';
            }else {
                $include=RAMregex($array[$i]['content'],"INCLUDE");
                if($include) {
                    $filepath=dirname(__FILE__)."/includes/".$include;
                    if(file_exists($filepath)) {
                        $content=FileInput($filepath);
                    }else {
                        $content="File:".$include." does not exist.";
                    }
                    $filepath=null;
                    $include=null;
                }else {
                    $content=$array[$i]['content'];
                }
            }
            $title=$array[$i]['title'];
        }
        $title=preg_replace("/\\$/","\\\\$",$title);
        $title=preg_replace("/%%TITLE%%/",$title,$format['title']);
        $content=preg_replace("/\\$/","\\\\$",$content);
        $content=preg_replace("/%%CONTENT%%/",$content,$format['content']);
        if($returnarray) {
            $output[$i]['title']=$title;
            $output[$i]['content']=$content;
        } else {
            $output['title'] .= $title;
            $output['content'] .= $content;
        }
    }
    $title=null;
    $content=null;
    $id=null;
    $array=null;
    $format=null;
    return $output;
}
function FileInput($file) {
    $str=null;
    if(file_exists($file)) {
        $trimmed = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach($trimmed as $line) {
            $str.=$line;
        }
    }
    return $str;
}
function setOpacity($op) {
    return ($op>0.99?"":"filter:'alpha(opacity=".
                    ($op*100).")';filter:alpha(opacity=".
                    ($op*100).");opacity:$op;-moz-opacity:$op;-khtml-opacity:$op;");
}
function RAMget_calendar($initial = true) {
    global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
    ob_start();
    if(!$posts) {
        $gotsome = $wpdb->get_var("SELECT ID from $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC LIMIT 1");
        if(!$gotsome) {
        }
    }
    if(isset($_GET['w']))
        $w=''.intval($_GET['w']);
    $week_begins=intval(get_option('start_of_week'));
    if(!empty($monthnum)&&!empty($year)) {
        $thismonth=''.zeroise(intval($monthnum),2);
        $thisyear=''.intval($year);
    }elseif (!empty($w)) {
        $thisyear = ''.intval(substr($m,0,4));
        $d=(($w-1)*7)+6;
        $thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('${thisyear}0101', INTERVAL $d DAY) ), '%m')");
    }elseif (!empty($m)) {
        $thisyear=''.intval(substr($m,0,4));
        if(strlen($m)<6) {
            $thismonth='01';
        }else {
            $thismonth=''.zeroise(intval(substr($m,4,2)),2);
        }
    }else {
        $thisyear=gmdate('Y',current_time('timestamp'));
        $thismonth=gmdate('m',current_time('timestamp'));
    }
    $unixmonth=mktime(0,0,0,$thismonth,1,$thisyear);
    $previous=$wpdb->get_row("SELECT DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");
    $next=$wpdb->get_row("SELECT DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-01'
		AND MONTH( post_date ) != MONTH( '$thisyear-$thismonth-01' )
		AND post_type = 'post' AND post_status = 'publish'
			ORDER	BY post_date ASC
			LIMIT 1");
    $str.='<table summary="' . __('Calendar') . '">
	<caption><strong>' . sprintf(_c('%1$s %2$s|Used as a calendar caption'), $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</strong></caption>
	<thead><tr>';
    $myweek = array();
    for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
        $myweek[]=$wp_locale->get_weekday(($wdcount+$week_begins)%7);
    }
    foreach($myweek as $wd) {
        $day_name=(true==$initial)?$wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
        $str.="<th abbr=\"$wd\" scope=\"col\" title=\"$wd\">$day_name</th>";
    }
    $str.='</tr></thead><tfoot><tr>';
    if ($previous) {
        $str.='<td abbr="' . $wp_locale->get_month($previous->month) . '" colspan="3" id="prev"><a href="' .
                get_month_link($previous->year, $previous->month) . '" title="' . sprintf(__('View posts for %1$s %2$s'), $wp_locale->get_month($previous->month),
                date('Y',mktime(0,0,0,$previous->month,1,$previous->year))).'">&laquo; '.$wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)).'</a></td>';
    }else {
        $str.= '<td colspan="3" id="prev" class="pad">&nbsp;</td>';
    }
    $str.= '<td class="pad">&nbsp;</td>';
    if ( $next ) {
        $str.= '<td abbr="' . $wp_locale->get_month($next->month).'" colspan="3" id="next"><a href="' .
                get_month_link($next->year,$next->month).'" title="'.sprintf(__('View posts for %1$s %2$s'),$wp_locale->get_month($next->month),
                date('Y',mktime(0,0,0,$next->month,1,$next->year))).'">'.$wp_locale->get_month_abbrev($wp_locale->get_month($next->month)).' &raquo;</a></td>';
    } else {
        $str.='<td colspan="3" id="next" class="pad">&nbsp;</td>';
    }
    $str.='</tr></tfoot><tbody><tr>';
    $dayswithposts=$wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts WHERE MONTH(post_date) = '$thismonth'
		AND YEAR(post_date) = '$thisyear'
		AND post_type = 'post' AND post_status = 'publish'
		AND post_date < '".current_time('mysql').'\'',ARRAY_N);
    if($dayswithposts) {
        foreach ((array)$dayswithposts as $daywith) {
            $daywithpost[]=$daywith[0];
        }
    } else {
        $daywithpost=array();
    }
    if (strpos($_SERVER['HTTP_USER_AGENT'],'MSIE')!==false||strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'camino')!==false||strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'safari')!==false) {
        $ak_title_separator="\n";
    }
    else {
        $ak_title_separator=', ';
    }
    $ak_titles_for_day=array();
    $ak_post_titles=$wpdb->get_results("SELECT post_title, DAYOFMONTH(post_date) as dom "
            ."FROM $wpdb->posts "
            ."WHERE YEAR(post_date) = '$thisyear' "
            ."AND MONTH(post_date) = '$thismonth' "
            ."AND post_date < '".current_time('mysql')."' "
            ."AND post_type = 'post' AND post_status = 'publish'"
    );
    if ( $ak_post_titles ) {
        foreach ( (array) $ak_post_titles as $ak_post_title ) {

            $post_title = apply_filters( "the_title", $ak_post_title->post_title );
            $post_title = str_replace('"', '&quot;', wptexturize( $post_title ));

            if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
                $ak_titles_for_day['day_'.$ak_post_title->dom] = '';
            if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
                $ak_titles_for_day["$ak_post_title->dom"] = $post_title;
            else
                $ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
        }
    }
    $pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
    if ( 0 != $pad )
        $str.= '<td colspan="'.$pad.'" class="pad">&nbsp;</td>';
    $daysinmonth = intval(date('t', $unixmonth));
    for ( $day = 1; $day <= $daysinmonth; ++$day ) {
        if ( isset($newrow) && $newrow )
            $str.= "</tr><tr>";
        $newrow = false;
        if ( $day == gmdate('j', (time() + (get_option('gmt_offset') * 3600))) && $thismonth == gmdate('m', time()+(get_option('gmt_offset') * 3600)) && $thisyear == gmdate('Y', time()+(get_option('gmt_offset') * 3600)) )
            $str.= '<td id="today" style="font-weight:bold;">';
        else
            $str.= '<td>';
        if ( in_array($day, $daywithpost) )
            $str.= '<a href="' . get_day_link($thisyear, $thismonth, $day) . "\" title=\"$ak_titles_for_day[$day]\">$day</a>";
        else
            $str.= $day;
        $str.= '</td>';
        if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
            $newrow = true;
    }
    $pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
    if ( $pad != 0 && $pad != 7 )
        $str.= '<td class="pad" colspan="'.$pad.'">&nbsp;</td>';
    $str.= "</tr></tbody></table>";
    return $str;
}
function RAMrecent_comments($count=7, $length=30) {
    global $wpdb;
    $sql= "SELECT comment_author,comment_ID,comment_post_ID,comment_approved,comment_type,SUBSTRING(comment_content,1,$length) AS excerpt FROM $wpdb->comments WHERE comment_approved = '1' AND comment_type = '' ORDER BY comment_date_gmt DESC LIMIT $count";
    $comments = $wpdb->get_results($sql);
    $output .= "<ul>";
    foreach ($comments as $comment) {
        $output.='<li>' . sprintf(__('%1$s on %2$s'), $comment->comment_author, '<a href="'. get_comment_link($comment->comment_ID) . '">' . get_the_title($comment->comment_post_ID) . '</a>') . ":&nbsp;".strip_tags($comment->excerpt) . '...</li>';
    }
    $output .= "</ul>";
    return $output;
}
?>