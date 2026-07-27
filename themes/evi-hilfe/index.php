<?php get_header(); ?>

<section class="hero">
	<div class="wrap hero-inner">
		<div class="hero-text">
			<p class="eyebrow">Alltags- &amp; Haushaltshilfe</p>
			<h1>Ich bin für Sie da.</h1>
			<p class="lead">
				Wenn der Alltag zu viel wird, nehme ich Ihnen die Last ab –
				einfühlsam, zuverlässig und <strong>für Sie kostenlos</strong>.
			</p>

			<p class="hero-pill">
				<?php get_template_part( 'parts/icon', null, array( 'name' => 'check' ) ); ?>
				<span>Die Kosten übernimmt vollständig die Pflegekasse</span>
			</p>

			<ul class="hero-badges">
				<li><?php get_template_part( 'parts/icon', null, array( 'name' => 'check' ) ); ?> Studentin der Klinischen Psychologie</li>
				<li><?php get_template_part( 'parts/icon', null, array( 'name' => 'check' ) ); ?> Zertifizierte Mentorin für Gewaltfreie Kommunikation</li>
				<li><?php get_template_part( 'parts/icon', null, array( 'name' => 'check' ) ); ?> 11 Jahre Erfahrung</li>
			</ul>

			<div class="hero-actions">
				<a class="btn btn--primary" href="tel:<?php echo esc_attr( EVI_PHONE_LINK ); ?>">
					<?php get_template_part( 'parts/icon', null, array( 'name' => 'phone' ) ); ?>
					<?php echo esc_html( EVI_PHONE ); ?>
				</a>
				<a class="btn btn--ghost" href="#kontakt">Schreiben Sie mir</a>
			</div>
		</div>

		<figure class="hero-figure">
			<?php
			// Foto über „Beitragsbild" der Startseite austauschbar.
			if ( has_post_thumbnail() ) {
				the_post_thumbnail( 'large' );
			} else {
				echo '<div class="photo-placeholder"><span>Hier kommt ein Foto von Ewa hin</span></div>';
			}
			?>
		</figure>
	</div>
</section>

<section class="section section--light" id="fuer-wen">
	<div class="wrap">
		<h2>Für wen bin ich da?</h2>
		<p class="section-intro">
			Manchmal reicht eine helfende Hand, damit ein Tag wieder leichter wird.
			Meine Unterstützung richtet sich an:
		</p>

		<ul class="cards">
			<?php
			$zielgruppen = array(
				array( 'people', 'Ältere Menschen', 'Damit Sie so selbstständig zu Hause leben können, wie Sie es möchten.' ),
				array( 'heart', 'Menschen mit Behinderung oder Pflegebedarf', 'Verlässliche Hilfe, die sich nach Ihrem Tempo richtet – nicht umgekehrt.' ),
				array( 'star', 'Schwangere Frauen', 'Entlastung in einer Zeit, in der Sie Ihre Kraft für Wichtigeres brauchen.' ),
				array( 'people', 'Familien mit Kindern', 'Damit zwischen Terminen und Haushalt wieder Luft zum Atmen bleibt.' ),
			);
			foreach ( $zielgruppen as list( $icon, $titel, $text ) ) :
				?>
				<li class="card">
					<span class="card-icon"><?php get_template_part( 'parts/icon', null, array( 'name' => $icon ) ); ?></span>
					<h3><?php echo esc_html( $titel ); ?></h3>
					<p><?php echo esc_html( $text ); ?></p>
				</li>
			<?php endforeach; ?>
		</ul>

		<p class="highlight">
			<?php get_template_part( 'parts/icon', null, array( 'name' => 'check' ) ); ?>
			<span>
				<strong>Sie zahlen nichts.</strong> Die Kosten werden vollständig von der
				Pflegekasse übernommen – auch um die Formalitäten müssen Sie sich nicht kümmern.
			</span>
		</p>
	</div>
</section>

