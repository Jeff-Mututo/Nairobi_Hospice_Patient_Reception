<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

# Nairobi Hospice Patient Reception System

This project was completed as part of my final year project. This uses the Laravel Framework to create a full-stack application that employs CRUD operations for staff, patients and their patient information

## Running The Application

### Install Dependencies
- Firstly, make sure you have php and composer installed.
- Navigate to project directory
`composer install`

### Project Configuration
- In the project’s root directory, locate the .env.example file.
- Create a copy of this file and rename it to .env.
- Open the .env file and configure the necessary environment variables, such as the database name: 'patientmanagement', username: 'root' and password: ''(empty)
`php artisan key:generate`
`php artisan migrate`
`php artisan db:seed`

### Launch The Project
`php artisan serve`

### Log In Credentials

#### Admin
Email: admin@gmail.com
Pass: admin1admin1

#### Test User
Email: testuser1@gmail.com
Pass: user1user1
