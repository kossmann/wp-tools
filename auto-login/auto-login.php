<?php
/**
 * Plugin Name: Auto Login for Local Testing
 * Description: Automatically logs in a user for testing purposes on a local environment.
 * Version: 1.0
 * Author: Daniel Kossmann & AI
 * Plugin URI:  https://github.com/kossmann/wp-tools/auto-login
 * License: GPL v3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package WP_Tools
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Automatically logs in the first administrator user in local environment.
 *
 * @since 1.0.0
 *
 * @return void
 */
function wp_tools_auto_login_local() {
    // Check if WP_ENVIRONMENT_TYPE is defined and set to 'local'.
    if ( ! defined( 'WP_ENVIRONMENT_TYPE' ) || 'local' !== WP_ENVIRONMENT_TYPE ) {
        return;
    }

    // Only run if it's the admin area and user is not logged in.
    if ( ! is_admin() || is_user_logged_in() ) {
        return;
    }

    // Get the first admin user.
    $args = array(
        'role'    => 'administrator',
        'number'  => 1,
        'orderby' => 'ID',
        'order'   => 'ASC',
    );
    
    $admin_users = get_users( $args );

    if ( empty( $admin_users ) ) {
        wp_die( esc_html__( 'No admin users found in the system.', 'wp-tools' ) );
        return;
    }

    $admin_user = $admin_users[0];

    // Force login as this admin user.
    wp_set_current_user( $admin_user->ID );
    wp_set_auth_cookie( $admin_user->ID, true );
    
    // Redirect to admin dashboard.
    wp_safe_redirect( admin_url() );
    exit;
}

add_action( 'init', 'wp_tools_auto_login_local' );