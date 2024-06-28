<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_empresa = $_POST['id_empresa'];
    $data_pagar = $_POST['data_pagar'];
    $valor = $_POST['valor'];

    $sql = "INSERT INTO tbl_conta_pagar (valor, data_pagar, pago, id_empresa) VALUES (?, ?, 0, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dsi", $valor, $data_pagar, $id_empresa);

    if ($stmt->execute()) {
        echo "Nova conta adicionada com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
