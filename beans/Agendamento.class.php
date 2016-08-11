<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Agendamento {
    private $bloco;
    private $observacao;
    private $tempoAgendado;
    private $tempoLivre;
    private $tolerancia;
    
    public function getBloco() {
        return $this->bloco;
    }

    public function getObservacao() {
        return $this->observacao;
    }

    public function getTempoAgendado() {
        return $this->tempoAgendado;
    }

    public function getTempoLivre() {
        return $this->tempoLivre;
    }

    public function getTolerancia() {
        return $this->tolerancia;
    }

    public function setBloco($bloco) {
        $this->bloco = $bloco;
        return $this;
    }

    public function setObservacao($observacao) {
        $this->observacao = $observacao;
        return $this;
    }

    public function setTempoAgendado($tempoAgendado) {
        $this->tempoAgendado = $tempoAgendado;
        return $this;
    }

    public function setTempoLivre($tempoLivre) {
        $this->tempoLivre = $tempoLivre;
        return $this;
    }

    public function setTolerancia($tolerancia) {
        $this->tolerancia = $tolerancia;
        return $this;
    }


}