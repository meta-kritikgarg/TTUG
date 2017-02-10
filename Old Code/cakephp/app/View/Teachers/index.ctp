<h1>List of teachers</h1>
<?php echo $this->Html->link(
    'Add Teacher',
    array('controller' => 'teachers', 'action' => 'add')
); ?>
<table>
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Department</th>
        <th>Type</th>
        <th>Load</th>
        <th>Options</th>

    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php
    //print_r( $teachers);
    foreach ($teachers as $teacher): ?>
        <tr>
            <td><?php echo $teacher['Teacher']['code']; ?></td>
            <td><?php echo $teacher['Teacher']['name']; ?></td>
            <td><?php echo $teacher['Teacher']['department']; ?></td>
            <td><?php echo $teacher['Teacher']['type']; ?></td>
            <td>
               <?php  echo $teacher['Teacher']['load'];
               //echo $this->Html->link($teacher['Teacher']['subject_code'],
                //    array('controller' => 'courses', 'action' => 'view', $course['Dtcourse']['subject_code'])); ?>
            </td>
            <td>
                <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $teacher['Teacher']['id']),
                    array('confirm' => 'Are you sure?')
                );
                ?>
                <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $teacher['Teacher']['id'])
                );
                ?>
            </td>

        </tr>
    <?php endforeach; ?>

    <?php unset($teacher);
   // print_r( $sum);
    ?>
</table>