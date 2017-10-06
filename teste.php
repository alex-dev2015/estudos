<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Página de Testes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">Panel with panel-default class</div>
    <div class="panel-body">
        <div class="container">
            <div class="container">
                <h3>Deseja concluir à aula?</h3>
                <a href="#" class='btn btn-info' role='button'>Marcar como concluída</a>
            </div>
            <br>
            <div class="container">

               <div class="panel panel-default col-md-11">
                  <h3>Informar interrupção!</h3>
                   <form class="form-inline" >
                    <div class="form-group">
                        <label for="email">Tempo da interrupção:</label>
                        <input type="text" size="30" class="form-control" id="tempo">
                    </div>
                    <button type="submit" class="btn btn-info">Confirmar</button>
                </form>
               </br>
               </div>


            </div>

        </div>
        <?php
            $img = imagecreatefrompng("img/inteligencia.png");
            
        ?>
        <img src="img/inteligencia.png">

    </div>
</div>

</div>

</body>
</html>