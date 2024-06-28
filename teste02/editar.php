<!DOCTYPE html>
<html lang="pt-BR">
<head>
<link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Editar Conta a Pagar</title>
</head>
<body>
    <h1>Editar Conta a Pagar</h1>
    <?php
    include 'conexao.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Obter os dados da conta a pagar
        $sql = "SELECT valor, data_pagar, id_empresa FROM tbl_conta_pagar WHERE id_conta_pagar = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($valor, $data_pagar, $id_empresa);
        $stmt->fetch();
        $stmt->close();
    }
    ?>

    <form action="processoEditar.php" method="POST">
        <input type="hidden" name="id_conta_pagar" value="<?php echo $id; ?>">
        <label for="empresa">Empresa:</label>
        <select name="id_empresa" id="empresa" required>
            <?php
            $sql = "SELECT id_empresa, nome FROM tbl_empresa";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                $selected = ($row['id_empresa'] == $id_empresa) ? 'selected' : '';
                echo "<option value='{$row['id_empresa']}' {$selected}>{$row['nome']}</option>";
            }
            ?>
        </select><br>

        <label for="data_pagar">Data a ser pago:</label>
        <input type="date" id="data_pagar" name="data_pagar" value="<?php echo $data_pagar; ?>" required><br>

        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor" value="<?php echo $valor; ?>" required><br>

        <button type="submit" name="submit">Salvar</button>
    </form>
</body>
</html>
