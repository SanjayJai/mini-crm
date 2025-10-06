
# Company & Employee Management System

## About the Project

This is a **Laravel-based web application** designed to manage companies and employees efficiently.  
It supports multiple user roles with distinct permissions:

- **Admin**: Can manage all companies and employees.  
- **Company**: Can manage its profile (logo, website) and its employees.  
- **Employee**: Can view personal profile and associated company details.

---

## Features

### Admin
- List, create, edit, and delete companies.
- Dashboard with total companies and employees.

### Company
- Edit company profile (website, logo).
- Manage own employees (create, edit, delete).

### Employee
- View personal profile.
- See associated company details.

---

## Technology Stack
- **Backend**: PHP 8.2, Laravel 12.x  
- **Frontend**: Blade, Bootstrap 5  
- **Database**: MySQL  
- **Authentication**: Customized Auth  
- **File Storage**: Laravel Storage (for company logos)

---

## Installation

1. Clone the repository:
```bash
git clone https://github.com/SanjayJai/mini-crm.git
cd your-repo
Install dependencies:

bash
Copy code
composer install
npm install
npm run dev
Create .env file:

bash
Copy code
cp .env.example .env
Configure your .env database settings:

env
Copy code
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_user
DB_PASSWORD=your_password
Run migrations and seeders:

bash
Copy code
php artisan migrate --seed
Serve the application:

bash
Copy code
php artisan serve
Usage
Admin: Login to manage companies 

Company: Login to update profile and manage employees.

Employee: Login to view your profile.

Contributing
Contributions are welcome! Please fork the repository and submit pull requests.
See CONTRIBUTING.md for more information.

Code of Conduct
Please follow our Code of Conduct to ensure a welcoming community.

License
This project is open-sourced software licensed under the MIT license.

Contact
For any questions, contact Your Name at youremail@example.com.




If you want, I can **prepare a fully ready-to-push README** with **all images and placeholders pre-arranged**, so you literally just drop it in your repo and it works perfectly.  

Do you want me to do that?
