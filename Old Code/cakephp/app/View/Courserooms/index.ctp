<link href="http://localhost/www/ttug/js/jquery-ui.css" rel="stylesheet">
<script src="http://localhost/www/ttug/js/jquery.min.js"></script>
<script src="http://localhost/www/ttug/js/jquery-ui.min.js"></script>
<script>
    $(function()
    {
        var $dialog = $("#view_dialog").dialog(
            {
                autoOpen: false,
                title: 'Select Room/Lab',
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

                $("#course_idj").attr('value',$x);
                $dialog.dialog('open');
                //console.log(data);


            });
            return false;
        });
    });
</script>


<div id="view_dialog">
    <?php
    echo $this->Form->create('Courseroom');

    echo $this->Form->input('room_id', array('type'=>'select', 'label'=>'Room', 'options'=>$data, 'default'=>'3'));
    echo $this->Form->input('course_id', array('type'=>'text', 'label'=>'Course','id'=>'course_idj'));

    echo $this->Form->input('is_hard', array('type'=>'text', 'label'=>'is compulsory','id'=>'is_hard', 'default'=>'1'));

    echo $this->Form->end('Save');


    ?>

</div>







<?php
/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 15-04-16
 * Time: 02:12 PM
 */

echo $this->Form->postLink(
    'Assign Automatically ',
    array('action' => 'assign_room_to_labs_rnd')
);
echo "<br>";
echo $this->Form->postLink(
    ' Delete All',
    array('action' => 'delete_all')
);

?>

<table>
    <tr>
        <th>Subject</th>
        <th>Code</th>
        <th>Branch</th>
        <th>Room Type</th>
        <th>Room</th>
        <th>Options</th>

    </tr>

<?php
    //print_r( $teachers);
    foreach ($courses as $course): ?>
        <tr>
            <td><?php echo $course['Course']['subject']; ?></td>
            <td><?php echo $course['Course']['subject_code']; ?></td>
            <td><?php echo $course['Students']['code']."-".$course['Students']['branch']; ?></td>
            <td><?php echo $course['Course']['room_type']; ?></td>
            <td><?php  $flag1=0;

                    foreach($course_rooms as $room)
                    {
                        if($course['Course']['id']==$room['Course']['id'])
                        {
                            $flag1=1;
                            echo $this->Form->postLink(
                                $room['Room']['room_name'],
                                array('action' => 'delete', $room['Courseroom']['id']),
                                array('confirm' => 'Are you sure to delete ?')
                            );

                        }
                    }

                    if(!$flag1)
                    {
                        echo $this->Html->link('Add', array('action' => 'view', $course['Course']['id']),
                            array('class' => 'view_dialog','data-t'=>$course['Course']['id']));
                    }
                ?></td>
            <td><?php echo $this->Form->postLink(
                    'Delete All',
                    array('action' => 'delete_by_course_id', $course['Course']['id']),
                    array('confirm' => 'Are you sure to delete ?')
                ); ?></td>

        </tr>
        <?php
        //print_r( $teachers);
        foreach ($course['Batches'] as $batch): ?>

        <tr>
            <td><?php echo $batch['el_batch']; ?> </td>
            <td><?php

                $flag2=0;

                foreach($course_rooms as $room)
                {
                    if($batch['id']==$room['Course']['id'])
                    {
                        $flag2=1;
                        echo $this->Form->postLink(
                            $room['Room']['room_name'],
                            array('action' => 'delete', $room['Courseroom']['id']),
                            array('confirm' => 'Are you sure to delete ?')
                        );
                    }
                }

                if(!$flag2)
                {
                    echo $this->Html->link('Set Room', array('action' => 'view', $batch['id']),
                        array('class' => 'view_dialog','data-t'=>$batch['id']));
                }

                ?> </td>

        </tr>


    <?php endforeach;?>
    <?php endforeach;?>

</table>
