<?php
/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 18-02-16
 * Time: 09:49 PM
 */
echo "-------------------Testing-----------------------";

?>
<h1>Test 1 - all the remaning availability of courses"</h1>
<table>
    <tr>
        <th>Course ID</th>
        <th>Remaining Availability</th>
        <th>Code</th>
        <th>Batch</th>
<!--        <th>a</th>-->
<!--        <th>b</th>-->
    </tr>
    <?php
    // print_r( $elements);
    foreach ($availability as $element) {?>
        <tr>
            <td><?php echo $element['courses']['id']; ?></td>
            <td><?php echo $element[0]['availability']; ?></td>
            <td><?php echo $element['courses']['subject_code']; ?></td>
            <td><?php echo $element['courses']['batch']; ?></td>
        </tr>
        <?php }; ?>
    <?php unset($element); ?>
</table>

<h1>Test 2.1 - Duplicate DTD - ROOM"</h1>
<table>
    <tr>
        <th>Generated ID</th>
        <th>Course_id</th>
        <th>Teacher_id</th>
        <th>Room_id</th>
        <th>DTD</th>
        <!--        <th>b</th>-->
    </tr>
    <?php
    // print_r( $elements);
    foreach ($room_dtd as $element) {?>
        <tr>
            <td><?php echo $element['a']['id']; ?></td>
            <td><?php echo $element['a']['course_id']; ?></td>
            <td><?php echo $element['a']['teacher_id']; ?></td>
            <td><?php echo $element['a']['room_id']; ?></td>
            <td><?php echo $element['a']['dtd']; ?></td>

        </tr>
    <?php }; ?>
    <?php unset($element); ?>
</table>


<h1>Test 2.2 - Duplicate DTD - TEACHER"</h1>
<table>
    <tr>
        <th>Generated ID</th>
        <th>Course_id</th>
        <th>Teacher_id</th>
        <th>Room_id</th>
        <th>DTD</th>
        <!--        <th>b</th>-->
    </tr>
    <?php
    // print_r( $elements);
    foreach ($teacher_dtd as $element) {?>
        <tr>
            <td><?php echo $element['a']['id']; ?></td>
            <td><?php echo $element['a']['course_id']; ?></td>
            <td><?php echo $element['a']['teacher_id']; ?></td>
            <td><?php echo $element['a']['room_id']; ?></td>
            <td><?php echo $element['a']['dtd']; ?></td>

        </tr>
    <?php }; ?>
    <?php unset($element); ?>
</table>

<h1>Test 2.3 - Duplicate DTD - COURSE"</h1>
<table>
    <tr>
        <th>Generated ID</th>
        <th>Course_id</th>
        <th>Teacher_id</th>
        <th>Room_id</th>
        <th>DTD</th>
        <!--        <th>b</th>-->
    </tr>
    <?php
    // print_r( $elements);
    foreach ($course_dtd as $element) {?>
        <tr>
            <td><?php echo $element['a']['id']; ?></td>
            <td><?php echo $element['a']['course_id']; ?></td>
            <td><?php echo $element['a']['teacher_id']; ?></td>
            <td><?php echo $element['a']['room_id']; ?></td>
            <td><?php echo $element['a']['dtd']; ?></td>

        </tr>
    <?php }; ?>
    <?php unset($element); ?>
</table>