<?php
$conn = new mysqli("localhost", "root", "", "parkify");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM parkingspots";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Parking Spots</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('bg1.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #ffffff;
        }

        .container {
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 40px;
            max-width: 90%;
            margin: 60px auto;
            box-shadow: 0 0 20px rgba(0, 255, 255, 0.3);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #00ffff;
            font-size: 2rem;
            text-shadow: 0 0 10px #00ffff80;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 16px;
            text-align: center;
        }

        th {
            background: rgba(0, 106, 255, 0.3);
            color: #ffffff;
        }

        td {
            background: rgba(255, 255, 255, 0.1);
            color: #f0f0f0;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            table {
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Parking Spots</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>City</th>
                <th>Area</th>
                <th>Total Slots</th>
                <th>Available Slots</th>
                <th>Latitude</th>
                <th>Longitude</th>
            </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['city']}</td>
                        <td>{$row['area']}</td>
                        <td>{$row['total_slots']}</td>
                        <td>{$row['available_slots']}</td>
                        <td>{$row['lat']}</td>
                        <td>{$row['lon']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No parking spots found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
