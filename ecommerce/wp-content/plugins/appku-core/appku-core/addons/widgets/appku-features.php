<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Features Widget .
 *
 */
class Appku_Feature extends Widget_Base {

	public function get_name() {
		return 'appkufeatures';
	}

	public function get_title() {
		return __( 'Appku Features', 'appku' );
	}

	public function get_icon() {
		return 'eicon-code';
    }

	public function get_categories() {
		return [ 'appku' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'features_section',
			[
				'label'     => __( 'Features', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'feature_style',
			[
				'label' 		=> __( 'Feature Style', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'appku' ),
					'2' 		=> __( 'Style Two', 'appku' ),
					'3' 		=> __( 'Style Three', 'appku' ),
					'4' 		=> __( 'Style Four', 'appku' ),
					'5' 		=> __( 'Style Five', 'appku' ),
				],
			]
		);
		
        $this->add_control(
			'title',
			[
				'label' 	=> __( 'Title', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '1']],
			]
        );
        $this->add_control(
			'subtitle',
			[
				'label' 	=> __( 'Subtitle', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '1']],
			]
        );
        $this->add_control(
			'desc',
			[
				'label' 	=> __( 'Description', 'appku' ),
                'type' 		=> Controls_Manager::WYSIWYG,
                'default'  	=> __( 'The Description area', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '1']],
			]
        );
        $this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Button Text', 'appku' ),
                'rows' 		=> 2,
                'condition'		=> [ 'feature_style' => [ '1' ] ],
			]
        );

        $this->add_control(
			'button_link',
			[
				'label' 		=> __( 'Link', 'appku' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'appku' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'		=> [ 'feature_style' => [ '1' ] ],
			]
		);
		$this->add_control(
			'section_heading',
			[
				'label' 		=> __( 'Allow Section Heading ?', 'appku' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'appku' ),
				'label_off' 	=> __( 'Hide', 'appku' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 'feature_style' => [ '2' ] ],
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' 	=> __( 'Title', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '2'],'section_heading' => [ 'yes']],
			]
        );
        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> __( 'Subtitle', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 3,
                'default'  	=> __( 'The Description area', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '2'],'section_heading' => [ 'yes']],
			]
        );
        $this->add_control(
			'feature_title',
			[
				'label' 	=> __( 'Feature Title', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '3','4','5']],
			]
        );
        $this->add_control(
			'details_page',
			[
				'label' 	=> __( 'Detail Page URL?', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'The Title', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '3','4','5']],
			]
        );
        $this->add_control(
			'feature_con',
			[
				'label' 	=> __( 'Feature Content', 'appku' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( 'Content Area', 'appku' ),
                'condition'		=> [ 'feature_style' => [ '3','4','5']],
			]
        );
        $this->add_control(
			'chose_icon_style',
			[
				'label' 		=> __( 'Icon Type', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'class',
				'options' 		=> [
					'class'  	=> __( 'Class', 'appku' ),
					'img' 		=> __( 'Image', 'appku' ),
				],
				'condition'		=> [ 'feature_style' => [ '3','4','5']],
			]
		);
        $this->add_control(
			'icon_class', [
				'label' 		=> __( 'Icon Class', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
				'condition'		=> [ 'chose_icon_style' => [ 'class' ] ],
			]
        );
        $this->add_control(
			'icon_image',
			[
				'label' 		=> __( 'Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'chose_icon_style' => [ 'img' ] ],
			]
		);
		$this->add_control(
			'is_active',
			[
				'label' 		=> __( 'Make it Active ?', 'appku' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'appku' ),
				'label_off' 	=> __( 'No', 'appku' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 'feature_style' => [ '4' ] ],
			]
		);


        //----------------------------feddback repeter start--------------------------------//

		$repeater = new Repeater();

		$repeater->add_control(
			'title', [
				'label' 		=> __( 'Title', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'desc', [
				'label' 		=> __( 'Content', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
			]
        );
        $repeater->add_control(
			'chose_icon_style',
			[
				'label' 		=> __( 'Icon Type', 'appku' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'class',
				'options' 		=> [
					'class'  	=> __( 'Class', 'appku' ),
					'img' 		=> __( 'Image', 'appku' ),
				],
			]
		);
        $repeater->add_control(
			'icon_class', [
				'label' 		=> __( 'Icon Class', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( 'Rubaida Kanom' , 'appku' ),
				'label_block' 	=> true,
				'condition'		=> [ 'chose_icon_style' => [ 'class' ] ],
			]
        );
        $repeater->add_control(
			'icon_image',
			[
				'label' 		=> __( 'Image', 'appku' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
				'condition'		=> [ 'chose_icon_style' => [ 'img' ] ],
			]
		);
        $repeater->add_control(
			'details_page', [
				'label' 		=> __( 'Details Page URL', 'appku' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'default' 		=> __( '#' , 'appku' ),
				'label_block' 	=> true,
			]
        );

		$this->add_control(
			'slides',
			[
				'label' 		=> __( 'Features', 'appku' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
					[
						'title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
					[
						'title' 		=> __( 'Rubaida Kanom', 'appku' ),
					],
				],
				'title_field' 	=> '{{{ title }}}',
				'condition'		=> [ 'feature_style!' => ['3','4','5']],
			]
		);
		$this->end_controls_section();

		//------------------------------------feature Control------------------------------------//

		$this->start_controls_section(
			'features_control',
			[
				'label'     => __( 'Features Control', 'appku' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition'		=> [ 'feature_style!' => ['3','4','5']],
			]
        );
        $this->add_control(
			'make_slider',
			[
				'label' 		=> __( 'Use it as slider ?', 'appku' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'appku' ),
				'label_off' 	=> __( 'Hide', 'appku' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'		=> [ 'feature_style' => [ '2' ] ],
			]
		);
		$this->add_control(
			'desktop_items',
			[
				'label' 		=> __( 'Items To Show', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 0,
						'step' 		=> 1,
						'max' 		=> 10,
					],
				],
				'default' 		=> [
					'unit' 			=> '%',
					'size' 			=> 5,
				],
				'condition'		=> [ 'make_slider' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'laptop_items',
			[
				'label' 		=> __( 'Laptop Items', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 2,
				],
				'condition'		=> [ 'make_slider' => [ 'yes' ] ],
			]
		);

        $this->add_control(
			'tablet_items',
			[
				'label' 		=> __( 'Tablet Items', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 2,
				],
				'condition'		=> [ 'make_slider' => [ 'yes' ] ],
			]
		);

        $this->add_control(
			'mobile_items',
			[
				'label' 		=> __( 'Mobile Items', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 	=> 0,
						'step' 	=> 1,
						'max' 	=> 10,
					],
				],
				'default' 	=> [
					'unit' 		=> '%',
					'size' 		=> 1,
				],
				'condition'		=> [ 'make_slider' => [ 'yes' ] ],
			]
		);
		$this->add_control(
			'colmn_items',
			[
				'label' 		=> __( 'Column View', 'appku' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ '%' ],
				'range' 		=> [
					'%' 	=> [
						'min' 		=> 0,
						'step' 		=> 1,
						'max' 		=> 4,
					],
				],
				'default' 		=> [
					'unit' 			=> '%',
					'size' 			=> 4,
				],
				'condition'		=> [ 'make_slider!' =>  'yes' ],
			]
		);


        $this->end_controls_section();


        //------------------------------------icon-styling------------------------------------//

        $this->start_controls_section(
			'general_styling',
			[
				'label' 	=> __( 'General Styling', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
		$this->add_responsive_control(
			'Item_icon_align',
			[
				'label' 		=> __( 'Feature Alignment', 'appku' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __( 'Left', 'appku' ),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __( 'Center', 'appku' ),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __( 'Right', 'appku' ),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 	=> 'center',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .our-features-area .feature-items .single-item .item,{{WRAPPER}} .advanced-features-area .af-items .item,{{WRAPPER}} .icon,{{WRAPPER}} .feature-style-four,{{WRAPPER}} .features-style-four' => 'text-align: {{VALUE}};',
                ],
                'condition'		=> [ 'feature_style!' => [ '1' ] ],
			]
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Icon Hover Animation', 'appku' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'condition'		=> [ 'feature_style' => [ '2','3', '4','5' ] ],
			]
		);


		$this->add_control(
			'item_bg_color',
			[
				'label' 		=> __( 'Item Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .item'	=> 'background: {{VALUE}}!important;',
				],
				'condition'		=> [ 'feature_style!' => '5' ],
			]
        );
        $this->add_control(
			'item_bg_color3',
			[
				'label' 		=> __( 'Background Color 1', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition'		=> [ 'feature_style' => '5' ],
			]
        );
        $this->add_control(
			'item_bg_color2',
			[
				'label' 		=> __( 'Background Color 2', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .feature-style-four-item' => 'background-image: -webkit-linear-gradient(270deg,{{item_bg_color3.VALUE}} 40%,{{VALUE}} 60%);',
                ],
				'condition'		=> [ 'feature_style' => '5' ],
			]
        );
        $this->add_control(
			'item_bg__hvr_arrow_icon_bg_color',
			[
				'label' 		=> __( 'Active Arrow Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .software-feature-area .item i'	=> 'background: {{VALUE}}!important;',
				],
				'condition'		=> [ 'feature_style' => [ '1' ] ],
			]
        );
        $this->add_control(
			'item_bg__hvr_arrow_icon_color',
			[
				'label' 		=> __( 'Active Arrow Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .software-feature-area .item i'	=> 'color: {{VALUE}}!important;',
				],
				'condition'		=> [ 'feature_style' => [ '1' ] ],
			]
        );    
        $this->end_controls_section();

        

		/*-----------------------------------------section Content styling------------------------------------*/

		$this->start_controls_section(
			'section_con_styling',
			[
				'label' 	=> __( 'Section Content', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'feature_style!' => ['3','4','5'] ],
			]
        );
        $this->start_controls_tabs(
			'style_tabs3'
		);


		$this->start_controls_tab(
			'style_normal_tab3',
			[
				'label' => esc_html__( 'Title', 'appku' ),
			]
		);
        $this->add_control(
			's_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .left-info h2'	=> 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .site-heading h2'	=> 'color: {{VALUE}}!important;',

				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 's_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .left-info h2,{{WRAPPER}} .site-heading h2',
			]
		);

        $this->add_responsive_control(
			's_title_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .left-info h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .site-heading h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			's_title_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .left-info h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .site-heading h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab4',
			[
				'label' => esc_html__( 'Content', 'appku' ),
			]
		);
		$this->add_control(
			's_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .left-info p'	=> 'color: {{VALUE}}!important;',
					'{{WRAPPER}} .site-heading p'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 's_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .left-info p,{{WRAPPER}} .site-heading p',
			]
		);

        $this->add_responsive_control(
			's_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .left-info p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .site-heading p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			's_content_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .left-info p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .site-heading p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab6',
			[
				'label' => esc_html__( 'Subtitle', 'appku' ),
			]
		);
		$this->add_control(
			'f_content_color6',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .left-info h4'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'f_content_typography6',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .left-info h4',
			]
		);

        $this->add_responsive_control(
			'f_content_margin6',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .left-info h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'f_content_padding6',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .left-info h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );



		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();




		/*-----------------------------------------features styling------------------------------------*/

		$this->start_controls_section(
			'feturs_con_styling',
			[
				'label' 	=> __( 'Features', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
			]
        );
        $this->start_controls_tabs(
			'style_tabs'
		);


		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Title', 'appku' ),
			]
		);
        $this->add_control(
			'f_title_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .item h4,{{WRAPPER}} .feature-style-four h4 a,{{WRAPPER}} .features-style-four h4 a,{{WRAPPER}} .features-style-four h4'	=> 'color: {{VALUE}}!important;',

				],
			]
        );
        $this->add_control(
			'f_title_hvr_color',
			[
				'label' 		=> __( 'Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} a:hover'	=> 'color: {{VALUE}}!important;',

				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'f_title_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .item h4,{{WRAPPER}} .feature-style-four h4,{{WRAPPER}} .features-style-four h4',
			]
		);

        $this->add_responsive_control(
			'f_title_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .item h4,{{WRAPPER}} .feature-style-four h4,{{WRAPPER}} .features-style-four h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'f_title_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .item h4,{{WRAPPER}} .feature-style-four h4,{{WRAPPER}} .features-style-four h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
        );
		$this->end_controls_tab();

		//--------------------secound--------------------//

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Content', 'appku' ),
			]
		);
		$this->add_control(
			'f_content_color',
			[
				'label' 		=> __( 'Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .item p,{{WRAPPER}} .feature-style-four p,{{WRAPPER}} .features-style-four p'	=> 'color: {{VALUE}}!important;'
				],
			]
        );
        $this->add_group_control(
		Group_Control_Typography::get_type(),
		 	[
				'name' 			=> 'f_content_typography',
		 		'label' 		=> __( 'Typography', 'appku' ),
		 		'selector' 	=> '{{WRAPPER}} .item p,{{WRAPPER}} .feature-style-four p,{{WRAPPER}} .features-style-four p',
			]
		);

        $this->add_responsive_control(
			'f_content_margin',
			[
				'label' 		=> __( 'Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .item p,{{WRAPPER}} .feature-style-four p,{{WRAPPER}} .features-style-four p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );

        $this->add_responsive_control(
			'f_content_padding',
			[
				'label' 		=> __( 'Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .item p,{{WRAPPER}} .feature-style-four p,{{WRAPPER}} .features-style-four p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
			]
        );



		$this->end_controls_tab();


		$this->end_controls_tabs();
		$this->end_controls_section();

		//---------------------------------------Button Style---------------------------------------//

		$this->start_controls_section(
			'button_style_section',
			[
				'label' 	=> __( 'Button Style', 'appku' ),
				'tab' 		=> Controls_Manager::TAB_STYLE,
				'condition'		=> [ 'feature_style' => [ '1' ] ],
			]
        );

        $this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Button Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'color: {{VALUE}}',
                ],
			]
        );

        $this->add_control(
			'button_color_hover',
			[
				'label' 		=> __( 'Button Color Hover', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme:hover' => 'color: {{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'button_bg_color',
			[
				'label' 		=> __( 'Button Background Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'background:{{VALUE}}!important;',
                ],
			]
        );

        $this->add_control(
			'button_bg_hover_color',
			[
				'label' 		=> __( 'Button Background Hover Color', 'appku' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme::after' => 'background-color:{{VALUE}}',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border',
				'label' 	=> __( 'Border', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-theme',
			]
		);

        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 		=> 'border_hover',
				'label' 	=> __( 'Border Hover', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-theme:hover',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'button_typography',
				'label' 	=> __( 'Button Typography', 'appku' ),
                'selector' 	=> '{{WRAPPER}} .btn.btn-theme',
			]
        );

        $this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Button Margin', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
        );

        $this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Button Padding', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
        $this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Button Border Radius', 'appku' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .btn.btn-theme' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_shadow',
				'label' => esc_html__( 'Button Shadow', 'appku' ),
				'selector' => '{{WRAPPER}} .btn.btn-theme',
			]
		);
        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings_for_display();

        echo '<!------------------------------- Features Area start ------------------------------->';

        if( $settings['feature_style'] == '1' ){

        	echo '<div class="software-feature-area">';
		        echo '<div class="container">';
		            echo '<div class="feature-items">';
		                echo '<div class="row align-center">';
		                    echo '<div class="col-lg-6 left-info">';
		                        if(!empty($settings['subtitle'])){
			                        echo '<h4>'.wp_kses_post($settings['subtitle']).'</h4>';
			                    }
			                    if(!empty($settings['title'])){
			                        echo '<h2>'.wp_kses_post($settings['title']).'</h2>';
			                    }
			                    if(!empty($settings['desc'])){
			                        echo wp_kses_post($settings['desc']);
			                    }
			                    if( ! empty( $settings['button_text'] ) ) {
			                    	if( ! empty( $settings['button_link']['url'] ) ) {
							            $this->add_render_attribute( 'button', 'href', esc_url( $settings['button_link']['url'] ) );
							        }
				            		if( ! empty( $settings['button_link']['nofollow'] ) ) {
							            $this->add_render_attribute( 'button', 'rel', 'nofollow' );
							        }
							        if( ! empty( $settings['button_link']['is_external'] ) ) {
							            $this->add_render_attribute( 'button', 'target', '_blank' );
							        }
							        $this->add_render_attribute( 'button', 'class', 'btn circle btn-theme effect btn-md' );

							        	echo '<a '.$this->get_render_attribute_string('button').'>'.esc_html( $settings['button_text'] ).' </a>';
	                            }
		                    echo '</div>';
		                    echo '<div class="col-lg-6">';
		                        echo '<div class="features-list">';
		                        	foreach( $settings['slides'] as $single_data ){
		                        		$url = $single_data['details_page'] ;
		                        		if(!empty($url)){
		                        			$url_start_tag 	= '<a href="'.esc_url($url).'">';
		                        			$url_end_tag 	= '</a>';
		                        		}else{
		                        			$url_start_tag 	= '';
		                        			$url_end_tag 	= '';
		                        		}
			                            echo '<!-- Single Itme -->';
			                            echo '<div class="item">';
			                                echo '<div class="icon">';
			                                    echo '<i class="fas fa-angle-right"></i>';
			                                    if($single_data['chose_icon_style'] == 'class' ){
			                                    	echo '<div class="icon">';
			                                    		echo wp_kses_post($single_data['icon_class']);
			                                    	echo '</div>';
			                                    }else{
			                                    	echo appku_img_tag( array(
														'url'	=> esc_url( $single_data['icon_image']['url'] ),
													) );
			                                    }			                                    
			                                echo '</div>';
			                                echo '<div class="content">';
			                                    if(!empty($single_data['title'])){
					                              	echo '<h4>'.$url_start_tag.esc_html($single_data['title']).$url_end_tag.'</h4>';
					                            }
					                            if(!empty($single_data['desc'])){
					                               	echo '<p>'.esc_html($single_data['desc']).'</p>';
					                            }
			                                echo '</div>';
			                            echo '</div>';
			                            echo '<!-- End Single Itme -->';
			                        }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['feature_style'] == '2' ){

			if( $settings['make_slider'] == 'yes' ){
				$this->add_render_attribute( 'wrapper', 'class', 'row features-carousel owl-carousel owl-theme' );
				$this->add_render_attribute( 'wrapper', 'data-slide-show', $settings['desktop_items']['size'] );
		        $this->add_render_attribute( 'wrapper', 'data-lg-slide-show', $settings['laptop_items']['size'] );
		        $this->add_render_attribute( 'wrapper', 'data-md-slide-show', $settings['tablet_items']['size'] );
		        $this->add_render_attribute( 'wrapper', 'data-sm-slide-show', $settings['mobile_items']['size'] );
			}else{
				$this->add_render_attribute( 'wrapper', 'class', 'row' );
				if( $settings['colmn_items']['size'] == 1 ){
					$colmn = 12;
				}elseif( $settings['colmn_items']['size'] == 2 ){
					$colmn = 6;
				}elseif( $settings['colmn_items']['size'] == 3 ){
					$colmn = 4;
				}else{
					$colmn = 3;
				}
			}

			$elementClass = 'single-item';

			if ( $settings['hover_animation'] ) {
				$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
			}
			echo '<div class="advanced-features-area">';
			    if( $settings['section_heading'] == 'yes' ){
			        echo '<div class="container">';
			            echo '<div class="row">';
			                echo '<div class="col-lg-8 offset-lg-2">';
			                    echo '<div class="site-heading text-light text-center">';
			                    	if(!empty($settings['section_title'])){
		                              	echo '<h2>'.esc_html($settings['section_title']).'</h2>';
		                            }
		                            echo '<div class="devider"></div>';
		                            if(!empty($settings['section_subtitle'])){
		                               	echo '<p>'.esc_html($settings['section_subtitle']).'</p>';
		                            }  
			                    echo '</div>';
			                echo '</div>';
			            echo '</div>';
			        echo '</div>';
			    }
		        echo '<div class="container-fill">';
		            echo '<div class="af-items">';
		                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
		                    foreach( $settings['slides'] as $single_data ){
		                    	if( $settings['make_slider'] == 'yes' ){
				                    echo '<div class="'.$elementClass.'">';
				                }else{
				                	echo '<div class="'.$elementClass.' col-lg-'.$colmn.' col-md-6">';
				                }
				                $url = $single_data['details_page'] ;
                        		if(!empty($url)){
                        			$url_start_tag 	= '<a href="'.esc_url($url).'">';
                        			$url_end_tag 	= '</a>';
                        		}else{
                        			$url_start_tag 	= '';
                        			$url_end_tag 	= '';
                        		}
			                        echo '<div class="item">';
			                            if($single_data['chose_icon_style'] == 'class' ){
	                                    	echo '<div class="icon">';
	                                    		echo wp_kses_post($single_data['icon_class']);
	                                    	echo '</div>';
	                                    }else{
	                                    	echo appku_img_tag( array(
												'url'	=> esc_url( $single_data['icon_image']['url'] ),
											) );
	                                    }
			                           	echo '<div class="info">';
			                               	if(!empty($single_data['title'])){
				                              	echo '<h4>'.$url_start_tag.esc_html($single_data['title']).$url_end_tag.'</h4>';
				                            }
				                            if(!empty($single_data['desc'])){
				                               	echo '<p>'.esc_html($single_data['desc']).'</p>';
				                            }
			                           	echo '</div>';
			                        echo '</div>';
			                    echo '</div>';
			                }  
		                echo '</div>';
		            echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}elseif( $settings['feature_style'] == '3' ){
			$elementClass = 'our-features-area';

			if ( $settings['hover_animation'] ) {
				$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
			}

			$url = $settings['details_page'] ;
    		if(!empty($url)){
    			$url_start_tag 	= '<a href="'.esc_url($url).'">';
    			$url_end_tag 	= '</a>';
    		}else{
    			$url_start_tag 	= '';
    			$url_end_tag 	= '';
    		}
			echo '<div class="'.$elementClass.'">';
				echo '<div class="feature-items">';
					echo '<div class="single-item">';
		                echo '<div class="item">';
		                   if($settings['chose_icon_style'] == 'class' ){
                            	echo '<div class="icon">';
                            		echo wp_kses_post($settings['icon_class']);
                            	echo '</div>';
                            }else{
                            	echo appku_img_tag( array(
									'url'	=> esc_url( $settings['icon_image']['url'] ),
								) );
                            }
		                   echo '<div class="info">';
		                       	if(!empty($settings['feature_title'])){
	                              	echo '<h4>'.$url_start_tag.esc_html($settings['feature_title']).$url_end_tag.'</h4>';
	                            }
	                            if(!empty($settings['feature_con'])){
	                               	echo '<p>'.esc_html($settings['feature_con']).'</p>';
	                            }
		                   echo '</div>';
		               echo '</div>';
		            echo '</div>';
	            echo '</div>';
            echo '</div>';
		}elseif( $settings['feature_style'] == '4' ){
			$elementClass = 'feature-style-four-box';

			if ( $settings['hover_animation'] ) {
				$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
			}

			$url = $settings['details_page'] ;
    		if(!empty($url)){
    			$url_start_tag 	= '<a href="'.esc_url($url).'">';
    			$url_end_tag 	= '</a>';
    		}else{
    			$url_start_tag 	= '';
    			$url_end_tag 	= '';
    		}
    		if( $settings['is_active'] == 'yes' ){
    			$active_class = ' active';
    		}else{
    			$active_class = '';
    		}
			echo '<div class="'.$elementClass. $active_class.'">';
				echo '<div class="single-item">';
					echo '<div class="feature-style-four">';
		                if(!empty($settings['feature_title'])){
                          	echo '<h4>'.$url_start_tag.esc_html($settings['feature_title']).$url_end_tag.'</h4>';
                        }
                    	echo '<div class="icon">';
		                    if($settings['chose_icon_style'] == 'class' ){
	                        	echo wp_kses_post($settings['icon_class']);
	                        }else{
	                        	echo appku_img_tag( array(
									'url'	=> esc_url( $settings['icon_image']['url'] ),
								) );
	                        }
                        echo '</div>';
		                if(!empty($settings['feature_con'])){
                           	echo '<p>'.esc_html($settings['feature_con']).'</p>';
                        }

		            echo '</div>';
	            echo '</div>';
            echo '</div>';
		}else{
			$elementClass = 'features-style-four';

			if ( $settings['hover_animation'] ) {
				$elementClass .= ' elementor-animation-' . $settings['hover_animation'];
			}

			$url = $settings['details_page'] ;
    		if(!empty($url)){
    			$url_start_tag 	= '<a href="'.esc_url($url).'">';
    			$url_end_tag 	= '</a>';
    		}else{
    			$url_start_tag 	= '';
    			$url_end_tag 	= '';
    		}
			echo '<div class="'.$elementClass.'">';
                echo '<div class="feature-style-four-item">';
                    echo '<div class="icon">';
	                    if($settings['chose_icon_style'] == 'class' ){
                        	echo wp_kses_post($settings['icon_class']);
                        }else{
                        	echo appku_img_tag( array(
								'url'	=> esc_url( $settings['icon_image']['url'] ),
							) );
                        }
                    echo '</div>';
                    echo '<div class="info">';
                        if(!empty($settings['feature_title'])){
                          	echo '<h4>'.$url_start_tag.esc_html($settings['feature_title']).$url_end_tag.'</h4>';
                        }
                        if(!empty($settings['feature_con'])){
                           	echo '<p>'.esc_html($settings['feature_con']).'</p>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
		}

		echo '<!--------------------------------- Features Area end --------------------------------->';
	}
}