<?php
session_start() ;
setcookie('id','',time()-5000) ;
setcookie('key','',time()-5000) ;
$_SESSION = [] ;
session_unset() ;
session_destroy() ;
header("Location: ../websitezahoteel/index.php") ;

?>
