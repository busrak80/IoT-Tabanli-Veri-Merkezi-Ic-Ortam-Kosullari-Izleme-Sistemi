<?php
        session_start();
        // MySQL veritabanı bağlantısı için gerekli bilgileri ayarlayın
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "olcumler";

        // Veritabanına bağlan
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantı hatası kontrolü
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $kullanici_adi = $_POST["kullanici_adi"];
        $sifre = $_POST["sifre"];

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        
                if ($row["kullanici_adi"] == $kullanici_adi && $row["sifre"] == $sifre)
                {
                    $_SESSION["kullanici_adi"] = $kullanici_adi;
                    return header("Location: OlcumTablo.php");
                }
                else
                {
                    echo "Kullanıcı adı veya şifre hatalı login sayfasına yönlendiriliyor...";
                    header("Refresh: 2; url=index.php");
                }
            }
        }
        
        ?>
