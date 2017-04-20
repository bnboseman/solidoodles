
<?php echo $this->Form->create('Doodle', array( 'action' => 'search', 
		'role' =>'search', 
		'class' =>'navbar-form',
		 'inputDefaults' => array('label' => false)
		)); ?>
<div class="form-group" display="inline">
	<div class="input-group">
		<?php echo $this->Form->input('Search', array('placeholder'=> 'Search', 'type' => 'text', 'class' => 'form-control') ); ?>
		<span class="input-group-addon" id="doodle-submit"><span class="glyphicon glyphicon-search"></span></span>
		<?php echo $this->Form->end();?>
	</div>
</div>
<script>
var form = document.getElementById("DoodleSearchForm");
$('#doodle-submit').css('cursor', 'pointer');
document.getElementById("doodle-submit").addEventListener("click", function () {
  form.submit();
});
</script>