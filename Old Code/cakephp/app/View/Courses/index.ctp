<h1>List of courses</h1>
<table>
    <tr>
        <th>Year</th>
        <th>SEM</th>
        <th>Batch</th>
        <th>Subject</th>
        <th>code</th>
        <th>Option</th>


    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->
    <?php echo $this->Html->link(
        'Add Course',
        array('controller' => 'courses', 'action' => 'add')
    ); ?>
    <?php
   // print_r( $courses);
    foreach ($courses as $course): ?>
        <tr>
            <td><?php echo $course['Course']['year']; ?></td>
            <td><?php echo $course['Course']['sem']; ?></td>
            <td><?php echo $course['Course']['batch']; ?></td>
            <td><?php echo $course['Course']['subject']; ?></td>
            <td><?php echo $course['Course']['subject_code']; ?></td>
            <td>
                <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $course['Course']['id']),
                    array('confirm' => 'Are you sure?')
                );
                ?>
                <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $course['Course']['id'])
                );
                ?>
            </td>




        </tr>
    <?php endforeach;

    echo $this->Form->postLink(
    ' Delete All El Labs',
    array('action' => 'delete_all_elaborate_lab')
    );
    ?>
    <?php unset($course); ?>
</table>