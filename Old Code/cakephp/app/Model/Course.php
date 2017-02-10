<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 08-02-16
 * Time: 10:51 AM
 */
class Course extends AppModel
{
    public $belongsTo = array(
        'Students' => array(
            'className' => 'Student',
            'foreignKey' => 'student_id',
        ),

    );
    public $hasMany = array(
        'Batches' => array(
            'className' => 'Course',
            'foreignKey' => 'course_id'
        )
    );


    public $validate = array(
        'subject' => array(
            'rule' => 'notBlank'
        ),
        'year' => array(
            'rule' => 'notBlank'
        )
    );


}
?>