<?php
/** Kontaktformular – ohne Plugin, ohne externe Dienste. */

$hinweis = evi_contact_notice();
$datenschutz = get_page_by_path( 'datenschutz' );
?>

<?php if ( $hinweis ) : ?>
	<p class="form-notice form-notice--<?php echo esc_attr( $hinweis[0] ); ?>" role="status">
		<?php echo esc_html( $hinweis[1] ); ?>
	</p>
<?php endif; ?>

<form class="kontaktformular" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
	<input type="hidden" name="action" value="evi_kontakt">
	<?php wp_nonce_field( 'evi_kontakt', 'evi_nonce' ); ?>

	<p class="feld">
		<label for="evi-name">Ihr Name <span aria-hidden="true">*</span></label>
		<input type="text" id="evi-name" name="evi_name" required autocomplete="name">
	</p>

	<p class="feld">
		<label for="evi-email">Ihre E-Mail-Adresse <span aria-hidden="true">*</span></label>
		<input type="email" id="evi-email" name="evi_email" required autocomplete="email">
	</p>

	<p class="feld">
		<label for="evi-telefon">Telefon <span class="optional">(freiwillig)</span></label>
		<input type="tel" id="evi-telefon" name="evi_telefon" autocomplete="tel">
	</p>

	<p class="feld feld--breit">
		<label for="evi-nachricht">Wie kann ich Ihnen helfen? <span aria-hidden="true">*</span></label>
		<textarea id="evi-nachricht" name="evi_nachricht" rows="6" required></textarea>
	</p>

	<?php // Honeypot: für Menschen unsichtbar, für Bots verlockend. ?>
	<p class="honeypot" aria-hidden="true">
		<label for="evi-website">Bitte dieses Feld leer lassen</label>
		<input type="text" id="evi-website" name="evi_website" tabindex="-1" autocomplete="off">
	</p>

	<p class="feld feld--breit einwilligung">
		<label>
			<input type="checkbox" name="evi_einwilligung" value="1" required>
			<span>
				Ich bin damit einverstanden, dass meine Angaben zur Bearbeitung meiner
				Anfrage gespeichert werden.
				<?php if ( $datenschutz ) : ?>
					Hinweise dazu in der
					<a href="<?php echo esc_url( get_permalink( $datenschutz ) ); ?>">Datenschutzerklärung</a>.
				<?php endif; ?>
				<span aria-hidden="true">*</span>
			</span>
		</label>
	</p>

	<p class="feld feld--breit">
		<button type="submit" class="btn btn--primary">Nachricht senden</button>
		<span class="pflichtfeld-hinweis">Felder mit * sind Pflichtfelder.</span>
	</p>
</form>
