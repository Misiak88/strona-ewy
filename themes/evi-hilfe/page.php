<?php get_header(); ?>

<article class="section section--light">
	<div class="wrap prose">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<h1><?php the_title(); ?></h1>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
</article>

<?php get_footer(); ?>
