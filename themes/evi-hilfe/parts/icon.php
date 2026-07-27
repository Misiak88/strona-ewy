<?php
/**
 * Kleine Inline-Icons.
 *
 * @var array $args ['name' => string]
 */
$name = $args['name'] ?? '';

$paths = array(
	'phone'  => '<path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.24 11.4 11.4 0 0 0 3.6.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1 11.4 11.4 0 0 0 .57 3.6 1 1 0 0 1-.25 1z"/>',
	'mail'   => '<path d="M3 5h18a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1zm9 8L4.2 7h15.6z"/>',
	'check'  => '<path d="M9.6 16.2 5.4 12l-1.4 1.4 5.6 5.6 12-12L20.2 5.6z"/>',
	'star'   => '<path d="M12 1.5c1 5.4 4.1 8.5 9.5 9.5-5.4 1-8.5 4.1-9.5 9.5-1-5.4-4.1-8.5-9.5-9.5 5.4-1 8.5-4.1 9.5-9.5z"/>',
	'heart'  => '<path d="M12 20.7 4.3 13a5 5 0 1 1 7.1-7.1l.6.6.6-.6A5 5 0 1 1 19.7 13z"/>',
	'people' => '<path d="M16 11a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zm-8 0a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zm0 2c-2.7 0-8 1.4-8 4v3h9.5v-3c0-1.2.6-2.3 1.6-3.2A14 14 0 0 0 8 13zm8 0c-.6 0-1.3.1-2 .2 1.3 1 2 2.2 2 3.8v3h8v-3c0-2.6-5.3-4-8-4z"/>',
);

if ( ! isset( $paths[ $name ] ) ) {
	return;
}
?>
<svg class="icon icon--<?php echo esc_attr( $name ); ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" focusable="false"><?php
	echo $paths[ $name ]; // phpcs:ignore WordPress.Security.EscapeOutput -- feste SVG-Pfade oben.
?></svg>
