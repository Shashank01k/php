# CodeIgniter User & Assignment Management

## Project Overview

A PHP CodeIgniter 4 MVC application for user management
and assignment tracking.

### Main Features

- User registration and login
- Admin authentication
- Role-based access
- User CRUD operations
- Profile management
- Assignment management
- Admin-to-user assignment
- User assignment viewing
- Form validation
- CSRF protection
- Secure password hashing

## User Roles

| User Type | Role |
|---:|---|
| 1 | Super Admin |
| 2 | Admin |
| 3 | Sub Admin |
| 4 | User |

## CRUD Flow

### User CRUD

Add User
→ Validate
→ Save
→ User List
→ Edit / Delete

### Assignment

Admin
→ Create Assignment
→ Select User
→ Save
→ User Login
→ My Assignments
→ View Assignment

## Security

- `password_hash()` for password storage
- `password_verify()` for login
- CSRF protection
- CodeIgniter Model/Query Builder
- Server-side validation
- Role-based authentication
- Session-based access control

## URLs

### Admin

- `/admin/login`
- `/admin/index`
- `/admin/profile`
- `/admin/assignments`
- `/admin/assignments/create`
- `/admin/assignments/edit/{id}`

### User

- `/users/login`
- `/users/register`
- `/users/assignments`
- `/users/assignments/view/{id}`

## Technologies

- PHP
- CodeIgniter 4
- MySQL
- Bootstrap 5
- JavaScript
- HTML5 / CSS3
- Font Awesome

## Interview Explanation

I developed this application using CodeIgniter 4 and MVC architecture.
The application provides user CRUD, authentication, role-based access,
and assignment management. Admins can create and assign tasks to users,
while users can view only their assigned tasks.
Security includes password hashing, CSRF protection, validation,
session authentication, and Query Builder-based database operations.