<?php
    include('php/function.php');
?>
<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
    <head>
        <?php include('links/cabecalho.php');?>   
    </head>
    
    <body>

        <div id="main-wrapper">  

            <?php include('links/preloader.php');?> 

            <?php  include('links/menu.php');?>       

            <div class="page-wrapper">      
                
                <?php include('links/side_bar_direita.php');?>

                <div class="container-fluid">

                    <!-- Start Page Content -->                    
                    <div class="card" style="padding: 10px;"> 
                        <div>                                
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAddPigmento">
                                Novo Pigmento
                            </button>         
                            
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAddTipo">
                                Novo Tipo de Pigmento
                            </button>      
                            
                            <button style="width: auto; border-radius: 5px;" type="button" class="btn btn-info margin-5" data-toggle="modal" data-target="#modalAddFornecedor">
                                Novo Fornecedor
                            </button>
                        </div>                  
                    </div> 

                    <!-- MODAL NOVO FORNECEDOR -->
                    <div class="modal fade" id="modalAddFornecedor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de uma classe de material</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                   

                                    <div class="card">

                                        <!-- Cria um formulário -->
                                        <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=IF">
                                            <div class="card-body">

                                                <!-- Titulo da div -->
                                                <h4 class="card-title">Adicionar Fornecedor</h4>
                                                <div class="form-group row">
                                                    <div class="col-sm-9">
                                                        <input style="width:100%;" id="iFornecedor" name="nFornecedor" type="text" class="form-control" placeholder="Nome do fornecedor aqui" style="width: 20%; height:36px;">
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="border-top">
                                                <div class="card-body">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </form>        
                                    </div>  

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL NOVO PIGMENTO -->
                    <div class="modal fade" id="modalAddPigmento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Pigmento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"> 

                                    <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=IPG">
                                        <div class="card-body">

                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do material</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="iDescricao" name="nDescricao" placeholder="Nome do pigmento">
                                                </div>
                                            </div> 

                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Código</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="iCodigo" name="nCodigo" placeholder="Opcional">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="fname" class="col-sm-3 text-right control-label col-form-label">Lote</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="iLote" name="nLote" placeholder="Opcional">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 m-t-15" style="text-align: right;">Tipo</label>
                                                <div class="col-md-9">
                                                    <select id="iTipo" name="nTipo" class="select2 form-control custom-select" style="width: 100%; height:36px;">
                                                        <?php echo optionTipoPigmento();?>                                                                                
                                                    </select>
                                                </div>                                    
                                            </div>

                                            <div style="align-itens= side;" class="form-group row">
                                                <label for="email1" class="col-sm-3 text-right control-label col-form-label">Fornecedor</label>
                                                <div style="display:inline;" class="col-sm-9">
                                                    <select id="iFornecedor" name="nFornecedor" class="select2 form-control custom-select" style="width: 100%; height:36px;">                                           
                                                        <?php echo optionFornecedor();?>                                                                                 
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Quantidade</label>
                                                <div class="col-sm-9">
                                                    <input id="iQuandtidade" name="nQuandtidade" type="text" class="form-control" id="iQuantidade" name="nQuantidade" placeholder="Quantidade em gramas" style="width= 10%;">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" id= "iObservacoes" name="nObservacoes" placeholder="Opcional"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="border-top">
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-primary">Salvar</button>
                                            </div>                      
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL NOVO TIPO DE PIGMENTO -->
                    <div class="modal fade" id="modalAddTipo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true ">
                        <div class="modal-dialog" role="document ">                                
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastrar Novo Pigmento</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true ">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body"> 

                                    <!-- Cria um formulário para adicionar um tipo de pigmento  -->
                                    <form method="POST" class="form-horizontal" action= "php/saveMateriais.php?validacao=ITP">
                                        <div class="card-body">

                                            <!-- Titulo da div -->
                                            <h4 class="card-title">Adicionar tipo de pigmento</h4>
                                            <div class="form-group row">
                                                <div class="col-sm-9">
                                                    <input style="width:100%;" id="iTipoPigmento" name="nTipoPigmento" type="text" class="form-control" placeholder="Ex: MTB" style="width: 20%; height:36px;">
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="border-top">
                                            <div class="card-body">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>  

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <!-- ============================================================== -->
                        <!-- Cria um formulário -->
                        <!-- ============================================================== -->
                        
                    </div>  
                    <!-- ============================================================== -->
                    <!-- End PAge Content -->
                    <!-- ============================================================== -->


                    <!-- ============================================================== -->
                    <!-- Right sidebar -->
                    <!-- ============================================================== -->
                    <!-- .right-sidebar -->
                    <!-- ============================================================== -->
                    <!-- End Right sidebar -->
                    <!-- ============================================================== -->
                </div>
                <!-- ============================================================== -->
                <!-- End Container fluid  -->
                <!-- ============================================================== -->            
                <!-- ============================================================== -->
                <!-- footer -->
                <!-- ============================================================== -->
                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
                <!-- ============================================================== -->
                <!-- End footer -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>
    </body>
</html>