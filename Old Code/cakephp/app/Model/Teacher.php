<?php
class Teacher extends AppModel {
public $validate = array(
'Teacher Name' => array(
'rule' => 'notBlank'
),
'Code' => array(
'rule' => 'notBlank'
)
);

}

?>