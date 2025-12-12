# VERTEX - Inter-University Competition Event Platform

<p align="center">
  <strong>A comprehensive e-commerce platform for managing university competitions, workshops, webinars, and modules</strong>
</p>

## 📋 Table of Contents
- [Project Overview](#project-overview)
- [Features](#features)
- [Technology Stack](#technology-stack)
- [Setup Instructions](#setup-instructions)
- [Database Schema](#database-schema)
- [API Documentation](#api-documentation)
- [Usage Guide](#usage-guide)
- [Project Structure](#project-structure)

---

## 🎯 Project Overview

VERTEX is a dynamic, student-driven e-commerce platform designed to connect learners, innovators, and creators from across the globe through exciting competitions, engaging webinars, and skill-based challenges. The platform bridges the gap between education and innovation by allowing participants from various universities and disciplines to collaborate, compete, and grow together.

### Key Objectives
- Provide a centralized platform for inter-university events
- Enable easy registration and payment for competitions, workshops, and webinars
- Streamline order management for administrators
- Offer RESTful APIs for external integrations

---

## ✨ Features

### 1. **Complete CRUD Operations**
- **Modules Management**: Create, Read, Update, Delete modules/workshops/webinars/competitions
- **Order Management**: Full order lifecycle management with status tracking
- **User Management**: User registration, authentication, and profile management

### 2. **Database Relationships**
- **One-to-Many**: User → Orders
- **One-to-Many**: Order → OrderItems
- **One-to-Many**: Module → OrderItems
- All relationships properly implemented with foreign keys and cascading

### 3. **AJAX Integration**
- **Real-time Search**: Admin order search with 300ms debounce
- **Dynamic Filtering**: Searches by Order ID, Customer Name, and Email
- **No Page Reload**: Smooth user experience with dropdown results

### 4. **Image Upload with Preview**
- Client-side preview using FileReader API
- Server-side validation (JPEG, PNG, JPG, GIF, max 2MB)
- Automatic old image deletion on update

### 5. **RESTful API**
- Service layer architecture (Controller → Service → Model)
- JSON responses for all endpoints
- Complete CRUD operations via API

### 6. **Admin Panel**
- Dashboard with statistics
- Module inventory management
- Order management with status updates
- User overview

### 7. **User Features**
- Browse modules/competitions
- Shopping cart functionality
- Checkout with team member details
- Order history and tracking

---

## 🛠️ Technology Stack

- **Framework**: Laravel 11.x
- **PHP**: 8.2+
- **Database**: MySQL
- **Frontend**: Blade Templates, Bootstrap 5.3, Vanilla JavaScript
- **AJAX**: Fetch API
- **Authentication**: Laravel Breeze
- **Version Control**: Git

---

## 📦 Setup Instructions

### Prerequisites
- PHP >= 8.2
- Composer
- MySQL
- Node.js & NPM

### Installation Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/areebatariqq/VERTEX.-Laravel-Website.git
   cd VERTEX.-Laravel-Website
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   npm run build
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   - Open `.env` file
   - Update database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=vertex_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed Database (Optional)**
   ```bash
   php artisan db:seed
   ```

8. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

9. **Start Development Server**
   ```bash
   php artisan serve
   ```

10. **Access Application**
    - Frontend: http://localhost:8000
    - Admin Panel: http://localhost:8000/admin/dashboard (login required)

---

## 🗄️ Database Schema

### Tables

#### 1. **users**
- `id` - Primary Key
- `name` - User's full name
- `email` - Unique email address
- `password` - Hashed password
- `role` - Enum (admin, user)
- `timestamps`

#### 2. **modules**
- `id` - Primary Key
- `name` - Module name
- `type` - Enum (module, workshop, webinar, competition)
- `fee` - Decimal price
- `earlybird_fee` - Nullable decimal
- `team_min` - Minimum team size
- `team_max` - Maximum team size
- `duration` - Event duration
- `date` - Event date
- `description` - Text description
- `image` - Image path
- `timestamps`

#### 3. **orders**
- `id` - Primary Key
- `user_id` - Foreign Key → users
- `subtotal` - Decimal
- `tax` - Decimal
- `total_amount` - Decimal
- `status` - Enum (pending, processing, completed, cancelled)
- `payment_method` - Enum (cash, card, online)
- `notes` - Nullable text
- `timestamps`

#### 4. **order_items**
- `id` - Primary Key
- `order_id` - Foreign Key → orders
- `module_id` - Foreign Key → modules
- `module_name` - String
- `module_type` - String
- `quantity` - Integer
- `price` - Decimal
- `total` - Decimal
- `team_members` - JSON (nullable)
- `timestamps`

---

## 🔌 API Documentation

### Base URL
```
http://localhost:8000/api
```

### Module API Endpoints

#### Get All Modules
```http
GET /api/module/
```
**Response:**
```json
[
  {
    "id": 1,
    "name": "UI/UX Design",
    "type": "module",
    "fee": 3000,
    "earlybird_fee": 2500,
    ...
  }
]
```

#### Create Module
```http
POST /api/module/store
```
**Body:**
```json
{
  "name": "Speed Coding",
  "type": "module",
  "fee": 1500,
  "team_min": 1,
  "team_max": 2
}
```

#### Get Module for Edit
```http
GET /api/module/edit/{id}
```

#### Update Module
```http
POST /api/module/update
```
**Body:**
```json
{
  "id": 1,
  "name": "Updated Name",
  "fee": 2000
}
```

#### Delete Module
```http
GET /api/module/destroy/{id}
```

### Order API Endpoints

#### Get All Orders
```http
GET /api/order/
```

#### Get Single Order
```http
GET /api/order/show/{id}
```

#### Create Order
```http
POST /api/order/store
```
**Body:**
```json
{
  "user_id": 1,
  "subtotal": 3000,
  "tax": 300,
  "total_amount": 3300,
  "payment_method": "card",
  "items": [
    {
      "module_id": 1,
      "quantity": 1,
      "price": 3000
    }
  ]
}
```

#### Update Order Status
```http
POST /api/order/update
```
**Body:**
```json
{
  "id": 1,
  "status": "completed"
}
```

#### Delete Order
```http
GET /api/order/destroy/{id}
```

---

## 📖 Usage Guide

### For Regular Users

1. **Browse Modules**
   - Navigate to `/modules` to view all available competitions, workshops, and webinars

2. **Add to Cart**
   - Click on any module to view details
   - Fill in team member information
   - Click "Add to Cart"

3. **Checkout**
   - View cart at `/cart`
   - Proceed to checkout (login required)
   - Select payment method and add notes
   - Complete order

4. **Track Orders**
   - View order history at `/orders`
   - Check order status and details

### For Administrators

1. **Login**
   - Access admin panel at `/admin/dashboard`
   - Default credentials can be created via seeder

2. **Manage Modules**
   - Create new modules with image upload
   - Edit existing modules
   - Delete modules
   - Preview images before upload

3. **Manage Orders**
   - View all orders with statistics
   - Search orders using AJAX search bar
   - Update order status
   - View detailed order information
   - Delete orders if needed

4. **Dashboard**
   - View total modules, users, orders count
   - Check total revenue
   - See recent modules

---

## 📁 Project Structure

```
VERTEX.-Laravel-Website/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Api/
│   │   │   │   ├── ModuleApiController.php
│   │   │   │   └── OrderApiController.php
│   │   │   ├── Admin/
│   │   │   │   └── ModuleController.php
│   │   │   ├── AuthController.php
│   │   │   ├── OrderController.php
│   │   │   └── PageController.php
│   │   └── Middleware/
│   │       └── EnsureUserIsAdmin.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Module.php
│   │   ├── Order.php
│   │   └── OrderItem.php
│   └── Services/
│       ├── ModuleService.php
│       └── OrderService.php
├── database/
│   ├── migrations/
│   │   ├── create_users_table.php
│   │   ├── create_modules_table.php
│   │   ├── create_orders_table.php
│   │   └── create_order_items_table.php
│   └── seeders/
│       ├── ModulesTableSeeder.php
│       └── UsersTableSeeder.php
├── public/
│   ├── css/
│   ├── images/
│   │   └── modules/
│   └── videos/
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   ├── modules/
│       │   └── orders/
│       ├── auth/
│       ├── layouts/
│       └── [other views]
├── routes/
│   ├── web.php
│   └── api.php
└── README.md
```

---

## 🔑 Key Implementation Details

### AJAX Search
- **File**: `resources/views/admin/orders/index.blade.php`
- **Controller**: `OrderController::searchOrders()`
- **Features**: 300ms debounce, multi-field search, dropdown results

### Image Upload
- **Files**: `admin/modules/create.blade.php`, `admin/modules/edit.blade.php`
- **Controller**: `Admin/ModuleController.php`
- **Validation**: JPEG/PNG/JPG/GIF, max 2MB
- **Storage**: `public/images/modules/`

### API Architecture
- **Pattern**: Controller → Service → Model
- **Response Format**: JSON with success/message fields
- **Location**: `app/Http/Controllers/Api/`, `app/Services/`

---

## 👥 Contributors
- **Areeba Tariq** - Full Stack Developer

---

## 📄 License
This project is developed for educational purposes as part of Software Construction and Development course.

---

## 📞 Support
For any queries or issues, please contact through GitHub repository.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
