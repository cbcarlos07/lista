<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Agendamento_Controller {
    public function getAgendamentos($data_pesq){
        require_once './model/Agendamento_DAO.class.php';
        $ad = new Agendmento_DAO();
        $retorno = $ad->getAgendamentos($data_pesq);
        return $retorno;
    }
}