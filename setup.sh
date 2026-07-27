#!/usr/bin/env bash
set -euo pipefail

# Port aus docker-compose.yml lesen, damit beide nicht auseinanderlaufen.
PORT="$(grep -oP '^\s+- "\K[0-9]+(?=:80")' docker-compose.yml | head -1)"
SITE_URL="http://localhost:${PORT:-8080}"
SITE_TITLE="Evi Hilfe"
ADMIN_USER="admin"
ADMIN_PASS="admin"
ADMIN_EMAIL="admin@example.com"

wp() { docker compose exec -T wpcli wp --path=/var/www/html "$@"; }

docker compose up -d

echo "Czekam na WordPressa..."
until wp core is-installed 2>/dev/null || wp core version >/dev/null 2>&1; do sleep 2; done

if ! wp core is-installed 2>/dev/null; then
  wp core install \
    --url="$SITE_URL" \
    --title="$SITE_TITLE" \
    --admin_user="$ADMIN_USER" \
    --admin_password="$ADMIN_PASS" \
    --admin_email="$ADMIN_EMAIL" \
    --skip-email
fi

# Adres strony poprawiamy tylko wtedy, gdy w bazie siedzi jakiś localhost.
# Jeśli strona jest wystawiona publicznie (tunel, prawdziwa domena), nie ruszamy.
AKTUALNY_URL="$(wp option get home 2>/dev/null || echo '')"
if [[ "$AKTUALNY_URL" == *localhost* && "$AKTUALNY_URL" != "$SITE_URL" ]]; then
  wp option update home "$SITE_URL"
  wp option update siteurl "$SITE_URL"
fi

wp language core install de_DE --activate
wp option update timezone_string "Europe/Berlin"
wp option update date_format "d.m.Y"
wp rewrite structure '/%postname%/' --hard

wp plugin delete akismet hello 2>/dev/null || true

# Eigenes Theme
wp theme activate evi-hilfe
wp option update blogname "EVI – Alltags- & Haushaltshilfe"
wp option update blogdescription "Einfach, unkompliziert, menschlich."

# Pflichtseiten in Deutschland. Inhalt kommt aus content/*.html,
# damit er versioniert ist und auf der Produktion identisch landet.
declare -A PFLICHTSEITEN=(
  [impressum]="Impressum"
  [datenschutz]="Datenschutzerklärung"
)

for slug in "${!PFLICHTSEITEN[@]}"; do
  titel="${PFLICHTSEITEN[$slug]}"
  inhalt="$(cat "content/${slug}.html")"
  id="$(wp post list --post_type=page --name="$slug" --field=ID --format=ids)"

  if [ -z "$id" ]; then
    wp post create --post_type=page --post_status=publish \
      --post_name="$slug" --post_title="$titel" --post_content="$inhalt"
  else
    wp post update "$id" --post_title="$titel" --post_content="$inhalt"
  fi
done

echo
echo "Gotowe:"
echo "  Strona:  $SITE_URL"
echo "  Panel:   $SITE_URL/wp-admin  (login: $ADMIN_USER / $ADMIN_PASS)"
echo "  Poczta:  http://localhost:8025  (maile z formularza lądują tutaj, nie u Ewy)"
