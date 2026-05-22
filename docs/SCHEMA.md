# Database Schema Notes

The original archive included a phpMyAdmin export generated on January 15, 2012. The dump was removed from the public repository to avoid shipping database artifacts.

The schema modeled these tables:

- `album`: album metadata, artist relationship, year, and album art filename.
- `artist`: artist profile, location, website, genre, contact, email, and password fields.
- `email`: mailing list signup addresses.
- `sounds_like`: artist-to-mainstream-artist similarity entries.
- `track`: uploaded track metadata, filename, artist, album, and review status.
- `user`: admin/user identity records.

No production data or seed credentials are required for this public archive.

