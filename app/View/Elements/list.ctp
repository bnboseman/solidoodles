<div id="modelcontainer">  
<?php foreach( $models as $model ): ?>
<div id="cwidget">
<a href="/models/view/<?php echo $model['Doodle']['id']?>"><?php echo $this->Html->image( $model['Doodle']['default_picture'], array('alt' => $model['Doodle']['name'], 'height' => 200, 'width' => 357) ); ?></a>		
<div id="cbracket">
</div> 
</div>
<?php endforeach;  ?>
</div>