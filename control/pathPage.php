<?php
class Path{
    //Trata e inclue as paginas
    function pathPage($value){
        if(file_exists("view/php/".$value.'.php')){
            $page=$value;
            if($page==1 && isset($_SESSION['retirada']['contrato_cli'])) {
                return "view/php/".$page.".php";   
            }
            else if($page>1  && $page<=7 && ( isset($_SESSION['retirada']['contrato_cli']) || isset($_SESSION['retirada']['id_ret']) )){
                 return "view/php/".$page.".php";  
            }   
            else if($page>=8 && $page<9 && isset($_SESSION['retirada']['id_ret'])){
                return "view/php/".$page.".php";   
            }
            else if($page>=9 ){
                 return "view/php/".$page.".php";  
            }
            else {
                return "view/php/12.php";  
            }
        }
        else{
            return "view/php/13.php";  

            }   
        
    }
}

    

