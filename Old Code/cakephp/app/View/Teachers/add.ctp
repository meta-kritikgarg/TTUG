<h1>Add Teacher</h1>
<?php
echo $this->Form->create('Teacher');
echo $this->Form->input('name');
echo $this->Form->input('code');
echo $this->Form->input('department');
echo $this->Form->input('load');


$options = array('gf' => 'Guest Faculty', 'mf' => 'Main Faculty');
$attributes = array('legend' => false);
echo $this->Form->radio('type', $options, $attributes);

echo $this->Form->end('Save');

?>