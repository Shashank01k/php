# Project_b CRUD README

# Overview
  ## Project_b is a CRUD (Create, Read, Update, Delete) system developed using the CodeIgniter framework with MySQL database. It provides functionalities for user registration, login, dashboard access, and data management.

  ## Note:  When inserting seeder data for login, use a password remember token as the password.
  
  ### CRUD System Implementation Status
  
  # Functionality
    
- [x] Login
- [x] Logout
- [x] Singal Delete
- [x] Edit
- [x] Seeder
- [ ] All Delete
- [ ] Filter
- [x] Privacy & Terms

### Screenshots

Below are screenshots showcasing various aspects of the CRUD project:


- [Link 1](https://snipboard.io/XiV7yA.jpg)
- [Link 2](https://snipboard.io/1NHQFu.jpg)
- [Link 3](https://snipboard.io/rq7SFN.jpg)
- [Link 4](https://snipboard.io/mP2v7p.jpg)
- [Link 5](https://snipboard.io/aSLVxv.jpg)
- [Link 6](https://snipboard.io/9Vpg3F.jpg)
- [Link 7](https://snipboard.io/MWkAJ6.jpg)
- [Link 8](https://snipboard.io/JQObIP.jpg)
- [Link 9](https://snipboard.io/EGCusd.jpg)
- [Link 10](https://snipboard.io/lz93jE.jpg)


Feel free to click on each screenshot to view it in full size.


# Requirements

  CodeIgniter version: v3.1.13
  PHP version: 8.2.12
  phpMyAdmin version: 5.2.1
  
# Installation

  Clone the repository to your local machine.
  
  Navigate to the project directory.
  
  Import the database schema provided in database/project_b_db.sql to your MySQL server.
  
  Configure your database connection in app/Config/Database.php with your MySQL credentials.
  
  Run the following commands to create the necessary files and migrate the database:
  
  
# bash

    php spark make:model tblUsersModel
  
    php spark make:seeder UsersModelSeeder
  
    php spark make:model states
  
    php spark make:controller web/v1/UserDeleteController
  

  # NOTE: Repeat the above command for other necessary controllers

    php spark make:migration create_users_table --resources
  
    php spark db:seed UsersModelSeeder
  
  
# Start the development server by running:

    php spark serve
  
  
# Usage

  Access the dashboard at http://localhost:8080/dashboard.
  
  User registration page: http://localhost:8080/sign_up.
  
  Login page: http://localhost:8080/sign_in.
  
  Seeder for inserting dummy users: http://localhost:8080/seeder.
  
  
# Command Reference

    php spark db:seed UsersModelSeeder: Run seeder to insert dummy users into the database.
  
    php spark make:model tblUsersModel: Create a model for the users table.
  
    php spark make:seeder UsersModelSeeder: Create a seeder for generating dummy user data.
  
    php spark make:model states: Create a model for managing states (if applicable).
  
    php spark make:controller web/v1/UserDeleteController: Create a controller for user deletion (example).
  
    php spark make:migration create_users_table --resources: Create a migration file for creating users table with necessary resources.
  
    php spark serve: Start the development server.
  

# Contributors

  SHASHANK PANDEY
  
# License

  This project is licensed under the MIT License.
