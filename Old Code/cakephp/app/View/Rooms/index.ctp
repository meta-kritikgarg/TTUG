<h1>List of Rooms/Lab</h1>
<table>
    <tr>
        <th>Room/Lab</th>
        <th>Type</th>
        <th>Slots/Day</th>
        <th>Slots/Week</th>
        <th>Capacity</th>
        <th>Option</th>


    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->
    <?php echo $this->Html->link(
        'Add Room/Lab',
        array('controller' => 'rooms', 'action' => 'add')
    ); ?>
    <?php
   // print_r( $rooms);
    foreach ($rooms as $room): ?>
        <tr>
            <td><?php echo $room['Room']['room_name']; ?></td>
            <td><?php echo $room['Room']['type']; ?></td>
            <td><?php echo $room['Room']['slots_day']; ?></td>
            <td><?php echo $room['Room']['slots_week']; ?></td>
            <td><?php echo $room['Room']['capacity']; ?></td>
            <td>
                <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $room['Room']['id']),
                    array('confirm' => 'Are you sure?')
                );
                ?>
                <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $room['Room']['id'])
                );
                ?>
            </td>




        </tr>
    <?php endforeach; ?>

    <?php unset($room); ?>
</table>