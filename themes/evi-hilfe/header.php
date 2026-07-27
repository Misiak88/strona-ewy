<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<a class="skip-link" href="#inhalt">Zum Inhalt springen</a>

<header class="site-header">
	<div class="wrap header-inner">
		<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php get_template_part( 'parts/logo' ); ?>
		</a>

		<nav class="site-nav" aria-label="Hauptmenü">
			<a href="<?php echo esc_url( home_url( '/#fuer-wen' ) ); ?>">Für wen</a>
			<a href="<?php echo esc_url( home_url( '/#leistungen' ) ); ?>">Leistungen</a>
			<a href="<?php echo esc_url( home_url( '/#ablauf' ) ); ?>">Ablauf</a>
			<a href="<?php echo esc_url( home_url( '/#ueber-mich' ) ); ?>">Über mich</a>
			<a class="nav-cta" href="tel:<?php echo esc_attr( EVI_PHONE_LINK ); ?>">
				<?php get_template_part( 'parts/icon', null, array( 'name' => 'phone' ) ); ?>
				<?php echo esc_html( EVI_PHONE ); ?>
			</a>
		</nav>
	</div>
</header>

<main id="inhalt">
