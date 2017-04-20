<div class="row">
	<div class="md-col-12">
		<h1> Categories</h1>
	</div>
</div>


<div id="modelcontainer" class="row">  
<?php 
for ($i = 0; $i < count($categories); $i++ ) {
?>
<div id="cwidget">
	<a href="/categories/<?php echo $categories[$i]['Category']['slug']?>"><?php echo $this->Html->image($categories[$i]['Category']['image']); ?></a>
	<div id="cbracket"><p><?php echo $categories[$i]['Category']['name']?></p></div>
</div>
<?php }
?>
</div>