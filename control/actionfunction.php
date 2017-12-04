<?php

//Button do interesse 1
 if(isset($_POST['b1']) && $_POST['b1']=='b1'){
     $_SESSION['retirada']['interesse']=1;
     header("Location:2");
 }
 //Button do interesse 2
 else if(isset($_POST['b2']) && $_POST['b2']=='b2'){
    $_SESSION['retirada']['interesse']=2;
    $array=[
            $_SESSION['retirada']['contrato_cli'],
            $_SESSION['retirada']['nome_cli'],
            $_SESSION['retirada']['interesse']
        ];
    RetiradaControll::insertUnique($array);
    unset($_SESSION);
    session_destroy();
    header("Location:11");
 }
 //Button date 1
 else if(isset($_POST['b3']) && $_POST['b3']=='b3'){
     //$date=RetiradaControll::genareteDate($_POST['b3-value'])
     $data = $_POST['b3-value'];
     $_SESSION['retirada']['data']= RetiradaControll::genareteDate(2,$data);
     header("Location:3");
}
 else if(isset($_POST['b4']) && $_POST['b4']=='b4'){
     $data = $_POST['b4-value'];
     $_SESSION['retirada']['data']= RetiradaControll::genareteDate(2,$data);
     header("Location:3");
}

else if(isset($_POST['b5'])){
    $data=$_POST['b5-h'];
    $_SESSION['retirada']['data']= RetiradaControll::genareteDate(2,$data);
    header("Location:3");
}

else if(isset($_POST['b6']) && $_POST['b6']=='b6'){
    $_SESSION['retirada']['horario']=1;
     header("Location:4");
}
else if(isset($_POST['b7']) && $_POST['b7']=='b7'){
    $_SESSION['retirada']['horario']=2;
     header("Location:4");
}
else if(isset($_POST['b8']) && $_POST['b8']=='b8'){
     header("Location:6");
}
else if(isset($_POST['b9']) && $_POST['b9']=='b9'){
     header("Location:5");
}

//Aciona o formulário de cadastro de enderesso
else if(isset($_POST['b10']) && $_POST['b10']=='b10'){
    $cep=$_POST['cep'];
    $num=$_POST['num'];
    $ende=$_POST['ende'];
    $bairro=$_POST['bairro'];
    $cidade=$_POST['cidade'];
    $estado=$_POST['estado'];
    $array=[$cep,$num,$ende,$bairro,$cidade,$estado];
    $chave = RetiradaControll::validaEndereco($array);
    if($chave==true){
        $cidade= RetiradaControll::selectParam("cidade","id",$cidade);
        $estado= RetiradaControll::selectParam("estado","id",$estado);
        $_SESSION['retirada']['endereco']= $ende." ".$bairro." ".$num." ".$cidade['nome']."-".$estado['uf']." ".$cep;
        header("Location:6");
    }
    else if($chave==false){
        $msg="A cidade não corresponde com o Estado marcado!";
    }
}
else if(isset($_POST['estado'])){
    $linha = RetiradaControll::selectCidadeParam($_POST['estado']);
    foreach ($linha as $row){
        //echo json_decode($row);
        echo '<option value="'.$row->id.'" class="cidades">'.$row->nome.'</option>';
    }
}
//Aciona o formulário de cadastro de complemento
else if(isset($_POST['b11']) && $_POST['b11']=='b11'){
    $com=$_POST['complemento'];
    $_SESSION['retirada']['complemento']=$com;
    header("Location:7");
}

 //Aciona o button do telefone que vai inserir os valores já obtidos
 else if(isset($_POST['b12']) && $_POST['b12']=='b12'){
    $tel=$_POST['telefone'];
    if(!$tel==""){
        $_SESSION['retirada']['telefone']=$tel;
       
        $chave= RetiradaControll::validaSession();
        
        if($chave==true){
            
            $array=[
            $_SESSION['retirada']['contrato_cli'],
            $_SESSION['retirada']['nome_cli'],
            $_SESSION['retirada']['interesse'],
            $_SESSION['retirada']['data'],
            $_SESSION['retirada']['horario'],
            $_SESSION['retirada']['endereco'],
            $_SESSION['retirada']['complemento'],
            $_SESSION['retirada']['telefone'] ];
            
            $chaveInsert=RetiradaControll::validaInsert($array);
            
            if($chaveInsert){
            if(!isset($_SESSION['retirada']['id_ret'])){
                $id_ret= RetiradaControll::insertRetirada($array);
                 unset($_SESSION);
                session_destroy();
                session_start();
                $_SESSION['retirada']['id_ret']=$id_ret;
                $_SESSION['retirada']['contrato_cli']=$array[0];
                $_SESSION['retirada']['nome_cli']=$array[1];
                $_SESSION['retirada']['interesse']=$array[2];
                $_SESSION['retirada']['data']=$array[3];
                $_SESSION['retirada']['horario']=$array[4];
                $_SESSION['retirada']['endereco']=$array[5];
                $_SESSION['retirada']['complemento']=$array[6];
                $_SESSION['retirada']['telefone']=$array[7];
                header("Location:8");
            }
            else if(isset($_SESSION['retirada']['id_ret'])){
                $value=[$array[3],$array[4],$array[5],$array[6],$array[7]];
             
                RetiradaControll::updateRet($value,$_SESSION['retirada']['id_ret']);
                 header("Location:8");
            }
            else{
                $msg="Todas as informações são necessárias!";
            }
            
            }    
             
        }
        else{
            $msg="Todas as informações são necessárias!";
        }
     
        
    }
    
} 




else if(isset($_POST['b13']) && $_POST['b13']=='b13'){
    RetiradaControll::updateStatusRet($_SESSION['retirada']['id_ret']);
    unset($_SESSION);
    session_destroy();
    header("Location:9");

}    