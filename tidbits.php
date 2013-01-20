<?php

/*
  Plugin Name: tidbits
  Plugin URI: http://wordpress.org/extend/plugins/tidbits/
  Description: tidbits.
  Version: 1.0.1
  Author URI: http://tekapo.com/
 */

/**
 * ツールバーにテンプレートファイルを表示
 *
 */
new Show_Template_File_Name();

class Show_Template_File_Name {

	function __construct() {

		add_action( "admin_bar_menu", array( &$this, "show_template_file_name_on_top" ), 9999 );

//    add_action("admin_menu", array(&$this, "admin_menu"));
//    add_filter('plugin_row_meta',   array(&$this, 'plugin_row_meta'), 10, 2);
	}

	public function show_template_file_name_on_top( $wp_admin_bar ) {

		if ( !is_admin() and is_super_admin() ) {
			global $template;
			$template = basename( $template );
//	$template = str_replace( ABSPATH, '', $template );

			global $wp_admin_bar;
			$args = array(
				'id'	 => 'show_template_file_name_on_top',
				'title'	 => 'Template: ' . $template,
			);

			$wp_admin_bar->add_node( $args );
		}
	}

}
