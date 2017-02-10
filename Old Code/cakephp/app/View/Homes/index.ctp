<?php echo $this->Html->link(
    'Show Courses',
    array('controller' => 'courses', 'action' => '')
); ?>


<br>
<?php echo $this->Html->link(
    'Show Teachers',
    array('controller' => 'teachers', 'action' => '')
); ?>
<br>
<?php echo $this->Html->link(
    'Show Student Groups',
    array('controller' => 'students', 'action' => '')
); ?>
<br>
<?php echo $this->Html->link(
    'Show Rooms',
    array('controller' => 'rooms', 'action' => '')
); ?>
<br>
<?php
//print_r($load);
?>