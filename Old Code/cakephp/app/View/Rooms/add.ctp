<h1>Add Course</h1>
<?php
echo $this->Form->create('Room');
echo $this->Form->input('room_name');
echo $this->Form->input('type');
echo $this->Form->input('slots_day');
echo $this->Form->input('slots_week');
echo $this->Form->input('capacity');
echo $this->Form->input('type');

echo $this->Form->end('Save');
?>