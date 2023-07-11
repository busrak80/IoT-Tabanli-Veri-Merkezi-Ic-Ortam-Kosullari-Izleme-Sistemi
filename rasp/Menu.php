<?php
session_start();
?>

<div class="navbar">
        <ul>
            <li><a href="http://localhost/rasp/OlcumTablo.php">Ölçümler</a></li>
            <li><a href="http://localhost/rasp/grafik.php">Ölçümler Grafik Tablo</a></li>
            <li><a href="http://localhost/rasp/register.php">Yönetici Ekle</a></li>
            <li><a href="#"><?php echo "<b>Mevcut Kullanıcı : ".$_SESSION["kullanici_adi"] ?></a></li>
            <li>
        </ul>
        <ul>
            <li><a href="http://localhost/rasp/cikis.php">Çıkış Yap</a></li>

        </ul>
</div>
