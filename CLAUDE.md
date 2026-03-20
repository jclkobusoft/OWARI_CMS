# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

OWARI CMS is a Laravel 5.6 monolithic CMS for managing an automotive product catalog (Nikko Auto distribution). It combines product management, content management, and a public-facing website. The app uses MySQL, Elasticsearch for product search, and a mixed jQuery + Vue.js 2 frontend with Bootstrap 4.

## Common Commands

```bash
# Development server
php artisan serve

# Database migrations
php artisan migrate

# Run tests
./vendor/bin/phpunit
./vendor/bin/phpunit --filter=TestClassName       # single test class
./vendor/bin/phpunit tests/Feature/ExampleTest.php # single test file

# Asset compilation (Laravel Mix / Webpack)
npm run dev          # development build
npm run watch        # watch mode
npm run prod         # production build

# Artisan utilities
php artisan cache:clear
php artisan tinker
```

## Architecture

**Stack:** Laravel 5.6 (PHP 7.1+), MySQL, Elasticsearch 6.x, Vue.js 2, Bootstrap 4, Laravel Mix (Webpack)

**Routing:**
- `routes/web.php` — Public site routes and admin routes (protected by `auth` middleware, prefixed `/admin`)
- `routes/api.php` — API endpoints with CORS middleware (prefixed `/api`), includes search, images, and third-party integrations (`/api/soma/*`)

**Controllers** (`app/Http/Controllers/`):
- `WebController` — Main public website (largest controller)
- `ProductosController` — Product CRUD, Excel import/export, image management (largest by LOC)
- `SistemaController` — Admin dashboard, company settings
- Other controllers map 1:1 to domain entities (Marcas, Boletines, Catalogos, Informate, etc.)

**Models** (`app/Models/`): 16 Eloquent models. Key ones:
- `Producto` — Uses `ElasticquentTrait` for Elasticsearch indexing and `SoftDeletes`
- `DatosGenerales` — Global CMS configuration/settings
- `ProductoBusqueda` / `ProductoBusquedaDos` — Denormalized search index models

**Elasticsearch:** Configured in `config/elasticquent.php` (default index: `productos`, host: `localhost:9200`). Product model defines ES mappings for full-text search.

**Middleware:** Custom `CORS.php` middleware for API routes. Standard Laravel middleware stack otherwise.

**Views:** Blade templates in `resources/views/`. Split between `web/` (public) and `admin/` (dashboard). Theme assets in `public/cms/`.

**Assets pipeline:** `resources/assets/js/app.js` → `public/js`, `resources/assets/sass/app.scss` → `public/css` (via `webpack.mix.js`)

## Key Integrations

- **Excel import/export** via `maatwebsite/excel ~2.1` for bulk product operations
- **DataTables** via `yajra/laravel-datatables-oracle ~8.0` for server-side admin tables
- **HTML/Form helpers** via `laravelcollective/html ^5.4`

## Testing

PHPUnit 7 with two test suites: `Feature` and `Unit` (in `tests/`). Test environment uses array drivers for cache/session/mail and reduced bcrypt rounds. No linting or formatting tools are configured.
