<?php
/**
 * EVI – Alltags- & Haushaltshilfe
 *
 * Kontaktdaten an einer Stelle. Hier ändern, nicht in den Templates.
 */

const EVI_NAME       = 'Ewa Milanowska';
const EVI_PHONE      = '0163 154 59 83';
const EVI_PHONE_LINK = '+491631545983';
const EVI_EMAIL      = 'evi.alltagshilfe@gmail.com';

/**
 * Absenderadresse des Kontaktformulars. Muss zur Domain gehören, sonst stufen
 * viele Postfächer die Nachricht wegen SPF/DMARC als Spam ein. Die Adresse des
 * Absenders landet im Reply-To, nicht im From.
 */
const EVI_FROM_EMAIL = 'noreply@evi-hilfe.de';

function evi_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'style', 'script' ) );
	register_nav_menus( array( 'primary' => 'Hauptmenü' ) );
}
add_action( 'after_setup_theme', 'evi_setup' );

function evi_assets() {
	wp_enqueue_style( 'evi', get_stylesheet_uri(), array(), filemtime( get_stylesheet_directory() . '/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'evi_assets' );

/** Emoji-Skripte und Block-CSS raus – die Seite braucht sie nicht. */
function evi_cleanup() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'evi_cleanup', 100 );

/* ------------------------------------------------------------------------
 * Kontaktformular
 *
 * Bewusst ohne Plugin und ohne externe Dienste: kein reCAPTCHA (das wäre eine
 * Datenübermittlung an Google), stattdessen ein Honeypot-Feld und eine Nonce.
 * ---------------------------------------------------------------------- */

function evi_handle_contact() {
	$zurueck = home_url( '/#kontakt' );

	$fail = function ( $code ) use ( $zurueck ) {
		wp_safe_redirect( add_query_arg( 'kontakt', $code, $zurueck ) );
		exit;
	};

	if ( ! isset( $_POST['evi_nonce'] ) || ! wp_verify_nonce( $_POST['evi_nonce'], 'evi_kontakt' ) ) {
		$fail( 'fehler' );
	}

	// Bots füllen gern jedes Feld aus – Menschen sehen dieses hier nicht.
	if ( ! empty( $_POST['evi_website'] ) ) {
		wp_safe_redirect( add_query_arg( 'kontakt', 'ok', $zurueck ) );
		exit;
	}

	$name      = sanitize_text_field( wp_unslash( $_POST['evi_name'] ?? '' ) );
	$email     = sanitize_email( wp_unslash( $_POST['evi_email'] ?? '' ) );
	$telefon   = sanitize_text_field( wp_unslash( $_POST['evi_telefon'] ?? '' ) );
	$nachricht = sanitize_textarea_field( wp_unslash( $_POST['evi_nachricht'] ?? '' ) );

	if ( '' === $name || '' === $nachricht || ! is_email( $email ) || empty( $_POST['evi_einwilligung'] ) ) {
		$fail( 'unvollstaendig' );
	}

	$betreff = sprintf( 'Anfrage über evi-hilfe.de von %s', $name );
	$text    = sprintf(
		"Neue Anfrage über das Kontaktformular:\n\nName: %s\nE-Mail: %s\nTelefon: %s\n\nNachricht:\n%s\n",
		$name,
		$email,
		'' !== $telefon ? $telefon : 'nicht angegeben',
		$nachricht
	);

	$headers = array(
		sprintf( 'From: EVI Website <%s>', EVI_FROM_EMAIL ),
		sprintf( 'Reply-To: %s <%s>', $name, $email ),
	);

	if ( ! wp_mail( EVI_EMAIL, $betreff, $text, $headers ) ) {
		$fail( 'versand' );
	}

	wp_safe_redirect( add_query_arg( 'kontakt', 'ok', $zurueck ) );
	exit;
}
add_action( 'admin_post_nopriv_evi_kontakt', 'evi_handle_contact' );
add_action( 'admin_post_evi_kontakt', 'evi_handle_contact' );

/**
 * Lokale Entwicklung: E-Mails über Mailpit statt über den echten Mailserver.
 * Auf der Produktion sind die Konstanten nicht gesetzt, dann greift der Hook nicht.
 */
function evi_dev_smtp( $phpmailer ) {
	if ( ! defined( 'EVI_SMTP_HOST' ) ) {
		return;
	}
	$phpmailer->isSMTP();
	$phpmailer->Host       = EVI_SMTP_HOST;
	$phpmailer->Port       = defined( 'EVI_SMTP_PORT' ) ? EVI_SMTP_PORT : 1025;
	$phpmailer->SMTPAuth   = false;
	$phpmailer->SMTPSecure = '';
	$phpmailer->SMTPAutoTLS = false;
}
add_action( 'phpmailer_init', 'evi_dev_smtp' );

/** Rückmeldung nach dem Absenden. */
function evi_contact_notice() {
	$status = sanitize_key( $_GET['kontakt'] ?? '' );

	$texte = array(
		'ok'             => array( 'erfolg', 'Vielen Dank! Ihre Nachricht ist angekommen. Ich melde mich zeitnah bei Ihnen.' ),
		'unvollstaendig' => array( 'fehler', 'Bitte füllen Sie Name, E-Mail und Nachricht aus und bestätigen Sie die Einwilligung.' ),
		'versand'        => array( 'fehler', 'Die Nachricht konnte technisch nicht versendet werden. Bitte rufen Sie mich an – ich freue mich auf Sie.' ),
		'fehler'         => array( 'fehler', 'Da ist etwas schiefgelaufen. Bitte versuchen Sie es erneut oder rufen Sie mich an.' ),
	);

	return $texte[ $status ] ?? null;
}
