<?php
namespace Bricksbee;

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

class Element_GravityForms extends \Bricks\Element {

    public $category     = 'Bricksbee';
    public $name         = 'bb-gravityforms';
    public $icon         = 'ti-layout-accordion-merged';
    public $css_selector = '.bb-gravityform';

    public function get_label() {
        return esc_html__( 'Gravity Forms', 'bricksbee' );
    }

    public function set_control_groups() {

        $this->control_groups['_general'] = [
            'title' => esc_html__( 'General', 'bricksbee' ),
            'tab'   => 'content',
        ];

        $this->control_groups['_fields'] = [
            'title' => esc_html__( 'Fields', 'bricksbee' ),
            'tab'   => 'content',
        ];

        $this->control_groups['_submitButton'] = [
            'title' => esc_html__( 'Submit Button', 'bricksbee' ),
            'tab'   => 'content',
        ];

    }

    protected function get_gravity_forms() {

        $field_options = [];

        if ( class_exists( 'GFForms' ) ) {
            $forms = \RGFormsModel::get_forms( null, 'title' );
            if ( is_array( $forms ) ) {
                foreach ( $forms as $form ) {
                    $field_options[$form->id] = $form->title;
                }
            }
        }

        return $field_options;
    }

    public function set_controls() {

        if ( !class_exists( 'GFForms' ) ) {
            $this->controls['_gravityforms_install'] = [
                'tab'     => 'content',
                'type'    => 'info',
                'content' => esc_html__( 'Please click on the link below and install/activate Gravity Forms. Make sure to refresh this page after installation or activation.', 'bricksbee' ),
            ];
        }

        $this->controls['_formID'] = array(
            'tab'         => 'content',
            'label'       => esc_html__( 'Select Form', 'bricksbee' ),
            'type'        => 'select',
            'placeholder' => esc_html__( 'Select a Form', 'bricksbee' ),
            'options'     => $this->get_gravity_forms(),
            'default'     => '',
        );

        // General
        $this->controls['_formAjaxOption'] = [
            'tab'     => 'content',
            'group'   => '_general',
            'label'   => esc_html__( 'Enable AJAX Form Submission', 'bricksbee' ),
            'type'    => 'checkbox',
            'default' => false,
        ];

        $this->controls['_formTitleOption'] = [
            'tab'     => 'content',
            'group'   => '_general',
            'label'   => __( 'Title & Description', 'bricksbee' ),
            'type'    => 'select',
            'default' => 'yes',
            'options' => [
                'yes'  => __( 'From Gravity Form', 'bricksbee' ),
                'no'   => __( 'Enter Your Own', 'bricksbee' ),
                'none' => __( 'None', 'bricksbee' ),
            ],
            'inline'  => true,
        ];

        $this->controls['_formTitle'] = array(
            'tab'      => 'content',
            'group'    => '_general',
            'label'    => esc_html__( 'Form Title', 'bricksbee' ),
            'type'     => 'text',
            'required' => ['_formTitleOption', '=', 'no'],
        );

        $this->controls['_formDesc'] = array(
            'tab'      => 'content',
            'group'    => '_general',
            'label'    => esc_html__( 'Form Description', 'bricksbee' ),
            'type'     => 'textarea',
            'required' => ['_formTitleOption', '=', 'no'],
        );

        $this->controls['_KTKSFormOption'] = [
            'tab'     => 'content',
            'group'   => '_general',
            'label'   => esc_html__( 'Keyboard Tab Key Support', 'bricksbee' ),
            'type'    => 'checkbox',
            'default' => false,
        ];

        $this->controls['_formTabIndexOption'] = [
            'tab'      => 'content',
            'group'    => '_general',
            'label'    => __( 'Set Tabindex Value', 'bricksbee' ),
            'type'     => 'number',
            'min'      => 0,
            'max'      => 10,
            'step'     => '1',
            'inline'   => true,
            'default'  => '1',
            'required' => ['_KTKSFormOption', '=', true],
        ];

        $this->controls['_formHelpInfo'] = [
            'tab'      => 'content',
            'group'    => '_general',
            'content'  => esc_html__( 'You need to change above tabindex value if pressing tab on your keyboard not works as expected.', 'bricksbee' ),
            'type'     => 'info',
            'required' => ['_KTKSFormOption', '=', true],
        ];

        // Field
        $this->controls['_labelTypography'] = [
            'tab'    => 'content',
            'group'  => '_fields',
            'label'  => esc_html__( 'Label typography', 'bricksbee' ),
            'type'   => 'typography',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property' => 'font',
                    'selector' => '.bb-gravityform .gfield_label, .bb-gravityform .gfield_checkbox li label, .bb-gravityform .ginput_container_consent label, .bb-gravityform .gfield_radio li label, .bb-gravityform .gsection_title, .bb-gravityform .gfield_html, .bb-gravityform .ginput_product_price, .bb-gravityform .ginput_product_price_label, .bb-gravityform .gf_progressbar_title, .bb-gravityform .gf_page_steps, .bb-gravityform .gfield_checkbox div label, .bb-gravityform .gfield_radio div label',
                ],
            ],
        ];

        $this->controls['_placeholderTypography'] = [
            'tab'    => 'content',
            'group'  => '_fields',
            'label'  => esc_html__( 'Placeholder typography', 'bricksbee' ),
            'type'   => 'typography',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property' => 'font',
                    'selector' => '.bb-gravityform .gform_wrapper .gfield input::placeholder, .bb-gravityform .ginput_container textarea::placeholder',
                ],
            ],
        ];

        $this->controls['_fieldTypography'] = [
            'tab'    => 'content',
            'group'  => '_fields',
            'label'  => esc_html__( 'Field typography', 'bricksbee' ),
            'type'   => 'typography',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property' => 'font',
                    'selector' => '.bb-gravityform .gform_wrapper .gfield input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]), .bb-gravityform .ginput_container select, .bb-gravityform .ginput_container .chosen-single, .bb-gravityform .ginput_container textarea, .bb-gravityform .gfield_checkbox input[type="checkbox"]:checked + label:before, .bb-gravityform .ginput_container_consent input[type="checkbox"] + label:before',
                ],
            ],
        ];

        $this->controls['_fieldBackgroundColor'] = [
            'tab'    => 'content',
            'group'  => '_fields',
            'label'  => esc_html__( 'Field background', 'bricksbee' ),
            'type'   => 'color',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property'  => 'background-color',
                    'selector'  => '.bb-gravityform .gform_wrapper input[type=email], .bb-gravityform .gform_wrapper input[type=text], .bb-gravityform .gform_wrapper input[type=password], .bb-gravityform .gform_wrapper input[type=url], .bb-gravityform .gform_wrapper input[type=tel], .bb-gravityform .gform_wrapper input[type=number], .bb-gravityform .gform_wrapper input[type=date], .bb-gravityform .gform_wrapper select,  .bb-gravityform .gform_wrapper .chosen-container-single .chosen-single,  .bb-gravityform .gform_wrapper .chosen-container-multi .chosen-choices,  .bb-gravityform .gform_wrapper textarea,  .bb-gravityform .gfield_checkbox input[type="checkbox"] + label:before, .bb-gravityform .gfield_radio input[type="radio"] + label:before,  .bb-gravityform .gfield_radio .gchoice_label label:before, .bb-gravityform .gform_wrapper .gf_progressbar, .bb-gravityform .ginput_container_consent input[type="checkbox"] + label:before',
                    'important' => true,
                ],
            ],
        ];

        $this->controls['_fieldBorder'] = [
            'tab'    => 'content',
            'group'  => '_fields',
            'label'  => esc_html__( 'Field border', 'bricksbee' ),
            'type'   => 'border',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => ' .bb-gravityform .gform_wrapper input[type=email], .bb-gravityform .gform_wrapper input[type=text], .bb-gravityform .gform_wrapper input[type=password], .bb-gravityform .gform_wrapper input[type=url], .bb-gravityform .gform_wrapper input[type=tel], .bb-gravityform .gform_wrapper input[type=number], .bb-gravityform .gform_wrapper input[type=date], .bb-gravityform .gform_wrapper select, .bb-gravityform .gform_wrapper .chosen-single, .bb-gravityform .gform_wrapper textarea, .bb-gravityform .gfield_checkbox input[type="checkbox"] + label:before, .bb-gravityform .ginput_container_consent input[type="checkbox"] + label:before, .bb-gravityform .gfield_radio input[type="radio"] + label:before, .bb-gravityform .gfield_radio .gchoice_label label:before',
                    'important' => true,
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
                    'selector' => '.bb-gravityform .gform_wrapper form .gform_body input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):not([type="image"]):not([type="file"]),.bb-gravityform .gform_wrapper textarea',
                ],
                [
                    'property' => 'padding-left',
                    'selector' => '.bb-gravityform .ginput_container select, .bb-gravityform.ginput_container .chosen-single',
                ],
                [
                    'property' => 'height',
                    'selector' => '.bb-gravityform .gfield_checkbox input[type="checkbox"] + label:before, .bb-gravityform .gfield_radio input[type="radio"] + label:before, .bb-gravityform .gfield_radio .gchoice_label label:before,.bb-gravityform .ginput_container_consent input[type="checkbox"] + label:before',
                ],
                [
                    'property' => 'width',
                    'selector' => '.bb-gravityform .gfield_checkbox input[type="checkbox"] + label:before, .bb-gravityform .gfield_radio input[type="radio"] + label:before, .bb-gravityform .gfield_radio .gchoice_label label:before,.bb-gravityform .ginput_container_consent input[type="checkbox"] + label:before',
                ],
            ],
        ];

        //Submit Button
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
                    'selector' => '.bb-gravityform input[type="submit"],.bb-gravityform input[type="button"]',
                ],
            ],
            'inline' => true,
        ];

        $this->controls['_submitButtonMargin'] = [
            'tab'   => 'content',
            'group' => '_submitButton',
            'label' => esc_html__( 'Margin', 'bricksbee' ),
            'type'  => 'dimensions',
            'css'   => [
                [
                    'property' => 'margin',
                    'selector' => '.bb-gravityform input[type="submit"],.bb-gravityform input[type="button"]',
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
                    'selector' => '.bb-gravityform input[type="submit"],.bb-gravityform input[type="button"]',
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
            'placeholder' => esc_html__( 'Custom', 'bricksbee' ),
            'default'     => 'primary',
        ];

        $this->controls['_submitButtonTypography'] = [
            'tab'    => 'content',
            'group'  => '_submitButton',
            'type'   => 'typography',
            'label'  => esc_html__( 'Typography', 'bricksbee' ),
            'css'    => [
                [
                    'property'  => 'typography',
                    'selector'  => '.bb-gravityform input[type="submit"],.bb-gravityform input[type="button"]',
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
                    'selector'  => '.bb-gravityform input[type="submit"],.bb-gravityform input[type="button"]',
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
            'label'  => esc_html__( 'Border', 'bricks', 'bricksbee' ),
            'type'   => 'border',
            'inline' => true,
            'small'  => true,
            'css'    => [
                [
                    'property'  => 'border',
                    'selector'  => '.bb-gravityform input[type="submit"],.bb-gravityform input[type="button"]',
                    'important' => true,
                ],
            ],
        ];

    }

    public function render() {

        $settings = $this->settings;

        if ( !class_exists( 'GFForms' ) ) {
            return $this->render_element_placeholder(
                [
                    'title' => esc_html__( 'Gravity Forms is missing! Please install and activate', 'bricksbee' ),
                ]
            );
        }

        if ( empty( $settings['_formID'] ) ) {
            return $this->render_element_placeholder(
                [
                    'title' => esc_html__( 'Please select a Gravity Form', 'bricksbee' ),
                ]
            );
        }

        $form_title_option = isset( $settings['_formTitleOption'] ) ? $settings['_formTitleOption'] : '';
        $form_title        = '';
        $description       = '';
        $form_desc         = 'false';

        if ( $form_title_option ) {
            if ( class_exists( 'GFAPI' ) ) {
                $form       = array();
                $form       = \GFAPI::get_form( absint( $settings['_formID'] ) );
                $form_title = isset( $form['title'] ) ? $form['title'] : '';
                $form_desc  = 'true';
            }
        } elseif ( !$form_title_option ) {
            $form_title  = isset( $settings['_formTitle'] ) ? $settings['_formTitle'] : '';
            $description = isset( $settings['_formDesc'] ) ? $settings['_formDesc'] : '';
            $form_desc   = 'false';
        } else {
            $form_title  = '';
            $description = '';
            $form_desc   = 'false';
        }

        $ajax      = isset( $settings['_formAjaxOption'] ) ? 'true' : 'false';
        $tab_index = isset( $settings['_formTabIndexOption'] ) ? $settings['_formTabIndexOption'] : '';

        $shortcode_extra = '';
        $shortcode_extra = apply_filters( 'bb_gf_shortcode_extra_param', '', absint( $settings['_formID'] ) );

        $submit_btton_style = isset( $settings['_submitButtonStyle'] ) ? $settings['_submitButtonStyle'] : 'primary';

        // Set Attribute
        $this->set_attribute( 'form-wrapper', 'id', 'bb-gf-form-' . $this->id );
        $this->set_attribute( 'form-wrapper', 'class', 'bb-form bb-gravityform bb-gravityform-button-bg-' . $submit_btton_style );

        // Render
        $html = '';
        $html .= '<div ' . $this->render_attributes( 'form-wrapper', true ) . '>';

        $html .= do_shortcode( '[gravityform id=' . absint( $settings['_formID'] ) . ' ajax="' . $ajax . '" title="false" description="' . $form_desc . '" tabindex=' . $tab_index . ' ' . $shortcode_extra . ']' );

        $html .= '</div>';

        echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }

    public static function render_builder() {?>
		<script type="text/x-template" id="tmpl-bricks-element-gravityforms">
			<div v-else v-html="renderElementPlaceholder()"></div>
		</script>
	<?php
}

}
