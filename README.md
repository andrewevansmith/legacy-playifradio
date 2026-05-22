# Legacy PlayIfRadio

Archived PHP indie-radio discovery prototype, circa January 2012.

## What this shows

- A custom PHP MVC-style framework with routing, controllers, models, sessions, email, and database helpers.
- Artist registration, login, music upload, admin review, and playlist generation workflows.
- A focused product concept: recommend and stream independent artists by similarity to mainstream artists.

## Archive Status

This repository is preserved as a public reference project. It uses legacy PHP APIs and is not intended to run unchanged on modern infrastructure.

## Cleanup Notes

- Removed hardcoded admin credentials and replaced them with environment-backed placeholders.
- Removed private notification recipients and replaced app/owner email settings with safe defaults.
- Removed the SQL dump, uploaded/demo media, Flash/Silverlight binaries, compiler jars, and player demo files.
- Added lightweight missing views so the referenced routes make sense during code review.
- Preserved the original product identity because this project is being kept as a named legacy reference.

## Configuration

The archived app reads optional environment variables in `framework/core/config.php`:

- `PIR_BASE_URL`
- `PIR_APP_EMAIL`
- `PIR_OWNER_EMAIL`
- `PIR_ADMIN_EMAIL`
- `PIR_ADMIN_PASSWORD`

Default values are placeholders for local review only.

