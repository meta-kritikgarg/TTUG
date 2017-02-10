<?php
/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 15-04-16
 * Time: 02:09 PM
 *
 */

App::import('model','Course');

class Courseroom extends AppModel
{

    public $belongsTo = array(
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'course_id'
        ),

        'Room' => array(
            'className' => 'Room',
            'foreignKey' => 'room_id'
        )

    );

    public $validate = array(
        'course_id' => 'isUnique',
    );


}

?>