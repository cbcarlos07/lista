<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$data_ = $_GET['busca'];

require_once './controller/Agendamento_Controller.class.php';
require_once './beans/Agendamento.class.php';
require_once './services/AgendamentoListIterator.class.php';

$ac = new Agendamento_Controller();
//$dataAtual = date('d/m/Y');
//echo $dataAtual;
$lista = $ac->getAgendamentos($data_);

$agListIterator = new AgendamentoListIterator($lista);

$agendamento = new Agendamento();
while($agListIterator->hasNextAgendamento()){
  $agendamento = $agListIterator->getNextAgendamento();
  echo "
       <tr>
          <td>".$agendamento->getBloco()."</td>
          <td>".$agendamento->getObservacao()."</td>
          <td>".$agendamento->getTempoAgendado()."</td>
          <td>".$agendamento->getTempoLivre()."</td>
          <td>".$agendamento->getTolerancia()."</td>    
       </tr>
       ";
}    