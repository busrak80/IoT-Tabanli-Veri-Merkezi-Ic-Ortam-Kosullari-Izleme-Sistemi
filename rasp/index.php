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
    <title>Giriş Yap</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
        <h2>Giriş Yap</h2>
        <form action="LoginKontrol.php" method="post">
            <label>Kullanıcı Adı:</label>
            <input type="text" name="kullanici_adi" required><br><br>
            <label>Şifre:</label>
            <input type="password" name="sifre" required><br><br>
            <input type="submit" value="Giriş Yap">            
        </form>
    </div>
</body>
</html>
