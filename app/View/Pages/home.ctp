<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
if (!Configure::read('debug')):
	throw new NotFoundException();
endif;
App::uses('Debugger', 'Utility');
?>
<h2>Welcome to Solidoodles!</h2>

<?php
if (Configure::read('debug') > 0):
	Debugger::checkSecurityKeys();
endif;
?>


<?php
if (isset($filePresent)):
	App::uses('ConnectionManager', 'Model');
	try {
		$connected = ConnectionManager::getDataSource('default');
	} catch (Exception $connectionError) {
		$connected = false;
		$errorMsg = $connectionError->getMessage();
		if (method_exists($connectionError, 'getAttributes')) {
			$attributes = $connectionError->getAttributes();
			if (isset($errorMsg['message'])) {
				$errorMsg .= '<br />' . $attributes['message'];
			}
		}
	}
?>
<p>
	<?php
		if ($connected && $connected->isConnected()):
			echo '<span class="notice success">';
	 			echo __d('cake_dev', 'Cake is able to connect to the database.');
			echo '</span>';
		else:
			echo '<span class="notice">';
				echo __d('cake_dev', 'Cake is NOT able to connect to the database.');
				echo '<br /><br />';
				echo $errorMsg;
			echo '</span>';
		endif;
	?>
</p>
<?php endif; ?>
<?php
	App::uses('Validation', 'Utility');
	if (!Validation::alphaNumeric('cakephp')) {
		echo '<p><span class="notice">';
			echo __d('cake_dev', 'PCRE has not been compiled with Unicode support.');
			echo '<br/>';
			echo __d('cake_dev', 'Recompile PCRE with Unicode support by adding <code>--enable-unicode-properties</code> when configuring');
		echo '</span></p>';
	}
?>



<h3><?php echo __d('cake_dev', 'The place for your Solidoodles'); ?></h3>
<p>
Welcome to Solidoodles. Solidoodles is the place where users can upload their Solidoodles. 

</p>
<div id="recent"> 
Recent Solidoodles 
<?php /*foreach ($uc as $upload): ?>
<h2><?php echo $upload['Upload']['name']; ?> </h2> 
<h3>File name:</h3><?php echo $upload['Upload']['model']; ?>
<h3>Description:</h3><?php echo $upload['Upload']['description']; ?> 
<h3>Created:</h3><?php echo $upload['Upload']['created']; ?>
<h3>Number of Views:<?php echo $upload['Upload']['numberofviews']; ?></h3>
<?php $link = $upload['Upload']['model']; ?> 
<?php $id = $upload['Upload']['id']; ?> 
<?php echo $this->Html->link("Model Page", 'http://dev.solidoodles.com/uploads/solidoodle?solidoodle=' . $id); ?> 
<?php echo $this->Html->link("Download it Now!", 'https://s3.amazonaws.com/Solidoodles1/' . $link)  ?>
<br />
<?php endforeach */?>

<div> 
