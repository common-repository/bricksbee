<?php
/**
 * Plugin Name: Bricksbee
 * Plugin URI: https://www.bricksbee.com/
 * Description: Bricksbee is a premium extension for Bricks Theme that adds 10+ elements. Bricks must be installed and activated.
 * Author: UnifiedWP
 * Author URI: https://www.unifiedwp.com/
 * Version: 0.0.1
 * Requires at least: 4.6
 * Tested up to: 5.8
 * Requires PHP: 5.6
 * License: GPL v3
 * Text Domain: bricksbee
 * Domain Path: /languages
 *
 * Bricksbee Lite
 * Copyright (C) 2021, Bricksbee, support@bricksbee.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @category            Plugin
 * @package             Bricksbee
 *
 * @author              Fahim R.
 * @copyright           Copyright © 2021 Fahim R. (UnifiedWP)
 */

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( 'bricks' !== get_template() ) {
    return;
}

/**
 * The main plugin class.
 *
 * @access public
 * @package Bricksbee
 *
 * @author  Fahim R.
 *
 * @since 1.0.0
 */
final class Bricksbee_Lite {

    /**
     * Holds the class object.
     *
     * @since 1.0.0
     */
    public static $instance;

    /**
     * Plugin version
     *
     * @since 1.0.0
     */
    public $version = '0.0.1';

    /**
     * Appsero
     *
     * @var [type]
     */
	public $appsero = null;

    /**
     * Plugin file.
     *
     * @since 1.0.0
     */
    public $file;

    /**
     * The name of the plugin.
     *
     * @since 1.0.0
     */
    public $plugin_name = 'Bricksbee Lite';

    /**
     * Unique plugin slug identifier.
     *
     * @since 1.0.0
     */
    public $plugin_slug = 'bricksbee';

    /**
     * Class constructor.
     *
     * @since 1.0.0
     */
    private function __construct() {}

    /**
     * Returns the singleton instance of the class.
     *
     * @since 1.0.0
     *
     * @return \Bricksbee_lite
     */
    public static function instance() {
        if ( !isset( self::$instance ) && !( self::$instance instanceof Bricksbee_Lite ) ) {
            self::$instance       = new Bricksbee_Lite();
            self::$instance->file = __FILE__;

            global $wp_version;

            if ( version_compare( $wp_version, '4.6', '<' ) ) {
                add_action( 'admin_notices', array( self::$instance, 'bricksbee_wp_notice' ) );
                return;
            }

            // Define constants
            self::$instance->define_constants();

            // Load init file
            self::$instance->init();

            //Hooks
            self::$instance->register_hooks();

            //Appsero
            self::$instance->init_appsero_tracking();

        }

        return self::$instance;
    }
    
    /**
     * Register hooks
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public function register_hooks() {
        add_action( 'init', [ $this, 'i18n' ] );
        add_filter( 'body_class', [ $this, 'add_body_classes' ] );
    }

    /**
     * i18n function
     * 
     * @since 1.0.0
     *
     * @return void
     */
    public function i18n() {
        load_plugin_textdomain( 'bricksbee' );
    }

    /**
     * Define the required plugin constants
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function define_constants() {
        define( 'BRICKSBEE_VERSION', $this->version );
        define( 'BRICKSBEE_FILE', $this->file );
        define( 'BRICKSBEE_DIR', plugin_dir_path( $this->file ) );
        define( 'BRICKSBEE_URL', plugins_url( '', BRICKSBEE_FILE ) );
        define( 'BRICKSBEE_ASSETS', BRICKSBEE_URL . '/assets/' );

        if ( ! defined( 'BRICKSBEE_DEBUG ' ) ) {
            define( 'BRICKSBEE_DEBUG', false );
        }

        if ( BRICKSBEE_DEBUG || ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ) {
            define( 'BRICKSBEE_ASSETS_SUFFIX', '' );
        } else {
            define( 'BRICKSBEE_ASSETS_SUFFIX', '.min' );
        }
    }

    /**
     * Initialize the plugin tracker
     *
     * @return void
     */
    protected function init_appsero_tracking() {

        if ( ! class_exists( 'Appsero\Client' ) ) {
            require_once __DIR__ . '/vendor/appsero/client/src/Client.php';
        }

        $this->appsero = new Appsero\Client( 
            '5b800176-c73a-4c74-89c1-846fcbf0054c', 
            'Bricksbee', 
            __FILE__ 
        );

        // Active insights
        $this->appsero->insights()->init();

    }

    /**
     * Loads all files into scope.
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function init() {
        if ( version_compare( PHP_VERSION, '5.4', '>=' ) ) {
            require_once BRICKSBEE_DIR . 'includes/init.php';
        } else {
            add_action(
                'admin_notices',
                function() {
                    $message = sprintf( esc_html__( 'Bricks requires PHP version %s+.', 'bricksbee' ), '5.4' );
                    $html    = sprintf( '<div class="error">%s</div>', wpautop( $message ) );
                    echo wp_kses_post( $html );
                }
            );
        }
    }

    /**
     * Output a nag notice if the user has an out of date WP version installed
     *
     * @since 1.0.0
     *
     * @return void
     */
    public function bricksbee_wp_notice() {
        $url = admin_url( 'plugins.php' );

        if ( is_network_admin() ) {
            $url = network_admin_url( 'plugins.php' );
        }
        ?>
		<div class="error">
			<p><?php echo sprintf( esc_html__( 'Sorry, but your version of WordPress does not meet Bricksbee\'s required version of %1$s4.6%2$s to run properly. The plugin not been activated. %3$sClick here to return to the Dashboard%4$s.', 'bricksbee' ), '<strong>', '</strong>', '<a href="' . $url . '">', '</a>' ); ?></p>
		</div>

    <?php }

    public function add_body_classes( $classes ) {
        $classes[] = 'bricksbee-plugin';

        return $classes;
    }

}

/**
 * The main function responsible for returning the one true Bricksbee Lite
 * Instance to functions everywhere.
 *
 * @since 1.0.0
 *
 * @return Bricksbee_Lite The singleton Bricksbee_Lite instance.
 */
function bricksbee_lite() {
    return Bricksbee_Lite::instance();
}

// kick it off
bricksbee_lite();