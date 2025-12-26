<?php
/**
 * Plugin Name: NanoReel - Video Widgets for Conversions
 * Plugin URI: https://nanoreel.vercel.app
 * Description: Add shoppable video widgets to your WooCommerce store in 1 click. Increase conversions with TikTok-style video popups.
 * Version: 1.0.0
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Author: NanoReel
 * Author URI: https://github.com/LuaGR
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: nanoreel
 * Domain Path: /languages
 *
 * WC requires at least: 5.0
 * WC tested up to: 8.5
 */

if (!defined('ABSPATH')) {
	exit;
}

// Plugin constants
define('NANOREEL_VERSION', '1.0.0');
define('NANOREEL_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('NANOREEL_PLUGIN_URL', plugin_dir_url(__FILE__));
define('NANOREEL_API_URL', 'https://nanoreel.up.railway.app');

// Require plugin classes
require_once NANOREEL_PLUGIN_DIR . 'includes/class-nanoreel-settings.php';
require_once NANOREEL_PLUGIN_DIR . 'includes/class-nanoreel-widget.php';
require_once NANOREEL_PLUGIN_DIR . 'includes/class-nanoreel-shortcode.php';

/**
 * Main Plugin Class
 */
class NanoReel_Plugin {

	private static $instance = null;

	public static function get_instance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct() {
		add_action('plugins_loaded', array($this, 'init'));
		register_activation_hook(__FILE__, array($this, 'activate'));
		register_deactivation_hook(__FILE__, array($this, 'deactivate'));
	}

	public function init() {
		NanoReel_Settings::get_instance();
		// Widget and Shortcode self-initialize via hooks in their own files

		add_action('wp_footer', array($this, 'enqueue_widget_script'), 100);
	}

	public function enqueue_widget_script() {
		$widget_id = get_option('nanoreel_widget_id', 'nanoreel-demo');
		$mode = get_option('nanoreel_mode', 'managed');

		// Fallback: si widget_id está vacío, usar demo
		if (empty($widget_id)) {
			$widget_id = 'nanoreel-demo';
		}

		wp_enqueue_script(
			'nanoreel-widget',
			NANOREEL_API_URL . '/public/widget.min.js',
			array(),
			NANOREEL_VERSION,
			true
		);

		if ($mode === 'managed') {
			echo '<nanoreel-widget widget-id="' . esc_attr($widget_id) . '"></nanoreel-widget>';
		} elseif ($mode === 'selfhosted') {
			$video_url = get_option('nanoreel_video_url', '');
			$cta_text = get_option('nanoreel_cta_text', '');
			$cta_link = get_option('nanoreel_cta_link', '');
			$accent_color = get_option('nanoreel_accent_color', '');
			$shape = get_option('nanoreel_shape', 'rounded');

			if (!empty($video_url) && !empty($cta_text) && !empty($cta_link)) {
				echo '<nanoreel-widget ';
				echo 'video-url="' . esc_attr($video_url) . '" ';
				echo 'cta-text="' . esc_attr($cta_text) . '" ';
				echo 'cta-link="' . esc_url($cta_link) . '" ';
				if (!empty($accent_color)) {
					echo 'accent-color="' . esc_attr($accent_color) . '" ';
				}
				echo 'shape="' . esc_attr($shape) . '"';
				echo '></nanoreel-widget>';
			}
		}
	}

	public function activate() {
		add_option('nanoreel_mode', 'managed');
		add_option('nanoreel_widget_id', 'nanoreel-demo');
		add_option('nanoreel_shape', 'rounded');

		flush_rewrite_rules();
	}

	public function deactivate() {
		flush_rewrite_rules();
	}
}

// Initialize plugin
NanoReel_Plugin::get_instance();
