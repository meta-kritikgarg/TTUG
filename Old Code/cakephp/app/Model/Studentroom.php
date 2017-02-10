<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 17-02-16
 * Time: 03:08 PM
 */
App::import('model','Course');

class Studentroom  extends AppModel
{
    // public $belongsTo = array('Teacher','Course');

    public $belongsTo = array(
        'Student' => array(
            'className' => 'Student',
            'foreignKey' => 'student_id',
            'fields' => array('code','id')
        ),
        'Room' => array(
            'className' => 'Room',
            'foreignKey' => 'room_id',
            'fields' => 'room_name' ,
        )

    );



}

?>

