<?php

session_start();
 

if(!isset($_SESSION["kullanici_adi"])){
 //giriş yaptıktan sonra geri tusuna basıp siteyi kullanmamak için
 echo '<script>alert("Bu sayfayı görüntüleme yetkiniz yoktur.")</script>';
header("Refresh:0.5; url=http://localhost/rasp/cikis.php");
 
}else{
 

//giriş yaptıtran sonra engelleyici kurallar yok

}
 
?>