<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Exames_DAO {
    
    public function getLista($nome){
        
        require_once 'ConnectionFactory.class.php';
        require_once './beans/Exame.class.php';
        require_once './services/ExamesList.class.php';
        
        $con = new ConnectionFactory();
        $connection = $con->getConnection();
        
        try{
            if ($nome == ""){
                $sql_text = "SELECT DS_ITEM_AGENDAMENTO
                                ,TO_CHAR(HR_REALIZACAO,'HH24')||':'||TO_CHAR(HR_REALIZACAO,'MI') TEMPO
                            FROM ITEM_AGENDAMENTO
                                ,EXA_RX
                                ,EXA_SET
                                ,SET_EXA
                           WHERE ITEM_AGENDAMENTO.CD_EXA_RX = EXA_RX.CD_EXA_RX
                             AND EXA_SET.CD_EXA_RX          = EXA_RX.CD_EXA_RX
                             AND EXA_SET.CD_SET_EXA         = SET_EXA.CD_SET_EXA
                             AND ITEM_AGENDAMENTO.TP_ITEM = 'I'
                             AND ITEM_AGENDAMENTO.SN_ATIVO = 'S'
                             AND SET_EXA.CD_SET_EXA = 8
                          ORDER BY 1";
                $statement = oci_parse($connection, $sql_text);
                oci_execute($statement);
            }
            else{
                $sql_text = "SELECT DS_ITEM_AGENDAMENTO
                                ,TO_CHAR(HR_REALIZACAO,'HH24')||':'||TO_CHAR(HR_REALIZACAO,'MI') TEMPO
                            FROM ITEM_AGENDAMENTO
                                ,EXA_RX
                                ,EXA_SET
                                ,SET_EXA
                           WHERE ITEM_AGENDAMENTO.CD_EXA_RX = EXA_RX.CD_EXA_RX
                             AND EXA_SET.CD_EXA_RX          = EXA_RX.CD_EXA_RX
                             AND EXA_SET.CD_SET_EXA         = SET_EXA.CD_SET_EXA
                             AND ITEM_AGENDAMENTO.TP_ITEM = 'I'
                             AND ITEM_AGENDAMENTO.SN_ATIVO = 'S'
                             AND SET_EXA.CD_SET_EXA = 8
                             AND (
                                    (DS_ITEM_AGENDAMENTO LIKE :NOME) 
                                      OR 
                                        (TO_CHAR(TO_CHAR(HR_REALIZACAO,'HH24')||':'||TO_CHAR(HR_REALIZACAO,'MI')) LIKE :NOME)
                                    )
                          ORDER BY 1";
                $statement = oci_parse($connection, $sql_text);
                $desc = "%".$nome."%";
                oci_bind_by_name($statement, ":NOME", $desc);  
                oci_execute($statement);
            }
            
            $exameList = new ExameList();
            while($row = oci_fetch_array($statement, OCI_ASSOC)){
                $exame = new Exame();
                $exame->setDescricao($row['DS_ITEM_AGENDAMENTO']);
                $exame->setTempo($row['TEMPO']);
                $exameList->addExame($exame);
            }
        } catch (PDOException $ex) {
                echo " Erro: ".$ex->getMessage();
        }
        return $exameList;
    }
    
}//fim da classe