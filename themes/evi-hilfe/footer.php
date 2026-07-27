</main>

<footer class="site-footer">
	<div class="wrap footer-inner">
		<div class="footer-brand">
			<?php get_template_part( 'parts/logo', null, array( 'invert' => true ) ); ?>
			<p class="footer-claim">„Manchmal braucht man einfach jemanden, der da ist."</p>
		</div>

		<div class="footer-contact">
			<p class="footer-name"><?php echo esc_html( EVI_NAME ); ?></p>
			<p>
				<a href="tel:<?php echo esc_attr( EVI_PHONE_LINK ); ?>"><?php echo esc_html( EVI_PHONE ); ?></a><br>
				<a href="mailto:<?php echo esc_attr( EVI_EMAIL ); ?>"><?php echo esc_html( EVI_EMAIL ); ?></a>
			</p>
		</div>

	</div>

	<div class="wrap footer-bottom">
		<p class="footer-copy">© <?php echo esc_html( date_i18n( 'Y' ) ); ?> EVI – Alltags- &amp; Haushaltshilfe</p>

		<nav class="footer-legal" aria-label="Rechtliches">
			<?php
			// Die Seiten „Impressum" und „Datenschutz" sind in Deutschland Pflicht
			// und gehören dorthin, wo man sie sucht: in die unterste Zeile.
			foreach ( array( 'impressum' => 'Impressum', 'datenschutz' => 'Datenschutz' ) as $slug => $label ) {
				$page = get_page_by_path( $slug );
				if ( $page ) {
					printf( '<a href="%s">%s</a>', esc_url( get_permalink( $page ) ), esc_html( $label ) );
				}
			}
			?>
		</nav>
	</div>
</footer>

<a class="mobile-call" href="tel:<?php echo esc_attr( EVI_PHONE_LINK ); ?>">
	<?php get_template_part( 'parts/icon', null, array( 'name' => 'phone' ) ); ?>
	Jetzt anrufen
</a>

<?php wp_footer(); ?>
</body>
</html>
