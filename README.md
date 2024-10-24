# Employment Management System

Welcome to the Employment Management System. This comprehensive system aids organizations in efficiently managing various aspects such as employee attendance, profiles, salaries, and other related tasks. It also features modules for leave management, performance reviews, and payroll processing, ensuring a holistic approach to human resource management.

## Features

- **Employee Profiles**: Maintain detailed profiles including personal information, job roles, and contact details.
- **Attendance Tracking**: Monitor employee check-ins and check-outs to manage attendance records accurately.
- **Salary Management**: Automate payroll calculations and generate payslips for employees.
- **Leave Management**: Manage leave requests and approvals, and keep track of all types of leaves.
- **Performance Reviews**: Set up and manage periodic performance evaluations.
- **User Access Control**: Define roles and permissions to control access to sensitive information within the system.

## Installation

To set up the Employment Management System on your local machine, follow these steps:

### Prerequisites

- PHP >= 7.3
- Composer
- Laravel 8
- A database system (MySQL, PostgreSQL)

### Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/your-repository/employment-management-system.git
   cd employment-management-system
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Set up environment variables**

   Copy the `.env.example` file to a new file named `.env` and update the database and other configurations as necessary.

   ```bash
   cp .env.example .env
   ```

4. **Generate application key**

   ```bash
   php artisan key:generate
   ```

5. **Run database migrations and seeders**

   ```bash
   php artisan migrate --seed
   ```

6. **Start the server**

   ```bash
   php artisan serve
   ```

   The application will be available at `http://localhost:8000`.

## Usage

Log in to the system using the credentials provided by the system administrator. Navigate through the dashboard to manage users, attendances, and other resources.

Thank you for choosing Employment Management System for your organization's needs.

Admin Login Credentials:
- Email: admin@material.com
- Password: secret
