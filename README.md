# LaraShop - E-Commerce Laravel Application

LaraShop adalah aplikasi e-commerce lengkap yang dibangun dengan Laravel 12, menampilkan panel admin yang komprehensif, manajemen produk, sistem keranjang belanja dengan persistensi database, dan pelacakan transaksi real-time.

## ✨ Fitur Utama

### Untuk Customer
- 🛍️ **Katalog Produk** - Jelajahi produk dengan filter kategori, pencarian, dan pengurutan
- 🛒 **Keranjang Belanja Persisten** - Keranjang tersimpan di database, tidak hilang setelah logout
- 💳 **Checkout Aman** - Validasi stok real-time dan pemrosesan transaksi
- 📦 **Riwayat Pesanan** - Lacak semua pesanan dan detail transaksi Anda
- 📊 **Update Harga Real-time** - Kalkulasi harga otomatis saat mengubah quantity

### Untuk Admin
- 📊 **Dashboard Statistik** - Ringkasan penjualan, produk, dan profit
- 🏷️ **Manajemen Kategori** - CRUD lengkap untuk kategori produk
- 📦 **Manajemen Produk** - Kelola produk dengan gambar, harga, cost, dan stok
- 💰 **Laporan Transaksi** - Lihat semua transaksi dengan detail lengkap
- 📈 **Analytics** - Top selling products dan sales overtime dengan kalkulasi profit
- 👥 **Role-Based Access** - Pemisahan akses admin dan customer

## 🛠️ Teknologi yang Digunakan

- **Framework**: Laravel 12.47.0
- **PHP**: 8.4.7
- **Frontend**: Tailwind CSS v3.4.19 + Alpine.js
- **Build Tool**: Vite 7.3.1
- **Database**: MySQL
- **Authentication**: Laravel Breeze

## 📋 Persyaratan Sistem

Pastikan sistem Anda memiliki:
- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL
- Git

## 🚀 Cara Menjalankan Projek di Lokal

### 1. Clone Repository

```bash
git clone <repository-url>
cd larashop
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Konfigurasi Environment

```bash
# Copy file .env.example menjadi .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larashop
DB_USERNAME=root
DB_PASSWORD=
```

Buat database baru di MySQL:

```sql
CREATE DATABASE larashop;
```

### 5. Jalankan Migration dan Seeder

```bash
# Jalankan migration dan seeder sekaligus
php artisan migrate:fresh --seed
```

Seeder akan membuat:
- **User Admin**: email: `admin@example.com`, password: `password`
- **User Customer**: email: `user@example.com`, password: `password`
- **6 Kategori**: Electronics, Fashion, Home & Living, Books, Sports, Food & Beverage
- **23 Produk** dengan data realistis (nama, harga, stok, gambar)

### 6. Buat Symbolic Link untuk Storage

```bash
php artisan storage:link
```

### 7. Jalankan Development Server

Buka **2 terminal** dan jalankan:

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Dev Server (untuk Tailwind CSS):**
```bash
npm run dev
```

### 8. Akses Aplikasi

Buka browser dan akses:
- **Website**: http://localhost:8000

## 🔐 Login Credentials

### Admin
- Email: `admin@example.com`
- Password: `password`
- Akses: Dashboard Admin dengan full analytics dan manajemen

### Customer
- Email: `user@example.com`
- Password: `password`
- Akses: Shopping, cart, dan order tracking

## 📁 Struktur Projek

```
larashop/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/           # Admin controllers
│   │   └── CartController.php
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database schema
│   └── seeders/            # Data seeders
├── resources/
│   ├── views/
│   │   ├── admin/          # Admin panel views
│   │   ├── cart/           # Cart views
│   │   ├── products/       # Product catalog
│   │   └── transactions/   # Order history
│   ├── css/
│   └── js/
├── routes/
│   └── web.php            # Application routes
└── public/
    └── storage/           # Public storage (images)
```

## 🎯 Fitur Database

### Tables
- **users** - User authentication dengan role (admin/user)
- **categories** - Kategori produk
- **products** - Produk dengan harga, cost, stok, dan gambar
- **carts** - Keranjang belanja per user
- **cart_items** - Item dalam keranjang (persisten)
- **transactions** - Header transaksi
- **transaction_details** - Detail item per transaksi

### Relasi
- User hasOne Cart
- Cart hasMany CartItems
- Product hasMany CartItems
- Transaction hasMany TransactionDetails

## 🔧 Troubleshooting

### Tailwind CSS tidak muncul
```bash
npm run dev
```
Pastikan Vite dev server berjalan di terminal terpisah.

### Error "Route [welcome] not defined"
Sudah diperbaiki - route welcome di-redirect ke products.index.

### Keranjang hilang setelah logout
Sudah diperbaiki dengan database-backed cart. Keranjang sekarang persisten.

### Error migration
```bash
php artisan migrate:fresh --seed
```
Reset database dan jalankan ulang migration.

## 📝 Catatan Pengembangan

- **Real-time Cart Updates**: Menggunakan JavaScript untuk update harga tanpa reload
- **Profit Tracking**: Admin dapat melihat profit per produk dan per periode
- **Stock Validation**: Validasi stok real-time saat checkout
- **Persistent Cart**: Cart tersimpan di database, tidak di session

## 📄 License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
