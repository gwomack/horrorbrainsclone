# Scream Hive

A modern, reliable resource for horror movie enthusiasts, providing up-to-date movie releases, reviews, and discussion opportunities.

## About

Scream Hive is a minimalist horror movie database and review platform that focuses on listing the latest horror movie releases, providing movie synopses, user reviews, and discussion sections. The platform is designed to be mobile-optimized and features a dark, horror-themed UI.

# DEMO

[Scream Hive Demo](https://screemhive.danielveronese.download)

## Features

-   Latest horror movie releases
-   Detailed movie information including:
    -   Movie posters
    -   Synopses
    -   Main cast
    -   Production details
    -   Availability information
    -   Trailers
    -   Critics' reviews
-   User reviews and ratings (1-5 star system)
-   Discussion sections
-   Search and filtering capabilities
-   Mobile-optimized design
-   Affiliate links integration (Amazon, Netflix)

## Tech Stack

### Backend

-   Laravel v11 (PHP ^8.2)
-   Livewire for real-time features
-   Filament v3.2 for admin dashboard
-   PostgreSQL database
-   Redis for caching and queues

### Frontend

-   Vite v5.0
-   Tailwind CSS v3.4
-   Figtree font
-   Font Awesome icons
-   Axios for HTTP requests

### Development Tools

-   Pest PHP for testing
-   Laravel Pint for code style
-   Laravel Debugbar
-   Laravel IDE Helper
-   Scramble for API documentation
-   Laravel Sail for development server

## Requirements

-   PHP 8.2 or higher
-   PostgreSQL
-   Redis
-   Node.js & NPM
-   Composer

## Installation

1. Clone the repository

```bash
git clone [repository-url]
```

2. Install PHP dependencies

```bash
composer install
```

3. Install NPM dependencies

```bash
npm install
```

4. Copy environment file

```bash
cp .env.example .env
```

5. Generate application key

```bash
php artisan key:generate
```

6. Configure your database in `.env`

7. Run migrations

```bash
php artisan migrate
```

8. Start the development server

```bash
php artisan sail:up
```

9. In a separate terminal, start Vite

```bash
npm run dev
```

## Development

The project follows these development guidelines:

-   Code style is enforced using Laravel Pint
-   Tests are written using Pest PHP
-   UI styling follows the established design system
-   All changes must maintain existing functionality
-   Core functionality should not be altered without explicit request

## Security

-   Follows OWASP security guidelines
-   Implements CAPTCHA for comment sections
-   Uses Laravel Sanctum for authentication
-   Implements proper password hashing with Bcrypt

## Deployment

The site is deployed using GitHub Actions via SSH to a personal server. Regular backups are implemented using PostgreSQL tools.

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

[License Type] - See LICENSE file for details

## Contact

[Contact Information]
