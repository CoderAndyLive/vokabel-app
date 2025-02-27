<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About This Project

This is a Laravel-based web application for managing vocabulary learning. It includes features for user authentication, word management, training sessions, and an admin panel for managing users.

## Features

- User authentication and email verification
- CRUD operations for words
- Training sessions for vocabulary learning
- Admin panel for managing users

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/CoderAndyLive/vokabel-app
    cd vokabel-app
    ```

2. Install dependencies:
    ```sh
    composer install
    npm install
    ```

3. Copy the `.env.example` file to [.env](http://_vscodecontentref_/1) and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate an application key :
    ```sh
    php artisan key:generate
    ```

5. Run the migrations:
    ```sh
    php artisan migrate
    ```

6. Start the development server:
    ```sh
    php artisan serve
    npm run dev
    ```

## Usage

- Visit `http://localhost:8000` to access the application.
- Register a new user or log in with an existing account.
- Manage words and start training sessions from the dashboard.
- Admin users can manage other users from the admin panel.

## Running Tests

To run the tests, use the following command:

```sh
php artisan test