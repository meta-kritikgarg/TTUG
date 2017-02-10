<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 10-02-16
 * Time: 11:41 PM
 */
class HomesController extends  AppController{

    public $helpers = array('Html', 'Form');

    var $uses = array('Teacher');

    public function index()
    {
        
        $this->set('load',$this->Teacher->count_total_load());
        //$this->set('teachers', $this->Teacher->find('all'));
    }



}