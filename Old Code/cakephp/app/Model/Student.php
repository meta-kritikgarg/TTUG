<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 08-02-16
 * Time: 10:51 AM
 */
class Student extends AppModel
{
    public $validate = array(
        'branch' => array(
            'rule' => 'notBlank'
        ),
        'code' => array(
            'rule' => 'notBlank'
        )
    );
}
?>