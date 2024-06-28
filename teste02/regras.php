<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obter a conta a pagar
    $sql = "SELECT valor, data_pagar FROM tbl_conta_pagar WHERE id_conta_pagar = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($valor, $data_pagar);
    $stmt->fetch();
    $stmt->close();

    $hoje = date("Y-m-d");
    $data_pagar = strtotime($data_pagar);
    $hoje = strtotime($hoje);

    if ($hoje < $data_pagar) {
        $valor *= 0.95; // Desconto de 5%
    } elseif ($hoje > $data_pagar) {
        $valor *= 1.10; // Acréscimo de 10%
    }

    // Marcar como paga e atualizar valor
    $sql = "UPDATE tbl_conta_pagar SET pago = 1, valor = ? WHERE id_conta_pagar = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("di", $valor, $id);

    if ($stmt->execute()) {
        echo "Conta marcada como paga com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
