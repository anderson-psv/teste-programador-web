<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Vendas</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="main">
    <?php
        require_once('./inc/db_conncet.php');
        require_once('./inc/nav_bar.php');
    ?>
    <h1>Listagem de Produtos</h1>
        <?php
            $results = $conn->query("SELECT * FROM produto ORDER BY referencia");

            if ($results->num_rows > 0)
            {   
                echo "<table border='1' width='100%'>
                        <tr>
                            <th width='100' >Referência</th>
                            <th >Nome</th>
                            <th >Preço Un.</th>
                        </tr>";

                foreach ($results as $res)
                {
                    echo "<tr>
                            <td align='right'>$res[referencia]</td>
                            <td>$res[nome]</td>
                            <td align='right'>".number_format($res['preco'], 2 , ',', '.')."</td>
                        <tr>";
                }
                echo "</table>";
            }
            mysqli_free_result($results);
            $conn->close();
        ?>
    </section>
</body>
</html>