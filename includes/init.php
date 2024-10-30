<?php
namespace Bricksbee;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Plugin {

    /**
     * Holds the class object.
     *
     * @since 1.0.0
     */
    public static $instance;

    /**
     * Autoload and init components
     *
     * @since 1.0.0
     */
    public function __construct() {
        $this->autoloader();
        $this->helper_files();

        $this->elements = new Elements();
        $this->elements::init();


        $this->assets_manager = new Assets_Manager();
    }

    /**
     * Plugin instance
     *
     * @since 1.0.0
     */
    public static function instance() {
        if ( !isset( self::$instance ) && !( self::$instance instanceof Plugin ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Autoload files
     *
     * @since 1.0.0
     */
    private function autoloader() {
        require_once BRICKSBEE_DIR . 'includes/autoloader.php';
        Autoloader::register();
    }

    /**
     * Helper files
     *
     * @since 1.0.0
     */
    private function helper_files() {
        require_once BRICKSBEE_DIR . 'includes/helper/functions.php';
        require_once BRICKSBEE_DIR . 'includes/helper/functions-forms.php';
    }

}

// Get the plugin up and running
Plugin::instance();