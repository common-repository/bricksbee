<?php
namespace Bricksbee;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Element_Buttons extends \Bricks\Element {

    public $category = 'Bricksbee';
    public $name     = 'bb-buttons';
    public $icon     = 'ti-control-stop';

    public function get_label() {
        return esc_html__( 'Dual Button', 'bricksbee' );
    }

    public function set_control_groups() {

        $this->control_groups['primary'] = [
            'title' => esc_html__( 'Primary Button', 'bricksbee' ),
            'tab'   => 'content',
        ];

        $this->control_groups['primary_button'] = [
            'title' => esc_html__( 'Primary Button Design', 'bricksbee' ),
            'tab'   => 'content',
        ];

        $this->control_groups['connector'] = [
            'title' => esc_html__( 'Connector', 'bricksbee' ),
            'tab'   => 'content',
        ];

        $this->control_groups['secondary'] = [
            'title' => esc_html__( 'Secondary Button', 'bricksbee' ),
            'tab'   => 'content',
        ];

        $this->control_groups['secondary_button'] = [
            'title' => esc_html__( 'Secondary Button Design', 'bricksbee' ),
            'tab'   => 'content',
        ];

    }

    public function set_controls() {

        $this->controls['_alignment'] = [
            'tab'     => 'content',
            'label'   => esc_html__( 'Alignment', 'bricksbee' ),
            'type'    => 'justify-content',
            'css'     => [
                [
                    'property' => 'justify-content',
                    'selector' => '.bb-buttons-wrap',
                ],
            ],
            'default' => 'center',
            'exclude' => [
                'space-between',
                'space-around',
                'space-evenly',
            ],
        ];

        $this->controls['_space_between_buttons'] = [
            'tab'     => 'content',
            'label'   => esc_html__( 'Space Between Buttons', 'bricksbee' ),
            'type'    => 'slider',
            'css'     => [
                [
                    'property'  => 'margin-left',
                    'selector'  => '.bb-secondary-button',
                    'important' => true,
                ],
                [
                    'property'  => 'margin-right',
                    'selector'  => '.bb-primary-button',
                    'important' => true,
                ],
            ],
            'units'   => [
                'px' => [
                    'min'  => 1,
                    'max'  => 100,
                    'step' => 1,
                ],
            ],
            'default' => '32px',
        ];

        // Primary Button
        $this->controls['primary_text'] = [
            'tab'            => 'content',
            'group'          => 'primary',
            'type'           => 'text',
            'default'        => esc_html__( 'Click Me #1', 'bricksbee' ),
            'hasDynamicData' => 'text',
            'placeholder'    => esc_html__( 'Click Me #1', 'bricksbee' ),
        ];

        $this->controls['primary_size'] = [
            'tab'         => 'content',
            'group'       => 'primary',
            'label'       => esc_html__( 'Size', 'bricksbee' ),
            'type'        => 'select',
            'options'     => $this->control_options['buttonSizes'],
            'inline'      => true,
            'reset'       => true,
            'placeholder' => esc_html__( 'Medium', 'bricksbee' ),
        ];

        $this->controls['primary_style'] = [
            'tab'         => 'content',
            'group'       => 'primary',
            'label'       => esc_html__( 'Style', 'bricksbee' ),
            'type'        => 'select',
            'options'     => $this->control_options['styles'],
            'inline'      => true,
            'reset'       => true,
            'default'     => 'primary',
            'placeholder' => esc_html__( 'None', 'bricksbee' ),
        ];

        $this->controls['primary_circle'] = [
            'tab'     => 'content',
            'group'   => 'primary',
            'label'   => esc_html__( 'Circle', 'bricksbee' ),
            'type'    => 'checkbox',
            'default' => true,
            'reset'   => true,
        ];

        $this->controls['primary_outline'] = [
            'tab'   => 'content',
            'group' => 'primary',
            'label' => esc_html__( 'Outline', 'bricksbee' ),
            'type'  => 'checkbox',
            'reset' => true,
        ];

        // Primary Button: Link
        $this->controls['primary_link_separator'] = [
            'tab'   => 'content',
            'group' => 'primary',
            'label' => esc_html__( 'Link', 'bricksbee' ),
            'type'  => 'separator',
        ];

        $this->controls['primary_link'] = [
            'tab'   => 'content',
            'group' => 'primary',
            'label' => esc_html__( 'Link type', 'bricksbee' ),
            'type'  => 'link',
        ];

        // Primary Button: Icon
        $this->controls['primary_icon_separator'] = [
            'tab'   => 'content',
            'group' => 'primary',
            'label' => esc_html__( 'Icon', 'bricksbee' ),
            'type'  => 'separator',
        ];

        $this->controls['primary_icon'] = [
            'tab'     => 'content',
            'group'   => 'primary',
            'label'   => esc_html__( 'Icon', 'bricksbee' ),
            'type'    => 'icon',
            'default' => [
                'library' => 'themify',
                'icon'    => 'ti-star',
            ],
            'css'     => [
                [
                    'selector' => '.icon-svg',
                ],
            ],
        ];

        $this->controls['primary_icon_typography'] = [
            'tab'      => 'content',
            'group'    => 'primary',
            'label'    => esc_html__( 'Typography', 'bricksbee' ),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => 'i',
                ],
            ],
            'exclude'  => [
                'font-family',
                'font-weight',
                'font-style',
                'text-align',
                'text-decoration',
                'text-transform',
                'line-height',
                'letter-spacing',
            ],
            'inline'   => true,
            'small'    => true,
            'required' => ['primary_icon', '!=', ''],
        ];

        $this->controls['primary_icon_position'] = [
            'tab'         => 'content',
            'group'       => 'primary',
            'label'       => esc_html__( 'Position', 'bricksbee' ),
            'type'        => 'select',
            'options'     => $this->control_options['iconPosition'],
            'inline'      => true,
            'placeholder' => esc_html__( 'Left', 'bricksbee' ),
            'default'     => 'left',
            'required'    => ['primary_icon', '!=', ''],
        ];

        $this->controls['primary_icon_space'] = [
            'tab'      => 'content',
            'group'    => 'primary',
            'label'    => esc_html__( 'Space between', 'bricksbee' ),
            'type'     => 'checkbox',
            'css'      => [
                [
                    'property' => 'justify-content',
                    'selector' => '.bb-button',
                    'value'    => 'space-between',
                ],
            ],
            'required' => ['primary_icon', '!=', ''],
        ];

        // Primary Button: Design
        $this->controls['primary_button_width'] = [
            'tab'    => 'content',
            'group'  => 'primary_button',
            'label'  => esc_html__( 'Width in %', 'bricksbee' ),
            'type'   => 'number',
            'unit'   => '%',
            'min'    => 0,
            'max'    => 100,
            'css'    => [
                [
                    'property' => 'width',
                    'selector' => '.bb-primary-button',
                ],
            ],
            'inline' => true,
        ];

        $this->controls['primary_button_margin'] = [
            'tab'   => 'content',
            'group' => 'primary_button',
            'label' => esc_html__( 'Margin', 'bricksbee' ),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'margin',
                    'selector' => '.bb-primary-button',
                ],
            ],
        ];

        $this->controls['primary_button_margin']['default'] = [
            'top'    => 0,
            'bottom' => 0,
            'left'   => 0,
        ];

        $this->controls['primary_button_padding'] = [
            'tab'   => 'content',
            'group' => 'primary_button',
            'label' => esc_html__( 'Padding', 'bricksbee' ),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bb-primary-button',
                ],
            ],
        ];

        $this->controls['primary_button_padding']['default'] = [
            'top'    => 12,
            'right'  => 45,
            'bottom' => 12,
            'left'   => 45,
        ];

        $this->controls['primary_button_typography'] = [
            'tab'    => 'content',
            'group'  => 'primary_button',
            'type'   => 'typography',
            'label'  => esc_html__( 'Typography', 'bricksbee' ),
            'css'    => [
                [
                    'property'  => 'typography',
                    'selector'  => '.bb-primary-button',
                    'important' => true,
                ],
            ],
            'inline' => true,
            'popup'  => true,
        ];

        $this->controls['primary_button_background'] = [
            'tab'    => 'content',
            'group'  => 'primary_button',
            'type'   => 'color',
            'label'  => esc_html__( 'Background Color', 'bricksbee' ),
            'inline' => true,
            'popup'  => true,
            'css'    => [
                [
                    'property'  => 'background-color',
                    'selector'  => '.bb-primary-button',
                    'important' => true,
                ],
            ],
            // 'default' => [
            //     'rgb' => 'rgba(255, 235, 59, 1)',
            //     'hex' => '#ffeb3b',
            // ],
        ];

        $this->controls['primary_button_border'] = [
            'tab'    => 'content',
            'group'  => 'primary_button',
            'label'  => esc_html__( 'Border', 'bricksbee' ),
            'type'   => 'border',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-primary-button',
                    'important' => true,
                ],
            ],
        ];

        $this->controls['primary_button_boxshadow'] = [
            'tab'    => 'content',
            'group'  => 'primary_button',
            'label'  => esc_html__( 'Box shadow', 'bricksbee' ),
            'type'   => 'box-shadow',
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-primary-button',
                    'important' => true,
                ],
            ],
            'inline' => true,
            'small'  => true,
        ];

        // Connector
        $this->controls['connector'] = [
            'tab'         => 'content',
            'group'       => 'connector',
            'type'        => 'select',
            'label'       => __( 'Type', 'bricksbee' ),
            'placeholder' => esc_html__( 'Select Type', 'bricksbee' ),
            'options'     => [
                'icon' => __( 'Icon', 'bricksbee' ),
                'text' => __( 'Text', 'bricksbee' ),
            ],
            'default'     => 'icon',
            'inline'      => true,
        ];

        $this->controls['connector_text'] = [
            'tab'      => 'content',
            'group'    => 'connector',
            'label'    => esc_html__( 'Text', 'bricksbee' ),
            'type'     => 'text',
            'default'  => esc_html__( 'Or', 'bricksbee' ),
            'required' => ['connector', '=', 'text'],
        ];

        $this->controls['connector_text_typography'] = [
            'tab'      => 'content',
            'group'    => 'connector',
            'label'    => esc_html__( 'Typography', 'bricksbee' ),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bb-button-connector',
                ],
            ],
            'exclude'  => [
                'text-align',
                'text-decoration',
            ],
            'inline'   => true,
            'small'    => true,
            'required' => ['connector', '=', 'text'],
        ];

        $this->controls['connector_icon'] = [
            'tab'      => 'content',
            'group'    => 'connector',
            'label'    => esc_html__( 'Icon', 'bricksbee' ),
            'type'     => 'icon',
            'css'      => [
                [
                    'selector' => '.icon-svg',
                ],
            ],
            'default'  => [
                'library' => 'themify',
                'icon'    => 'ti-face-smile',
            ],
            'required' => ['connector', '=', 'icon'],
        ];

        $this->controls['connector_icon_typography'] = [
            'tab'      => 'content',
            'group'    => 'connector',
            'label'    => esc_html__( 'Icon Font', 'bricksbee' ),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => '.bb-button-connector i',
                ],
            ],
            'exclude'  => [
                'font-family',
                'font-weight',
                'font-style',
                'text-align',
                'text-decoration',
                'text-transform',
                'line-height',
                'letter-spacing',
            ],
            'inline'   => true,
            'small'    => true,
            'required' => ['connector', '=', 'icon'],
        ];

        $this->controls['connector_width'] = [
            'tab'     => 'content',
            'group'   => 'connector',
            'label'   => esc_html__( 'Width in px', 'bricksbee' ),
            'type'    => 'number',
            'unit'    => 'px',
            'min'     => 0,
            'max'     => 100,
            'default' => 30,
            'css'     => [
                [
                    'property' => 'width',
                    'selector' => '.bb-button-connector',
                ],
            ],
            'inline'  => true,
        ];

        $this->controls['connector_height'] = [
            'tab'     => 'content',
            'group'   => 'connector',
            'label'   => esc_html__( 'Width in px', 'bricksbee' ),
            'type'    => 'number',
            'unit'    => 'px',
            'min'     => 0,
            'max'     => 100,
            'default' => 30,
            'css'     => [
                [
                    'property' => 'height',
                    'selector' => '.bb-button-connector',
                ],
            ],
            'inline'  => true,
        ];

        $this->controls['connector_background'] = [
            'tab'     => 'content',
            'group'   => 'connector',
            'type'    => 'color',
            'label'   => esc_html__( 'Background Color', 'bricksbee' ),
            'inline'  => true,
            'popup'   => true,
            'default' => [
                'rgb' => 'rgba(255, 214, 79, 1)',
                'hex' => '#ffd64f',
            ],
            'css'     => [
                [
                    'property'  => 'background-color',
                    'selector'  => '.bb-button-connector',
                    'important' => true,
                ],
            ],
        ];

        $this->controls['connector_border'] = [
            'tab'     => 'content',
            'group'   => 'connector',
            'label'   => esc_html__( 'Border', 'bricksbee' ),
            'type'    => 'border',
            'inline'  => true,
            'small'   => true,
            'css'     => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-button-connector',
                    'important' => true,
                ],
            ],
            'default' => [
                'radius' => [
                    'top'    => 30,
                    'right'  => 30,
                    'bottom' => 30,
                    'left'   => 30,
                ],
            ],
        ];

        $this->controls['connector_boxshadow'] = [
            'tab'    => 'content',
            'group'  => 'connector',
            'label'  => esc_html__( 'Box shadow', 'bricksbee' ),
            'type'   => 'box-shadow',
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-button-connector',
                    'important' => true,
                ],
            ],
            'inline' => true,
            'small'  => true,
        ];

        // Secondary Button
        $this->controls['secondary_text'] = [
            'tab'            => 'content',
            'group'          => 'secondary',
            'type'           => 'text',
            'default'        => esc_html__( 'Click Me #2', 'bricksbee' ),
            'hasDynamicData' => 'text',
            'placeholder'    => esc_html__( 'Click Me #2', 'bricksbee' ),
        ];

        $this->controls['secondary_size'] = [
            'tab'         => 'content',
            'group'       => 'secondary',
            'label'       => esc_html__( 'Size', 'bricksbee' ),
            'type'        => 'select',
            'options'     => $this->control_options['buttonSizes'],
            'inline'      => true,
            'reset'       => true,
            'placeholder' => esc_html__( 'Medium', 'bricksbee' ),
        ];

        $this->controls['secondary_style'] = [
            'tab'         => 'content',
            'group'       => 'secondary',
            'label'       => esc_html__( 'Style', 'bricksbee' ),
            'type'        => 'select',
            'options'     => $this->control_options['styles'],
            'inline'      => true,
            'reset'       => true,
            'default'     => 'primary',
            'placeholder' => esc_html__( 'None', 'bricksbee' ),
        ];

        $this->controls['secondary_circle'] = [
            'tab'     => 'content',
            'group'   => 'secondary',
            'label'   => esc_html__( 'Circle', 'bricksbee' ),
            'type'    => 'checkbox',
            'inline'  => true,
            'default' => true,
            'reset'   => true,
        ];

        $this->controls['secondary_outline'] = [
            'tab'   => 'content',
            'group' => 'secondary',
            'label' => esc_html__( 'Outline', 'bricksbee' ),
            'type'  => 'checkbox',
            'reset' => true,
        ];

        // Secondary Button: Link
        $this->controls['secondary_link_separator'] = [
            'tab'   => 'content',
            'group' => 'secondary',
            'label' => esc_html__( 'Link', 'bricksbee' ),
            'type'  => 'separator',
        ];

        $this->controls['secondary_link'] = [
            'tab'   => 'content',
            'group' => 'secondary',
            'label' => esc_html__( 'Link type', 'bricksbee' ),
            'type'  => 'link',
        ];

        // Secondary Button: Icon
        $this->controls['secondary_icon_separator'] = [
            'tab'   => 'content',
            'group' => 'secondary',
            'label' => esc_html__( 'Icon', 'bricksbee' ),
            'type'  => 'separator',
        ];

        $this->controls['secondary_icon'] = [
            'tab'     => 'content',
            'group'   => 'secondary',
            'label'   => esc_html__( 'Icon', 'bricksbee' ),
            'type'    => 'icon',
            'default' => [
                'library' => 'themify',
                'icon'    => 'ti-reload',
            ],
            'css'     => [
                [
                    'selector' => '.icon-svg',
                ],
            ],
        ];

        $this->controls['secondary_icon_typography'] = [
            'tab'      => 'content',
            'group'    => 'secondary',
            'label'    => esc_html__( 'Typography', 'bricksbee' ),
            'type'     => 'typography',
            'css'      => [
                [
                    'property' => 'font',
                    'selector' => 'i',
                ],
            ],
            'exclude'  => [
                'font-family',
                'font-weight',
                'font-style',
                'text-align',
                'text-decoration',
                'text-transform',
                'line-height',
                'letter-spacing',
            ],
            'inline'   => true,
            'small'    => true,
            'required' => ['secondary_icon', '!=', ''],
        ];

        $this->controls['secondary_icon_position'] = [
            'tab'         => 'content',
            'group'       => 'secondary',
            'label'       => esc_html__( 'Position', 'bricksbee' ),
            'type'        => 'select',
            'options'     => $this->control_options['iconPosition'],
            'inline'      => true,
            'default'     => 'left',
            'placeholder' => esc_html__( 'Left', 'bricksbee' ),
            'required'    => ['secondary_icon', '!=', ''],
        ];

        $this->controls['secondary_icon_space'] = [
            'tab'      => 'content',
            'group'    => 'secondary',
            'label'    => esc_html__( 'Space between', 'bricksbee' ),
            'type'     => 'checkbox',
            'css'      => [
                [
                    'property' => 'justify-content',
                    'selector' => '.bb-button',
                    'value'    => 'space-between',
                ],
            ],
            'required' => ['secondary_icon', '!=', ''],
        ];

        // Secondary Button: Design
        $this->controls['secondary_button_width'] = [
            'tab'    => 'content',
            'group'  => 'secondary_button',
            'label'  => esc_html__( 'Width in %', 'bricksbee' ),
            'type'   => 'number',
            'unit'   => '%',
            'min'    => 0,
            'max'    => 100,
            'css'    => [
                [
                    'property' => 'width',
                    'selector' => '.bb-secondary-button',
                ],
            ],
            'inline' => true,
        ];

        $this->controls['secondary_button_margin'] = [
            'tab'   => 'content',
            'group' => 'secondary_button',
            'label' => esc_html__( 'Margin', 'bricksbee' ),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'margin',
                    'selector' => '.bb-secondary-button',
                ],
            ],
        ];

        $this->controls['secondary_button_margin']['default'] = [
            'top'    => 0,
            'right'  => 0,
            'bottom' => 0,
            'left'   => 16,
        ];

        $this->controls['secondary_button_padding'] = [
            'tab'   => 'content',
            'group' => 'secondary_button',
            'label' => esc_html__( 'Padding', 'bricksbee' ),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bb-secondary-button',
                ],
            ],
        ];

        $this->controls['secondary_button_padding']['default'] = [
            'top'    => 12,
            'right'  => 45,
            'bottom' => 12,
            'left'   => 45,
        ];

        $this->controls['secondary_button_typography'] = [
            'tab'    => 'content',
            'group'  => 'secondary_button',
            'type'   => 'typography',
            'label'  => esc_html__( 'Typography', 'bricksbee' ),
            'css'    => [
                [
                    'property'  => 'typography',
                    'selector'  => '.bb-secondary-button',
                    'important' => true,
                ],
            ],
            'inline' => true,
            'popup'  => true,
        ];

        $this->controls['secondary_button_background'] = [
            'tab'    => 'content',
            'group'  => 'secondary_button',
            'type'   => 'color',
            'label'  => esc_html__( 'Background Color', 'bricksbee' ),
            'inline' => true,
            'popup'  => true,
            'css'    => [
                [
                    'property'  => 'background-color',
                    'selector'  => '.bb-secondary-button',
                    'important' => true,
                ],
            ],
        ];

        $this->controls['secondary_button_border'] = [
            'tab'    => 'content',
            'group'  => 'secondary_button',
            'label'  => esc_html__( 'Border', 'bricksbee' ),
            'type'   => 'border',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-secondary-button',
                    'important' => true,
                ],
            ],
        ];

        $this->controls['secondary_button_boxshadow'] = [
            'tab'    => 'content',
            'group'  => 'secondary_button',
            'label'  => esc_html__( 'Box shadow', 'bricksbee' ),
            'type'   => 'box-shadow',
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-secondary-button',
                    'important' => true,
                ],
            ],
            'inline' => true,
            'small'  => true,
        ];

    }

    public function render() {

        $settings = $this->settings;

        // Render

        $this->set_attribute( 'buttons-wrapper', 'class', 'bb-buttons-wrap' );

        $primary_button_classes[]   = 'bb-button bb-primary-button';
        $secondary_button_classes[] = 'bb-button bb-secondary-button';

        if ( isset( $settings['primary_size'] ) ) {
            $primary_button_classes[] = $settings['primary_size'];
        }

        if ( isset( $settings['secondary_size'] ) ) {
            $secondary_button_classes[] = $settings['secondary_size'];
        }

        // Primary Style.
        if ( isset( $settings['primary_style'] ) ) {
            // Outline
            if ( isset( $settings['primary_outline'] ) ) {
                $primary_button_classes[] = 'outline';
                $primary_button_classes[] = 'bb-color-' . $settings['primary_style'];
            } else {
                // Fill (default)
                $primary_button_classes[] = 'bb-background-' . $settings['primary_style'];
            }
        }

        //Secondary Style.
        if ( isset( $settings['secondary_style'] ) ) {
            // Outline
            if ( isset( $settings['secondary_outline'] ) ) {
                $secondary_button_classes[] = 'outline';
                $secondary_button_classes[] = 'bb-color-' . $settings['secondary_style'];
            } else {
                // Fill (default)
                $secondary_button_classes[] = 'bb-background-' . $settings['secondary_style'];
            }
        }

        if ( isset( $settings['primary_circle'] ) ) {
            $primary_button_classes[] = 'circle';
        }

        $this->set_attribute( 'primary-button-wrapper', 'class', $primary_button_classes );

        if ( isset( $settings['secondary_circle'] ) ) {
            $secondary_button_classes[] = 'circle';
        }

        $this->set_attribute( 'secondary-button-wrapper', 'class', $secondary_button_classes );

        $buttons_html = '';
        $buttons_html .= '<div ' . $this->render_attributes( 'buttons-wrapper', true ) . '>';

        // Render primary button
        if ( isset( $settings['primary_link'] ) ) {
            $this->set_link_attributes( 'primary-button-wrapper', $settings['primary_link'] );
        }

        $primary_icon_position = isset( $settings['primary_icon_position'] ) ? $settings['primary_icon_position'] : 'right';

        if ( isset( $settings['primary_icon']['icon'] ) ) {
            $this->set_attribute( 'primary-icon', 'class', $settings['primary_icon']['icon'] );
        }

        if ( isset( $settings['primary_icon']['icon'] ) || isset( $settings['primary_icon']['svg'] ) ) {
            $this->set_attribute( 'primary-button-wrapper', 'class', "icon-$primary_icon_position" );
        }

        $link_tag = isset( $settings['primary_link'] ) ? 'a' : 'span';

        // Get icon HTML ('i' or 'svg')
        $primary_icon_html = isset( $settings['primary_icon'] ) ? self::render_control_icon( $settings['primary_icon'] ) : false;

        $buttons_html .= '<' . esc_attr( $link_tag ) . ' ' . $this->render_attributes( 'primary-button-wrapper', true ) . '>';

        if ( $primary_icon_html && $primary_icon_position === 'left' ) {
            $buttons_html .= $primary_icon_html;
        }

        if ( isset( $settings['primary_text'] ) ) {
            $buttons_html .= '<span ' . $this->render_attributes( 'primary-button-text' ) . '>' . trim( $settings['primary_text'] ) . '</span>';
        }

        if ( $primary_icon_html && $primary_icon_position === 'right' ) {
            $buttons_html .= $primary_icon_html;
        }

        // Render Connector
        $connector       = isset( $settings['connector'] ) ? $settings['connector'] : 'none';
        $connector_icon  = isset( $settings['connector_icon'] ) ? self::render_control_icon( $settings['connector_icon'] ) : false;
        $connector_text  = isset( $settings['connector_text'] ) ? $settings['connector_text'] : '';
        $connector_space = isset( $settings['_space_between_buttons'] ) ? $settings['_space_between_buttons'] : '16px';

        $connector_styles   = [];
        $connector_styles[] = 'right: calc( 0px - ' . $connector_space . ' )';

        $this->set_attribute( 'connector-wrapper', 'class', 'bb-button-connector' );
        $this->set_attribute( "connector-wrapper", 'style', join( '; ', $connector_styles ) );

        if ( $connector ) {
            $buttons_html .= '<span ' . $this->render_attributes( 'connector-wrapper' ) . ' >';
            if ( $connector_icon && 'icon' === $connector ) {
                $buttons_html .= $connector_icon;
            }
            if ( $connector_text && 'text' === $connector ) {
                $buttons_html .= $connector_text;
            }
            $buttons_html .= '</span>';
        }

        $buttons_html .= '</' . esc_attr( $link_tag ) . '>';

        // Render Secondary Button
        if ( isset( $settings['secondary_link'] ) ) {
            $this->set_link_attributes( 'secondary-button-wrapper', $settings['secondary_link'] );
        }

        $secondary_icon_position = isset( $settings['secondary_icon_position'] ) ? $settings['secondary_icon_position'] : 'right';

        if ( isset( $settings['secondary_icon']['icon'] ) ) {
            $this->set_attribute( 'secondary-icon', 'class', $settings['secondary_icon']['icon'] );
        }

        if ( isset( $settings['secondary_icon']['icon'] ) || isset( $settings['secondary_icon']['svg'] ) ) {
            $this->set_attribute( 'secondary-button-wrapper', 'class', "icon-$secondary_icon_position" );
        }

        $link_tag = isset( $settings['secondary_link'] ) ? 'a' : 'span';

        // Get icon HTML ('i' or 'svg')
        $secondary_icon_html = isset( $settings['secondary_icon'] ) ? self::render_control_icon( $settings['secondary_icon'] ) : false;

        $buttons_html .= '<' . esc_attr( $link_tag ) . ' ' . $this->render_attributes( 'secondary-button-wrapper', true ) . '>';

        if ( $secondary_icon_html && $secondary_icon_position === 'left' ) {
            $buttons_html .= $secondary_icon_html;
        }

        if ( isset( $settings['secondary_text'] ) ) {
            $buttons_html .= '<span ' . $this->render_attributes( 'secondary-button-text' ) . '>' . trim( $settings['secondary_text'] ) . '</span>';
        }

        if ( $secondary_icon_html && $secondary_icon_position === 'right' ) {
            $buttons_html .= $secondary_icon_html;
        }

        $buttons_html .= '</' . esc_attr( $link_tag ) . '>';

        $buttons_html .= '</div>';
        
        echo $buttons_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    public static function render_builder() {?>
		<script type="text/x-template" id="tmpl-bricks-element-buttons">
			<div class="bb-buttons-wrap">
                <component
                    :is="settings.primary_link ? 'a' : 'span'"
                    :class="[
                        'bb-button bb-primary-button',
                        settings.primary_size ? settings.primary_size : null,
                        settings.primary_style ? settings.primary_outline ? 'outline bb-color-' + settings.primary_style : 'bb-background-' + settings.primary_style : null,
                        settings.primary_circle ? 'circle' : null,
                        settings.primary_icon && settings.primary_icon_position ? 'icon-' + settings.primary_icon_position : null,
                        settings.primary_icon && !settings.primary_icon_position ? 'icon-right' : null
                    ]">
                    <icon-svg v-if="settings.primary_icon_position === 'left' && settings.primary_icon" :iconSettings="settings.primary_icon"/>
                    <contenteditable tag="span" :name="name" controlKey="primary_text" toolbar="style" :settings="settings"/>
                    <icon-svg v-if="settings.primary_icon_position !== 'left' && settings.primary_icon" :iconSettings="settings.primary_icon"/>
                    
                </component>
                
                <component
                    :is="settings.secondary_link ? 'a' : 'span'"
                    :class="[
                        'bb-button bb-secondary-button',
                        settings.secondary_size ? settings.secondary_size : null,
                        settings.secondary_style ? settings.secondary_outline ? 'outline bb-color-' + settings.secondary_style : 'bb-background-' + settings.secondary_style : null,
                        settings.secondary_circle ? 'circle' : null,
                        settings.secondary_icon && settings.secondary_icon_position ? 'icon-' + settings.secondary_icon_position : null,
                        settings.secondary_icon && !settings.secondary_icon_position ? 'icon-right' : null
                    ]">
                    <icon-svg v-if="settings.secondary_icon_position === 'left' && settings.secondary_icon" :iconSettings="settings.secondary_icon"/>
                    <contenteditable tag="span" :name="name" controlKey="secondary_text" toolbar="style" :settings="settings"/>
                    <icon-svg v-if="settings.secondary_icon_position !== 'left' && settings.secondary_icon" :iconSettings="settings.secondary_icon"/>
                </component>
            </div>
		</script>
	<?php
}

}