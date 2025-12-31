=== NanoReel - Video Widgets for Conversions ===
Contributors: nanoreel
Tags: video, ecommerce, woocommerce, conversion, shoppable video
Requires at least: 5.8
Tested up to: 6.9
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Embeddable TikTok-style video widgets that boost e-commerce conversions. Add shoppable videos to any page in seconds.

== Description ==

**NanoReel** turns static product pages into engaging video experiences. Add floating video bubbles that visitors can click to watch product demos, testimonials, or tutorials - without leaving your site.

### 🚀 Key Features

* **Zero coding required** - Install, configure, and go live in under 2 minutes
* **Mobile-first design** - Optimized for TikTok-generation shoppers
* **Lightning fast** - <50ms page load impact (lazy loading enforced)
* **Two modes:**
  * **Managed Mode:** Host your config on NanoReel's backend (recommended)
  * **Self-Hosted Mode:** Full control over video URL, CTA, colors
* **Flexible placement:**
  * Global widget (appears on all pages)
  * Manual placement via `[nanoreel]` shortcode
  * Sidebar/footer via WordPress Widgets
* **Customizable:**
  * Accent colors (match your brand)
  * Button shapes (rounded or circle)
  * CTA text and links
* **WooCommerce compatible** - Boost product page conversions

### 💡 Perfect For

* E-commerce stores (WooCommerce, Easy Digital Downloads)
* SaaS landing pages
* Course creators
* Real estate listings
* Restaurant menus
* Portfolio showcases

### 🎯 How It Works

1. Install plugin
2. Configure video URL and CTA in Settings → NanoReel
3. Widget appears as floating bubble in bottom-right corner
4. Visitors click → video opens in full-screen overlay
5. CTA button drives conversions (shop, signup, book demo)

### 🆓 Free vs Founder Deal

**Free Version:**
* Self-Hosted Mode (configure your own video)
* Demo widget included (nanoreel-demo)
* Visible "Powered by NanoReel" branding

