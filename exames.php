<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$desc_ = strtoupper($_GET['busca']);

require_once './controller/Exame_Controller.class.php';
require_once './beans/Exame.class.php';
require_once './services/ExameListIterator.class.php';

$ec = new Exame_Controller();

$exameList_in = $ec->getLista($desc_);

$exListIt = new ExameListIterator($exameList_in);

$exame = new Exame();
while($exListIt->hasNextExame()){
 $exame = $exListIt->getNextExame();
  echo "
       <tr>
          <td>".$exame->getDescricao()."</td>
          <td>".$exame->getTempo()."</td>         
       </tr>
       ";
}    