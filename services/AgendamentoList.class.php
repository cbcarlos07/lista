<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class AgendamentoList {
    private $_agendamento = array();
    private $_agendamentoCount = 0;
    public function __construct() {
    }
    public function getAgendamentoCount() {
      return $this->_agendamentoCount;
    }
    private function setAgendamentoCount($newCount) {
      $this->_agendamentoCount = $newCount;
    }
    public function getAgendamento($_agendamentoNumberToGet) {
      if ( (is_numeric($_agendamentoNumberToGet)) && 
           ($_agendamentoNumberToGet <= $this->getAgendamentoCount())) {
           return $this->_agendamento[$_agendamentoNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addAgendamento(Agendamento $_agendamento_in) {
      $this->setAgendamentoCount($this->getAgendamentoCount() + 1);
      $this->_agendamento[$this->getAgendamentoCount()] = $_agendamento_in;
      return $this->getAgendamentoCount();
    }
    public function removeAgendamento(Agendamento $_agendamento_in) {
      $counter = 0;
      while (++$counter <= $this->getAgendamentoCount()) {
        if ($_agendamento_in->getAuthorAndTitle() == 
          $this->_agendamento[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getAgendamentoCount(); $x++) {
              $this->_agendamento[$x] = $this->_agendamento[$x + 1];
          }
          $this->setAgendamentoCount($this->getAgendamentoCount() - 1);
        }
      }
      return $this->getAgendamentoCount();
    }
}
