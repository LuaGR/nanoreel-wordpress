<?php
/**
 * WordPress Widget
 *
 * Allows widget placement in sidebars/footer via Widgets admin
 *
 * @package NanoReel
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

class NanoReel_Widget extends WP_Widget {

    /**
     * Constructor
     */
    public function __construct() {
        parent::__construct(
            'nanoreel_widget',
            __('NanoReel Video Widget', 'nanoreel'),
            array(
                'description' => __('Embeddable video widget for conversions', 'nanoreel'),
                'classname'   => 'nanoreel-widget-container',
            )
        );

        // Enqueue widget script on frontend
        add_action('wp_enqueue_scripts', array($this, 'enqueue_widget_script'));
    }

    /**
     * Widget frontend output
     *
     * @param array $args     Display arguments (before_widget, after_widget, etc.)
     * @param array $instance Widget instance settings
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];

        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }

        // Render widget based on mode
        $widget_id = !empty($instance['widget_id']) ? $instance['widget_id'] : '';

        if (!empty($widget_id)) {
            // Managed mode: use widget-id
            echo sprintf('<nanoreel-widget widget-id="%s"></nanoreel-widget>', esc_attr($widget_id));
        } else {
            // Fallback: use global settings
            $mode = get_option('nanoreel_mode', 'managed');

            if ($mode === 'managed') {
                $global_widget_id = get_option('nanoreel_widget_id', 'nanoreel-demo');
                echo sprintf('<nanoreel-widget widget-id="%s"></nanoreel-widget>', esc_attr($global_widget_id));
            } else {
                // Self-hosted mode
                $video_url = get_option('nanoreel_video_url', '');
                if (!empty($video_url)) {
                    $html = sprintf('<nanoreel-widget video-url="%s"', esc_url($video_url));

                    $cta_text = get_option('nanoreel_cta_text', '');
                    $cta_link = get_option('nanoreel_cta_link', '');
                    $accent_color = get_option('nanoreel_accent_color', '#FFE500');
                    $shape = get_option('nanoreel_shape', 'rounded');

                    if (!empty($cta_text)) $html .= sprintf(' cta-text="%s"', esc_attr($cta_text));
                    if (!empty($cta_link)) $html .= sprintf(' cta-link="%s"', esc_url($cta_link));
                    if (!empty($accent_color)) $html .= sprintf(' accent-color="%s"', esc_attr($accent_color));
                    if (!empty($shape)) $html .= sprintf(' shape="%s"', esc_attr($shape));

                    $html .= '></nanoreel-widget>';
                    echo $html;
                }
            }
        }

        echo $args['after_widget'];
    }

    /**
     * Widget admin form
     *
     * @param array $instance Widget instance settings
     */
    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $widget_id = !empty($instance['widget_id']) ? $instance['widget_id'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php _e('Title (optional):', 'nanoreel'); ?>
            </label>
            <input
                class="widefat"
                id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                type="text"
                value="<?php echo esc_attr($title); ?>"
            >
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_id')); ?>">
                <?php _e('Widget ID (optional):', 'nanoreel'); ?>
            </label>
            <input
                class="widefat"
                id="<?php echo esc_attr($this->get_field_id('widget_id')); ?>"
                name="<?php echo esc_attr($this->get_field_name('widget_id')); ?>"
                type="text"
                value="<?php echo esc_attr($widget_id); ?>"
                placeholder="nanoreel-main"
            >
            <small><?php _e('Leave empty to use global settings from Settings → NanoReel', 'nanoreel'); ?></small>
        </p>
        <?php
    }

    /**
     * Update widget settings
     *
     * @param array $new_instance New widget settings
     * @param array $old_instance Old widget settings
     * @return array Sanitized settings
     */
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        $instance['widget_id'] = !empty($new_instance['widget_id']) ? sanitize_text_field($new_instance['widget_id']) : '';
        return $instance;
    }

    /**
     * Enqueue widget script from production API
     */
    public function enqueue_widget_script() {
        wp_enqueue_script(
            'nanoreel-widget',
            NANOREEL_API_URL . '/public/widget.min.js',
            array(),
            NANOREEL_VERSION,
            true // Load in footer
        );
    }
}

/**
 * Register widget
 */
function nanoreel_register_widget() {
    register_widget('NanoReel_Widget');
}
add_action('widgets_init', 'nanoreel_register_widget');
