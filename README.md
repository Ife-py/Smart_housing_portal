smart 
# 🏠 Smart Housing Portal: House Renting and Complaint Management System

The Smart Housing Portal is a modern web-based system developed using **Laravel** that streamlines the house renting process and simplifies complaint management between tenants and landlords. It provides a unified platform for property listing, rental management, dispute resolution, and administrative oversight.

---

## 📌 Project Overview

Urban housing often faces challenges such as poor complaint resolution, lack of transparency, and inefficient rental processes. This project is designed to provide an all-in-one solution that facilitates better communication, accountability, and management for tenants, landlords, and administrators.

This system supports:
- Property listing and rental workflows
- Secure user authentication and role-based access
- Complaint tracking and resolution
- Administrative monitoring and control

---

## 🚀 Core Features

### 🔐 Authentication & User Roles
- Secure login and registration
- Roles: Admin, Landlord, Tenant
- Email verification and password reset

### 🏠 House Renting
- List and view available houses
- Search and filter listings
- Book and track rental status

### 🛠 Complaint Management
- Tenants can submit complaints
- Landlords/admin can view and resolve complaints
- Complaint status tracking and updates
- Use of Chatbots to further enhance fast response

### 📊 Admin Dashboard
- View analytics, manage users and properties
- Approve/reject listings
- Oversee system activities

### 💬 Contact and Support
- Responsive "Contact Us" form
- Direct communication channel between stakeholders

---

## 🧱 System Architecture

- **Frontend:** Blade templating + Bootstrap 5
- **Backend:** Laravel MVC architecture
- **Database:** MySQL with Eloquent ORM
- **Authentication:** Laravel Breeze / Jetstream (or custom)
- **Security:** CSRF protection, form validation, hashed passwords

---

## 🛠 Technologies Used

| Technology      | Purpose                               |
|-----------------|----------------------------------------|
| Laravel 10.x    | Backend framework (PHP)                |
| MySQL           | Relational database                    |
| Bootstrap 5     | Responsive frontend UI framework       |
| Blade Template  | Server-side HTML rendering             |
| Git & GitHub    | Version control and collaboration      |
| Composer / NPM  | Dependency management                  |

---

## 🗂 Folder Structure


├── app/
├── public/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── auth/
│   │   ├── admin/
│   │   ├── landlord/
│   │   └── tenant/
├── routes/
│   └── web.php
├── database/
│   └── migrations/
├── .env


---

## ⚙️ Installation & Setup

### Step 1: Clone the Project
```bash
git clone https://github.com/your-username/smart-housing-portal.git
cd smart-housing-portal
````

### Step 2: Install Dependencies

```bash
composer install
npm install && npm run dev
```

### Step 3: Set Up Environment

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials.

### Step 4: Run Migrations

```bash
php artisan migrate
```

### Step 5: Serve Application

```bash
php artisan serve
```

---

## 👤 User Roles

| Role     | Permissions Summary                                       |
| -------- | --------------------------------------------------------- |
| Admin    | Full control over users, listings, complaints, settings   |
| Landlord | Can post properties, respond to complaints, view bookings |
| Tenant   | Browse, rent, and raise complaints on rented properties   |

---

## 💾 Database & Image Storage

* MySQL is recommended for data storage.
* House images and user uploads are stored in the `storage/app/public` directory and served via symbolic link from `public/storage`.
* Use `php artisan storage:link` during setup.

---

## 🔐 Security Considerations

* CSRF protection for all forms
* Hashed passwords using bcrypt
* Form validation and input sanitization
* Role-based access control
* Secure file uploads and size limits

---

## 📁 Admin Panel Overview

### Navigation Includes:

* **Dashboard**: Overview of system stats and activities
* **Manage Users**: View, edit, delete tenants and landlords
* **Manage Properties**: Approve, reject or update listings
* **Complaints**: View, assign and update complaint statuses
* **Payments**: Track rent payments and histories
* **Settings**: Update system-wide configurations

---

## 🔄 Development Methodology

We use **Agile with Scrum Framework**, which includes:

* **Sprints**: Short, time-boxed development cycles (1-2 weeks)
* **Daily Standups**: Progress tracking and blockers
* **Backlog Management**: Prioritization of tasks
* **Sprint Reviews and Retrospectives**: Feedback and improvement

This allows for flexibility, fast iteration, and high adaptability throughout the project lifecycle.

---

## 📸 Screenshots (Optional)

Include screenshots of:

* Admin dashboard
* Property listing page
* Complaint submission page
* Contact form

---

## 📧 Contact

Developed by: **Ifeoluwa .Py**
GitHub: \[[https://github.com/ife-py](https://github.com/your-username)]
Email: \[[ifeoluwaomoleke01@gmail.com](mailto:ifeoluwaomoleke01@gmail.com)]

---

## 📃 License

This project is for academic purposes and is licensed under the MIT License (or specify your preferred license if needed).

---

## 📝 Acknowledgments

Special thanks to:

* Laravel Documentation
* Bootstrap Community
* Stack Overflow Contributors
* GitHub Open Source Projects

```

```
