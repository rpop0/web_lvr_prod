<?php $menuName = basename($_SERVER['PHP_SELF']);?>

<nav class="navbar navbar-dark navbar-expand-md sticky-top" >
	<a class="navbar-brand" href="index">PANOU ADMINISTRARE</a>
	<button class="navbar-toggler" data-toggle="collapse" data-target="#menuItems">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="menuItems">
		<ul class="navbar-nav ml-auto">
			<li <?php if($menuName=='admin_panel_pg.php'){echo 'class="nav-item active"';}else{echo 'class="nav-item hover"';} ?>>
				<a href="index" class="nav-link">ADMINISTRARE</a>
			</li>
			<li <?php if($menuName=='admin_reset_pg.php'){echo 'class="nav-item active"';}else{echo 'class="nav-item hover"';} ?>>
				<a href="admin_reset_pg" class="nav-link">RESETARE CONT</a>
			</li>
			<li <?php if($menuName=='admin_comenzi_pg.php'){echo 'class="nav-item active"';}else{echo 'class="nav-item hover"';} ?>>
				<a href="admin_comenzi_pg" class="nav-link">COMENZI</a>
			</li>
			<li class="nav-item hover">
				<a href="../index" class="nav-link">SITE</a>
			</li>
			<li class="nav-item hover">
				<form action="admin_includes/admin_logout_inc" method="POST">
					<button type="submit" name="logout-submit" class="nav-link btn btn-xs">LOG OUT</button>
				</form>
				
			</li>
			
		</ul>
	</div>
	
	
</nav>

