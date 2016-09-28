<?php

$admin_pages = array();

$admin_pages['general_options'] =  array(
	'title' =>  'General Options',
	'submenus' => 	array(
		array(
			'slug' => 'general_options',
			'title' =>  'General options'
		),
		array(
			'slug' => 'header_options',
			'title' =>  'Header options'
		),
		array(
			'slug' => 'logo_options',
			'title' =>  'Logo options'
		),
		 array(
			'slug' => 'favicon_options',
			'title' =>  'Favicon options'
		),
		array(
			'slug' => 'info_card',
			'title' =>  'Info card options (Header)'
		),
		array(
			'slug' => 'cta_options',
			'title' =>  'Call to action (Header)'
		),
		array(
			'slug' => 'nav_options',
			'title' =>  'Navigations Options (Header)'
		),
		array(
			'slug' => 'footer_options',
			'title' =>  'Footer options'
		),
		 array(
			'slug' => 'default_header_options',
			'title' =>  'Default Sub-header options'
		),
		array(
			'slug' => 'hidden_panel_options',
			'title' =>  'Hidden panel options'
		),
		array(
			'slug' => 'google_analytics',
			'title' =>  'Google Analytics'
		),
		array(
			'slug' => 'mailchimp_options',
			'title' =>  'Mailchimp options'
		),
		array(
			'slug' => 'recaptcha_options',
			'title' =>  'reCaptcha options'
		),
	)
);

$admin_pages['google_font_options'] = array(
	'title' =>  'Fonts Setup',
	'submenus' => 	array(
			array(
				'slug' => 'gfont_setup',
				'title' =>  'Google Fonts setup'
			),
			array(
				'slug' => 'custom_font_setup',
				'title' =>  'Custom Fonts setup'
			),
		)
);

$admin_pages['font_options'] = array(
	'title' =>  'Font Options',
	'submenus' => 	array(
		array(
			'slug' => 'headings_font_options',
			'title' =>  'Headings'
		),
		array(
			'slug' => 'body_font_options',
			'title' =>  'Body fonts'
		),
		array(
			'slug' => 'main_menu_fonts_options',
			'title' =>  'Main menu'
		),
		array(
			'slug' => 'alternative_fonts_options',
			'title' =>  'Alternative font'
		)
	)
);

$admin_pages['blog_options'] = array(
	'title' =>  'Blog Options',
	'submenus' => 	array(
		array(
			'slug' => 'blog_archive_options',
			'title' =>  'Archive options'
		),
		array(
			'slug' => 'single_blog_options',
			'title' =>  'Single blog item options'
		),
	)
);

$admin_pages['portfolio_options'] = array(
	'title' =>  'Portfolio options',
	'submenus' => 	array()
);

$admin_pages['documentation_options'] = array(
	'title' =>  'Documentation options',
	'submenus' => 	array()
);

$admin_pages['layout_options'] = array(
	'title' =>  'Layout options',
	'submenus' => 	array()
);

$admin_pages['color_options'] = array(
	'title' =>  'Color options',
	'submenus' => 	array()
);

$admin_pages['unlimited_header_options'] = array(
	'title' =>  'Unlimited sub-headers',
	'submenus' => 	array()
);

$admin_pages['unlimited_sidebars'] = array(
	'parent'=>'unlimited_sidebars',
	'title' =>  'Sidebars options',
	'submenus' => 	array(
		array(
			'slug' => 'unlimited_sidebars',
			'title' =>  'Unlimited Sidebars'
		),
		array(
			'slug' => 'sidebar_settings',
			'title' =>  'Sidebar Settings'
		),
	),
);

$admin_pages['coming_soon_options'] = array(
	'title' =>  'Coming soon options',
	'submenus' => 	array()
);

$admin_pages['zn_404_options'] = array(
	'title' =>  '404 page options',
	'submenus' => 	array()
);

$admin_pages['advanced_options'] = array(
	'title' =>  'Advanced options',
	'submenus' => 	array(
		array(
			'slug' => 'advanced_options',
			'title' =>  'Advanced options'
		),
		array(
			'slug' => 'custom_css',
			'title' =>  'Custom css'
		),
		array(
			'slug' => 'custom_js',
			'title' =>  'Custom javascript'
		),
	)
);