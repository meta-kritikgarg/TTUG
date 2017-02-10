
<h1>Edit Teacher</h1>
<?php
echo $this->Form->create('Teacher');
echo $this->Form->input('name');
echo $this->Form->input('code');
echo $this->Form->input('department');

$options = array('gf' => 'Guest Faculty', 'mf' => 'Main Faculty');
$attributes = array('legend' => true);
echo $this->Form->radio('type', $options, $attributes);

echo $this->Form->input('load');

echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save');
?>