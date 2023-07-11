<?php
session_start(); 
ini_set('error_reporting', 0);
ini_set('display_errors', 0);


//veritabanına veri eklemek için veri tabanı bağlantısını yapıyoruz.
$vt_sunucu= "localhost";
$vt_kullanici= "root";
$vt_sifre= "";
$vt_adi= "olcumler";

// Bağlantıyı oluştur
$conn= mysqli_connect($vt_sunucu, $vt_kullanici, $vt_sifre, $vt_adi);
$conn->set_charset("utf8");
// bağlantıyı test et

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}

$sql = "SELECT ZAMAN,SICAKLIK,NEM,YANGIN,SU,SES,HAREKET FROM genel_olcumler ORDER BY ID DESC LIMIT 20";

$result = $conn->query($sql);

?>

<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
 <title>Ölçümler</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
			margin-left:auto;
			margin-right:auto;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
		td:hover{
          background-color:blue;
		}
		h1{
			text-align:center;
		}
		
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
	</head>
	<body>

    <?php
    include "Menu.php";
    ?>

	
    <h1>Ölçümler</h1>
    <table>
        <tr>
            <th>Zaman</th>
            <th>Sıcaklık</th>
            <th>Nem</th>
            <th>Yangın</th>
            <th>Su</th>
			<th>Hareket</th>
			 <th>Ses</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
       ?>

		 <?php
      


            echo "<tr>";
            echo "<td>".$row['ZAMAN']."</td>";
            echo "<td>".$row['SICAKLIK']."</td>";
            echo "<td>".$row['NEM']."</td>";
            echo "<td>".$row['YANGIN']."</td>";
            echo "<td>".$row['SU']."</td>";
			echo "<td>".$row['SES']."</td>";
			echo "<td>".$row['HAREKET']."</td>";
            echo "</tr>";
        
            }
        }
        ?>
    </table>
    
<?php

header("Refresh: 10; url=OlcumTablo.php");
 
?> 

</body>
</html>
