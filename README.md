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
   - Create a new database named 'movie_ticket_booking'
   - Import the SQL file from the database/ directory

3. **Configuration**:
   - Update database credentials in includes/config.php
     define('DB_SERVER', 'localhost');
     define('DB_USERNAME', 'your_username');
     define('DB_PASSWORD', 'your_password');
     define('DB_NAME', 'movie_ticket_booking');
     
4. **Run**:
   - Start your Apache and MySQL servers
   - Access the application at http://localhost/cinema_hall_system
     
5. **Screenshots**:
   - Homepage:
     <img width="1028" height="2528" alt="localhost_cinema_hall_system_index php" src="https://github.com/user-attachments/assets/efcf7177-bcff-44de-9cb6-002b462e3ecf" />
   - Movies:
     <img width="1028" height="2577" alt="localhost_cinema_hall_system_movies php" src="https://github.com/user-attachments/assets/9bc05fcf-47e4-4b10-a0b1-8ee1df98de79" />
   - Booking Movie:
     <img width="1028" height="1934" alt="localhost_cinema_hall_system_booking php_id=9" src="https://github.com/user-attachments/assets/a773358a-c300-4bbc-b6c5-f11b80fc5bd3" />
   - View All Booked Movies: 
     <img width="1028" height="1152" alt="localhost_cinema_hall_system_viewuserbooking php" src="https://github.com/user-attachments/assets/4b560f59-3171-4db1-be91-212948f8da34" />     
   - View Booking Ticket:
     <img width="1028" height="1436" alt="localhost_cinema_hall_system_ticket php_bookingid=14" src="https://github.com/user-attachments/assets/103e02fb-906e-44be-b31d-4eb53b0fe124" />

6. **Usage**:
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

7. **Contact**:
- Email: maharjan.ashwin098@gmail.com
- GitHub: @AshwinMaharjan
