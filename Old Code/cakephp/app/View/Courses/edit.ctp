
<h1>Edit Course</h1>
<?php
echo $this->Form->create('Course');
echo $this->Form->input('subject');
echo $this->Form->input('year');
echo $this->Form->input('sem');
echo $this->Form->input('batch');
echo $this->Form->input('frequency');
echo $this->Form->input('type');

echo $this->Form->input('subject_code');
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Post');
?>