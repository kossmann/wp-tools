# wp-tools
The tools I use to help with some WordPress-related tasks.

## local-wp-reset.sh

Quickly reset WordPress and still keep themes plus some plugins, with optional `--url` and `--language` parameters:

```bash
local-wp-reset.sh --url=https://www.danielkossmann.com --language=pt_BR
```

Requires: WP-CLI

## auto-login

This is a plugin I use locally so I don't have to log in as admin every time I reset a site.

Requires: `define( 'WP_ENVIRONMENT_TYPE', 'local' );` in `wp-config.php`

## force-locale.php

This is used to set WP-CLI’s output to a specific language (locale).

Example:
```bash
wp --require=$HOME/workspace/wp-tools/force-locale.php plugin install wordpress-seo
```
