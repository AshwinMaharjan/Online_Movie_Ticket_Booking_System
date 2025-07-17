# Online Movie Ticket Booking System

A web-based application for booking movie tickets online, built with PHP and MySQL.

## Features

- **User Authentication**: Register, login, and manage user profiles
- **Movie Listings**: Browse current and upcoming movies with details
- **Theater Selection**: Choose from multiple theaters and showtimes
- **Seat Selection**: Interactive seat map for choosing preferred seats
- **Booking Management**: View, modify, and cancel bookings
- **Admin Panel**: Manage movies, theaters, showtimes, and view reports
- **Payment Integration**: Secure payment processing (simulated)
- **Responsive Design**: Works on desktop and mobile devices

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap
- **Backend**: PHP
- **Database**: MySQL
- **Server**: XAMPP/WAMP (Localhost)
- **Other Tools**: jQuery, AJAX

## Installation

1. **Prerequisites**:
   - XAMPP/WAMP server installed
   - PHP 7.0 or higher
   - MySQL 5.7 or higher

2. **Setup**:
   ```bash
   # Clone the repository
   git clone https://github.com/AshwinMaharjan/Online_Movie_Ticket_Booking_System.git
   
   # Move the project folder to your server's root directory (htdocs for XAMPP, www for WAMP)
   
   # Import the database
   - Open phpMyAdmin
   - Create a new database named 'dbmovies'
   - Import the SQL file from the dbmovies.sql

3. **Configuration**:
   - Update database credentials in includes/config.php
      ```bash
     define('DB_SERVER', 'localhost');
     define('DB_USERNAME', 'root');
     define('DB_PASSWORD', '');
     define('DB_NAME', 'dbmovies');
     
4. **Run**:
   - Start your Apache and MySQL servers
   - Access the application at http://localhost/cinema_hall_system
     

5. **Usage**:
  - For Users:
      - Register or login to your account
      - Browse available movies
      - Select theater, showtime, and seats
      - Complete the payment process
      - View/Manage your bookings in the dashboard
  - For Admin:
      - Login with admin credentials
      - Manage movies, theaters, and showtimes
      - View booking reports and user statistics
      - Update system settings
        
6. **Project Structure**:
    ```bash
      cinema_hall_system/
      ├── admin/            
      ├── assets/           
      ├── css/            
      ├── images/            
      ├── lib/            
      ├── qr/            
      ├── temp_qr/            
      ├── uploads/            

7. **Screenshots**:
   - Homepage:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/f4af85da-ade5-40d5-9114-ce264aee8bde" />
   - Movies:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/f16dded4-e476-40eb-80e0-5d74e4454558" />
   - Theater:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/509d6796-97db-4a8d-a58e-571bd2b7506f" />
   - Login:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/6ff1cf6e-d251-4ebe-87fd-a59c01f40871" />
   - Register:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/0d522a94-72f2-4274-8475-f828f39f30eb" />
   - Admin Dashboard:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/c2a2624a-75a2-4bdd-9f4f-305cafab463a" />
   - Admin Categories:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/469b9ed3-59e0-4399-9bc7-b06871fc5bcc" />
   - Admin Movies:
      <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/7f629a35-9228-491d-898f-e11beade8dca" />
   - Admin Theater:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/6d9da74d-aa63-439b-bddf-dfa4efa154c7" />
   - Admin Revenue:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/d70df6e2-4912-434c-818c-29f5c98253ef" />
   - Adming Managing Users:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/e0a8967a-e85e-4e86-98d8-45842eae62d4" />
   - Adming Booking:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/08ff2359-4d1d-4d7d-8c45-da681aec3744" />
   - Users Homepage:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/b2f181f1-1ac0-4392-b636-496b5884f5d4" />
   - Users Booking:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/e025fd3d-7ecd-4248-8f8b-9e35ac395e5b" />
   - Users View Ticket:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/706c3eb1-d1f6-4767-9873-9eff254717d0" />
   - Users Profile:
     <img width="1366" height="768" alt="image" src="https://github.com/user-attachments/assets/5d6e18af-f656-45af-a540-932b146883c5" />
     
8. **Contact**:
- Email: maharjan.ashwin098@gmail.com
- Instagram: https://www.instagram.com/__ashwin07__/
- Facebook: https://www.facebook.com/mhrzn.ashwin/
- GitHub: @AshwinMaharjan
