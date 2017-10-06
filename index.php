<?php
   require_once ("plano.php");

   if (isset($_POST["tempo"]))
   {
      $p2 = new plano();
      $tempo = $_POST["tempo"];
      $id    = $_GET ["aula"];
      $p2->upTempo($tempo, $id);
      header('Location:index.php ');
   }
   if (isset($_POST["incompleta"]))
   {
      $p3 = new plano();
      $id_incompleta = $_GET ["aula"];
       if (!isset($_POST["coment-incompleta"]))
           $resumo = "";
       else
           $resumo  = $_POST["coment-incompleta"];
      $p3->upAula($id_incompleta, $resumo);
      header('Location:index.php ');
   }
    if (isset($_POST["coment-default"]))
    {
       $p4 = new plano();
       $id_completa = $_GET ["aula"];
       if (!isset($_POST["coment-default"]))
           $resumo = "";
        else
           $resumo  = $_POST["coment-default"];
       $p4->upAula($id_completa, $resumo);
       header('Location:index.php ');
    }


?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="jumbotron">
    <h2>Painel das disciplinas assistidas</h2>
    <p><strong>Informação:</strong>Ao assistir uma áula, pressione em cima do container correspondente para marcar como assistida.</p>
    </div>
        <div class="panel-group" id="accordion">
        <!--Aqui será-->
           <?php
           $pe = new plano();
               if (isset($_GET["turma"]) != "" || (isset($_GET["aula"]) != ""))
               {
                   $turma = $_GET["turma"];
                   $aula  = $_GET["aula"];
                   $pe->turmaAula($aula, $turma);
                   echo "<a href='index.php'>Página Inicial</a> 
                         <div class='panel panel-default'>
                            <div class='panel-heading'>
                                Disciplina: ".$pe->getMateria() ." - ".$pe->getAula() . " 
                                
                                 ";
                                if ($pe->getAulaStatus() == 0) echo "<span class='label label-info'>FALTA ASSISTIR</span>";
                                if ($pe->getAulaStatus() == 1) echo "<span class='label label-warning'>INCOMPLETA</span>";
                                if ($pe->getAulaStatus() == 2) echo "<span class='label label-success'>COMPLETA</span>";
                            echo "
                            </div>
                         <div class='panel-body'>
                            ";
                        //Aqui fica fora do echo
                           if ($pe->getAulaStatus() == 0)
                           {
                               echo "<div class='container'>
                                        <div class='panel panel-default col-md-11'>
                                            <h3>Deseja concluir à aula?</h3>
                                            <div class='container col-md-12'>
                                            <form class='form-horizontal' method='post' >
                                                <div class='form-group'>
                                                    <input type='hidden' class='form-control' name='default' id='default'>
                                                    <label for='comment'>Comentário:</label>
                                                    <textarea class='form-control' rows='5' id='coment-default' name='coment-default'></textarea>
                                                    <br>
                                                    <button type='submit' class='btn btn-info'>Marcar como concluída</button>
                                                </div>
                                                
                                                
                                            </form>
                                            </div>
                                            </br>
                                        </div>
                                        </br>
                                        </br>                            
                                           <div class='panel panel-default col-md-11'>
                                              <h3>Informar interrupção!</h3>
                                               <form class='form-inline' method='post' >
                                                <div class='form-group'>
                                                    <label >Tempo da interrupção:</label>
                                                    <input type='text' size='30' class='form-control' name='tempo' id='tempo'>
                                                </div>
                                                <button type='submit' class='btn btn-info'>Confirmar</button>
                                            </form>
                                           </br>
                                           </div>
                            
                            
                                        
                            
                                    </div>";

                           }
                           if ($pe->getAulaStatus() == 1)
                           {
                               echo "<div class='container'>
                                        <h3>Histórico da última parada</h3>
                                        <h4> 
                                           Parou aos ". $pe->getTempoParada()."
                                        </h4>
                                        <div class='panel panel-default col-md-11'>
                                            <h3>Deseja concluir à aula?</h3>
                                            <div class='container col-md-12'>
                                            <form class='form-horizontal' method='post' >
                                                <div class='form-group'>
                                                    <input type='hidden' class='form-control' name='incompleta' id='incompleta'>
                                                    <label for='comment'>Comentário:</label>
                                                    <textarea class='form-control' rows='5' id='coment-incompleta' name='coment-incompleta'></textarea>
                                                    <br>
                                                    <button type='submit' class='btn btn-info'>Marcar como concluída</button>
                                                </div>
                                            </form>
                                            </div>
                                            </br>
                                        </div>
                                        </br>
                                        </br> 
                                      
                                        
                                    </div>";

                           }
                           if ($pe->getAulaStatus() == 2)
                           {
                                echo "<div class='container col-md-12'>
                                        <h3>Resumo</h3>
                                      <p>".$pe->getResumo()."</p>
                                      </div>";
                           }

                   echo"
                            </div>
                         </div>";

               }
               else {
                   $pe->materias();
               }

           ?>
        </div>
</div>

</body>
</html>