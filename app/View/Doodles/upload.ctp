
<center><?php echo  $this->Html->image('icons/file-upload_cloud-icon.png')?></center>


<?php echo "<script>"; ?>
<?php echo "$(function() { var availableTags = [ \n"; ?>
<?php foreach($tags as $tag): ?>
<?php echo '"' . $tag . '"' . ", \n"?>
<?php endforeach ?>
<?php echo "]; $(\"#UploadTags\").autocomplete({ source: availableTags }); });"?>
<?php echo "</script>"; ?>
<?php echo $this->Form->create('Doodle', array('type' => 'File')); ?>

<?php echo $this->Form->input("name", array('placeholder'=> 'Model Title') ); ?>
<?php echo $this->Form->input('description',array('type' => 'text', 'placeholder'=> 'Description', 'cols' => '5'));?>

<?php echo $this->Form->input('public', array('label' => false, 'type'=>'select', 'options' => $public, 'selected' =>1)); ?>
<?php echo $this->Form->input('category_id', array('empty' => 'Select Category', 'label' => false)); ?>
<?php echo $this->Form->input('license_id', array('label' => false, 'selected' => 2)); ?>

<?php echo $this->Form->input('tags', array('placeholder'=> 'Tags ( Separated by comma)')); ?>
<?php echo $this->Form->input ( 'StlFiles.', array (
		'between' => '<br />',
		'type' => 'file',
		'label' => 'Files',
		'multiple'));
?>


<?php echo $this->Form->end(__('Upload')); ?>