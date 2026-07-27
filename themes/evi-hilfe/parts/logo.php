<?php
/**
 * Bildmarke EVI (aus dem gedruckten Flyer freigestellt) plus Untertitel als Text –
 * so bleibt der Untertitel scharf, skalierbar und vorlesbar.
 *
 * Liegt irgendwann eine Vektordatei vor, nur das <img> ersetzen.
 *
 * @var array $args ['invert' => bool] für dunklen Hintergrund.
 */
$invert = ! empty( $args['invert'] );
?>
<span class="brand<?php echo $invert ? ' brand--invert' : ''; ?>">
	<img class="brand-mark"
		src="<?php echo esc_url( get_template_directory_uri() . '/img/evi-logo.png' ); ?>"
		alt="EVI"
		width="640" height="502">
	<span class="brand-tagline">Alltags- &amp; Haushaltshilfe</span>
</span>
