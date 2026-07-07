# Sadhaka Website — Launch Plan

Spiritual content site on WordPress (Hostinger). Features: blog, user login, reviews, quotes, practice recommendations. Working copy via Hostinger staging; custom code version-controlled in Git.

## Architecture

- **WordPress on Hostinger** — your existing plan, one-click install
- **Astra theme** (free, fast) + `sadhaka-child` child theme (in this repo)
- **`sadhaka-core` plugin** (in this repo) — Quote & Practice post types, shortcodes
- **Off-the-shelf plugins** for login/reviews — don't reinvent these
- **Git** tracks only your custom code (`wp-content/plugins/sadhaka-core`, `wp-content/themes/sadhaka-child`). Content/DB is not versioned — staging + backups cover that.

## Phase 1 — Base setup (Day 1)

1. hPanel → Websites → Add Website → WordPress, select your domain
2. Enable free SSL (hPanel → Security → SSL) and force HTTPS
3. Appearance → Themes → install **Astra**
4. Install plugins:
   - **LiteSpeed Cache** (Hostinger runs LiteSpeed)
   - **UpdraftPlus** — backups
   - **Site Reviews** — star-rating reviews on any post/practice
   - **Members** (or Ultimate Member if you want profiles) — login/registration/roles
   - **Rank Math** — SEO
5. Settings → General → enable "Anyone can register", default role Subscriber

## Phase 2 — Deploy custom code (Day 1–2)

1. Push the `website/` folder to GitHub as its own repo (private is fine)
2. hPanel → Advanced → **Git** → add repo, deploy path = `public_html` (repo's `wp-content/` merges into the site's `wp-content/`), enable auto-deploy webhook
3. Activate **Sadhaka Core** plugin and **Sadhaka Child** theme in wp-admin
4. Verify: Quotes and Practices menus appear in admin; `[sadhaka_random_quote]` renders on a test page

## Phase 3 — Content structure (Day 2–4)

- **Pages**: Home, Blog, Practices (archive is auto at `/practices/`), Quotes, About, Login/Register
- **Blog**: standard posts with categories (e.g., Meditation, Philosophy, Daily Life)
- **Quotes**: add via Quotes CPT; drop `[sadhaka_random_quote]` on Home for a rotating quote
- **Practices**: add via Practices CPT with level/duration/tradition fields; `[sadhaka_practices level="beginner"]` lists recommendations
- **Reviews**: enable Site Reviews on Practice pages so logged-in users rate practices
- Build Home with the block editor or Astra starter template (Spirituality templates exist)

## Phase 4 — Working copy & workflow (ongoing)

**Hostinger staging** (hPanel → WordPress → Staging):

1. Create staging → full clone at a temp subdomain
2. Test plugin updates, design changes, new features on staging
3. "Publish" pushes staging → live

**Code workflow** (version control):

```
local edit → commit → push to GitHub → auto-deploys to Hostinger
```

- Branch `main` = live. Optionally add a `develop` branch deployed to staging.
- DB/uploads: never in Git. UpdraftPlus scheduled backups (daily DB, weekly full).

## Phase 5 — Launch checklist

- [ ] SSL + HTTPS forced
- [ ] Permalinks: Settings → Permalinks → "Post name"
- [ ] Registration tested (register, login, leave a review)
- [ ] LiteSpeed cache enabled, test with PageSpeed Insights
- [ ] UpdraftPlus backup schedule set
- [ ] Rank Math sitemap submitted to Google Search Console
- [ ] Limit Login Attempts plugin or Hostinger security enabled
- [ ] 10+ pieces of seed content (posts/quotes/practices) before announcing

## Working copy & version control (summary)

- **Working copy + published site**: Hostinger staging is the working copy; publish merges to live.
- **Version control**: this `website/` folder is the Git repo (+ Hostinger Git deploy). Content lives in the DB and is handled by staging + backups — the standard WordPress model.
