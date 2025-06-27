#!/usr/bin/env sh

# Configuration variables
SITE_URL="http://test.local"
ADMIN_USER="kossmann"
ADMIN_PASSWORD="kossmann"
ADMIN_EMAIL="dev-email@dev-domain.local"
THEME="twentytwentyfour"
LANGUAGE="en_US"

# Optional command line arguments
while [ "$#" -gt 0 ]; do
    case "$1" in
        --language=*)
            LANGUAGE="${1#*=}"
            ;;
        --url=*)
            SITE_URL="${1#*=}"
            ;;
    esac
    shift
done

# Delete plugins, but keep the ones I need: starting with dk-, auto-login and index.php
find wp-content/plugins/ -mindepth 1 -maxdepth 1 -type d ! -name 'dk-*' ! -name 'auto-login' ! -name 'index.php' -exec trash {} +;

# Delete everything in wp-content except plugins/ and themes/
find wp-content/ -mindepth 1 -maxdepth 1 -type d ! -name 'plugins' ! -name 'themes' -exec trash {} +;

# Reset database
wp db reset --yes;

# Install WordPress
wp core install --url="$SITE_URL" --title="" --admin_user="$ADMIN_USER" --admin_password="$ADMIN_PASSWORD" --admin_email="$ADMIN_EMAIL";

# Set language, useful for testing internationalization
wp language core install ${LANGUAGE} --activate;

# Activated desired theme
wp theme activate ${THEME};

# Activate all plugins
wp plugin activate --all;
