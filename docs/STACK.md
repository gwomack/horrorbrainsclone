# Technology Stack Documentation

## Backend

-   **Framework**: Laravel v11 (PHP ^8.2)
-   **Real-time Features**: Livewire
-   **Admin Dashboard**: Filament v3.2
    -   Filament Plugins:
        -   Shield (Roles & Permissions)
        -   Spatie Media Library Plugin
        -   Spatie Settings Plugin
        -   Filament Breezy
        -   Filament Excel
        -   Filament Impersonate
        -   Filament Socialite

## Frontend

-   **Build Tool**: Vite v5.0
-   **CSS Framework**: Tailwind CSS v3.4
    -   Custom font: Figtree
    -   PostCSS
    -   Autoprefixer
-   **HTTP Client**: Axios
-   **Icons**: Font Awesome (via Blade components)

## Database & Storage

-   **Primary Database**: PostgreSQL
-   **Cache**: Redis
-   **Session Storage**: Redis
-   **Queue System**: Redis
-   **File Storage**: Local disk (with symbolic links)

## Authentication & Authorization

-   **Authentication**: Laravel Sanctum
-   **OAuth Providers**:
    -   Google (via Socialite)
-   **Authorization**: Filament Shield

## Development Tools

-   **Testing**:
    -   Pest PHP
    -   Pest Laravel Plugin
-   **Code Quality**:
    -   Laravel Pint (Code Style)
    -   Laravel Debugbar
    -   Laravel IDE Helper
-   **API Documentation**: Scramble
-   **Development Server**: Laravel Sail
-   **Development Tools**:
    -   Laravel Vite Plugin
    -   Concurrently (for parallel task running)

## Deployment & Infrastructure

-   **Hosting**: Personal server
-   **CI/CD**: GitHub Actions via SSH
-   **Backup Solutions**:
    -   PostgreSQL `pg_dump` for logical backups
    -   PostgreSQL `pg_basebackup` for physical backups

## Mail Services

-   **Primary Mail Driver**: SMTP
-   **Alternative Mail Service**: Resend (configured but not active)

## Caching & Performance

-   **Cache Driver**: Redis
-   **Queue Driver**: Redis
-   **Redis Client**: Predis

## Current Integration Points

-   Affiliate links integration planned for:
    -   Amazon
    -   Netflix
-   Google Ads integration (planned for future)

## Security

-   **Password Hashing**: Bcrypt (12 rounds)
-   OWASP security guidelines
-   CAPTCHA implementation for comment sections

## Development Environment

-   **Timezone**: America/Sao_Paulo
-   **Locale**: English (en)
-   **Debug Mode**: Enabled in development

---

_Note: This document will be updated as the stack evolves or when new technologies are integrated into the project._
