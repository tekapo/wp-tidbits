<?php

/*
  Plugin Name: tidbits
  Plugin URI: http://wordpress.org/extend/plugins/tidbits/
  Description: tidbits.
  Version: 1.0.4
  Author URI: http://tekapo.com/
 */

/**
 * show template file name on the tool bar.
 *
 */
new Show_Template_File_Name();

class Show_Template_File_Name {

	function __construct() {
		add_action( "admin_bar_menu", array( &$this, "show_template_file_name_on_top" ), 9999 );
		add_action( 'wp_enqueue_scripts', array( &$this, "add_tidbits_stylesheet" ), 9999 );
	}

	public function show_template_file_name_on_top( $wp_admin_bar ) {

		if ( is_admin() or ! is_super_admin() )
			return;

		global $template;

		$template_file_name		 = basename( $template );
		$template_relative_path	 = str_replace( ABSPATH, '', $template );

		global $wp_admin_bar;
		$args = array(
			'id'	 => 'show_template_file_name_on_top',
			'title'	 => 'Template:<span class="show-template-name"> ' . $template_file_name . '</span>',
		);

		$wp_admin_bar->add_node( $args );

		$wp_admin_bar->add_menu( array(
			'parent' => 'show_template_file_name_on_top',
			'id'	 => 'template_relative_path',
			'title'	 => 'Relative path:<span class="show-template-name"> ' . $template_relative_path . '</span>',
		) );

		$wp_admin_bar->add_menu( array(
			'parent' => 'show_template_file_name_on_top',
			'id'	 => 'template_absolute_path',
			'title'	 => 'Absolute path:<span class="show-template-name"> ' . $template . '</span>',
		) );
	}

	public function add_tidbits_stylesheet() {

		if ( is_admin() or ! is_super_admin() )
			return;

		wp_register_style( 'tidbits-style', plugins_url( 'style.css', __FILE__ ) );
		wp_enqueue_style( 'tidbits-style' );
	}

}