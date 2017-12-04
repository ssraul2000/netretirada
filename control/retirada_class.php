<?php
require_once ('model/retirada_model.php');
class RetiradaControll {
        
        // Seleciona os dados do cliente da net
        public static function selectParamCli($value){
            return RetiradaModel::selectAll(1,"account_cli","id",$value);

        }
        //Valida se a conta passada possui permissão para agendar...
        public function init($value){
            
            $linha = RetiradaControll::selectParamCli($value);
        
            $status=RetiradaModel::selectAllObj(2,"retirada_equi_net","contrato_cli",$linha['id']);
            $chave=0;
            foreach ($status as $row){
                if($row->status == 1){
                    $chave=1;
                    break;
                }
  
            }
            if($chave==0){
                $_SESSION['account']['id']=$linha['id'];
                $_SESSION['retirada']['endereco']=$linha['endereco'];
                $_SESSION['retirada']['contrato_cli']=$linha['id'];
                $_SESSION['retirada']['nome_cli']=$linha['name'];
                $linha = RetiradaModel::selectUnique(2,"id_ret","retirada_equi_net", "contrato_cli",$linha['id']);
                $_SESSION['retirada']['id_ret'] = $linha['id_ret'];
            }
            return $chave;
        }
        //Seleciona dados de acordo com os parametros 
        public static function selectParam($table,$param,$value){
            return RetiradaModel::selectAll(2,$table,$param,$value);
        }
        //Seleciona o status da retirada
         public static function selectStatusRet($value){
            $linha=RetiradaModel::selectUnique(2,"status","retirada_equi_net","contrato_cli",$value);
            return $linha['status'];
        }
            //Seleciona todas as cidades para inserir no option do select
        public static function selectCidade(){
            return RetiradaModel::selectAllTableOrder(2,"cidade");
        }
        //  //Seleciona todas as cidades para inserir no option do select
        public static function selectCidadeParam($value){
            return RetiradaModel::selectAllOrden(2,"cidade","estado",$value);
        }
        //Seleciona todos os estados para inserir no option do select
        public static function selectEstado(){
            return RetiradaModel::selectAllTableOrder(2,"estado");
        }
        //Valida se todas as session possuem valor
        public static function validaSession(){
            $chave=true;
            if(
            !isset($_SESSION['retirada']['contrato_cli'])||
            !isset($_SESSION['retirada']['nome_cli'])||
            !isset($_SESSION['retirada']['interesse'])||
            !isset($_SESSION['retirada']['data'])||
            !isset($_SESSION['retirada']['horario'])||
            !isset($_SESSION['retirada']['endereco'])||
            !isset($_SESSION['retirada']['complemento'])||
            !isset($_SESSION['retirada']['telefone'] )){
                $chave=false;
            }
            return $chave;
        }
        //Inserindo os dados quando de retirada sem a linha status
        function insertRetirada($array){
            RETURN RetiradaModel::insertRetirada($array);       
        }
        
         // Seleciona o horario que o usuário escolheu
         public static function selectHorario($value){
            $linha=RetiradaModel::selectUnique(2,"text_horario","tipo_horario_ret","id_horario",$value);
            return $linha['text_horario'];
        }
        //Valida a inserção da retirada... 
        function validaInsert($array){
            $id_ret=0;
            $id_account=$_SESSION['retirada']['contrato_cli'];
            $chave = true;
            for($i=0;$i<count($array);$i++){
                if(empty($array[$i])){
                    $chave=false;
                    break;
                }
            }
            
            if($chave){
                $chaveStatus=RetiradaControll::selectStatusRet($id_account);
              
                //Se status for igual a 0
                if($chaveStatus==1){
                    $chave=false;
                }   
            }
            return $chave;
        }
       
        // Pega os dados da retirada do cliente...
        function getRetirada($value){
            $linha=RetiradaModel::selectDadosRetirada($value);
            return $linha;
        }
        
        //Gerar a data em padrão americano
        function genareteDate($chave,$date){
            if($chave==1){
                $semana=['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'];
            $dia=date('w',strtotime($date));
            $data= $semana[$dia] ." ". date('d-m-Y', strtotime(str_replace("-", "/", $date))) ;
            
            }
            else if($chave==2){
                $data = date("Y-m-d", strtotime(str_replace("/", "-", $date)));
            }
            return $data;
        }
        
        //Valida o formulário do endereço
        function validaEndereco($array){
            $chave = true;
            for($i=0;$i<count($array);$i++){
                if(!isset($array[$i])){
                    $chave=false;
                    break;
                }
            }
            if($chave==true){
                $selectCi = RetiradaModel::selectAll(2,"cidade","id",$array[4]);
                $selectEs = RetiradaModel::selectAll(2,"estado","id",$array[5]);
               
                if($selectCi['estado'] != $selectEs['id']){
                    $chave=false;
                    
                } 
            }
            return $chave;
        }
        //Atualiza o statsu da retirada
        public function updateStatusRet($value){
            RetiradaModel::updateParam("retirada_equi_net","status",1,"id_ret",$value);
        }
        //Atualiza a retirada quando escolhe alterar os dados
        public function updateRet($array,$id_ret){
            RetiradaModel::updateRet($array,$id_ret);
        }
        public function getSaudacao(){
           date_default_timezone_set('America/Sao_Paulo');
            if(date('H')>0 && date('H')<6){
                $msg="uma Boa Madrugada";
            }
            else if(date('H')>=6 && date('H')<12){
                $msg="um Bom Dia";
            }
            else if(date('H')>=12 && date('H')<18){
                $msg="uma Boa Tarde";
            }
            else if(date('H')>=18 && date('H')<=23){
                $msg="uma Boa Noite";
            }
            return $msg;
        }
        //Inserir a resposta de não tem interesse.
        public function insertUnique($array){
            return RetiradaModel::insertRetNotInteresse($array);
        }
}
?>