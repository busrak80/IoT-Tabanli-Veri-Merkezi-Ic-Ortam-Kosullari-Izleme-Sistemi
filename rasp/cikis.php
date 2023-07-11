<?php
 
session_start();

 
session_destroy();
 
echo "Çıkış Yaptınız.Login Sayfasına Yönlendiriliyorsunuz";
 
header("Refresh: 2; url=index.php");
 
?>