<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Agendmento_DAO {
    
    public function getAgendamentos($data_pesq){
                require_once 'ConnectionFactory.class.php';
                require_once './services/AgendamentoList.class.php';
                 $conn = new ConnectionFactory();   
                 $conexao = $conn->getConnection();
                 
		 $sql_text = "SELECT BLOCOS

                                ,CASE
                                    WHEN BLOCOS = 'BLOCO 1  ||  07:00 - 09:00'
                                      THEN '8 Exames de 15 Minutos'
                                    WHEN BLOCOS = 'BLOCO 2  ||  09:00 - 10:00'
                                      THEN '2 Exames de 30 Minutos'
                                     WHEN BLOCOS = 'BLOCO 3  ||  10:00 - 12:00'
                                      THEN '8 Exames de 15 ou 20 Minutos'
                                     WHEN BLOCOS = 'BLOCO 4  ||  12:00 - 13:00'
                                      THEN '2 Exames de 30 Minutos'
                                     WHEN BLOCOS = 'BLOCO 5  ||  13:00 - 14:00'
                                      THEN '2 Exames de 15 e 1 de 60 Minutos'
                                    WHEN BLOCOS = 'BLOCO 6  ||  14:00 - 16:00'
                                      THEN '8 Exames de 15 ou 20 Minutos'
                                    WHEN BLOCOS = 'BLOCO 7  ||  16:00 - 17:00'
                                      THEN '2 Exames de 30 Minutos'
                                    WHEN BLOCOS = 'BLOCO 8  ||  17:00 - 19:00'
                                      THEN '8 Exames de 15 Minutos'
                                    WHEN BLOCOS = 'BLOCO 9  ||  19:00 - 20:00'
                                      THEN '2 Exames de 30 Minutos'
                                 END OBSERVACAO

                                 ,dbamv.fnc_converte_dia_hr((SUM(TEMPO)/60)/24) TEMPO_AGENDADO
                                 ,CASE
                                    WHEN BLOCOS = 'BLOCO 1  ||  07:00 - 09:00' AND SUM(TEMPO) > 120
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 1  ||  07:00 - 09:00' AND SUM(TEMPO) <= 120
                                      THEN TO_CHAR(120-SUM(TEMPO))||' minuto(s)'


                                    WHEN BLOCOS = 'BLOCO 2  ||  09:00 - 10:00' AND SUM(TEMPO) > 60
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 2  ||  09:00 - 10:00' AND SUM(TEMPO) <= 60
                                      THEN TO_CHAR(60-SUM(TEMPO))||' minuto(s)'


                                    WHEN BLOCOS = 'BLOCO 3  ||  10:00 - 12:00' AND SUM(TEMPO) > 8*20
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 3  ||  10:00 - 12:00' AND SUM(TEMPO) <= 8*20
                                      THEN TO_CHAR((8*20)-SUM(TEMPO))||' minuto(s)'


                                    WHEN BLOCOS = 'BLOCO 4  ||  12:00 - 13:00' AND SUM(TEMPO) > 60
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 4  ||  12:00 - 13:00' AND SUM(TEMPO) <= 60
                                      THEN TO_CHAR(60-SUM(TEMPO))||' minuto(s)'

                                    WHEN BLOCOS = 'BLOCO 5  ||  13:00 - 14:00' AND SUM(TEMPO) > 75
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 5  ||  13:00 - 14:00' AND SUM(TEMPO) <= 75
                                      THEN TO_CHAR(75-SUM(TEMPO))||' minuto(s)'


                                    WHEN BLOCOS = 'BLOCO 6  ||  14:00 - 16:00' AND SUM(TEMPO) > 8*20
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 6  ||  14:00 - 16:00' AND SUM(TEMPO) <= 8*20
                                      THEN TO_CHAR((8*20)-SUM(TEMPO))||' minuto(s)'


                                    WHEN BLOCOS = 'BLOCO 7  ||  16:00 - 17:00' AND SUM(TEMPO) > 60
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 7  ||  16:00 - 17:00' AND SUM(TEMPO) <= 60
                                      THEN TO_CHAR(60-SUM(TEMPO))||' minuto(s)'


                                    WHEN BLOCOS = 'BLOCO 8  ||  17:00 - 19:00' AND SUM(TEMPO) > 120
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 8  ||  17:00 - 19:00' AND SUM(TEMPO) <= 120
                                      THEN TO_CHAR(120-SUM(TEMPO))||' minuto(s)'


                                    WHEN BLOCOS = 'BLOCO 9  ||  19:00 - 20:00' AND SUM(TEMPO) > 60
                                      THEN '-'
                                    WHEN BLOCOS = 'BLOCO 9  ||  19:00 - 20:00' AND SUM(TEMPO) <= 60
                                      THEN TO_CHAR(60-SUM(TEMPO))||' minuto(s)'
                                 END TEMPO_LIVRE
                                 ,MAX(FORA_N) TOLERANCIA




                             FROM (


                           SELECT CASE
                                    WHEN HORA IN (07,08)
                                      THEN 'BLOCO 1  ||  07:00 - 09:00'
                                    WHEN HORA IN (09)
                                      THEN 'BLOCO 2  ||  09:00 - 10:00'
                                    WHEN HORA IN (10,11)
                                      THEN 'BLOCO 3  ||  10:00 - 12:00'
                                    WHEN HORA IN (12)
                                      THEN 'BLOCO 4  ||  12:00 - 13:00'
                                    WHEN HORA IN (13)
                                      THEN 'BLOCO 5  ||  13:00 - 14:00'
                                    WHEN HORA IN (14,15)
                                      THEN 'BLOCO 6  ||  14:00 - 16:00'
                                    WHEN HORA IN (16)
                                      THEN 'BLOCO 7  ||  16:00 - 17:00'
                                    WHEN HORA IN (17,18)
                                      THEN 'BLOCO 8  ||  17:00 - 19:00'
                                    WHEN HORA IN (19)
                                      THEN 'BLOCO 9  ||  19:00 - 20:00'
                                    ELSE 'FORA DOS BLOCOS'
                                 END BLOCOS
                                 , TEMPO


                                 ,CASE
                                    WHEN HORA IN (07,08) AND TEMPO > 15
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                    WHEN HORA IN (09) AND TEMPO > 30
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                    WHEN HORA IN (10,11) AND TEMPO > 20
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                    WHEN HORA IN (12) AND TEMPO > 30
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                    WHEN (HORA IN (13) AND TEMPO <> 15) OR (HORA IN (13) AND TEMPO <> 60)
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                    WHEN HORA IN (14,15) AND TEMPO > 20
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                    WHEN HORA IN (16) AND TEMPO > 30
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                    WHEN HORA IN (17,18) AND TEMPO > 15
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                    WHEN HORA IN (19) AND TEMPO > 30
                                      THEN 'Existe Exame Agendado Não Permitido para o Horário'
                                 END FORA_N 


                             FROM (
                                   SELECT TO_CHAR(IT_AGENDA_CENTRAL.HR_AGENDA,'HH24') HORA
                                         ,TO_CHAR(HR_REALIZACAO,'HH24') TEMPO_HORA
                                         ,TO_CHAR(HR_REALIZACAO,'MI') TEMPO_MINUTO
                                         ,(TO_CHAR(HR_REALIZACAO,'HH24')*60)+TO_CHAR(HR_REALIZACAO,'MI') TEMPO
                                         ,COUNT(*) TOTAL
                                     FROM AGENDA_CENTRAL
                                         ,IT_AGENDA_CENTRAL
                                         ,ITEM_AGENDMTO_ITEM_AGEN_CTRAL
                                         ,ITEM_AGENDAMENTO
                                    WHERE AGENDA_CENTRAL.CD_AGENDA_CENTRAL = IT_AGENDA_CENTRAL.CD_AGENDA_CENTRAL
                                      AND IT_AGENDA_CENTRAL.CD_IT_AGENDA_CENTRAL = ITEM_AGENDMTO_ITEM_AGEN_CTRAL.CD_IT_AGENDA_CENTRAL(+)
                                      AND ITEM_AGENDAMENTO.CD_ITEM_AGENDAMENTO(+)   = ITEM_AGENDMTO_ITEM_AGEN_CTRAL.CD_ITEM_AGENDAMENTO
                                      AND AGENDA_CENTRAL.CD_RECURSO_CENTRAL = 1
                                      AND to_char(DT_AGENDA,'DD/MM/YYYY') = NVL(:DATA_,TO_CHAR(SYSDATE,'DD/MM/YYYY'))
                                      GROUP BY IT_AGENDA_CENTRAL.HR_AGENDA
                                              ,HR_REALIZACAO
                                      ORDER BY 1
                                 )
                           ORDER BY 1
                              )
                           GROUP BY BLOCOS
                           ORDER BY 1

                           ";
				//to_char(I.DT_CARDAPIO,'DD/MM/YYYY') = NVL(:DT,TO_CHAR(SYSDATE,'DD/MM/YYYY'))
                try {

                        $stmt = oci_parse($conexao, $sql_text);
                        //echo "Data escolhida: $data_pesq";
                        oci_bind_by_name($stmt, ":DATA_", $data_pesq);
                       
                        oci_execute($stmt);
                        $agendamentoList = new AgendamentoList();
                        while ($row = oci_fetch_array($stmt, OCI_ASSOC)){
                             $agendamento = new Agendamento();
                             if($row['BLOCOS'] == "FORA DOS BLOCOS"){
                                 $bloco = $row['BLOCOS'];
                             }else{
                                $bloco = str_replace("BLOCO", "", $row['BLOCOS']);
                             }
                             if(isset($row['OBSERVACAO'])){
                                 $observ = str_replace("Minutos","'",$row['OBSERVACAO']);
                             }else{
                                 $observ = '';
                             }
                             
                             if(isset($row['TEMPO_AGENDADO'])){
                                 $tempoAgendado = str_replace("hh",":",$row['TEMPO_AGENDADO']);
                                 $tempoAgendado = str_replace("mm","",$tempoAgendado);
                             }else{
                                 $tempoAgendado = '';
                             }
                             
                             if(isset($row['TEMPO_LIVRE'])){
                                 $tempoLivre = $row['TEMPO_LIVRE'];
                             }else{
                                 $tempoLivre = '';
                             }
                             
                             if(isset($row['TOLERANCIA'])){
                                 $tolerancia = $row['TOLERANCIA'];
                             }else{
                                 $tolerancia = '';
                             }
                             $agendamento->setBloco($bloco);
                             $agendamento->setObservacao($observ);
                             $agendamento->setTempoAgendado($tempoAgendado);
                             $agendamento->setTempoLivre($tempoLivre);
                             $agendamento->setTolerancia($tolerancia);
                             
                             $agendamentoList->addAgendamento($agendamento);
                          }
                        $conn->closeConnection($conexao);
                        } catch (PDOException $ex) {
                        //    echo "<script>  alert('Erro: ".$ex->getMessage()."')</script>";
                            echo " Erro: ".$ex->getMessage();
                  }
            
        		return $agendamentoList;
    } // fim do metodo getAgendmanento
    
} // fim da classe