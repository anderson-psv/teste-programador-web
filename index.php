
<?php

if(isset($_POST['action']) && $_POST['action'] === 'add')
{
    add_venda();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Vendas</title>

    <link rel="stylesheet" href="style.css">
    <script src="index.js"></script>
    <script>
        window.onload = function() 
        {   
            const cepBox          = document.getElementById('cep');
            const btn_buscar_prod = document.getElementById('btn_buscar');
            
            if (cepBox)
            {
                cepBox.addEventListener('keyup', function() {
                    format_cep(cepBox);
                });
            };

            if(btn_buscar_prod)
            {
                btn_buscar_prod.addEventListener('click', function() {
                    busca = document.getElementById('search_produto').value;
                    busca_produtos(busca);
                });
            };
        }
    </script>
    
</head>
<body>
    <section class="main">
        <?php
            require_once('./inc/db_conncet.php');
            require_once('./inc/nav_bar.php');
        ?>
        <!-- Cadastro Venda -->
        <div class="main_div">
            <form action="" method="post">
                <h1>Cadatro de Vendas</h1><br>

                <label for="">Data: </label>
                <input type="date" value="" required><br><br>

                <!-- Endereco de Entrega-->
                <div class="inner_div">
                    <h3>Endereço de Entrega</h3><br>
                    <label for="">CEP: </label><br>
                    <input type="text" name="cep" id="cep" maxlength="9" value="" required><br>
        
                    <label for="">Rua: </label><br>
                    <input type="text" name="rua" id="rua" value="" required ><br>
        
                    <label for="">Bairro: </label><br>
                    <input type="text" name="bairro" id="bairro" value="" required ><br>
        
                    <label for="">Cidade: </label><br>
                    <input type="text" name="cidade" id="cidade" value="" required ><br>
        
                    <label for="">UF: </label><br>
                    <input type="text" name="uf" id="uf" value="" maxlength="2" required ><br>
                </div>
                <br>
                <!-- Produtos -->
                <div class="inner_div">
                    <h3>Produtos</h3><br>
                    
                    <label for="">Produto: </label><br>
                    <input type="text" name="search_produto" id="search_produto">
                    <button type="button" id="btn_buscar">Buscar</button><br><br>
                    
                    <div id=div_busca_prod></div>

                    <div id=div_produtos></div>
                </div>
                <br>
                <input type="hidden" name="action" value='add'>
                <button type="submit" id="submit_button">Adicionar Venda</button>
            </form>
    </div>
    <br>
    <?php
        $results = $conn->query("SELECT v.id    as id_venda,
                                v.data,
                                vp.preco_unit as preco,
                                p.nome        as produto,
                                f.nome        as fornecedor
                                FROM venda as v
                                INNER JOIN venda_produto as vp
                                ON v.id=vp.venda_id
                                INNER JOIN  produto as p
                                ON vp.produto_id=p.id
                                INNER JOIN produto_fornecedor as pf
                                ON p.id=pf.produto_id
                                INNER JOIN fornecedor as f
                                ON pf.fornecedor_id=f.id
                                ORDER BY referencia");

        if ($results->num_rows > 0)
        {   
            echo "<table border='1' width='100%'>
                <tr>
                    <th >Referência</th>
                    <th >Descrição</th>
                    <th >Preço</th>
                </tr>";
            
            $id_venda = 0;
            
            foreach ($results as $res)
            {
                # code...
            }
            echo "</table>";
            mysqli_free_result($results);
            $conn->close();
        }
    ?>
    <hr>
    </section>
</body>
</html>
<?php
exit();

//Validaçã e inserção da venda
function add_venda()
{
    //In Progress
    header("Location: index.php");
}
?>