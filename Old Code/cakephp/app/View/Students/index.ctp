<h1>List of Student Groups</h1>
<table>
    <tr>
        <th>Year</th>
        <th>Branch</th>
        <th>Strength</th>
        <th>No of batches</th>
        <th>Code</th>
        <th>Option</th>


    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->
    <?php echo $this->Html->link(
        'Add Student Group',
        array('controller' => 'students', 'action' => 'add')
    ); ?>
    <?php
   // print_r( $students);
    foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student['Student']['year']; ?></td>
            <td><?php echo $student['Student']['branch']; ?></td>
            <td><?php echo $student['Student']['strength']; ?></td>
            <td><?php echo $student['Student']['batch_count']; ?></td>
            <td><?php echo $student['Student']['code']; ?></td>
            <td>
                <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $student['Student']['id']),
                    array('confirm' => 'Are you sure?')
                );
                ?>
                <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $student['Student']['id'])
                );
                ?>
            </td>




        </tr>
    <?php endforeach; ?>

    <?php unset($student);

    ?>
</table>