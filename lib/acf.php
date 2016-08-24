<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_tag',
		'title' => 'Tag',
		'fields' => array (
			array (
				'key' => 'field_57bdf3cfeeafb',
				'label' => __( 'Tło', 'sage' ),
				'name' => 'background',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'large',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'ef_user',
					'operator' => '==',
					'value' => 'all',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
