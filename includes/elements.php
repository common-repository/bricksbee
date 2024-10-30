<?php
namespace Bricksbee;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Elements {

    public static function init() {
        // Init elements
        add_action( 'init', array(__CLASS__, 'init_elements'), 11 );
    }

    public static function get_elements_map() {
        $elements_map = array(
            'cf7'          => array(
                'demo'  => '',
                'title' => __( 'Contact Form 7', 'bricksbee' ),
                'icon'  => '',
            ),
            'gravityforms' => array(
                'demo'  => '',
                'title' => __( 'Gravity Forms', 'bricksbee' ),
                'icon'  => '',
            ),
            'buttons' => array(
                'demo'  => '',
                'title' => __( 'Multi Buttons', 'bricksbee' ),
                'icon'  => '',
            ),
        );

        return apply_filters( 'bricksbee_get_elements_map', $elements_map );

    }

    public static function get_inactive_elements() {
        return get_option( 'bricksbee_inactive_elements', array() );
    }

    public static function set_inactive_elements( $elements = array() ) {
        update_option( 'bricksbee_inactive_elements', $elements );
    }

    public static function init_elements() {
        $inactive_elements = self::get_inactive_elements();
        foreach ( self::get_elements_map() as $key => $data ) {
            if ( !in_array( $key, $inactive_elements ) ) {
                $element_file = BRICKSBEE_DIR . 'includes/elements/' . $key . '.php';
                if ( is_readable( $element_file ) ) {
                    \Bricks\Elements::register_element( $element_file );
                }
            }
        }
    }

}