<!DOCTYPE html>
<html>
<head>
 <style>
       
        .navbar {
            background-color: #333;
            color: #fff;
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin-right: 10px;
        }

        .navbar ul li a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
        }

        .navbar ul li a:hover {
            background-color: #555;
        }
    </style>
    <title>Kayıt Ol</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
    include "Menu.php";
?>

    <div class="container">
        <h2>Kayıt Ol</h2>
        <form action="LoginKayit.php" method="post">
            <label>Ad:</label>
            <input type="text" name="ad" required><br><br>
            <label>Soyad:</label>
            <input type="text" name="soyad" required><br><br>
            <label>Email:</label>
            <input type="email" name="email" required><br><br>
            <label>Kullanıcı Adı:</label>
            <input type="text" name="kullanici_adi" required><br><br>
            <label>Şifre:</label>
            <input type="password" name="sifre" required><br><br>
            <label>Telefon:</label>
            <input type="text" name="telefon" required><br><br>
            <button type="submit"> Kayıt Ol</button>
        </form>
    </div>
</body>
</html>
