<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_conta_pagar = $_POST['id_conta_pagar'];
    $id_empresa = $_POST['id_empresa'];
    $data_pagar = $_POST['data_pagar'];
    $valor = $_POST['valor'];

    $sql = "UPDATE tbl_conta_pagar SET valor = ?, data_pagar = ?, id_empresa = ? WHERE id_conta_pagar = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dsii", $valor, $data_pagar, $id_empresa, $id_conta_pagar);

    if ($stmt->execute()) {
        header("Location: lista.php");
        exit();
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
