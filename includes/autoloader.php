<?php
namespace Bricksbee;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Autoloads plugin classes using PSR-4.
 *
 * @since 1.0.0
 */
class Autoloader {

    /**
     * Handle autoloading of PHP classes
     */
    public static function autoload( $class ) {
        if ( strpos( $class, __NAMESPACE__ ) !== 0 ) {
            return;
        }

        $class                = substr( $class, strlen( __NAMESPACE__ ) );
        $class                = strtolower( $class );
        $class                = str_ireplace( '_', '-', $class );
        $file_parts           = explode( '\\', $class );
        $len                  = count( $file_parts );
        $file_parts[$len - 1] = $file_parts[$len - 1];
        $file                 = dirname( __FILE__ ) . implode( '/', $file_parts ) . '.php';

        if ( is_file( $file ) ) {
            require_once $file;
        }
    }

    /**
     * Register SPL autoloader
     *
     */
    public static function register( $prepend = false ) {
        spl_autoload_register( array(new self(), 'autoload'), true, $prepend );
    }

}