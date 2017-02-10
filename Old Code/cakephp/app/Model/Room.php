<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 08-02-16
 * Time: 10:51 AM
 */
class Room extends AppModel
{
    public $validate = array(
        'room_name' => array(
            'rule' => 'notBlank'
        ),
        'type' => array(
            'rule' => 'notBlank'
        )
    );
}
?>