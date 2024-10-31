<?php
function RAMtabReset(){

}
function RAMtabScript($id, $added, $height) {
    $str='<script type="text/javascript">'
    .(!$added?'Rico.loadModule("Accordion","Corner");':'');
    $c=count($id);
    for($i=0;$i<$c;$i++) {
        $str.='Rico.onLoad(function(){var options={panelHeight:'
        .$height[$i].',hoverClass:"panelHover'.$id[$i].'",selectedClass:"panelSelected'
        .$id[$i].'"};options.corners="top";new Rico.TabbedPanel($$("div.panelheader'.$id[$i].'"),$$("div.panelContent'.$id[$i].'"),options);});';
    }
    $str.='</script>';
    $id=null;
    $added=null;
    $height=null;
    return $str;
}
function RAMtabTemp($id,$opacity=100) {
    return '<style type="text/css">#ricoTab'
    .$id.'{position:relative;width:%%WIDTH%%;'
    .setOpacity($opacity).'}.panelContentContainer'
    .$id.'{border:1px solid %%BORDERCOLOR%%;clear:both;}.panelheader'
    .$id.'{height:1.5em;color:%%TABTEXTCOLOR%%;background-color:%%TABCOLOR%%;font-weight:bold;float:left;display:inline;margin-top:1px;margin-left:1px;margin-right:1px;text-align:center;white-space:nowrap;overflow:hidden;%%HEADERWIDTH%%padding-top:3px;}.panelHover'
    .$id.'{color:%%HOVERCOLOR%%;cursor:pointer;}.panelSelected'.$id.'{color:%%SELECTEDTABTEXTCOLOR%%;background:%%SELECTEDTABCOLOR%%;cursor:auto;}.panelContent'
    .$id.'{%%CONTENTBG%%overflow:auto;}</style><div id="ricoTab'.$id.'"><div>%%TABS%%</div><div class="panelContentContainer'
    .$id.'">%%CONTENTS%%</div></div>';
}
?>