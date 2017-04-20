<?php echo $this->element('header'); ?>
		<div id="contentwhite">
			<div id="contentcenter">
					<?php echo $this->Session->flash('email'); ?>
					<?php echo $this->Session->flash(); ?>
					<?php echo $this->fetch('content'); ?>
			</div>
			<?php echo $this->element('footer'); ?>
		</div>
