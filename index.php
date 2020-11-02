<!DOCTYPE html>
<html>
    <head>
        <title>Lista de tradução</title>
        <link rel="stylesheet" href="assets/home.css">
    </head>
    <body>

        <?php 
            if(isset($_POST['inserir'])) { // VERIFICANDO SE O USUARIO CLICOU NO BOTÃO INSERIR
                // ARRAY DOS DADOS INSERIDO PELO USUARIO
                $arrayFile = array(
                    'en' => $_POST['en'],
                    'pt' => $_POST['pt']
                );

                // VERIFICANDO SE A PALAVRA JÁ FOI GRAVADA
                $arqLeitura = file('msg.txt');

                foreach($arqLeitura as $imprime) { $linha = trim($imprime); $valor = explode('|', $linha);
                    if($valor[0] == $arrayFile['en']) {
                        echo "<script>alert('A palavra já foi inserida.');
                        window.location.href='index.php'; </script>";
                        exit;
                    }
                }
                //SALVANDO OS DADOS EM UM TXT
                extract($_REQUEST);
                $arquivo = fopen("msg.txt", "a");

                fwrite($arquivo, $arrayFile['en']."|");
                fwrite($arquivo, $arrayFile['pt']."\n");

                fclose($arquivo);

            }

        ?>
        <form action="" method="post">
            <p>
                <label>Inglês</label>
                <input type="text" name="en">
            </p>
            <p>
                <label>Português</label>
                <input type="text" name="pt">
            </p>
            <p>
                <input type="submit" value="Inserir" name="inserir">
            </p>

        </form>
        <h2>Lista de palavras traduzidas</h2>
        <table border="0">
                <tr>
                    <td class="title">#</td>
                    <td class="title">Inglês</td>
                    <td class="title">Português</td>
                </tr>
            <?php 
            
            $arq = file('msg.txt'); 
            $i=0;
            foreach($arq as $imprime) { $linha = trim($imprime); $valor = explode('|', $linha); $i++;?>
                <tr>
                    <td class="conteudo"><?= $i ?></td>
                    <td class="conteudo"><?= (isset($valor[0])?$valor[0]:''); ?></td>
                    <td class="conteudo"><?= (isset($valor[1])?$valor[1]:''); ?></td>
                </tr>
            <?php } ?>
        </table>

    </body>
</html>