

# Smart Housing Portal

**Final Year Project**  
Department of Computer Science, [Ekiti State University]  
Author: Ifeoluwa [Omoleke]  
Supervisor: [Mrs Olarinde o.o]  
Academic Session: 2024/2025

Smart Housing Portal is a modern web application developed as a final year project to address the challenges of property management, tenant-landlord communication, and rental processes in Nigeria. Built with Laravel, this project demonstrates advanced web development skills and provides a robust platform for admins, landlords, and tenants to manage properties, handle complaints, process payments, and more.


## Project Objectives

- To provide a digital platform for seamless property management and communication between tenants and landlords.
- To automate rental processes, complaint tracking, and payment management.
- To demonstrate proficiency in full-stack web development using Laravel and modern UI frameworks.
- To integrate ai features to further improve complaint management.

## Features

- User authentication and role-based dashboards (Admin, Landlord, Tenant)
- Property listing and management
- Tenant and landlord management
- Complaint reporting and tracking
- Payment processing and history
- Reports and analytics dashboard
- Responsive, modern UI with Bootstrap 5
- Contact and support page
- AI chat bot 


## Screenshots

<!-- Add screenshots of your app's main pages here (Dashboard, Property Listing, Complaints, Payments, etc.) -->


## Getting Started (For Reviewers & Developers)

### Prerequisites
- PHP >= 8.0
- Composer
- Node.js & npm
- MySQL or compatible database

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/smart-housing-portal.git
   cd smart-housing-portal
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install JS dependencies:
   ```bash
   npm install && npm run build
   ```
4. Copy `.env.example` to `.env` and set your environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
5. Set up your database and update `.env` accordingly.
6. Run migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
7. Start the development server:
   ```bash
   php artisan serve
   ```


## Usage

- Access the portal at `http://localhost:8000` after running the server.
- Register as a tenant or landlord, or log in as an admin to manage the platform.
- Use the admin dashboard to manage users, properties, complaints, payments, and view analytics.

## Folder Structure

- `app/Http/Controllers` - Application controllers
- `resources/views` - Blade templates for UI
- `routes/web.php` - Web routes
- `public/` - Public assets


## Acknowledgements

- This project was completed as part of the requirements for the award of B.Sc. in Computer Science.
- Special thanks to my supervisor, [Supervisor Name], and all lecturers who provided guidance.

## Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change. This project is primarily for academic demonstration.


## License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).
