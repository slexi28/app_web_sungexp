<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$server = 'tcp:sl-sungexp-prod-0001.database.windows.net,1433';
$database = 'database-sungexp';
$username = 'adminuserdb@sl-sungexp-prod-0001';
$password = 'Basededatos1@';

try {
    $conn = new PDO("sqlsrv:Server=$server;Database=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<h2 style='color: green;'>✅ Órdenes registradas en la base de datos:</h2>";

    $stmt = $conn->query("SELECT id_orden, fecha, total, estado FROM Orden");
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>ID Orden</th><th>Fecha</th><th>Total</th><th>Estado</th></tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $val) {
            echo "<td>" . htmlspecialchars($val) . "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "<h2 style='color: red;'>❌ Error: " . $e->getMessage() . "</h2>";
}
?>
