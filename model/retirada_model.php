<?php
require_once ('db_connect.php');
    class RetiradaModel{
        
        // Seleciona todos os dados da tabela passada
        static function selectAllTable($db,$table) {
            $pdo= connect_db($db);
            $select=$pdo->prepare("SELECT * FROM $table");
            $select->execute();
            $linha=$select->fetchAll(PDO::FETCH_OBJ);
            return $linha;
        }
        static function selectAllTableOrder($db,$table) {
            $pdo= connect_db($db);
            $select=$pdo->prepare("SELECT * FROM $table ORDER BY nome");
            $select->execute();
            $linha=$select->fetchAll(PDO::FETCH_OBJ);
            return $linha;
        }
        //Seleciona em ordem alfabetica
        
        // Seleciona todos os dados da tabela com a coluna e valor passado na função.
        static function selectAll($db,$table, $column,$value) {
            $pdo= connect_db($db);
            $select=$pdo->prepare("SELECT * FROM $table WHERE $column=?");
            $select->bindValue(1,$value,PDO::PARAM_INT);
            $select->execute();
            $linha=$select->fetch(PDO::FETCH_ASSOC);
            return $linha;
        }
        // Seleciona todos os dados da tabela,em ordem, com a coluna e valor passado na função.
        static function selectAllOrden($db,$table, $column,$value) {
            $pdo= connect_db($db);
            $select=$pdo->prepare("SELECT * FROM $table WHERE $column=? ORDER BY nome");
            $select->bindValue(1,$value,PDO::PARAM_INT);
            $select->execute();
            $linha=$select->fetchAll(PDO::FETCH_OBJ);
            return $linha;
        }
        // Seleciona todos os dados da tabela com a coluna e valor passado na função.
        static function selectAllObj($db,$table, $column,$value) {
            $pdo= connect_db($db);
            $select=$pdo->prepare("SELECT * FROM $table WHERE $column=?");
            $select->bindValue(1,$value,PDO::PARAM_INT);
            $select->execute();
            $linha=$select->fetchAll(PDO::FETCH_OBJ);
            return $linha;
        }
         // Seleciona um dado da tabela com a coluna e valor passado na função.
        static function selectUnique($db,$dado,$table, $column,$value) {
            $pdo= connect_db($db);
            $select=$pdo->prepare("SELECT $dado FROM $table WHERE $column=?");
            $select->bindValue(1,$value,PDO::PARAM_INT);
            $select->execute();
            $linha=$select->fetch(PDO::FETCH_ASSOC);
            return $linha;
        }
        
        // Atualiza uma informação no banco
        function updateParam($table, $param,$value,$chave,$valuechave){
             $pdo= connect_db(2);
            $update=$pdo->prepare("UPDATE $table SET $param=? WHERE $chave=?");
            $update->bindParam(1,$value, PDO::PARAM_INT);
            $update->bindValue(2,$valuechave,PDO::PARAM_INT);
            $update->execute();
        }
        // Atualiza os dados da retirada
        function updateRet($array,$value){
             $pdo= connect_db(2);
            $update=$pdo->prepare("UPDATE retirada_equi_net SET data_ret=?, horario_ret=?,endereco=?,complemento=?,telefone=?,status=? WHERE id_ret=?");
            $update->bindParam(1,$array[0]);
            $update->bindParam(2,$array[1], PDO::PARAM_INT);
            $update->bindParam(3,$array[2], PDO::PARAM_STR);
            $update->bindParam(4,$array[3], PDO::PARAM_STR);
            $update->bindParam(5,$array[4], PDO::PARAM_STR);
            $update->bindValue(6,0,PDO::PARAM_INT);
            $update->bindValue(7,$value,PDO::PARAM_INT);
            $update->execute();
        }
        
        //Insere uma nova retirada
        function insertRetirada($value){
            $pdo= connect_db(2);
            //$insert=$pdo->prepare("INSERT INTO retirada_equi_net VALUES (DEFAULT,?,?,?,?,?,?,?,?)");
            $insert=$pdo->prepare("INSERT INTO retirada_equi_net (id_ret, contrato_cli, nome_cli, interesse, data_ret, horario_ret, endereco, complemento, telefone,status) VALUES(DEFAULT,?,?,?,?,?,?,?,?,?)");
            $insert->bindValue(1,$value[0],PDO::PARAM_INT);
            $insert->bindValue(2,$value[1],PDO::PARAM_STR);
            $insert->bindValue(3,$value[2],PDO::PARAM_INT);
            $insert->bindValue(4,$value[3]);
            $insert->bindValue(5,$value[4],PDO::PARAM_INT);
            $insert->bindValue(6,$value[5],PDO::PARAM_STR);
            $insert->bindValue(7,$value[6],PDO::PARAM_STR);
            $insert->bindValue(8,$value[7],PDO::PARAM_STR);
            $insert->bindValue(9,0,PDO::PARAM_INT);
            $insert->execute();
            $id_ret=$pdo->lastInsertId();
            return $id_ret;
        }
        //Inserindo a resposta n trenho interesse
        function insertRetNotInteresse($array){
            $pdo= connect_db(2);
            $insert=$pdo->prepare('INSERT INTO `retirada_equi_net`(id_ret, contrato_cli, nome_cli, interesse,status) VALUES (DEFAULT,?,?,?,? )');
            $insert->bindValue(1,$array[0],PDO::PARAM_INT);
            $insert->bindValue(2,$array[1],PDO::PARAM_STR);
            $insert->bindValue(3,$array[2],PDO::PARAM_INT);
            $insert->bindValue(4,2,PDO::PARAM_INT);
            $insert->execute();
        }
        
        
        
        
        //Seleciona todos os dados da retirada do equipamento
        function selectDadosRetirada($value){
            $pdo= connect_db(2);
            $select=$pdo->prepare("SELECT * FROM retirada_equi_net r INNER JOIN tipo_horario_ret th ON r.horario_ret = th.id_horario INNER JOIN tipo_interesse_ret ti ON r.interesse = ti.id_interesse WHERE r.id_ret=?");
            $select->bindParam(1,$value,PDO::PARAM_INT);
            $select->execute();
            $linha=$select->fetch(PDO::FETCH_ASSOC);
            return $linha;
        }
        
        
    }
?>