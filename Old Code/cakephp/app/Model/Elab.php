<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 14-04-16
 * Time: 02:12 PM
 */
class Elab extends AppModel
{
    public $useTable= 'courses';

    public $belongsTo = array(
        'Students' => array(
            'className' => 'Student',
            'foreignKey' => 'batch',
        ),

        'course'=> array(
            'className'=> 'Course',
            'foreignKey'=>'course_id'
        )


    );

}