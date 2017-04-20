<?php $cakeDescription = __d('Solidoodles', 'Solidoodles: A place to put your Doodles!'); ?>
<?php
$profile_href = '/users/profile/';
$my_uploads_href = '/users/uploads/';
$update_info_href = '/users/edit/';
$logout_href = "/users/logout";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('jquery-ui-10.10.3.custom.css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>

<?php
echo $this->Html->css('normalize.css');
$this->Html->script('js/jquery-2.0.3.min.js');
echo $this->Html->script('jquery-2.0.3.min.js');
$this->Html->script('js/jquery-ui-1.10.3.custom.min.js');
echo $this->Html->script('jquery-ui-1.10.3.custom.min.js');
$this->Html->script('js/carouFredSel-6.2.1/jquery.carouFredSel-6.2.1.js');
echo $this->Html->css('jquery-ui-1.10.3.custom');
echo $this->Html->script('carouFredSel-6.2.1/jquery.carouFredSel-6.2.1.js');
echo $this->Html->css('bootstrap.min.css');
echo $this->Html->css('bootstrap-responsive.min.css');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->css('uichanges');
echo $this->Html->script('jquery.dotdotdot.js');
echo $this->Html->script('jquery.dotdotdot.min.js');
echo $this->Html->css('cake.generic');
echo $this->Html->css('style');
?>
<body>
	<div id="container">
	<div class="row header-row">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navbar-collapse">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <div class="nav navbar-nav logo">
			      <?php
			      echo $this->Html->link(
			      	$this->Html->image('header-logo.png',	array('class' => "navbar-brand")),
							array('controller' => 'pages','action' => 'display', ),
							array('escape' => false, 'class' => 'logo-image')
			      );
			      ?>
					</div>
				</div>
				<div class="navbar-collapse collapse" role="navigation" id="site-navbar-collapse">
					<ul class="nav navbar-nav nav">
						<li>
						<?php
							echo $this->Html->link('explore',
								array('controller' => 'categories',
									'action'=>'index'
								)
							);
						?>
						</li>
						<li>
							<?php
								echo $this->Html->link('newest models',
									array('controller' => 'models',
										'action' => 'newest'
									)
								);
							?>
						</li>
						<li>
						<?php
							echo $this->Html->link('upload',
								array('controller' => 'models',
									'action' => 'upload'
								)
							);
						?>
						</li>
						<li>
							<a href="http://solidoodle.com">solidoodle</a>
						</li>
						<?php if (AuthComponent::user()){ ?>
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php echo $this->Html->image('icons/sign-in-ico.png',	array('class' => 'sign-in-ico')); ?>
								my account <span class="caret"></span>
							</a>
								<ul class="dropdown-menu logged-in-menu" role="menu">
									<li class="profile-uploads">
										<a class="profile" href="<?php echo $profile_href;?>">
											<div>
												<?php echo $this->Html->image('icons/user-big.png',	array('class' => 'my-profile-ico')); ?>
											</div>
											<div>My Profile</div>
										</a>
										<a class="uploads" href="<?php echo $my_uploads_href;?>">
											<div>
												<?php echo $this->Html->image('icons/upload-big.png',	array('class' => 'my-uploads-ico')); ?>
											</div>
											<div>My Uploads</div>
										</a>
									</li>
									<li class="update-logout">
										<a class="update" href="<?php echo $update_info_href;?>">
											<div>
												<?php echo $this->Html->image('icons/cog-big.png',	array('class' => 'update-info-ico')); ?>
											</div>
											<div>Update Info</div>
										</a>
										<a class="logout" href="<?php echo $logout_href;?>">
											<div>
												<?php echo $this->Html->image('icons/logout-big.png',	array('class' => 'logout-ico')); ?>
											</div>
											<div>Logout</div>
										</a>
									</li>
								</ul>
						</li>
						<?php } else { ?>
						<li class="sign-in">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php echo $this->Html->image('icons/sign-in-ico.png',	array('class' => 'sign-in-ico')); ?>
								Sign-In <span class="caret"></span>
							</a>
							<?php echo $this->element('login'); ?>
						</li>
						<li class="join">
							<?php
								echo $this->Html->link('Join!',
									array('controller' => 'users',
									'action' => 'register')
								);
							?>
						</li>
						<?php } ?>
					</ul>
					<div class="row">
						<div class="col-md-2">
							<?php echo $this->element('search'); ?>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</div>
	<script>
		$(document).ready(function () {
			$('.login-form, .logged-in-menu').click(function(event){
			  event.stopPropagation();
			});
		});
	</script>
