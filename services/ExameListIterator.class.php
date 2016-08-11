<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ExameIterator
 *
 * @author CARLOS
 */
class ExameListIterator {
    protected $exameList;
    protected $currentExame = 0;

    public function __construct(ExameList $exameList_in) {
      $this->exameList = $exameList_in;
    }
    public function getCurrentExame() {
      if (($this->currentExame > 0) && 
          ($this->exameList->getExameCount() >= $this->currentExame)) {
        return $this->exameList->getExame($this->currentExame);
      }
    }
    public function getNextExame() {
      if ($this->hasNextExame()) {
        return $this->exameList->getExame(++$this->currentExame);
      } else {
        return NULL;
      }
    }
    public function hasNextExame() {
      if ($this->exameList->getExameCount() > $this->currentExame) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}