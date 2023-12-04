<?php 
function selectHistoricoPedidos($id){
    $sql = 'SELECT * FROM historico_pedidos WHERE idPedido = '.$id.' GROUP BY idPedido;';

    include('connection.php');

    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);

    $array = array();

    if(mysqli_num_rows($result) > 0){
        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            array_push($array, $linha);
        }
    } else {

        $array = 0;
    }
    
    return $array;
}

function nomeStatus($stats){
    $status = '';
    
    if($stats = 0){
        $status = 'Em Aberto';        
    } else if($stats = 1){
        $status = 'Em Aberto';        
    } else if($stats = 2){
        $status = 'Em Andamento';        
    } else if($stats = 3){
        $status = 'Concluido';        
    }

    return $status;
}

function receitas($id){

    include('connection.php');

    $receita='';

    $sql='SELECT * FROM receita_materia_prima WHERE idReceita='.$id.';';

    $receita = mysqli_query($conn,$sql);
    mysqli_close($conn);

    if (mysqli_num_rows($receita) > 0){

        $array = array();

        while($linha = mysqli_fetch_array($receita, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }

        $receitas = $array;
    }

    return $receitas;
}

function dataTablePedido(){

    include('connection.php');

    $sql = 'SELECT * FROM view_pedidos
                WHERE stats <> 0
                GROUP BY pedidoId
                ORDER BY pedidoId ASC;';
            

    $table = "";

    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0){

        $array = array();

        while($linha = mysqli_fetch_array($result, MYSQLI_ASSOC )){
            array_push($array,$linha);
        }

        foreach($array as $campo){

            $dataAberto =''.substr($campo['abertoData_hora'], 8, 2).'/';
            $dataAberto .=''.substr($campo['abertoData_hora'], 5, 2).'/';
            $dataAberto .=''.substr($campo['abertoData_hora'], 0, 4).'';
            $horaAberto = substr($campo['abertoData_hora'], 11, 8);

            $dataProducao =''.substr($campo['producaoData_hora'], 8, 2).'/';
            $dataProducao .=''.substr($campo['producaoData_hora'], 5, 2).'/';
            $dataProducao .=''.substr($campo['producaoData_hora'], 0, 4).'';
            $horaProducao = substr($campo['producaoData_hora'], 11, 8);
            
            $dataFechado =''.substr($campo['fechadoData_hora'], 8, 2).'/';
            $dataFechado .=''.substr($campo['fechadoData_hora'], 5, 2).'/';
            $dataFechado .=''.substr($campo['fechadoData_hora'], 0, 4).'';
            $horaFechado = substr($campo['fechadoData_hora'], 11, 8);            

            $table .=   
                    '<tr align-items="center";>
                        <td>'.$campo['pedidoId'].'</td>
                        <td>'.$campo['produto'].'</td> 
                        <td>'.materiaisReceita($campo['receitaId'],2).'</td>         
                        <td>'.$campo['cor'].'</td>
                        <td>'.$dataAberto.' às '.$horaAberto.'</td>';
    
            if ($campo['stats'] == 1){
                
                $table .=
                        '<td>                            
                        <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalInicio'.$campo['pedidoId'].'">
                                Em aberto
                            </button>                                
                        </td>'; 

            } else if ($campo['stats'] == 2) {

                $table .=
                        '<td>                                                                       
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAltera'.$campo['pedidoId'].'">
                                Em Produção
                            </button>
                        </td>';

            } else if ($campo['stats'] == 3) {

                $table .=
                        '<td>Concluido</td>';

            } else if ($campo['stats'] == 0) {

                $table .=
                        '<td>Cancelado</td>';

            }

            $table .=
                        '<td>
                            <div class="divButtons">
                                <div class="div1">                                                                         
                                    <button style="width: auto; border-radius: 5px;" type="button;" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalPedido'.$campo['pedidoId'].'">
                                        Visualizar
                                    </button>
                                </div>
                                <div class="div2">
                                    <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-danger margin-5" data-toggle="modal" data-target="#modalExclui'.$campo['pedidoId'].'">
                                        Desativar
                                    </button>
                                </div>
                            <div>
                        </td>

                        <div class="modal fade" id="modalExclui'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Desativar Produto/molde</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>                       
                                    <div class="modal-body">
                                        <form method="POST" action="php/savePedidos.php? validacao=D&id='.$campo["pedidoId"].'">
                                            <label> Confirmar esta ação? </label>
                                            <div align-items="right">
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalInicio'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Iniciar produção?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST" action="php/savePedidos? validacao=A&id='.$campo["pedidoId"].'&stats='.$campo['stats'].'">
                                            <div>                                     
                                                <div class="input-group mb-3">
                                                    <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Máquina as ser produzida:</label>
                                                    <div class="col-sm-7">                                                            
                                                        <select id="idMaquina" name="nMaquina" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                            '.optionMaquina($campo['moldeId']).'
                                                        </select>
                                                    </div>
                                                </div>                                                    
                                            </div>

                                            <label> Confirmar esta ação? </label>
                                            <div align-items="right">
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalAltera'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Encerrar produção</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST" action="php/savePedidos.php? validacao=A&id='.$campo["pedidoId"].'&stats='.$campo['stats'].'">
                                            <div>                                
                                                <h4>Finalizando produção</h4>
                                                <div class="input-group mb-3">
                                                    <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Quantidade de refugos</label>
                                                    <div class="col-sm-4">
                                                        <input id="idRefugo" name="nRefugo" type="number" class="form-control" style="width: 100%; height:36px;">
                                                    </div>
                                                </div>
                                
                                                <div class="input-group mb-3">
                                                    <label for="nClasse" class="col-sm-5 text-right control-label col-form-label">Produção real</label>
                                                    <div class="col-sm-4">
                                                        <input id="idReal" name="nReal" type="text" class="form-control" style="width: 100%; height:36px;">
                                                    </div>
                                                </div>                                                    
                                            </div>

                                            <label> Confirmar esta ação? </label>
                                            <div align-items="right">
                                                <button  type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary"> Confirmar </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modalPedido'.$campo['pedidoId'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                            <div class="modal-dialog" role="document ">                                
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ordem de produção</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true ">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body pre-scrollable">
                                        <div>
                                            <h4>Autor da ordem de produção</h4>
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Autor</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['name'].' '.$campo['sobName'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';
                                    
            if($campo['nivel'] == 1){
                
                $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">turma</label>
                                <div class="col-sm-8">
                                    <input value="Administrador" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

            } else { 
                $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">turma</label>
                                <div class="col-sm-8">
                                    <input value="'.$campo['turma'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';


            }
                
            $table .=
                                            
                                        '</div>
                                        <div>
                                            <h4>Status da ordem de produção</h4>';

            if ($campo['stats'] == 1){

                $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Aberto em:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataAberto.' às '.$horaAberto.'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Inicializada:</label>
                                <div class="col-sm-8">
                                    <input value="Pedido não foi inicializado" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                <div class="col-sm-8">
                                    <input value="Pedido não foi inicializado" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

            } else if ($campo['stats'] == 2){

                $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Aberto em:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataAberto.' às '.$horaAberto.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Inicializada:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                <div class="col-sm-8">
                                    <input value="Pedido em andamento" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

            } else if ($campo['stats'] == 3){

                $datatime1 = new DateTime(''.substr($campo['producaoData_hora'], 0, 10).' '.substr($campo['abertoData_hora'], 11, 8).' America/Sao_Paulo');
                $datatime2 = new DateTime(''.substr($campo['fechadoData_hora'], 0, 10).' '.substr($campo['fechadoData_hora'], 11, 8).' America/Sao_Paulo');

                $data1  = $datatime1->format('Y-m-d H:i:s');
                $data2  = $datatime2->format('Y-m-d H:i:s');

                $diff = $datatime1->diff($datatime2);

                $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Duração</label>
                                <div class="col-sm-8">
                                    <input value="'.$diff->format("%a dias e %H:%I:%S").' horas" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Aberto em:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataAberto.' às '.$horaAberto.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Inicializada:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataProducao.' às '.$horaProducao.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Concluido em:</label>
                                <div class="col-sm-8">
                                    <input value="'.$dataFechado.' às '.$horaFechado.'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

            }

            $table .=
                                        '   <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produto</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['produto'].'" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                            
                                            <div class="input-group mb-3">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Peso do Produto</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['pesoPro'].'g" id="idProduto" name="nProduto" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>';

            if ($campo['stats'] == 1 || $campo['stats'] == 2){

                $table .=
                            '<div class="form-group row">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção prevista</label>
                                <div class="col-sm-8">
                                    <input value='.$campo['qtdPrevista'].' id="idQtdPrev" name="nQtdPrev" type="number" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

            }  else if ($campo['stats'] == 3){

                $table .=
                            '<div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Prevista:</label>
                                <div class="col-sm-8">
                                    <input value="'.$campo['qtdPrevista'].'" id="idQtdPrev" name="nQtdPrev" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>

                            <div class="input-group mb-3">                                        
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Real:</label>
                                <div class="col-sm-8">
                                    <input value="'.$campo['qtdRealizada'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>

                            <div class="input-group mb-3">                                    
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Refugos:</label>
                                <div class="col-sm-8">
                                    <input value="'.$campo['qtdRefugo'].'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Produção Total:</label>
                                <div class="col-sm-8">
                                    <input value="'.($campo['qtdRealizada'] - $campo['qtdRefugo']).'" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                </div>
                            </div>';

            }                                
                                            
            
            $table .=
                                            '<div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Ferramental</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['molde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Ferramental</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['tipoMolde'].'" id="idClasseMaterial" name="nClasseMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div>
                                                <div class="form-group row">
                                                    <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Máquina</label>
                                                    <div class="col-sm-8">
                                                        <input value="'.$campo['maquina'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                    </div>
                                                </div>
                                            </div>                            
                                        </div>

                                        '.materiaisReceita($campo['receitaId'],1).'

                                        <div>                            
                                            <h4>Pigmento Usado</h4>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Pigmento</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['cor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Código</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['codCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Lote</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['loteCor'].'" id="idCor" name="nCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>                      
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Quantidade Usada</label>
                                                <div class="col-sm-8">
                                                        <input value="'.($campo['qtdePigmento'] * $campo['qtdPrevista']).'g" id="idMolde" name="nMolde" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                            
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Tipo de Pigmento</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['tipoCor'].'" id="idTipoCor" name="nTipoCor" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>
                                
                                            <div class="form-group row">
                                                <label for="nClasse" class="col-sm-4 text-right control-label col-form-label">Fornecedor</label>
                                                <div class="col-sm-8">
                                                    <input value="'.$campo['fornecedorP'].'" id="idTipoMaterial" name="nTipoMaterial" type="text" class="form-control" style="width: 100%; height:36px;" disabled>
                                                </div>
                                            </div>                                                
                                        </div>

                                        <div>
                                            <form method="POST" action="php/savePedidos.php? validacao=U&id='.$campo['pedidoId'].'">                     
                                                <h4> Observações </h4>       
                                                <textarea style="width:100%;" id="iObs" name="nObs">'.$campo['obs'].'</textarea>
                                                <button type="submit">
                                                    Alterar observação
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </tr>';    
                   
        }
    }        

    return $table;
}

?>