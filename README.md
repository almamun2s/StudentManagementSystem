# School Management System

The School Management System is a web-based application built using PHP that facilitates the management and administration tasks within educational institutions. It provides functionalities for managing students, teachers, classes, tests and more.

## Features

- **User Management**: Admins can manage users including students, teachers, and staff members.
- **Student Information**: Track student information such as personal details, academic performance and more.
- **Teacher Information**: Manage teacher profiles, subjects taught, and other relevant details.
- **Gradebook**: Record and manage student grades for various classes and tests.

## Installation

1. Clone the repository to your local machine:

    ```
    git clone https://github.com/almamun2s/StudentManagementSystem.git
    ```

2. Import the provided SQL file into your database management system (such as MySQL) to create the necessary tables and data:

    ```sql
    mysql -u username -p database_name < database.sql
    ```

3. Configure the database connection settings by editing the `config.php` file located in the `private/core` directory:

    ```php
    define('DBHOST', 'localhost');
    define('DBNAME', 'school');
    define('DBUSER', 'admin');
    define('DBPASS', 'admin');
    define('DBDRIVER', 'mysql');
    ```

4. Navigate to the project directory in your web server's document root and start the server. Or you can define your ROOT 

    ```php
    define('ROOT', 'http://localhost/Projects/StudentManagementSystem/' );
    ```

5. Access the application through your web browser:

    ```
    http://localhost/Projects/StudentManagementSystem/
    ```

## Usage

1. **Admin Dashboard**: Log in as an admin to access the admin dashboard where you can manage users, tests, announcements, and more.

2. **Teacher Panel**: Teachers can log in to view their class schedules, enter grades, and access student profiles.

3. **Student Portal**: Students can log in to view their course schedule, grades, available tests and announcements.

## Contributing

Contributions are welcome! If you would like to contribute to the project, please fork the repository and submit a pull request with your changes.
