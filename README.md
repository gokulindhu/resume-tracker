# Resume Tracker

Resume Tracker is a web application developed for managing and tracking resumes of resources. It allows administrators to input resource details such as skill sets, salary expectations, and upload resumes.

## Features

- Admin can add, update, and view resource information
- Resume upload and storage functionality
- Track skill sets and salary expectations
- Built with a clean UI using Bootstrap
- Registration and login functionality

## Tech Stack

- **Backend**: Laravel 11 (PHP)
- **Database**: MySQL
- **Frontend**: HTML, Bootstrap
- **Others**: Node.js, Composer

## Prerequisites

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL

## Installation Instructions

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/resume-tracker.git
   cd resume-tracker
2. **Install PHP dependencies using Composer:**
   ```bash
   composer install
3. **Install Node.js dependencies:**
   ```bash
   npm install
4. **Create a .env file and configure your database connection:**
   ```bash
   cp .env.example .env
5. **Run database migrations:** 
   ```bash  
   php artisan migrate
6. **Generate the application key:**    
   ```bash
   php artisan key:generate
5. **Compile assets:**
   ```bash
   npm run dev
6. Link storage:
   ```bash
   php artisan storage:link 
7. Run the application:
   ```bash
   php artisan serve