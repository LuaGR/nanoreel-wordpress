/**
 * Admin JavaScript for NanoReel Settings Page
 *
 * Handles:
 * - Color picker initialization
 * - Mode toggle (Managed vs Self-Hosted)
 *
 * @package NanoReel
 * @since 1.0.0
 */

(function($) {
    'use strict';
    
    $(document).ready(function() {
        
        // Initialize WordPress color picker
        if ($.fn.wpColorPicker) {
            $('.nanoreel-color-picker').wpColorPicker();
        }
        
        // Mode toggle logic (Managed vs Self-Hosted)
        const $modeRadios = $('input[name="nanoreel_mode"]');
        const $managedSettings = $('#nanoreel-managed-settings');
        const $selfhostedSettings = $('#nanoreel-selfhosted-settings');
        
        // Toggle sections based on selected mode
        function toggleModeSettings() {
            const selectedMode = $('input[name="nanoreel_mode"]:checked').val();
            
            if (selectedMode === 'managed') {
                $managedSettings.show();
                $selfhostedSettings.hide();
            } else if (selectedMode === 'selfhosted') {
                $managedSettings.hide();
                $selfhostedSettings.show();
            }
        }
        
        // Initialize on page load
        toggleModeSettings();
        
        // Listen for mode changes
        $modeRadios.on('change', function() {
            toggleModeSettings();
        });
        
        // Preview video URL validation (optional enhancement)
        const $videoUrlInput = $('#nanoreel_video_url');
        const $videoPreviewBtn = $('#nanoreel-preview-video');
        
        if ($videoPreviewBtn.length) {
            $videoPreviewBtn.on('click', function(e) {
                e.preventDefault();
                const videoUrl = $videoUrlInput.val();
                
                if (!videoUrl) {
                    alert('Please enter a video URL first.');
                    return;
                }
                
                // Simple validation: check if URL ends with video extension
                const videoExtensions = ['.mp4', '.webm', '.ogg', '.mov'];
                const isVideo = videoExtensions.some(ext => videoUrl.toLowerCase().endsWith(ext));
                
                if (!isVideo) {
                    if (!confirm('This URL doesn\'t look like a video file. Continue anyway?')) {
                        return;
                    }
                }
                
                // Open video in new tab for quick preview
                window.open(videoUrl, '_blank');
            });
        }
        
        // Widget ID validation (ensure no spaces)
        const $widgetIdInput = $('#nanoreel_widget_id');
        
        $widgetIdInput.on('blur', function() {
            const widgetId = $(this).val().trim();
            
            if (widgetId && widgetId.includes(' ')) {
                alert('Widget ID cannot contain spaces. Use hyphens instead (e.g., "nanoreel-main").');
                $(this).val(widgetId.replace(/\s+/g, '-'));
            }
        });
        
        // CTA Link validation (ensure it's a valid URL)
        const $ctaLinkInput = $('#nanoreel_cta_link');
        
        $ctaLinkInput.on('blur', function() {
            const ctaLink = $(this).val().trim();
            
            if (ctaLink && !ctaLink.match(/^https?:\/\/.+/)) {
                if (confirm('CTA Link should start with http:// or https://. Add https:// automatically?')) {
                    $(this).val('https://' + ctaLink);
                }
            }
        });
        
    });
    
})(jQuery);
