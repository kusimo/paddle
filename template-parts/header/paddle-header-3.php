<?php
$paddle_menu = new PaddleMenu();
?>
<div class="container">
	<div id="header-style-3">
		<div class="NavHeader--header--2Tl7Q w-100 d-flex position-relative">
			<div class="Nav-header__left d-flex align-items-center justify-content-start">
				<?php
				$paddle_menu->logo();
				$paddle_menu->site_title();
				$paddle_menu->site_description();
				?>
			</div>
			<div class="NavHeader__menu d-flex">
				<nav id="main-header-navigation" class="nav-primary" data-header-style="1" role="navigation">
				<?php $paddle_menu::getMenu(); ?>
				</nav>
			</div>
		</div>
	</div><!--.header-style-2-->
</div><!--.container-->
