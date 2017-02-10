<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 11-02-16
 * Time: 11:01 PM
 */
class Techcourse extends AppModel
{
   // public $belongsTo = array('Teacher','Course');

    public $belongsTo = array(
        'Teacher' => array(
            'className' => 'Teacher',
            'foreignKey' => 'teacher_id',
            'fields' => 'name'
        ),
        'Course' => array(
            'className' => 'Course',
            'foreignKey' => 'course_id',
            'fields' => array('subject' ,'batch','course_id','el_batch'),

        )


            );



}

?>