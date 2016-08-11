<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of AgendamentoIterator
 *
 * @author CARLOS
 */
class AgendamentoListIterator {
    protected $agendamentoList;
    protected $currentAgendamento = 0;

    public function __construct(AgendamentoList $agendamentoList_in) {
      $this->agendamentoList = $agendamentoList_in;
    }
    public function getCurrentAgendamento() {
      if (($this->currentAgendamento > 0) && 
          ($this->agendamentoList->getAgendamentoCount() >= $this->currentAgendamento)) {
        return $this->agendamentoList->getAgendamento($this->currentAgendamento);
      }
    }
    public function getNextAgendamento() {
      if ($this->hasNextAgendamento()) {
        return $this->agendamentoList->getAgendamento(++$this->currentAgendamento);
      } else {
        return NULL;
      }
    }
    public function hasNextAgendamento() {
      if ($this->agendamentoList->getAgendamentoCount() > $this->currentAgendamento) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}