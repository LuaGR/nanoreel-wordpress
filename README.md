# NanoReel WordPress Plugin

Official WordPress plugin for [NanoReel](https://nanoreel.vercel.app) - embeddable video widgets for e-commerce conversions.

## 🚀 Quick Start

### Installation (Manual)

1. **Download or clone this repository:**
   ```bash
   git clone https://github.com/LuaGR/nanoreel-wordpress.git
   ```

2. **Copy to WordPress plugins directory:**
   ```bash
   cp -r nanoreel-wordpress /path/to/wordpress/wp-content/plugins/nanoreel
   ```

3. **Activate plugin:**
   - Go to WordPress Admin → Plugins
   - Find "NanoReel" and click "Activate"

4. **Configure settings:**
   - Go to WordPress Admin → NanoReel
   - Choose **Managed Mode** (recommended) or **Self-Hosted Mode**
   - Save settings

---

## 📂 Plugin Structure

```
nanoreel-wordpress/
├── nanoreel.php                         # Main plugin file (entry point)
├── includes/
│   ├── class-nanoreel-settings.php      # Admin settings page
│   ├── class-nanoreel-shortcode.php     # [nanoreel] shortcode
│   └── class-nanoreel-widget.php        # WordPress widget (sidebar)
├── assets/
│   ├── css/
│   │   └── admin.css                    # Admin page styles
│   └── js/
│       └── admin.js                     # Admin page interactivity
├── languages/                            # Translation files (future)
├── README.md                             # This file (developer docs)
├── readme.txt                            # WordPress.org listing
└── LICENSE                               # GPL v2+ license
```

---

## 🛠️ How It Works

### Architecture

1. **Plugin loads widget.js from production API:**
   - Script URL: `https://nanoreel.up.railway.app/public/widget.js`
   - No local bundling - always fetches latest version

2. **Two operation modes:**
   - **Managed Mode:** Uses `widget-id` to fetch config from backend API
   - **Self-Hosted Mode:** Manual configuration (video URL, CTA, colors)

3. **Integration points:**
   - **Global widget:** Auto-injected in `wp_footer` (all pages)
   - **Shortcode:** `[nanoreel]` for manual placement in posts/pages
   - **Widget:** Sidebar/footer placement via Widgets admin

---

## 📖 Usage Examples

### Managed Mode (Recommended)

```html
<!-- Admin Settings: Enter widget-id = "nanoreel-main" -->
<!-- Widget automatically appears on all pages -->
```

### Self-Hosted Mode

```html
<!-- Admin Settings: Enter video URL, CTA text/link, accent color -->
<!-- Widget appears with custom configuration -->
```

### Shortcode Usage

```html
<!-- Use global settings -->
[nanoreel]

<!-- Override widget-id -->
[nanoreel widget_id="custom-id"]

<!-- Full manual config -->
[nanoreel 
  video_url="https://example.com/video.mp4"
  cta_text="Shop Now"
  cta_link="https://example.com/shop"
  accent_color="#FFE500"
  shape="rounded"
]
```

### Widget (Sidebar)

1. Go to **Appearance → Widgets**
2. Drag "NanoReel Video Widget" to desired sidebar
3. Configure Widget ID (or leave empty to use global settings)

---

## 🧪 Testing Locally

### Option A: Existing WordPress Installation

```bash
# Copy plugin to your WordPress
cp -r nanoreel-wordpress /Applications/MAMP/htdocs/wordpress/wp-content/plugins/nanoreel

# Activate plugin in WordPress admin
# Test at: http://localhost:8888/wordpress
```

### Option B: Fresh WordPress Setup

```bash
# Download WordPress
curl -O https://wordpress.org/latest.tar.gz
tar -xzf latest.tar.gz

# Copy plugin
cp -r nanoreel-wordpress wordpress/wp-content/plugins/nanoreel

# Setup WordPress (create database, run installer)
# Activate plugin, configure settings
```

---

## 🔧 Development

### File Editing Guidelines

- **PHP files:** Follow WordPress Coding Standards
- **CSS:** BEM naming convention preferred
- **JavaScript:** ES5+ (WordPress supports back to IE11)
- **Comments:** Explain WHY, not WHAT (see AGENTS.md in core repo)

### Commit Message Format

Follow [Conventional Commits](https://www.conventionalcommits.org/):

```bash
feat: add color picker to self-hosted mode
fix: prevent widget-id from accepting spaces
refactor: simplify shortcode attribute parsing
```

### Testing Checklist

- [ ] Plugin activates without errors
- [ ] Settings page loads (Admin → NanoReel)
- [ ] Managed mode: Widget appears with correct config
- [ ] Self-hosted mode: Custom video/CTA works
- [ ] Shortcode renders widget in posts
- [ ] Widget works in sidebars
- [ ] Color picker functional
- [ ] No JavaScript console errors
- [ ] Mobile responsive (test on iPhone/Android)

---

## 🔗 Related Resources

- **Core Repository:** [github.com/LuaGR/nanoreel](https://github.com/LuaGR/nanoreel)
- **Landing Page:** [nanoreel.vercel.app](https://nanoreel.vercel.app)
- **Backend API:** [nanoreel.up.railway.app](https://nanoreel.up.railway.app)
- **Widget Script:** [nanoreel.up.railway.app/public/widget.js](https://nanoreel.up.railway.app/public/widget.js)

---

## 📜 License

GPL v2 or later (required for WordPress.org distribution).

See [LICENSE](LICENSE) file for full text.

---

## 🤝 Contributing

This plugin is currently maintained by the NanoReel core team.

For bug reports or feature requests, open an issue on GitHub.

---

## 📞 Support

- **Email:** nanoreel.team@gmail.com
- **Terms of Service:** [nanoreel.vercel.app/terms](https://nanoreel.vercel.app/terms)
- **Privacy Policy:** [nanoreel.vercel.app/privacy](https://nanoreel.vercel.app/privacy)

---

**Last Updated:** 2025-12-21  
**Version:** 1.0.0  
**Tested up to:** WordPress 6.4
