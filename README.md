# Laravel Project Setup

This repository contains a Laravel project for user management.

## Getting Started

To get started with the project, follow these steps:

1. **Clone the repository:**

    ```
    git clone https://github.com/soungoolwin/User-Management-Pico.git
    ```

2. **Navigate to the project directory:**

    ```
    cd User-Management-Pico
    ```

3. **Copy the `.env.example` file and rename it to `.env`:**

    ```
    cp .env.example .env
    ```

4. **Install PHP dependencies using Composer:**

    ```
    composer install
    ```

5. **Install JavaScript dependencies using npm:**

    ```
    npm install
    ```

6. **Generate the application key:**

    ```
    php artisan key:generate
    ```

7. **Run database migrations and seed the database:**

    ```
    php artisan migrate:fresh --seed
    ```

8. **Start the development server:**

    ```
    php artisan serve
    ```

## Admin Credentials

To access the admin dashboard, use the following credentials:

-   **Username:** demo
-   **Password:** picosbs

## Additional Notes

-   Make sure you have PHP, Composer, Node.js, and npm installed on your system before proceeding with the setup.
-   Ensure that you have a MySQL database set up and configured in your `.env` file.
-   Modify the `.env` file according to your environment settings, such as database connection details.
