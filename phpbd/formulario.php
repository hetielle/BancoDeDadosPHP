<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cliente</title>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data">

    Nome:<input type="text" name="nome"/><br/>
    Email:<input type="text" name="email"/><br/>
    Cidade:<input type="text" name="cidade"/><br/>
    Foto:<input type="file" name="foto"/><br/>

    <input type="submit" name="Incluir" value="Incluir"/>
    <input type="reset" name="Limpar" value="Limpar"/>
    <input type="submit" name="Mostrar" value="Mostrar"/>

</form>

<?php
    $nome=isset($_POST['nome'])?$_POST['nome']:null;
    $email=isset($_POST['email'])?$_POST['email']:null;
    $cidade=isset($_POST['cidade'])?$_POST['cidade']:null;
    $foto=isset($_FILES['foto']['name'])? $_FILES['foto']['name']:null;
 
    //////inserção no BD
    include("conexao.php");
    if(isset($_POST['Incluir']) && !empty($_POST['nome'])){
 
    $db=mysqli_select_db($conexao,$banco);
    $grava=mysqli_query($conexao,"insert into cliente(nome,email,cidade,foto)values('$nome','$email','$cidade','$foto')");
        if($grava==true){
            echo"Cadastro efetuado com sucesso!";
            move_uploaded_file($_FILES['foto']['tmp_name'],"upload/".$_FILES['foto']['name']);
 
        }else
            echo"Impossível incluir!";
        }

  /////mostra o que tem no BD
    if(isset($_POST['Mostrar'])){

    include("conexao.php");
        $db=mysqli_select_db($conexao,$banco);
        $resultado=mysqli_query($conexao,"select * from cliente order by codigo;");
        $num_linhas=mysqli_num_rows($resultado);
        echo"<table border=\"1\">";
        echo"<tr>
                <td>Código</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Cidade</td>
                <td>Foto</td>
                <td>Excluir registro</td>
                <td>Alterar registro</tr>
            </tr>";

        for($i=0;$i<$num_linhas;$i++){ 
            $mostra_tabela=mysqli_fetch_array($resultado);
            $codigo= $mostra_tabela['codigo'];
            echo"<tr>";
            echo"<td>";
            echo $codigo;
            echo"</td>";
            echo"<td>";
            echo $mostra_tabela['nome'];
            echo"</td>";
            echo"<td>";
            echo $mostra_tabela['email'];
            echo"</td>";
            echo"<td>";
            echo $mostra_tabela['cidade'];
            echo"</td>";
            echo"<td>";
            echo "<img width='50' height='50'src='upload/".$mostra_tabela['foto']."'>";
            echo"</td>";
            echo"<td><a href='excluir.php?x=$codigo'>Excluir</a></td>";
            echo"<td><a href='alterar.php?y=$codigo'>Alterar</a></td>";
            $nome=isset($_POST['nome'])?$_POST['nome']:null;
            $email=isset($_POST['email'])?$_POST['email']:null;
            $cidade=isset($_POST['cidade'])?$_POST['cidade']:null;
            $foto=isset($_FILES['foto']['name'])? $_FILES['foto']['name']:null;
        }
    }    
    //////inserção no BD
    include("conexao.php");
    if(isset($_POST['Incluir']) && !empty($_POST['nome'])){
        $db=mysqli_select_db($conexao,$banco);
        $grava=mysqli_query($conexao,"insert into cliente(nome,email,cidade,foto)values('$nome','$email','$cidade','$foto')");
        if($grava==true){
            echo"Cadastro efetuado com sucesso!";
            move_uploaded_file($_FILES['foto']['tmp_name'],"upload/".$_FILES['foto']['name']);
        }else
            echo"Impossível incluir!";
        }

  /////mostra o que tem no BD
    if(isset($_POST['Mostrar'])){

        include("conexao.php");
        $db=mysqli_select_db($conexao,$banco);
        $resultado=mysqli_query($conexao,"select * from cliente order by codigo;");
        $num_linhas=mysqli_num_rows($resultado);
        echo"<table border=\"1\">";
        echo"<tr>
                <td>Código</td>
                <td>Nome</td>
                <td>Email</td>
                <td>Cidade</td>
                <td>Foto</td>
                <td>Excluir registro</td>
                <td>Alterar registro</tr>
            </tr>";

    
        for($i=0;$i<$num_linhas;$i++){ 
            $mostra_tabela=mysqli_fetch_array($resultado);
            $codigo= $mostra_tabela['codigo'];
            echo"<tr>";
            echo"<td>";
            echo $codigo;
            echo"</td>";
            echo"<td>";
            echo $mostra_tabela['nome'];
            echo"</td>";
            echo"<td>";
            echo $mostra_tabela['email'];
            echo"</td>";
            echo"<td>";
            echo $mostra_tabela['cidade'];
            echo"</td>";
            echo"<td>";
            echo"</tr>";
        }
    echo"</table>";
  }

  mysqli_close($conexao); 

?>
</body>
</html>