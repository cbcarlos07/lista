<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Exame {
    private $descricao;
    private $tempo;
    
    public function getDescricao() {
        return $this->descricao;
    }

    public function getTempo() {
        return $this->tempo;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function setTempo($tempo) {
        $this->tempo = $tempo;
        return $this;
    }


}