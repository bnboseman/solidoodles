<?php echo $this->Form->Create('User'); ?>

<?php echo $this->Form->input('password', array('value' => '')); ?>

<?php echo $this->Form->input('repass', array('label' => 'Confirm Password', 'type' => 'password')); ?>

<?php echo $this->Form->Submit('Reset Password')?>