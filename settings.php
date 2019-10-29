<?php
if(!class_exists('PluginHtmlSettings'))
{
class PluginHtmlSettings
{
	/**
	 * Construct the plugin object
	 */
	public function __construct()
	{
		// register actions
		add_action('admin_init', array(&$this, 'admin_init'));
		add_action('admin_menu', array(&$this, 'add_menu'));
	}
		
	/**
	 * hook into WP's admin_init action hook
	 */
	public function admin_init()
	{
		// register your plugin's settings
		register_setting('plugin_html-group', 'HTMLEnglish');
		register_setting('plugin_html-group', 'HTMLGerman');

		// add your settings section
		add_settings_section(
			'plugin_html-section', 
			'My Pricing Settings', 
			array(&$this, 'settings_section_plugin_html'), 
			'plugin_html'
		);
		
		// add your setting's fields
		add_settings_field(
			'plugin_html-HTMLEnglish',
			'HTML in English',
			array(&$this, 'settings_field_input_textarea'),
			'plugin_html',
			'plugin_html-section',
			array(
				'field' => 'HTMLEnglish'
			)
		);
		add_settings_field(
			'plugin_html_HTMLGerman',
			'HTML in German',
			array(&$this, 'settings_field_input_textarea'),
			'plugin_html',
			'plugin_html-section',
			array(
				'field' => 'HTMLGerman'
			)
		);
	}
	
	public function settings_section_plugin_html()
	{
		// Think of this as help text for the section.
		echo 'These settings allow setting the text for the pricing table in various languages';
	}
	
	/**
	 * This function provides text inputs for settings fields
	 */
	public function settings_field_input_textarea($args)
	{
		// Get the field name from the $args array
		$field = $args['field'];
		// Get the value of this setting
		$value = get_option($field);
		// echo a proper input type="text"
		echo sprintf('<textarea name="%s" id="%s" cols="50" rows="20">%s</textarea>', $field, $field, $value);
	}
	
	/**
	 * add a menu
	 */		
	public function add_menu() {
		add_options_page( 'My HTML Options', 'My Pricing',
			'manage_options', 'plugin-html',
			array($this, 'my_plugin_options') );
	}

	function my_plugin_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
	}
	
}
}
