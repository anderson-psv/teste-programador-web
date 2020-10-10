<?php

// Used in index.php
if(isset($_GET) && $_GET['busca'])
{
    require_once('../inc/db_conncet.php');


    $busca   = $conn->real_escape_string($_GET['busca']);
    $results = $conn->query("SELECT * FROM produto
                             WHERE referencia LIKE '%$busca%'
                             OR nome LIKE '%$busca%'");
    
    if($results->num_rows > 0)
    {
        echo "<table border='1'>
                <tr>
                    <th>Referência</th>
                    <th>Nome</th>
                    <th>Preço Un.</th>
                    <th width='1'>Adicionar</th>
                </tr>";

        foreach ($results as $res)
        {
            echo "<tr>
                    <td align='right'>$res[referencia]</td>
                    <td>$res[nome]</td>
                    <td align='right'>$res[preco]</td>
                    <td align='center'><input type='checkbox' name='id_produtos_add[]' value='$res[id]'></td>
                </tr>";
        }
        echo "</table><br><button type='button' onclick='insere_produtos()'>Adicionar</button>";
    }
    else
    {
        //Error
        echo 0;
    }
}
exit();
?>
