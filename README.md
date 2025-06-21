# ABF E-commerce Backend API

Backend for an AC service app built using **Laravel 12**, **Sanctum** for token authentication, and manual implementation of:

- User registration and login
- Password reset flow
- Product search and filtering
- Quote request feature

---

## 🧩 Features Implemented

| Feature | Description |
|--------|-------------|
| 🔐 Register / Login | API-based user authentication using Sanctum |
| 🔁 Forgot Password | Generate token, send email, verify, and reset password |
| 🛒 Product Search | Filter by brand, price range, best seller, rating |
| 💬 Quote Request | Submit form to request custom pricing |

---

## 📦 Requirements

- PHP >= 8.2
- Composer
- MySQL / SQLite / PostgreSQL
- Node.js (if using frontend build tools)

---

## 🚀 Installation

```bash
# Clone the repo
git clone https://github.com/yourusername/abf-ecommerce.git 
cd abf-ecommerce

# Install dependencies
composer install

# Copy .env file
cp .env.example .env

# Generate key
php artisan key:generate

# Run migrations
php artisan migrate
```

---

### ✅ Postman Link

.  [postman collection](https://bold-shadow-545884.postman.co/workspace/My-Workspace~b9b22a27-16b9-4ee1-8b8a-ccc5cbe44b1f/collection/33273193-80c3b29f-b980-4f96-8141-52d9fa817236?action=share&creator=33273193) .
   

---

