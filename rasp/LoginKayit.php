<?php
session_start();

//Post metodu ile gönderilen verilerimizi alıyoruz.
$ad=$_POST["ad"];
$soyad=$_POST["soyad"];
$email=$_POST["email"];
$kullanici_adi=$_POST["kullanici_adi"];
$sifre=$_POST["sifre"];
$telefon=$_POST["telefon"];
$OnayDurum="onay";



//veritabanına veri eklemek için veri tabanı bağlantısını yapıyoruz.
$vt_sunucu= "localhost";
$vt_kullanici= "root";
$vt_sifre= "";
$vt_adi= "olcumler";

// Bağlantıyı oluştur
$baglan= mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);

// Bağlantıyı Kontrol Et
if (!$baglan) {
    die("Veri Tabanı Bağlantısı Başarısız: " . mysqli_connect_error());

}
$ekle= "INSERT INTO users (id,ad,soyad,email,kullanici_adi,sifre,telefon)  
                        VALUES (NULL,'$ad','$soyad','$email,','$kullanici_adi','$sifre','$telefon')";

if ($baglan->query($ekle) === TRUE)
{
    echo "<script>alert('Kullanıcı Sisteme Eklendi.');
            window.location.href='OlcumTablo.php';
            </script>";
}
else
{
    echo "Hata: " . $ekle. "<br>" . $baglan->error;
}
