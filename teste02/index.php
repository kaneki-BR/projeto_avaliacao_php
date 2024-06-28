<!DOCTYPE html>
<html lang="pt-BR">
<link rel="stylesheet" href="styles.css">
<head>
    <meta charset="UTF-8">
    <title>Gerenciamento de Contas a Pagar</title>
</head>
<body>
    <h1>Adicionar/Editar Conta a Pagar</h1>
    <form action="processamentoForm.php" method="POST">
        <label for="empresa">Empresa:</label>
        <select name="id_empresa" id="empresa" required>
            <?php
            include 'conexao.php';
            $sql = "SELECT id_empresa, nome FROM tbl_empresa";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id_empresa']}'>{$row['nome']}</option>";
            }
            ?>
        </select><br>
        
        <label for="data_pagar">Data a ser pago:</label>
        <input type="date" id="data_pagar" name="data_pagar" required><br>
        
        <label for="valor">Valor:</label>
        <input type="text" id="valor" name="valor" required><br>
        
        <button type="submit" name="submit">Inserir / Editar</button>
    </form>
    <form action="lista.php" method="POST">
    <button type="submit" name="submit">lista de contas</button>
    </form>
</body>
</html>
