# Meeting System (Laravel Version)

This repository contains a meeting management system built using Laravel and MariaDB. The system allows users to schedule, join, and manage meetings.

## Table of Contents

- [Getting Started](#getting-started)
- [Features](#features)
- [API Documentation](#api-documentation)
- [Technologies Used](#technologies-used)
- [License](#license)

## Getting Started

1. Clone the repository:

```bash
git clone https://github.com/your-username/meeting-system-laravel.git
```

2. Install dependencies:

```bash
cd meeting-system-laravel
composer install
```

3. Set up environment variables:

Create a `.env` file in the root directory of the project and add the following variables:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=meeting_system
DB_USERNAME=your_username
DB_PASSWORD=your_password

JWT_SECRET=your-secret-key
```

Replace `your-secret-key` with a strong secret key for JWT authentication, and update the database credentials accordingly.

4. Generate application key:

```bash
php artisan key:generate
```

5. Migrate the database:

```bash
php artisan migrate
```

6. Start the server:

```bash
php artisan serve
```

The server will start on `http://localhost:8000`.

## Features

- User registration and authentication using JWT.
- Creating, updating, and deleting meetings.
- Inviting attendees to meetings.
- Joining meetings using a unique meeting code.
- Sending notifications to attendees when a meeting is scheduled or updated.

## API Documentation

The API documentation is available at `http://localhost:8000/api/documentation`.

## Technologies Used

- Laravel
- MariaDB
- JWT-Auth
- Swagger for API documentation

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.

```