<?php
// Source: https://make.wordpress.org/cli/handbook/guides/force-output-specific-locale/
WP_CLI::add_wp_hook( 'pre_option_WPLANG', function() {
    return 'en_US';
});