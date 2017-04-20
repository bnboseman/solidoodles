<div class="row clear">
<div class="pagination">
<?php echo $this->Paginator->prev($this->Html->image('icons/page-numbering-arrow-left.png'), array('escape' => false, 'class' => 'prev'), null, array('class'=>'disabled'));?>
<?php echo $this->Paginator->numbers(array('class' => 'pg-numbers', 'separator' => '')); ?>
<?php echo $this->Paginator->next($this->Html->image('icons/page-numbering-arrow-right.png'), array('escape' => false, 'class' => 'next'), null, array('class'=>'disabled'));?>
</div>
</div>