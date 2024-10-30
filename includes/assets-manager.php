<?php
namespace Bricksbee;

if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly

class Assets_Manager {

    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_scripts'] );
    }

    /**
     * Register styles and scripts
     *
     * @since 1.0.0
     */
    public function enqueue_scripts() {

        /**
         * Styles
         */
        wp_enqueue_style(
            'bricksbee-frontend',
            BRICKSBEE_ASSETS . 'css/frontend' . BRICKSBEE_ASSETS_SUFFIX . '.css',
            [],
            ''
        );

        if ( is_rtl() ) {
            wp_enqueue_style(
                'bricksbee-frontend-rtl',
                BRICKSBEE_URL . 'css/frontend-rtl' . BRICKSBEE_ASSETS_SUFFIX . '.css',
                [],
                filemtime( BRICKSBEE_URL . 'css/frontend-rtl' . BRICKSBEE_ASSETS_SUFFIX . '.css' )
            );
        }

        /**
         * Scripts
         */
        // wp_enqueue_script(
        //     'bricksbee-scripts',
        //     BRICKSBEE_ASSETS . 'js/bricksbee.min.js',
        //     ['jquery'],
        //     filemtime( BRICKSBEE_URL . 'js/bricks.min.js' ),
        //     true
        // );

    }

}