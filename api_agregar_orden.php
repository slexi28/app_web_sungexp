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

    $input = json_decode(file_get_contents('php://input'), true);
    $id_cliente = $input['id_cliente'];
    $total = $input['total'];
    $estado = 'pendiente';

    $sql = "INSERT INTO Orden (fecha, total, estado, id_cliente) VALUES (GETDATE(), ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$total, $estado, $id_cliente]);

    echo "✅ Orden agregada correctamente";

} catch (PDOException $e) {
    echo "❌ Error al agregar la orden: " . $e->getMessage();
}
?>
