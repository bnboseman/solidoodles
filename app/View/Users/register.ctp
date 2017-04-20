<div class="users col-md-12">
<?php echo $this->Form->create('User'); ?>
        <legend><?php echo __('Add User'); ?></legend>
        <?php 
        
        echo $this->Form->input('username');
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('email');
        echo $this->Form->input('password');
        echo $this->Form->input('repass', array('label' => 'Confirm Password', 'type' => 'password'));
    ?>
    <?php echo $this->element('terms-of-use'); ?>
    <?php echo $this->Form->input('terms-of-use', array('type' => 'checkbox')); ?>
<?php echo $this->Form->end(__('Submit')); ?>

</div>
