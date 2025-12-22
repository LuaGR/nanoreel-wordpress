<?php
if (!defined('ABSPATH')) {
	exit;
}

class NanoReel_Settings {
	
	private static $instance = null;
	
	public static function get_instance() {
		if (null === self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	private function __construct() {
		add_action('admin_menu', array($this, 'add_menu'));
		add_action('admin_init', array($this, 'register_settings'));
		add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_assets'));
	}
	
	public function add_menu() {
		add_menu_page(
			__('NanoReel Settings', 'nanoreel'),
			__('NanoReel', 'nanoreel'),
			'manage_options',
			'nanoreel-settings',
			array($this, 'render_settings_page'),
			'dashicons-video-alt3',
			80
		);
	}
	
	public function enqueue_admin_assets($hook) {
		if ('toplevel_page_nanoreel-settings' !== $hook) {
			return;
		}
		
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		
		wp_enqueue_style(
			'nanoreel-admin',
			NANOREEL_PLUGIN_URL . 'assets/css/admin.css',
			array(),
			NANOREEL_VERSION
		);
		
		wp_enqueue_script(
			'nanoreel-admin',
			NANOREEL_PLUGIN_URL . 'assets/js/admin.js',
			array('jquery', 'wp-color-picker'),
			NANOREEL_VERSION,
			true
		);
	}
	
	public function register_settings() {
		register_setting('nanoreel_settings', 'nanoreel_mode', array(
			'type' => 'string',
			'default' => 'managed',
			'sanitize_callback' => 'sanitize_text_field'
		));
		
		register_setting('nanoreel_settings', 'nanoreel_widget_id', array(
			'type' => 'string',
			'sanitize_callback' => function($value) {
				// Fallback: si está vacío, forzar nanoreel-demo
				$sanitized = sanitize_text_field($value);
				return empty(trim($sanitized)) ? 'nanoreel-demo' : $sanitized;
			}
		));
		
		register_setting('nanoreel_settings', 'nanoreel_video_url', array(
			'type' => 'string',
			'sanitize_callback' => 'esc_url_raw'
		));
		
		register_setting('nanoreel_settings', 'nanoreel_cta_text', array(
			'type' => 'string',
			'sanitize_callback' => 'sanitize_text_field'
		));
		
		register_setting('nanoreel_settings', 'nanoreel_cta_link', array(
			'type' => 'string',
			'sanitize_callback' => 'esc_url_raw'
		));
		
		register_setting('nanoreel_settings', 'nanoreel_accent_color', array(
			'type' => 'string',
			'sanitize_callback' => 'sanitize_hex_color'
		));
		
		register_setting('nanoreel_settings', 'nanoreel_shape', array(
			'type' => 'string',
			'default' => 'rounded',
			'sanitize_callback' => 'sanitize_text_field'
		));
	}
	
	public function render_settings_page() {
		if (!current_user_can('manage_options')) {
			return;
		}
		
		$mode = get_option('nanoreel_mode', 'managed');
		$widget_id = get_option('nanoreel_widget_id', '');
		$video_url = get_option('nanoreel_video_url', '');
		$cta_text = get_option('nanoreel_cta_text', '');
		$cta_link = get_option('nanoreel_cta_link', '');
		$accent_color = get_option('nanoreel_accent_color', '#ffffff');
		$shape = get_option('nanoreel_shape', 'rounded');
		
		?>
		<div class="wrap nanoreel-settings">
			<h1><?php echo esc_html(get_admin_page_title()); ?></h1>
			
			<div class="nanoreel-header">
				<div class="nanoreel-logo">🎬</div>
				<div>
					<h2 style="margin: 0;"><?php _e('NanoReel Video Widget', 'nanoreel'); ?></h2>
					<p style="margin: 5px 0 0 0;">
						<?php _e('Turn passive visitors into buyers with 1-click shoppable video', 'nanoreel'); ?>
					</p>
				</div>
			</div>
			
			<?php settings_errors(); ?>
			
			<form method="post" action="options.php">
				<?php settings_fields('nanoreel_settings'); ?>
				
				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="nanoreel_mode"><?php _e('Configuration Mode', 'nanoreel'); ?></label>
						</th>
						<td>
							<select name="nanoreel_mode" id="nanoreel_mode" class="nanoreel-mode-selector">
								<option value="managed" <?php selected($mode, 'managed'); ?>>
									<?php _e('Managed (Backend Config)', 'nanoreel'); ?>
								</option>
								<option value="selfhosted" <?php selected($mode, 'selfhosted'); ?>>
									<?php _e('Self-Hosted (Manual Config)', 'nanoreel'); ?>
								</option>
							</select>
							<p class="description">
								<?php _e('Managed: We host your config (Founder Deal only). Self-Hosted: Configure here (all users).', 'nanoreel'); ?>
							</p>
						</td>
					</tr>
				</table>
				
				<div id="nanoreel-managed-settings" style="<?php echo $mode === 'managed' ? '' : 'display:none;'; ?>">
					<h2><?php _e('Managed Mode Settings', 'nanoreel'); ?></h2>
					<table class="form-table">
						<tr>
							<th scope="row">
								<label for="nanoreel_widget_id"><?php _e('Widget ID', 'nanoreel'); ?></label>
							</th>
							<td>
								<input type="text" 
									   name="nanoreel_widget_id" 
									   id="nanoreel_widget_id" 
									   value="<?php echo esc_attr($widget_id); ?>" 
									   class="regular-text"
									   placeholder="nanoreel-main">
								<p class="description">
									<?php _e('Founder Deal users: After purchase, reply to Lemon Squeezy email with your domain. We send you your widget-id (~1 hour).', 'nanoreel'); ?>
								</p>
							</td>
						</tr>
					</table>
				</div>
				
				<div id="nanoreel-selfhosted-settings" style="<?php echo $mode === 'selfhosted' ? '' : 'display:none;'; ?>">
					<h2><?php _e('Self-Hosted Mode Settings', 'nanoreel'); ?></h2>
					<table class="form-table">
						<tr>
							<th scope="row">
								<label for="nanoreel_video_url"><?php _e('Video URL', 'nanoreel'); ?></label>
							</th>
							<td>
								<input type="url" 
									   name="nanoreel_video_url" 
									   id="nanoreel_video_url" 
									   value="<?php echo esc_url($video_url); ?>" 
									   class="regular-text"
									   placeholder="https://your-cdn.com/video.mp4">
								<p class="description">
									<?php _e('MP4 video URL (9:16 vertical recommended)', 'nanoreel'); ?>
								</p>
							</td>
						</tr>
						
						<tr>
							<th scope="row">
								<label for="nanoreel_cta_text"><?php _e('CTA Button Text', 'nanoreel'); ?></label>
							</th>
							<td>
								<input type="text" 
									   name="nanoreel_cta_text" 
									   id="nanoreel_cta_text" 
									   value="<?php echo esc_attr($cta_text); ?>" 
									   class="regular-text"
									   placeholder="Shop Now">
							</td>
						</tr>
						
						<tr>
							<th scope="row">
								<label for="nanoreel_cta_link"><?php _e('CTA Button Link', 'nanoreel'); ?></label>
							</th>
							<td>
								<input type="url" 
									   name="nanoreel_cta_link" 
									   id="nanoreel_cta_link" 
									   value="<?php echo esc_url($cta_link); ?>" 
									   class="regular-text"
									   placeholder="https://your-store.com/product">
							</td>
						</tr>
						
						<tr>
							<th scope="row">
								<label for="nanoreel_accent_color"><?php _e('Accent Color', 'nanoreel'); ?></label>
							</th>
							<td>
								<input type="text" 
									   name="nanoreel_accent_color" 
									   id="nanoreel_accent_color" 
									   value="<?php echo esc_attr($accent_color); ?>" 
									   class="nanoreel-color-picker">
							</td>
						</tr>
						
						<tr>
							<th scope="row">
								<label for="nanoreel_shape"><?php _e('Widget Shape', 'nanoreel'); ?></label>
							</th>
							<td>
								<select name="nanoreel_shape" id="nanoreel_shape">
									<option value="rounded" <?php selected($shape, 'rounded'); ?>>
										<?php _e('Rounded (9:16)', 'nanoreel'); ?>
									</option>
									<option value="circle" <?php selected($shape, 'circle'); ?>>
										<?php _e('Circle (1:1)', 'nanoreel'); ?>
									</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				
				<?php submit_button(); ?>
			</form>
			
			<hr>
			
			<div class="nanoreel-upgrade-section">
				<h3><?php _e('Remove "Powered by NanoReel" branding', 'nanoreel'); ?></h3>
				<p><?php _e('Upgrade to Founder Deal for $49 (lifetime, limited to first 50 users) to remove branding and unlock Managed Mode.', 'nanoreel'); ?></p>
				<a href="https://nanoreel.lemonsqueezy.com/buy/3f230499-a324-408e-89d9-1b067c2bca10" class="button button-primary" target="_blank">
					<?php _e('Get Founder Deal', 'nanoreel'); ?>
				</a>
			</div>
		</div>
		<?php
	}
}
