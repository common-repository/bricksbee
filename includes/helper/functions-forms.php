<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Get a list of all CF7 forms
 *
 * @since 1.0.0
 *
 * @return array
 */
function bb_get_cf7_forms() {
    $forms = array();

    $_forms = get_posts( array(
        'post_type'      => 'wpcf7_contact_form',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ) );

    if ( !empty( $_forms ) ) {
        $forms = wp_list_pluck( $_forms, 'post_title', 'ID' );
    }

    return $forms;
}

/**
 * Get a list of all Gravity forms
 *
 * @since 1.0.0
 *
 * @return array
 */
function ba_get_gravity_forms() {

    $field_options = array();

    if ( class_exists( 'GFForms' ) ) {
        $forms              = \RGFormsModel::get_forms( null, 'title' );
        $field_options['0'] = 'Select';
        if ( is_array( $forms ) ) {
            foreach ( $forms as $form ) {
                $field_options[ $form->id ] = $form->title;
            }
        }
    }

    if ( empty( $field_options ) ) {
        $field_options = array(
            '-1' => __( 'You have not added any Gravity Forms yet.', 'bricksbee' ),
        );
    }

    return $field_options;
}