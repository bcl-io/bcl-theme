<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="description" content="bcl, Georg Tremmel, Shiho Fukuhara, Yuki, Yoshioka">
	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes" />
	
	<!-- Note there is no responsive meta tag here -->
	<!-- <link rel="shortcut icon" href="../../assets/ico/favicon.png"> -->

	<title>bcl</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<script type="text/javascript" src="//use.typekit.net/ncd2orm.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
	
	<link href="<?php echo get_stylesheet_directory_uri() ?>/css/bootstrap.css" rel="stylesheet">

	<?php //replace with custom bootstrap?>
	<link href="<?php echo get_stylesheet_directory_uri() ?>/css/bcl.css" rel="stylesheet">

	<?php wp_head(); ?>
</head>
	
<body>

<div id="page">

<div class="container-fluid">
<nav class="navbar navbar-default" role="navigation">

		
		<div class="navbar-header">
			<span class="navbar-brand"><a href="<?php echo site_url(); ?>">bcl</a></span>
		</div>
		
		<div class="collapse navbar-collapse">
	    
		<?php
				$menu_name = 'header-menu';
	
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

			$menu_items = wp_get_nav_menu_items($menu->term_id);

			$menuHtml = '<ul class="navbar-nav navbar-right">'."\n";

			
			foreach ($menu_items as $key => $m ) {
				$title = $m->title;
				$url = $m->url;
				
				if ($m->menu_item_parent==0) {
					if (($post->ID == $m->object_id) OR (is_home() AND $title=="Journal")) {
						$menuHtml .= "\t\t\t".'<li class="active">' . $title . '</li>'."\n";
					} else {
						$menuHtml .= "\t\t\t".'<li><a href="' . $url . '">' . $title . '</a></li>'."\n";
					}					
				}
			}
			$menuHtml .= "\t\t</ul>\n";	
		}
		echo $menuHtml;
	    // $menu_list now ready to output
		
		?>
		</div>
		<div class="row visible-xs">
			<div class="col-xs-12">
				<ul class="small-list">
					<li class="active">About</li>
					<li>Projects</li>
					<li>Contact</li>
				</ul>
			</div>
		</div>
</nav>
</div>

<div class="container-fluid">
	
