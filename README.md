# Sadhaka Website

Custom WordPress code for the Sadhaka spiritual content site. See **PLAN.md** for the full launch plan.

This `website/` folder is the Git repo root — initialize git here, not in the Sadhaka parent folder.

## Repo layout

```
wp-content/
├── plugins/sadhaka-core/    # Quote & Practice post types, Tradition taxonomy, shortcodes
└── themes/sadhaka-child/    # Astra child theme (custom styles)
```

## Shortcodes

| Shortcode | Purpose |
|---|---|
| `[sadhaka_random_quote]` | Random quote with author/source |
| `[sadhaka_practices level="beginner" tradition="yoga" count="5"]` | Practice recommendations (all attrs optional) |

## Deploy (GitHub Actions → Hostinger SSH)

Every push to `main` rsyncs the plugin and theme to the server via `.github/workflows/deploy.yml`.

Hostinger's native Git deploy needs an empty target directory, so it can't merge into an existing `wp-content` — hence the Actions approach.

One-time setup — add these **GitHub repo secrets** (Settings → Secrets and variables → Actions):

| Secret | Value |
|---|---|
| `HOSTINGER_HOST` | SSH host/IP from hPanel → Advanced → SSH Access |
| `HOSTINGER_PORT` | usually `65002` |
| `HOSTINGER_USER` | SSH username (e.g., `u123456789`) |
| `HOSTINGER_SSH_KEY` | private key (public half added in hPanel SSH Access) |
| `HOSTINGER_PATH` | e.g., `/home/u123456789/domains/yourdomain.com/public_html` |

Then in wp-admin: activate **Sadhaka Core** (Plugins) and **Sadhaka Child** (Appearance → Themes; requires Astra installed).

## Workflow

- Code changes: edit locally → commit → push → auto-deploys to live
- Content/plugin experiments: Hostinger staging site → test → publish to live
- After activating the plugin, visit Settings → Permalinks once (Save) to flush rewrite rules if `/practices/` 404s
