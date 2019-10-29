<?php
/*
Plugin Name: Simple HTML Plugin
Plugin URI: https://github.com/tpokorra/wp_plugin_html
Description: A simple wordpress plugin for inserting HTML code with shortcode. The HTML is defined in the settings, in 2 languages.
Version: 1.0
Author: Timotheus Pokorra
Author URI: https://www.solidcharity.com
License: GPL2
Version: 1.0.0
*/
/*
Copyright 2019  Timotheus Pokorra  (email : timotheus.pokorra@solidcharity.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if(!class_exists('PluginHtml')) :

	class PluginHtml
	{
		public function __construct() {}

		public static function init_actions() {

			// Initialize Settings
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$MySettings = new PluginHtmlSettings();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array(  __CLASS__, 'plugin_settings_link' ));
		}

		// Activate the plugin
		public static function activate()
		{
			// Do nothing
		}

		// Deactivate the plugin
		public static function deactivate()
		{
			// Do nothing
		}

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$url = admin_url( 'options-general.php?page=plugin-html');
			$links = (array) $links;
			$links[] = sprintf( '<a href="%s">%s</a>', $url, __( 'Settings', 'plugin-html' ) );
			return $links;

		}

		// insert the pricing table in english
		public static function show_pricing_table_en() {
			return get_option('HTMLEnglish');
		}

		// insert the pricing table in german
		public static function show_pricing_table_de() {
			return get_option('HTMLGerman');
		}

	}

add_action( 'plugins_loaded', array( 'PluginHtml', 'init_actions' ) );
add_shortcode('my-pricing-en', array('PluginHtml', 'show_pricing_table_en'));
add_shortcode('my-pricing-de', array('PluginHtml', 'show_pricing_table_de'));

endif;

