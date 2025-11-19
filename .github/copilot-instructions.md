# Copilot Instructions

## Project Snapshot
- Laravel storefront for Jatilawang Adventure that now relies entirely on the `items` domain (not the legacy `products` table).
- Public UX lives in `resources/views` with Tailwind utility classes; business rules sit in `app/Http/Controllers` and `app/Models`.
- Data is seeded via `database/seeders` and stored in tables defined under `database/migrations` (notably `items`, `item_detail_rent`, rentals, buys, ratings, reviews).

## Architecture & Data Flow
- `routes/web.php` splits guest/catalog routes from authenticated flows (dashboard, checkout, profile). Treat these route groups as the source of truth before adding endpoints.
- `HomeController@index` and `ProductController@index|show` drive the customer journey: both fetch `App\Models\Item` records and pass them to `home.blade.php` and `products/*.blade.php` respectively.
- Detail pages (`resources/views/products/show.blade.php`) expect an `$item` model plus eager-loaded relations `detailRent` and `rentalDetails` for status badges and stock messaging. Related products come from a simple random `Item` query.
- Product reviews are fetched asynchronously: the Blade view sets `productKey = "item-{$item->item_id}"` and talks to `/products/{productKey}/reviews`, so any backend change must keep that contract intact.

## Domain Conventions
- `App\Models\Item` uses `item_id` as a non-incrementing primary key (`$incrementing = false`). Whenever you create or seed items, you must supply a unique integer `item_id` explicitly.
- Stick to the `items` schema: avoid reviving the removed `products` table unless you also reintroduce migrations/seeds for it.
- Relationships are already modeled (e.g., `Item->detailRent`, `Item->rentalDetails`), so prefer eager loading with `with([...])` to keep Blade templates simple.
- Currency formatting is consistently done inline via `number_format(..., 0, ',', '.')`; keep that pattern so prices remain localized.

## Frontend Patterns
- Landing page “Produk Unggulan” now loops over the same `$items` collection and links directly to `route('products.show', ['slug' => $item->item_id])`. If you add new cards, ensure they still reference `item_id` instead of slugs.
- Detail view JavaScript lives inline at the bottom of `products/show.blade.php`. It expects a `<meta name="csrf-token">` tag from `layouts.public`; when adding new AJAX actions, reuse the same token extraction logic.

## Developer Workflow
- Install dependencies: `composer install`, `npm install`.
- Copy `.env.example` to `.env`, set DB credentials, then run `php artisan key:generate`.
- Database setup: `php artisan migrate --seed` (uses the ERD-aligned tables with 2025_* timestamps). If you already imported `jatilawang_adventure_*.sql`, keep migrations in sync manually.
- Serve + assets: run `php artisan serve` (default 127.0.0.1:8000) and `npm run dev` for Vite; use `npm run build` before deploying static assets to `public/build`.
- Tests (currently defaults): `php artisan test`. Feature work rarely adds tests, so mention coverage expectations explicitly if you add new behavior.

## Common Pitfalls
- Forgetting to eager load `detailRent` leads to extra queries or missing status badges; `ProductController@show` is the canonical example.
- Routes and views still reference legacy wording (“product”), but the backing data is `Item`. When renaming methods or files, keep URLs stable to avoid breaking JS review calls.
- Many migrations reference future dates (2025_*). If you reorder or add migrations, be mindful of timestamp ordering so Laravel runs them correctly.
