<?php
require_once('functions.php');
if(isset($_GET['file'])) {
    $file=RAMsanitize($_GET['file']);
    RAMgzipdeliver($file,($_GET['cacheonly']=='true'?true:false));
    $file=null;
    $type=null;
}else{echo "ERROR";}
?>