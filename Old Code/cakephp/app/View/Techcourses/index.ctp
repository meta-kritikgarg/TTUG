<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/ui-darkness/jquery-ui.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
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



<h1>List of  Tech Subject</h1>
<?php echo $this->Html->link(
    'Add Teacher',
    array('controller' => 'techcourses', 'action' => 'add')
); ?>

<div id="view_dialog">
<?php
echo $this->Form->create('Techcourse');

echo $this->Form->input('course_id', array('type'=>'select', 'label'=>'Course', 'options'=>$data, 'default'=>'3'));
echo $this->Form->input('teacher_id', array('type'=>'text', 'label'=>'Course','id'=>'teacher_idj'));
echo $this->Form->input('is_hard', array('type'=>'text', 'label'=>'is hard','id'=>'is_hard', 'default'=>'1'));


echo $this->Form->end('Save');


?>

</div>
<div>
    <table>
        <tr>
        <td>
             <?php echo "Total Required Working Hours = ".$rwh; ?>
        </td>
        <td>
            <?php echo "Total Available Working Hours = ".$awh; ?>
        </td>
        </tr>
    </table>
</div>
<table>
    <tr>
        <th>Name of Teacher</th>
        <th>Code</th>
        <th>Subjects</th>
        <th>Options</th>


    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php
    //print_r( $teachers);
    foreach ($list as $teacher): ?>
        <tr>
            <td><?php echo $teacher['Teacher']['name']; ?></td>
            <td><?php echo $teacher['Teacher']['code']; ?></td>
            <td>
         <?php   foreach($techcourses as $t)
                 {
                     if($t['Techcourse']['teacher_id']==$teacher['Teacher']['id'])
                     {
                        // echo $t['Course']['subject'];

                         $sub=$t['Course']['subject'];
                         if($sub==null)
                         {
                             foreach($courses as $course)
                             {
                                 if($course['Course']['id']==$t['Course']['course_id'])
                                     $sub=$course['Course']['subject']."(".$t['Course']['el_batch'].")";
                             }

                         }


                            echo $this->Form->postLink(
                               $sub,
                                array('action' => 'delete', $t['Techcourse']['id']),
                                array('confirm' => 'Are you sure to delete ?')
                            );
                            echo "<br>";

                     }

                 }

             ?>
                </td>
            <td>
                <?php echo $this->Html->link('Add', array('action' => 'view', $teacher['Teacher']['id']), array('class' => 'view_dialog','data-t'=>$teacher['Teacher']['id'])); ?>

            </td>


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


