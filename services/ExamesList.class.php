<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ExameList {
    private $_exame = array();
    private $_exameCount = 0;
    public function __construct() {
    }
    public function getExameCount() {
      return $this->_exameCount;
    }
    private function setExameCount($newCount) {
      $this->_exameCount = $newCount;
    }
    public function getExame($_exameNumberToGet) {
      if ( (is_numeric($_exameNumberToGet)) && 
           ($_exameNumberToGet <= $this->getExameCount())) {
           return $this->_exame[$_exameNumberToGet];
         } else {
           return NULL;
         }
    }
    public function addExame(Exame $_exame_in) {
      $this->setExameCount($this->getExameCount() + 1);
      $this->_exame[$this->getExameCount()] = $_exame_in;
      return $this->getExameCount();
    }
    public function removeExame(Exame $_exame_in) {
      $counter = 0;
      while (++$counter <= $this->getExameCount()) {
        if ($_exame_in->getAuthorAndTitle() == 
          $this->_exame[$counter]->getAuthorAndTitle())
          {
            for ($x = $counter; $x < $this->getExameCount(); $x++) {
              $this->_exame[$x] = $this->_exame[$x + 1];
          }
          $this->setExameCount($this->getExameCount() - 1);
        }
      }
      return $this->getExameCount();
    }
}