**Founder Deal ($49 one-time, limited to first 50 users):**
* Remove branding
* Managed Mode (we handle video/CTA updates via backend)
* Self-Hosted Mode (configure locally)
* Priority support
* [Upgrade here](https://nanoreel.lemonsqueezy.com/buy/3f230499-a324-408e-89d9-1b067c2bca10)

### 🔗 Links

* [Official Website](https://nanoreel.vercel.app)
* [GitHub Repository](https://github.com/LuaGR/nanoreel-wordpress)
* [Support](mailto:nanoreel.team@gmail.com)
* [Terms of Service](https://nanoreel.vercel.app/terms)
* [Privacy Policy](https://nanoreel.vercel.app/privacy)

== Installation ==

### Automatic Installation

1. Go to WordPress Admin → Plugins → Add New
2. Search for "NanoReel"
3. Click "Install Now" → "Activate"
4. Go to Settings → NanoReel
5. Configure your video settings

### Manual Installation

1. Download the plugin ZIP file
2. Go to WordPress Admin → Plugins → Add New → Upload Plugin
3. Choose the ZIP file and click "Install Now"
4. Activate the plugin
5. Go to Settings → NanoReel

### Configuration

**Free Users (Demo Widget):**
1. Plugin comes pre-configured with demo widget (nanoreel-demo)
2. Test immediately after activation
3. To use your own video:
   - Go to Settings → NanoReel
   - Select "Self-Hosted Mode"
   - Enter your video URL, CTA text/link, and colors
   - Save settings

**Founder Deal Users (Managed Mode):**
1. Purchase Founder Deal ($49)
2. Reply to Lemon Squeezy confirmation email with:
   - Your website domain
   - Video URL
   - CTA text/link
3. We configure your widget-id on backend (~1 hour)
4. We email you your widget-id (e.g., "yourstore-main")
5. Go to Settings → NanoReel → Select "Managed Mode"
6. Enter your widget-id and save
7. Update video/CTA anytime by emailing us (no code changes needed)

**Self-Hosted Mode (All Users):**
1. Go to Settings → NanoReel
2. Select "Self-Hosted Mode"
3. Enter:
   * Video URL (MP4, WebM, or MOV)
   * CTA text (e.g., "Shop Now")
   * CTA link (your checkout/landing page)
   * Accent color (hex code)
4. Save settings

**Using Shortcode:**

Place `[nanoreel]` anywhere in posts/pages to manually position widget.

**Using Widget (Sidebar):**

1. Go to Appearance → Widgets
2. Drag "NanoReel Video Widget" to desired sidebar
3. Configure Widget ID (optional)

== Frequently Asked Questions ==

= What video formats are supported? =

MP4, WebM, MOV, and OGG. We recommend MP4 (H.264) for best compatibility.

= Where should I host my videos? =

Any reliable CDN or cloud storage:
* Cloudflare R2 (recommended)
* AWS S3
* Bunny CDN
* Your own server (if bandwidth allows)

= Does this work with WooCommerce? =

Yes! NanoReel is fully compatible with WooCommerce. Add video widgets to product pages, shop pages, or checkout.

= Will this slow down my site? =

No. NanoReel uses lazy loading - the video only loads when clicked. Initial page load impact is <50ms.

= Can I use multiple videos on one page? =

Currently, NanoReel supports one widget per page. Multi-widget support is planned for v2.0.

= How do I remove the branding? =

Purchase Founder Deal ($49 one-time, limited to first 50 users):

1. Go to [nanoreel.lemonsqueezy.com](https://nanoreel.lemonsqueezy.com/buy/3f230499-a324-408e-89d9-1b067c2bca10)
2. Complete checkout
3. Reply to confirmation email with your website domain
4. We activate your license on backend (~1 hour)
5. Branding automatically disappears via backend license check

= Is this GDPR compliant? =

Yes. NanoReel doesn't collect personal data. Videos are hosted by you, analytics are anonymous (no cookies).

= Can I customize the widget position? =

Currently fixed to bottom-right corner. Custom positioning coming in v2.0.

= What browsers are supported? =

All modern browsers:
* Chrome, Firefox, Safari, Edge (last 2 versions)
* Mobile: iOS Safari 12+, Chrome Android 70+

= Do I need a NanoReel account? =

No account needed for any tier.

**Free:** Plugin works immediately with demo widget (nanoreel-demo). Switch to Self-Hosted Mode to use your own video.

**Founder Deal:** After purchase, reply to confirmation email with your domain. We configure your custom widget-id on our backend and email it to you.

== Screenshots ==

1. Admin settings page - Managed Mode
2. Admin settings page - Self-Hosted Mode
3. Widget floating bubble on site (closed state)
4. Widget video overlay (open state)
5. Mobile view - fully responsive
6. Color customization options

== Changelog ==

= 1.0.0 - 2025-12-21 =
* Initial release
* Managed Mode (widget-id based configuration)
* Self-Hosted Mode (manual configuration)
* Shortcode support: `[nanoreel]`
* WordPress Widget (sidebar/footer placement)
* Color customization
* Shape options (rounded/circle)
* Mobile responsive design
* WooCommerce compatibility
* GPL v2+ license

== Upgrade Notice ==

= 1.0.0 =
Initial release. No upgrade needed.

== Additional Info ==

### Performance

* Widget script: <5KB gzipped
* Lazy loading: Video loads only on click
* No external dependencies (React, jQuery, etc.)
* HTTP/2 + Keep-Alive optimized

### Privacy

* No cookies
* No personal data collection
* GDPR compliant
* Analytics are anonymous (domain-level only)

### Support

For support, contact: nanoreel.team@gmail.com

Response time: <24 hours (weekdays)

### Roadmap

Planned features for future versions:
* Multi-widget support (v2.0)
* Custom positioning (v2.0)
* A/B testing (v2.1)
* Video analytics dashboard (v2.2)
* Thumbnail customization (v2.3)
* Auto-play options (v2.4)

== Third-Party Services ==

This plugin connects to the NanoReel API for:
* Widget script delivery (`nanoreel.up.railway.app/public/widget.min.js`)
* Managed Mode configuration (Founder Deal users only)

**Data sent:**
* Domain name (for license validation)
* Widget ID (Managed Mode only)

**Data NOT sent:**
* User personal information
* Visitor IP addresses
* Browsing history

NanoReel API Terms: https://nanoreel.vercel.app/terms
Privacy Policy: https://nanoreel.vercel.app/privacy
