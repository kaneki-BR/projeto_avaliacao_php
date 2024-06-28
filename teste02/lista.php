<!DOCTYPE html>
<html lang="pt-BR">
<link rel="stylesheet" href="styles.css">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Contas a Pagar</title>
</head>
<body>
    <h1>Contas a Pagar</h1>
    <table border="1">
        <tr>
            <th>Empresa</th>
            <th>Data a Pagar</th>
            <th>Valor</th>
            <th>Pago</th>
            <th>Ações</th>
        </tr>
        <?php
        include 'conexao.php';

        $sql = "SELECT c.id_conta_pagar, e.nome, c.data_pagar, c.valor, c.pago FROM tbl_conta_pagar c 
                JOIN tbl_empresa e ON c.id_empresa = e.id_empresa";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $valor_formatado = number_format($row['valor'], 2, ',', '.');
            $pago = $row['pago'] ? 'Sim' : 'Não';

            echo "<tr>
                    <td>{$row['nome']}</td>
                    <td>{$row['data_pagar']}</td>
                    <td>R$ {$valor_formatado}</td>
                    <td>{$pago}</td>
                    <td>
                        <a href='marcarPago.php?id={$row['id_conta_pagar']}'>Marcar como Paga</a> | 
                        <a href='editar.php?id={$row['id_conta_pagar']}'>Editar</a> | 
                        <a href='excluir.php?id={$row['id_conta_pagar']}'>Excluir</a>
                    </td>
                </tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
