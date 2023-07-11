<?php
    include "Menu.php";
 ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Ölçümler</title>
    <style>
        /* CSS still remains the same */
        table {
            border-collapse: collapse;
            width: 70%;
            margin-left:auto;
            margin-right:auto;
        }
        /* ... */

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

    <!-- Include the Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php
    include "Menu.php";
?>
    <!-- Navbar and table code still remains the same -->

    <!-- Add a canvas element for the chart -->
    <canvas id="myChart"></canvas>

    <?php
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

        

        // SQL sorgusunu hazırla
        $sql = "SELECT ZAMAN, SICAKLIK, NEM FROM genel_olcumler ORDER BY ID DESC LIMIT 20";
        $result = $conn->query($sql);

        // Grafik için gerekli verileri oluştur
        $labels = array();
        $temperatureData = array();
        $humidityData = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $labels[] = $row['ZAMAN'];
                $temperatureData[] = $row['SICAKLIK'];
                $humidityData[] = $row['NEM'];
            }
        }
/* echo json_encode($labels);
echo json_encode($temperatureData);
echo json_encode($humidityData); */
        // Veritabanı bağlantısını kapat
        $conn->close();
    ?>

    <!-- JavaScript code to create the chart -->
    <script>

		// Extracted data from PHP variables

        var labels = <?php echo json_encode($labels); ?>;
        var temperatureData = <?php echo json_encode($temperatureData); ?>;
        var humidityData = <?php echo json_encode($humidityData); ?>;

        // Create a chart using Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Sıcaklık',
                        data: temperatureData,
                        borderColor: 'red',
                        fill: false
                    },
                    {
                        label: 'Nem',
                        data: humidityData,
                        borderColor: 'blue',
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Zaman'
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Değer'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
