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
                    <div class="card">

                        <!-- Cria um formulário -->                            
                        <form method="POST" class="form-horizontal" action= "php/saveCadastro.php?validacao=CP">
                            <div class="card-body">
                                
                                <!-- Titulo da div -->
                                <h4 class="card-title">Produto</h4>
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Nome do produto</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="iProduto" name= "nProduto" placeholder="Nome do material">
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Observações</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id= "iObservacoes" name="nObservacoes" placeholder="Campo não obrigatório"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 m-t-15" style="text-align: right;">Imagem do produto</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" id="iImagem" name= "nImagem">
                                    </div>
                                </div>
                            </div>    

                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" id="iBtnSalvar" name="nBtnSalvar" class="btn btn-primary">Salvar</button>
                                </div>                      
                            </div>
                        </form>
                    </div>  
                </div>

                <footer class="footer text-center">
                    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
                </footer>
            </div>
        </div>

        <!-- Linhas de javaScript em geral -->
        <?php include('links/script.php');?>
    </body>
</html>