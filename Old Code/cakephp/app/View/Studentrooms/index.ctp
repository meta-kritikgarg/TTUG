<link href="http://localhost/www/ttug/js/jquery-ui.css" rel="stylesheet">
<script src="http://localhost/www/ttug/js/jquery.min.js"></script>
<script src="http://localhost/www/ttug/js/jquery-ui.min.js"></script>
<script>
    $(function()
    {
        var $dialog = $("#view_dialog").dialog(
            {
                autoOpen: false,
                title: 'Select Course',
                width: 500,
                resizable: true,
                modal: true,
                buttons:
                {
                    "Cancel": function(){

                        $(this).dialog("close");
                    }
                }
            });
        $(".view_dialog").click(function()
        {
            var $x=$(this).attr('data-t');
            $dialog.load($(this).attr('href'), function (data)
            {
                console.log($x);

                $("#teacher_idj").attr('value',$x);
                $dialog.dialog('open');
                //console.log(data);


            });
            return false;
        });
    });
</script>

<h1>List of  Groups</h1>
<?php echo $this->Html->link(
    'Add Teacher',
    array('controller' => 'studentrooms', 'action' => 'add')
); ?>

<div id="view_dialog">
<?php
echo $this->Form->create('Studentroom');

echo $this->Form->input('room_id', array('type'=>'select', 'label'=>'Room', 'options'=>$data, 'default'=>'3'));
echo $this->Form->input('student_id', array('type'=>'text', 'label'=>'Student','id'=>'teacher_idj'));

echo $this->Form->input('is_hard', array('type'=>'text', 'label'=>'is compulsory','id'=>'is_hard', 'default'=>'1'));

echo $this->Form->end('Save');


?>

</div>
<div>
    <table>
        <tr>
        <td>
             <?php  //echo "Total Required Working Hours = ".$rwh; ?>
        </td>
        <td>
            <?php  //echo "Total Available Working Hours = ".$awh; ?>
        </td>
        </tr>
    </table>
</div>
<table>
    <tr>
        <th>Group</th>
        <th>Code</th>
        <th>Subjects</th>
        <th>Options</th>


    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php
    //print_r( $teachers);
    foreach ($list as $student): ?>
        <tr>
            <td><?php echo $student['Student']['year']; ?></td>
            <td><?php echo $student['Student']['branch']; ?></td>
            <td><?php echo $student['Student']['code']; ?></td>
            <td>
         <?php

         $flag1=0;

         foreach($student_room as $t)
                 {
                     if($t['Student']['id']==$student['Student']['id'])
                     {
                        // echo $t['Course']['subject'];

                         $flag1=1;
                            echo $this->Form->postLink(
                                $t['Room']['room_name'],
                                array('action' => 'delete', $t['Studentroom']['id']),
                                array('confirm' => 'Are you sure to delete ?')
                            );
                            echo "<br>";

                     }


                 }

            if(!$flag1)
             echo $this->Html->link('Add', array('action' => 'view', $student['Student']['id']),
                 array('class' => 'view_dialog','data-t'=>$student['Student']['id']));



             ?>


        </tr>
    <?php endforeach; ?>

    <?php unset($techcourse);
    // print_r( $sum);
    ?>
</table>
<?php

/*echo $this->Html->postLink(
    'Assign Automatically',
    array('controller' => 'techcourses'))*/

echo $this->Form->postLink(
    'Assign Automatically ',
    array('action' => 'assign_teacher_rnd')
);
echo "<br>";
echo $this->Form->postLink(
    ' Delete All',
    array('action' => 'delete_all')
);

/*echo $this->Form->create('Techcourse');

echo $this->Form->input('course_id', array('type'=>'select', 'label'=>'Course', 'options'=>$data, 'default'=>'3'));

//echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->input('teacher_id',array('type'=>'select', 'label'=>'Teacher', 'options'=>$list, 'default'=>'3'));

echo $this->Form->end('Save');*/


?>


