<?php

session_start();

session_destroy();

setcookie('name', '', time()-60*60);

header("location:index.php?out=yes");
exit();

?>