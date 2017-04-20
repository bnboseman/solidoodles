<ul class="dropdown-menu" role="menu">
    <?php echo $this->Form->create(
        'User',
        array( 'url' => array('controller' => 'Users', 'action' => 'login'),
        'inputDefaults' => array('label' => false),
        'class' => 'login-form'));
    ?>
    <li>
        <?php echo $this->Form->input('username', array('placeholder' => "Username", 'class' => "username-login"));?>
    </li>
    <li>
        <?php echo $this->Form->input('password', array('placeholder' => "Password", 'class' => 'password-login'));?>
    </li>
    <li class="button-row">
        <span class="link-row">
            I forgot my <?php echo $this->Html->link("password!", array('controller'   => 'users', 'action'=>'reset')); ?>
        </span>
        <span>
            <?php echo $this->Form->submit('sign-in'); ?>
        </span>
    </li>
    <?php echo $this->Form->end();?>
</ul>