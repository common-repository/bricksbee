<?php
namespace Bricksbee;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Element_CF7 extends \Bricks\Element {

    public $category     = 'Bricksbee';
    public $name         = 'bb-cf7';
    public $icon         = 'ti-layout-accordion-merged';
    public $css_selector = '.bb-cf7-form';

    public function get_label() {
        return esc_html__( 'Contact Form 7', 'bricksbee' );
    }

    public function set_control_groups() {

        $this->control_groups['fields'] = [
            'title' => esc_html__( 'Fields', 'bricksbee' ),
            'tab'   => 'content',
        ];

        $this->control_groups['_submitButton'] = [
            'title' => esc_html__( 'Submit Button', 'bricksbee' ),
            'tab'   => 'content',
        ];

    }

    public function set_controls() {

        if ( !class_exists( 'WPCF7_ContactForm' ) ) {
            $this->controls['_cf7_install'] = [
                'tab'     => 'content',
                'type'    => 'info',
                'content' => sprintf(
                    esc_html__( 'Please click on the link below and install/activate Contact Form 7. Make sure to refresh this page after installation or activation. %s', 'bricksbee' ),
                    '<a href="' . esc_url( admin_url( 'plugin-install.php?s=Contact+Form+7&tab=search&type=term' ) ) . '" target="_blank">' . esc_html__( ' Click to install or activate Contact Form 7', 'bricksbee' ) . '</a>'
                ),
            ];
        }

        $this->controls['_formID'] = array(
            'tab'         => 'content',
            'label'       => esc_html__( 'Select Form', 'bricksbee' ),
            'type'        => 'select',
            'options'     => bb_get_cf7_forms(),
            'placeholder' => esc_html__( 'Select a Form', 'bricksbee' ),
            'default'     => '',
        );

        $this->controls['_htmlClass'] = array(
            'tab'         => 'content',
            'label'       => esc_html__( 'HTML Class', 'bricksbee' ),
            'type'        => 'text',
            'description' => __( 'Add CSS custom class to the form.', 'bricksbee' ),
        );

        // Field
        $this->controls['_labelTypography'] = [
            'tab'    => 'content',
            'group'  => 'fields',
            'label'  => esc_html__( 'Label typography', 'bricksbee' ),
            'type'   => 'typography',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property' => 'font',
                    'selector' => '.bb-cf7-form label',
                ],
                [
                    'property' => 'color',
                    'selector' => '.bb-cf7-form .wpcf7 form.wpcf7-form:not(input)',
                ],
            ],
        ];

        $this->controls['_placeholderTypography'] = [
            'tab'    => 'content',
            'group'  => 'fields',
            'label'  => esc_html__( 'Placeholder typography', 'bricksbee' ),
            'type'   => 'typography',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property' => 'font',
                    'selector' => '::-webkit-input-placeholder',
                ],
                [
                    'property' => 'font',
                    'selector' => '::-moz-placeholder',
                ],
                [
                    'property' => 'font',
                    'selector' => '::-ms-input-placeholder',
                ],
                [
                    'property' => 'font',
                    'selector' => 'select', // Select placeholder
                ],
            ],
        ];

        $this->controls['_fieldTypography'] = [
            'tab'    => 'content',
            'group'  => 'fields',
            'label'  => esc_html__( 'Field typography', 'bricksbee' ),
            'type'   => 'typography',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property' => 'font',
                    'selector' => '.bb-cf7-form .wpcf7-form-control:not(.wpcf7-submit)',
                ],
            ],
        ];

        $this->controls['_fieldBackgroundColor'] = [
            'tab'    => 'content',
            'group'  => 'fields',
            'label'  => esc_html__( 'Field background', 'bricksbee' ),
            'type'   => 'color',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property'  => 'background-color',
                    'selector'  => '.bb-cf7-form input:not([type=submit]), .bb-cf7-form select, .bb-cf7-form textarea, .bb-cf7-form .wpcf7-checkbox input[type="checkbox"] + span:before, .bb-cf7-form .wpcf7-acceptance input[type="checkbox"] + span:before, .bb-cf7-form .wpcf7-radio input[type="radio"]:not(:checked) + span:before, .bb-cf7-form input[type=range]::-webkit-slider-runnable-track, .bb-cf7-form input[type=range]:focus::-webkit-slider-runnable-track'
                ],
            ],
        ];

        $this->controls['_fieldPadding'] = [
            'tab'   => 'content',
            'group' => 'fields',
            'label' => esc_html__( 'Field padding', 'bricksbee' ),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'padding',
                    'selector'  => '.bb-cf7-form input:not([type="submit"]), .bb-cf7-form select, .bb-cf7-form textarea',
                ],
            ],
        ];

        $this->controls['_fieldBorder'] = [
            'tab'    => 'content',
            'group'  => 'fields',
            'label'  => esc_html__( 'Field border', 'bricksbee' ),
            'type'   => 'border',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-cf7-form input:not([type=submit]), .bb-cf7-form select, .bb-cf7-form textarea, .bb-cf7-form .wpcf7-checkbox input[type="checkbox"]:checked + span:before, .bb-cf7-form .wpcf7-checkbox input[type="checkbox"] + span:before, .bb-cf7-form .wpcf7-acceptance input[type="checkbox"]:checked + span:before, .bb-cf7-form .wpcf7-acceptance input[type="checkbox"] + span:before, .bb-cf7-form .wpcf7-radio input[type="radio"] + span:before',
                ],
            ],
        ];

        //Submit Button - .wpcf7-submit
        $this->controls['_submitButtonWidth'] = [
            'tab'    => 'content',
            'group'  => '_submitButton',
            'label'  => esc_html__( 'Width in %', 'bricksbee' ),
            'type'   => 'number',
            'unit'   => '%',
            'min'    => 0,
            'max'    => 100,
            'css'    => [
                [
                    'property' => 'width',
                    'selector' => '.bb-cf7-form .wpcf7-submit',
                ],
            ],
            'inline' => true,
        ];

        $this->controls['_submitButtonAlign'] = [
            'tab'   => 'content',
            'group' => '_submitButton',
            'label' => esc_html__( 'Button Alignment', 'bricksbee' ),
            'type'  => 'text-align',
        ];

        $this->controls['_submitButtonMargin'] = [
            'tab'   => 'content',
            'group' => '_submitButton',
            'label' => esc_html__( 'Margin', 'bricksbee' ),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'margin',
                    'selector' => '.bb-cf7-form .wpcf7-submit',
                ],
            ],
        ];

        $this->controls['_submitButtonPadding'] = [
            'tab'   => 'content',
            'group' => '_submitButton',
            'label' => esc_html__( 'Padding', 'bricksbee' ),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'padding',
                    'selector' => '.bb-cf7-form .wpcf7-submit',
                ],
            ],
        ];

        $this->controls['_submitButtonStyle'] = [
            'tab'         => 'content',
            'group'       => '_submitButton',
            'label'       => esc_html__( 'Style', 'bricksbee' ),
            'type'        => 'select',
            'inline'      => true,
            'options'     => $this->control_options['styles'],
            'default'     => 'primary',
            'placeholder' => esc_html__( 'Custom', 'bricks', 'bricksbee' ),
        ];

        $this->controls['_submitButtonTypography'] = [
            'tab'    => 'content',
            'group'  => '_submitButton',
            'type'   => 'typography',
            'label'  => esc_html__( 'Typography', 'bricksbee' ),
            'css'    => [
                [
                    'property'  => 'typography',
                    'selector'  => '.bb-cf7-form .wpcf7-submit',
                    'important' => true,
                ],
            ],
            'inline' => true,
            'popup'  => true,
        ];

        $this->controls['_submitButtonBackground'] = [
            'tab'     => 'content',
            'group'   => '_submitButton',
            'type'    => 'color',
            'label'   => esc_html__( 'Background Color', 'bricksbee' ),
            'inline'  => true,
            'popup'   => true,
            'css'     => [
                [
                    'property'  => 'background-color',
                    'selector'  => '.bb-cf7-form .wpcf7-submit',
                    'important' => true,
                ],
            ],
            'default' => [
                'rgb' => 'rgba(250, 250, 250, 1)',
                'hex' => '#fafafa',
            ],
        ];

        $this->controls['_submitButtonBorder'] = [
            'tab'    => 'content',
            'group'  => '_submitButton',
            'label'  => esc_html__( 'Border', 'bricksbee' ),
            'type'   => 'border',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-cf7-form .wpcf7-submit',
                    'important' => true,
                ],
            ],
        ];

    }

    public function render() {

        if ( !class_exists( 'WPCF7_ContactForm' ) ) {
            return $this->render_element_placeholder(
                [
                    'title' => esc_html__( 'Contact form 7 is missing! Please install and activate', 'bricksbee' ),
                ]
            );
        }

        $settings   = $this->settings;
        $html_class = isset( $settings['_htmlClass'] ) ? $settings['_htmlClass'] : 'top';

        if ( empty( $settings['_formID'] ) ) {
            return $this->render_element_placeholder(
                [
                    'title' => esc_html__( 'No form selected.', 'bricksbee' ),
                ]
            );
        }

        $this->set_attribute( 'form-wrapper', 'id', 'bb-cf7-form-' . $this->id );
        $this->set_attribute( 'form-wrapper', 'class', 'bb-form bb-cf7-form bb-cf7-button-bg-' . $settings['_submitButtonStyle'] );

        $html = '';

        // Render
        $html .= '<div ' . $this->render_attributes( 'form-wrapper', true ) . '>';

        $html .= bb_do_shortcode( 'contact-form-7', [
            'id'         => $settings['_formID'],
            'html_class' => 'bb-cf7-style ' . bb_sanitize_html_class( $html_class ),
        ] );

        $html .= '</div>';
        
        echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }

    public static function render_builder() {?>
		<script type="text/x-template" id="tmpl-bricks-element-cf7">
			<div v-else v-html="renderElementPlaceholder()"></div>
		</script>
	<?php }

}