<p align="center">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

# Nairobi Hospice Patient Reception System

This project was completed as part of my final year project. This uses the Laravel Framework to create a full-stack application that employs CRUD operations for staff, patients and their patient information

## Running The Application

### Download Tools
- Firstly, make sure you have PHP v8.1 or HIGHER installed on your machine
- Download [Composer](https://getcomposer.org/)
- Download [NodeJS](https://nodejs.org/en)

### Install Dependencies
- Navigate to the project directory where all the files are located. For example: C:\Users\User\MyProject
`composer install`
`npm install`

### Database Setup
- Create a new database with whatever name and credentials you want

### Project Configuration
- In the project’s directory, locate the *.env.example* file.
- Create a copy of this file and rename it to *.env*
- Open the .env file and configure the necessary database variables
![screenshot of the .env file](public\images\example_env.png)
- Now run the following commands
`php artisan key:generate`
`php artisan migrate`
`php artisan db:seed`
- Your DB is now created with some placeholder logins to get you started

### Launch The Project
- Leave these commands running in 2 separate terminal windows
`npm run dev`
`php artisan serve`

### Log In Credentials

#### Admin
- Email: admin@gmail.com
- Pass: admin1admin1

#### Test User
- Email: testuser1@gmail.com
- Pass: user1user1
