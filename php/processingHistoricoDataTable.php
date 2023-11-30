<?php
    include('function.php');

    $filtros = '1 = 1'; //$_SESSION['filtroHistorico'];

    $tabelaBD = 'historico_pedidos';
    $primaryKey = 'idHistorico';
    $idPedido = 1;
    $_SESSION['idPedido'] = '';
    $id = 0;
    $columns = array(
                array( 'db' => 'idPedido',      'dt' => 0,'formatter' => function($d, $row){
                    $_SESSION['idPedido'] = $d;
                    return $_SESSION['idPedido'];
                }),
                array( 'db' => 'nomeUsuario',   'dt' => 1,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'produto',       'dt' => 2,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'maquina',       'dt' => 3,'formatter' => function($d, $row){
                    return $d;
                }),
                array( 'db' => 'statusPedido',  'dt' => 4,'formatter' => function($d, $row){
                    if($d == 1){
                        return 'Em Aberto';
                    } else if($d == 2){
                        return 'Em Andamento';
                    } else if($d == 3){
                        return 'Concluido';
                    } else if($d == 0){
                        return 'Cancelado';
                    }
                    
                    return $d;
                }),
                array( 'db' => 'dataHora_aberto',  'dt' => 5,'formatter' => function($d, $row){                    
                    if($d != ''){
                        $dataAberto =''.substr($d, 8, 2).'/';
                        $dataAberto .=''.substr($d, 5, 2).'/';
                        $dataAberto .=''.substr($d, 0, 4).'';
                        //return date( 'jS M y', strtotime($d)); -- retorna em formato 1fst Jun 23;
                        return $dataAberto; 
                    } else {
                        return 'Data não definida';
                    }
                    
                }),
                array( 'db' => 'idPedido',  'dt' => 6, 'formatter' => function($d, $row){
                    $status = consultaStatusHistoricoPedido($d);

                    if($status != 0){
                        return                        
                            '<div class="row justify-content-center">
                                <div class="ml-2 mr-2">
                                    <li class="fas fa-undo text-success">
                                        <a href="#" data-toggle="modal" data-target="#modalVisualizar'.$d.'">
                                        </a>
                                    </li>
                                </div>
                                <div class="ml-2 mr-2">
                                    <li class="fas fa-times-circle text-danger">
                                        <a href="#" data-toggle="modal" data-target="#modalExclui'.$d.'">
                                        </a>
                                    </li>
                                </div>
                            </div>';
            
                    } else {
            
                        return
                            '<li>
                                <a href="#" data-toggle="modal" class="fas fa-undo-alt bg-green" data-target="#modalRestaura'.$d.'">
                                </a>
                            </li>
                            <li class="">
                                <a href="#" data-toggle="modal" data-target="#modalExclui'.$d.'">
                                </a>
                            </li>';                      
                    }
                }));
    

    include('ajaxConnection.php');
    include('../ssp/ssp.class.php');
    echo json_encode(
        SSP::complex( $_POST, $sql_details, $tabelaBD, $primaryKey, $columns, null, $filtros)
    );