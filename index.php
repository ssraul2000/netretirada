<?php
session_start();
require_once ('control/retirada_class.php');
require_once ('control/actionfunction.php');
require_once ('control/pathPage.php');
 ?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NET RETIRADA</title>
    <link rel="icon" href="view/imgs/icone.ico" type="image/ico" sizes="32x32">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"
          integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="view/css/style.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

</head>

<body style="margin:0;padding:0;">
    
  <div class="div-logo" >
      <center><img src="view/imgs/net-logo.png" alt="" id="logo-inicial"></center>
  </div>
    <?php 
        if(isset($msg)){
            echo '<center><div id="dados" class="col-lg-6 col-lg-offset-3 col-xs-12 alert alert-danger "><center>'.$msg.'</center></div></center>';
        }
    ?>
<?php
    // Para saber qual a conta do cliente que vai agendar a retirada
    // obs: não foi infomado como vai ser a indentificação do cliente, esse método é provisório.
    if(isset($_GET['net'])){
        
        //Codificando o id para  ficar mais restrito
        $id=(string)$_GET['net'];
        $codificado =(int)base64_decode($id);
        
        if(is_numeric($codificado)){
            unset($_SESSION);
            session_destroy();
            session_set_cookie_params(1200);
            session_start();
            $chave = RetiradaControll::init($codificado);
            if($chave==0){      
                header("Location:1");
            }
            else{
                header("Location:10");
            }
        }
        else{
            echo    '<div class="container col-lg-6 col-lg-offset-3 col-xs-12 alert alert-danger " role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <center>Acesso negado!</center>
                    </div>';
        }
    }
    //Inclue trata as páginas
    if(isset($_GET['page']) && is_numeric($_GET['page'])){
        include_once (Path::pathPage($_GET['page']));
    }
    else{
        if(isset($_SESSION['retirada']['contrato_cli']) && !isset($_GET['page']) && !isset($_SESSION['retirada']['id_ret'])){
            header("Location:1");
        }
        else if(isset($_SESSION['retirada']['contrato_cli']) && !isset($_GET['page']) && !isset($_GET['net']) && isset($_SESSION['retirada']['id_ret'])){
            header("Location:8");
        }
        else{
            echo  '<div class="container col-lg-6 col-lg-offset-3 col-xs-12 alert alert-danger " role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <center>Essa página não existe!</center>
                </div>';
        }
    }
?>
<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script src="view/js/jquery.maskedinput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
<script src="view/js/net.js"></script>
<script src="view/js/gerandoDate.js"></script>
</body>
</html>