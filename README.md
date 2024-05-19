<p align="center"><a href="https://github.com/Maysker/bitcoin-trackerV2" target="_blank"><img src="https://raw.githubusercontent.com/Maysker/bitcoin-trackerV2/main/public/img/logo.png" width="200" alt="Bitcoin Tracker Logo"></a></p>
# Virtual Bitcoin Management Web Application

## Project Description

This web application allows users to register, buy and sell virtual bitcoins, manage their portfolio, and track transaction history. The project is implemented using Laravel for the backend and Blade for the frontend.

## Technology Stack

- **Backend:** Laravel 11
- **Frontend:** Blade
- **Database:** MySQL
- **API:** Coinbase API
- **Authentication:** Laravel Breeze

## Requirements

- PHP >= 8.0
- Composer
- Node.js
- MySQL

## Installation

### Clone the repository

git clone https://github.com/yourusername/your-repo-name.git
cd your-repo-name

Backend Setup

    Install dependencies:

bash

composer install

    Copy .env.example to .env and configure your database connection:

bash

cp .env.example .env

    Generate the application key:

bash

php artisan key:generate

    Run the migrations to create the database tables:

bash

php artisan migrate

    Start the development server:

bash

php artisan serve

Frontend Setup

Since the frontend is implemented using Blade, it is already set up with the Laravel application. No additional steps are required.
Usage

After completing the installation steps, open your browser and navigate to http://localhost:8000 to access the application.
Main Features

    User Registration and Authentication
    Buying and Selling Virtual Bitcoins
    Portfolio Management
    Transaction History
    Integration with Coinbase API for real-time exchange rates

Contribution

We welcome contributions to the project! Please follow these steps to contribute:

    Fork the repository
    Create a new branch (git checkout -b feature/YourFeature)
    Commit your changes (git commit -m 'Add YourFeature')
    Push to the branch (git push origin feature/YourFeature)
    Create a Pull Request

License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
