<?php
/**
 * Shortcode Handler
 *
 * Allows manual widget placement via [nanoreel] shortcode in posts/pages
 *
 * @package NanoReel
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Prevent direct access
}

class NanoReel_Shortcode {

    /**
     * Initialize shortcode
     */
    public function __construct() {
        add_shortcode('nanoreel', array($this, 'render_shortcode'));
    }

    /**
     * Render [nanoreel] shortcode
     *
     * Usage examples:
     * [nanoreel] - Uses global settings
     * [nanoreel widget_id="custom-id"] - Override widget-id
     * [nanoreel video_url="..." cta_text="..." cta_link="..."] - Override all
     *
     * @param array $atts Shortcode attributes
     * @return string HTML output
     */
    public function render_shortcode($atts) {
        // Parse shortcode attributes
        $atts = shortcode_atts(array(
            'widget_id'    => '',
            'video_url'    => '',
            'cta_text'     => '',
            'cta_link'     => '',
            'accent_color' => '',
            'shape'        => '',
            'button_style' => '',
        ), $atts, 'nanoreel');

        // Enqueue widget script (if not already loaded)
        $this->enqueue_widget_script();

        // Determine mode: managed (widget_id) or self-hosted (manual config)
        if (!empty($atts['widget_id'])) {
            return $this->render_managed_widget($atts['widget_id']);
        }

        // If no widget_id provided, check global settings
        $mode = get_option('nanoreel_mode', 'managed');

        if ($mode === 'managed') {
            $widget_id = get_option('nanoreel_widget_id', 'nanoreel-demo');
            return $this->render_managed_widget($widget_id);
        }

        // Self-hosted mode: use shortcode attributes or global settings
        return $this->render_selfhosted_widget($atts);
    }

    /**
     * Render managed widget (uses backend config via widget-id)
     *
     * @param string $widget_id Widget identifier
     * @return string HTML output
     */
    private function render_managed_widget($widget_id) {
        return sprintf(
            '<nanoreel-widget widget-id="%s"></nanoreel-widget>',
            esc_attr($widget_id)
        );
    }

    /**
     * Render self-hosted widget (manual configuration)
     *
     * @param array $atts Attributes (from shortcode or settings)
     * @return string HTML output
     */
    private function render_selfhosted_widget($atts) {
        // Fall back to global settings if shortcode attributes empty
        $video_url    = !empty($atts['video_url'])    ? $atts['video_url']    : get_option('nanoreel_video_url', '');
        $cta_text     = !empty($atts['cta_text'])     ? $atts['cta_text']     : get_option('nanoreel_cta_text', '');
        $cta_link     = !empty($atts['cta_link'])     ? $atts['cta_link']     : get_option('nanoreel_cta_link', '');
        $accent_color = !empty($atts['accent_color']) ? $atts['accent_color'] : get_option('nanoreel_accent_color', '#FFE500');
        $shape        = !empty($atts['shape'])        ? $atts['shape']        : get_option('nanoreel_shape', 'rounded');
        $button_style = !empty($atts['button_style']) ? $atts['button_style'] : get_option('nanoreel_button_style', 'solid');

        // Validate required fields
        if (empty($video_url)) {
            return '<p style="color:red;">[NanoReel Error: No video URL configured. Go to Settings → NanoReel]</p>';
        }

        // Build HTML attributes
        $html = sprintf(
            '<nanoreel-widget video-url="%s"',
            esc_url($video_url)
        );

        if (!empty($cta_text)) {
            $html .= sprintf(' cta-text="%s"', esc_attr($cta_text));
        }

        if (!empty($cta_link)) {
            $html .= sprintf(' cta-link="%s"', esc_url($cta_link));
        }

        if (!empty($accent_color)) {
            $html .= sprintf(' accent-color="%s"', esc_attr($accent_color));
        }

        if (!empty($shape)) {
            $html .= sprintf(' shape="%s"', esc_attr($shape));
        }

        if (!empty($button_style)) {
            $html .= sprintf(' button-style="%s"', esc_attr($button_style));
        }

        $html .= '></nanoreel-widget>';

        return $html;
    }

    /**
     * Enqueue widget script from production API
     */
    private function enqueue_widget_script() {
        if (!wp_script_is('nanoreel-widget', 'enqueued')) {
            wp_enqueue_script(
                'nanoreel-widget',
                NANOREEL_API_URL . '/public/widget.min.js',
                array(),
                NANOREEL_VERSION,
                true // Load in footer
            );
        }
    }
}

// Initialize shortcode
new NanoReel_Shortcode();
