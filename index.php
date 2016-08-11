<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Agendamento de Exames</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="img/ham.png">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/jquery.datetimepicker.min.css" rel="stylesheet">
        <link href="css/listaexames.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-3.1.0.js"></script>
        <script src="js/jquery.datetimepicker.full.js"></script>
        <script src="js/busca.js"></script>
        <script src="js/exame.js"></script>
        <script>
         function calendario(){
             $('#datetimepicker3').datetimepicker({value:'2011/12/11 12:00'})
             var d = $('#datetimepicker3').val();
                    console.log("Data carregada: "+d);
         }
        </script>
    </head>
    <body onload="calendario()">
        <!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalLabel">Excluir Item</h4>
            </div>
            <div class="modal-body">Deseja realmente excluir este item? </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Sim</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
            </div>
        </div>
    </div>
</div>
        
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Web Dev Academy</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Início</a></li>
                        <li><a href="#">Opções</a></li>
                        <li><a href="#">Perfil</a></li>
                        <li><a href="#">Ajuda</a></li>                        
                    </ul>
                </div>
            </div>
        </nav>
        <div id="main" class="container-fluid ">
            
            <hr />
            <div class="blocos divCor">
            <div class="col-xs-12 col-md-3 col-lg-2 ">
                <div style="width: 12px; height: 200px;">  
                <input id="datetimepicker3" class="campo-data" data-format="dd/MM/yyyy" type="text" style="display: none;" autofocus="">
              </div>   
            </div>
            <div class="col-xs-12 col-md-7 col-lg-9">
                <center><h3>Agendamento de Exames</h3></center>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover" style="margin-left: 5%; width: 100%">
                        <thead>
                          <th>Blocos</th>
                          <th>Observa&ccedil;&atilde;o</th>
                          <th>Tempo Agendado</th>
                          <th>Tempo Livre</th>
                          <th>Toler&acirc;ncia</th>
                        </thead>
                        <tbody id="resultados">
                            <?php
                              require_once './controller/Agendamento_Controller.class.php';
                              require_once './beans/Agendamento.class.php';
                              require_once './services/AgendamentoListIterator.class.php';
                              
                              $ac = new Agendamento_Controller();
                              $dataAtual = date('d/m/Y');
                              //echo $dataAtual;
                              $lista = $ac->getAgendamentos($dataAtual);
                              
                              $agListIterator = new AgendamentoListIterator($lista);
                              
                              $agendamento = new Agendamento();
                              $ln = 0;
                              while($agListIterator->hasNextAgendamento()){
                                  $agendamento = $agListIterator->getNextAgendamento();
                                  $ln++;
                                  if($ln%2){
                                      
                                  }
                            ?>
                            <tr>
                            <td><?php echo $agendamento->getBloco(); ?></td> 
                            <td><?php echo $agendamento->getObservacao(); ?></td> 
                            <td align="center"><?php echo $agendamento->getTempoAgendado(); ?></td> 
                            <td align="center"><?php echo $agendamento->getTempoLivre(); ?></td> 
                            <td><?php echo $agendamento->getTolerancia(); ?></td> 
                            </tr>
                            <?php } // fim do enquanto ?>
                        </tbody>
                    </table>
                </div>
            </div>
                </div>   
            <div class="col-xs-12 col-md-12 col-lg-1">
                <div id="slideout">
                        <div id="slidecontent">
                            <div class="titulo "><h4><center>Lista de Exames</center></h4></div>
                            <div class="input-group" style="width: 60%; margin-left: 5%; position: absolute">
                                <input id="search" type="text" name="table_search" onkeyUp="search()" class="form-control input-sm" placeholder="Pesquisar por Nome" style="text-transform: uppercase" >
                                <div class="input-group-btn">
                                  <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                </div>
                              </div>
                            <br>
                            <hr />
                            <div class="row">
                                <div class="box-body table-responsive no-padding exames">
                                <table class="table table-hover">
                                    <thead>
                                      <th>Descri&ccedil;&atilde;o</th>
                                      <th >Tempo</th>
                                    </thead>
                                    <tbody id="listaexame">
                                        <?php
                                            require_once './controller/Exame_Controller.class.php';
                                            require_once './beans/Exame.class.php';
                                            require_once './services/ExameListIterator.class.php';

                                            $ec = new Exame_Controller();

                                            $exameList_in = $ec->getLista("");

                                            $exListIt = new ExameListIterator($exameList_in);

                                            $exame = new Exame();
                                            while($exListIt->hasNextExame()){
                                                $exame = $exListIt->getNextExame();


                                        ?>
                                        <tr>
                                            <td><?php echo $exame->getDescricao(); ?></td>
                                            <td><?php echo $exame->getTempo(); ?></td>
                                        </tr>    
                                        <?php  } ?>
                                    </tbody>
                              </table> 
                              </div>
                            </div>
                        </div>
                        <div id="clickme" class="dropdown-toggle" data-toggle="dropdown">
                             <span class="input-group-addon"><i class="glyphicon glyphicon-menu-left"></i></span>
                        </div>
                </div>
                
                </div>
            
           
           
        </div> <!-- /#main -->
        
        <script src="js/bootstrap.min.js"></script>
        
        <script>
                jQuery('#datetimepicker3').datetimepicker({
                format:'d/m/Y ',
                inline:true,                
                timepicker: false,
                onSelectDate: function(ct, $i){
                    var d = $('#datetimepicker3').val();
                    console.log("Data escolhida: "+d);
                    carregar();
                    //alert('Data escolhida: '+d);
                }
              });
              $.datetimepicker.setLocale('pt-BR');
              
        </script>
        <script>
           $(function () {
                var rightVal = -517;
                $("#clickme").click(function () {
                    rightVal = (rightVal * -1) - 517;
                    $(this).parent().animate({right: rightVal + 'px'}, {queue: false, duration: 500});
                });
                
            });
//            var slidetimer;
//             $('#slideout').mouseleave(function() {
//               slidetimer = setTimeout("$('#slideout').animate({right: -517 + 'px'}, {queue: false, duration: 500});", 2000);
//          });
var slidetimer;
             $(".blocos").click(function() {
               $('#slideout').animate({right: -517 + 'px'}, {queue: false, duration: 500});
               console.log("Main Clicado");
          });
        </script>
        
        <script>
            $(document).ready(function(){
              $("#slideout").on("hide.bs.dropdown", function(){
                $("#clickme").html('<span class="input-group-addon"><i class="glyphicon glyphicon-menu-left"></i></span>');
              });
              $("#slideout").on("show.bs.dropdown", function(){
                $("#clickme").html('<span class="input-group-addon"><i class="glyphicon glyphicon-menu-right"></i></span>');
              });
            });
         </script>
    </body>
</html>
