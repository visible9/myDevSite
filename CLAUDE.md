# CLAUDE.md — WordPress Custom Theme Project

## Project Overview

Custom WordPress theme with ACF (Advanced Custom Fields) and Gutenberg block editor support.

---

### Access Credentials

Credentials are stored in `.env` (not committed to Git).

> Connection string:
> `mysql -u DB_USER -pDB_PASSWORD -h localhost DATABASE_NAME`

### WP-CLI (if available)

```bash
wp --path=/var/www/html option get siteurl
wp --path=/var/www/html post list
```

### SSH / FTP (if applicable)

```
Host:     HOST
Port:     22
User:     USERNAME
Key/Pass: KEY_OR_PASSWORD
Path:     /var/www/html/wp-content/themes/THEME_NAME/
```

---

## Theme Structure

```
wp-content/themes/THEME_NAME/
├── CLAUDE.md                  ← this file
├── style.css                  ← theme header
├── functions.php              ← block registration, ACF, hooks
├── index.php
├── header.php
├── footer.php
├── page.php
├── single.php
│
├── acf-json/                  ← ACF Local JSON field sync
│   └── group_*.json
│
├── blocks/                    ← custom Gutenberg blocks
│   ├── example-block/
│   │   ├── block.json         ← block metadata
│   │   ├── render.php         ← server-side render (ACF blocks)
│   │   ├── index.js           ← Edit component (optional)
│   │   └── style.css
│   └── ...
│
├── src/                       ← JS/CSS source files
│   ├── js/
│   └── scss/
│
├── assets/                    ← compiled files
│   ├── js/
│   └── css/
│
├── template-parts/            ← reusable template parts
├── templates/                 ← Page Templates
└── inc/                       ← PHP helpers, CPT registration, etc.
```

---

## Tech Stack

| Component | Details                              |
| --------- | ------------------------------------ |
| CMS       | WordPress 6.x                        |
| ACF       | Advanced Custom Fields PRO           |
| Editor    | Gutenberg (block editor)             |
| PHP       | 8.x                                  |
| Node.js   | 20.x (build tooling)                 |
| Bundler   | @wordpress/scripts (or Vite/Webpack) |
| CSS       | SCSS / Tailwind (specify as needed)  |

---

## Development Commands

```bash
# Install dependencies
npm install

# Development mode with watch
npm run start

# Production build
npm run build

# Lint JS
npm run lint:js

# Lint CSS
npm run lint:css
```

---

## Working with ACF

- Fields are stored and synced via `acf-json/` (Local JSON)
- Editing field groups in the UI → files update automatically
- On deploy → ACF reads from `acf-json/` and syncs to the DB
- Blocks are registered via `acf_register_block_type()` in `functions.php`

```php
// Example ACF block registration
acf_register_block_type([
    'name'            => 'example-block',
    'title'           => 'Example Block',
    'render_template' => 'blocks/example-block/render.php',
    'category'        => 'theme-blocks',
    'icon'            => 'star-filled',
    'keywords'        => ['example'],
    'supports'        => ['align' => false],
]);
```

---

## Working with Gutenberg Blocks

- Native blocks are registered via `block.json` + `register_block_type()`
- ACF blocks use `acf_register_block_type()` with a `render.php` template
- Theme block category is registered via the `block_categories_all` filter
- Block styles are enqueued via `enqueue_block_assets`

```php
// Native block registration
add_action('init', function() {
    register_block_type(__DIR__ . '/blocks/example-block');
});
```

---

## Code Conventions

1. **Naming:** blocks use `kebab-case`, PHP functions use `theme_prefix_*`
2. **ACF JSON:** always commit `acf-json/*.json` changes to Git
3. **Never edit** compiled files in `assets/` directly
4. **Translations:** wrap all strings in `__()` / `_e()` with the theme text domain
5. **Hooks:** use `after_setup_theme` for theme feature support declarations

---

## Useful SQL Queries

```sql
-- All pages
SELECT ID, post_title, post_status, post_name FROM wp_posts WHERE post_type = 'page';

-- ACF fields for a specific post (ID = 1)
SELECT meta_key, meta_value FROM wp_postmeta WHERE post_id = 1 ORDER BY meta_key;

-- Site options
SELECT option_name, option_value FROM wp_options WHERE option_name IN ('siteurl', 'blogname', 'template');

-- Users
SELECT ID, user_login, user_email FROM wp_users;
```

---

## Key Files for Claude Code

When working on this project, prioritize reading:

- `functions.php` — all registrations and hooks
- `acf-json/` — field group structure
- `blocks/` — block logic and templates
- `inc/` — helper modules
