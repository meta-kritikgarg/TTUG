<h1>Add Course</h1>
<?php
echo $this->Form->create('Student');
echo $this->Form->input('year');
echo $this->Form->input('branch');
echo $this->Form->input('strength');
echo $this->Form->input('batch_count');
echo $this->Form->input('code');

echo $this->Form->end('Save');
?>