<section class="section section--dark" id="leistungen">
	<div class="wrap">
		<h2>Was kann ich für Sie tun?</h2>
		<p class="section-intro section-intro--light">
			Von der Begleitung zum Arzt bis zum gemeinsamen Kaffee –
			Sie entscheiden, was gerade gebraucht wird.
		</p>

		<ul class="checklist">
			<?php
			$leistungen = array(
				'Unterstützung im Haushalt',
				'Begleitung zu Arzt- und Behördenterminen',
				'Einkaufen und Besorgungen',
				'Terminvereinbarungen und Organisation',
				'Hilfe bei der Lösung von Alltagsproblemen',
				'Gesellschaft leisten – Gespräche, Spaziergänge, gemeinsamer Kaffee',
				'Unterstützung im Alltag – wann immer Sie Hilfe brauchen',
				'Individuelle Betreuung – angepasst an Ihre persönlichen Bedürfnisse',
			);
			foreach ( $leistungen as $leistung ) :
				?>
				<li>
					<?php get_template_part( 'parts/icon', null, array( 'name' => 'check' ) ); ?>
					<?php echo esc_html( $leistung ); ?>
				</li>
			<?php endforeach; ?>
		</ul>

		<p class="claim">Kleine Hilfe, große Wirkung.</p>
	</div>
</section>

<section class="section section--light" id="ablauf">
	<div class="wrap">
		<h2>So einfach fangen wir an</h2>
		<p class="section-intro">Kein Papierkram, keine Verpflichtung – ein Anruf genügt.</p>

		<ol class="steps">
			<li>
				<span class="step-no">1</span>
				<h3>Sie melden sich</h3>
				<p>Rufen Sie mich an oder schreiben Sie mir eine E-Mail. Beides geht formlos.</p>
			</li>
			<li>
				<span class="step-no">2</span>
				<h3>Wir lernen uns kennen</h3>
				<p>In Ruhe besprechen wir, wobei Sie Hilfe brauchen und was zu Ihnen passt.</p>
			</li>
			<li>
				<span class="step-no">3</span>
				<h3>Ich bin für Sie da</h3>
				<p>Regelmäßig oder bei Bedarf – so, wie es in Ihren Alltag passt.</p>
			</li>
		</ol>
	</div>
</section>

<section class="section section--cream" id="ueber-mich">
	<div class="wrap about">
		<div class="about-text">
			<h2>Warum gerade ich?</h2>
			<p>
				Ich studiere Klinische Psychologie und bin zertifizierte Mentorin für
				Gewaltfreie Kommunikation (GFK). Seit 11 Jahren arbeite ich in diesem
				Bereich – mit der Haushaltsführung ebenso wie mit der Betreuung
				älterer Menschen.
			</p>
			<p>
				Deshalb sehe ich nicht nur, was praktisch zu tun ist, sondern auch, wie
				es Ihnen dabei geht. Genau das macht meine Hilfe zu mehr als einer
				Dienstleistung.
			</p>
			<blockquote>„Manchmal braucht man einfach jemanden, der da ist."</blockquote>
		</div>

		<aside class="about-box">
			<h3>Einfach, unkompliziert, menschlich.</h3>
			<p>
				Sie müssen sich um nichts kümmern. Ich begleite Sie mit Herz und
				Verlässlichkeit – pünktlich, diskret und mit offenem Ohr.
			</p>
			<p>Rufen Sie mich einfach an oder schreiben Sie mir. Ich freue mich auf Sie.</p>
			<p class="about-signature">– <?php echo esc_html( EVI_NAME ); ?></p>
		</aside>
	</div>
</section>

<section class="section section--contact" id="kontakt">
	<div class="wrap contact">
		<h2>Rufen Sie mich einfach an</h2>
		<p class="section-intro">
			Ein kurzes Gespräch genügt – unverbindlich und in Ruhe.
			Ich melde mich zurück, wenn ich gerade nicht ans Telefon gehen kann.
		</p>

		<div class="contact-cards">
			<a class="contact-card" href="tel:<?php echo esc_attr( EVI_PHONE_LINK ); ?>">
				<span class="contact-icon"><?php get_template_part( 'parts/icon', null, array( 'name' => 'phone' ) ); ?></span>
				<span class="contact-label">Telefon</span>
				<span class="contact-value"><?php echo esc_html( EVI_PHONE ); ?></span>
			</a>

			<a class="contact-card" href="mailto:<?php echo esc_attr( EVI_EMAIL ); ?>">
				<span class="contact-icon"><?php get_template_part( 'parts/icon', null, array( 'name' => 'mail' ) ); ?></span>
				<span class="contact-label">E-Mail</span>
				<span class="contact-value"><?php echo esc_html( EVI_EMAIL ); ?></span>
			</a>
		</div>

		<p class="oder-trenner"><span>oder schreiben Sie mir hier</span></p>

		<?php get_template_part( 'parts/kontaktformular' ); ?>

		<p class="contact-name">Ich freue mich auf Sie. – <?php echo esc_html( EVI_NAME ); ?></p>
	</div>
</section>

<?php get_footer(); ?>
