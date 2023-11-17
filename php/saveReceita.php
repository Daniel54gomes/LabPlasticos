<?php 
    include('function.php');
    include('connection.php');
    if(session_status() !== PHP_SESSION_ACTIVE){
        session_start();
    }
    $abreHTMLalert = '<div class="input-group mb-3">'
                    .'<div class="input-group-prepend" style="width: 100%; height:100%;">'
                    .'<div class="alert alert-warning" role="alert" style="width:100%; height:100%">';
    $fechaHTMLalert = '</div></div></div>';
    //Verifica se foi selecionado material
    if(!isset($_POST['tableMateriais'])){
        $_SESSION['error'] = $abreHTMLalert.'Escolha um material!'.$fechaHTMLalert;
        header('location: ../cadastroReceitas.php?idProduto='.$_GET["idProduto"].'&pr='.$_GET['pr']);
    }
    $produto=$_GET["idProduto"];
    //id de cada material
    $material=$_POST['tableMateriais'];
    $pigmento=$_POST['nPigmento'];
    $pesoPigmento = $_POST['nQuantPigmento'];
    $quant=[];
    $pesoMaterial=0;
    echo $_GET['pr'].' '.$_GET['idProduto'].'<br>';
    //CRIA UM VETOR DE QUANTIDADE COM A MESMA POSIÇÃO QUE O VETOR MATERIAL
    for($i=0;$i<count($material);$i++){
        //Verifica se um material n tem quantidade
        if(intval($_POST['nQuantidade'.$material[$i]])==0){
            $_SESSION['error'] = $abreHTMLalert.'Escolha uma quantidade para cada material selecionado!'.$fechaHTMLalert;
            header('location: ../cadastroReceitas.php?idProduto='.$_GET["idProduto"].'&pr='.$_GET['pr']);
        }
        $quant[]=$_POST['nQuantidade'.$material[$i]];
        $pesoMaterial+=intval($_POST['nQuantidade'.$material[$i]]);
    }

    $pesoTotal=$pesoMaterial+intval($pesoPigmento);
    
    $sql='select peso from produtos where idProduto='.$_GET["idProduto"];
    $result= mysqli_query($conn, $sql);
    mysqli_close($conn);

    if (mysqli_num_rows($result) > 0){

        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }
        foreach($array as $campo){
            if($campo['peso']<$pesoTotal){
                $_SESSION['error'] = $abreHTMLalert.'Peso total ultrapassa do peso do produto!'.$fechaHTMLalert;
                header('location: ../cadastroReceitas.php?idProduto='.$_GET["idProduto"].'&pr='.$_GET['pr']);
            }else if($campo['peso']>$pesoTotal){
                $_SESSION['error'] = $abreHTMLalert.'Peso total insuficiente para fabricar o produto!'.$fechaHTMLalert;
                header('location: ../cadastroReceitas.php?idProduto='.$_GET["idProduto"].'&pr='.$_GET['pr']);
            }
        }
    }
    $sqlInsert = "Insert into receitas (login, senha, nome , sobrenome, idTurma, tipo, ativo) values"
                ."('".$email."', md5('".$senha."'), '".$nome."' , '".$sobrenome."', ".$turma.", ".$tipoUsu.", 1);";
    mysqli_query($conn, $sqlInsert);
    mysqli_close($conn);












    //TESTE
    for($i=0;$i<count($material);$i++){
        echo $material[$i].' Tipo:'.' '.gettype($material[$i]).' quant:'.$quant[$i].' |';
    }
    echo $pigmento.' Quant:'.$pesoPigmento.'<br>';
    echo 'PesoTotal:'.$pesoTotal.'<br>';
    /*
    echo '<br>';
    $matriz=[];
    for($a= 0;$a<10;$a++){
        $matriz[$a]=[];
        echo '[';
        for($i= 0;$i<10;$i++){
            $matriz[$a][$i]=rand(0,9);
            echo $matriz[$a][$i];
            if($i<10){
                echo ',';
            }
        }
        echo ']<br>';
    }*/

    die();

?>
