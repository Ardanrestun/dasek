# 📚 DASEK - School Management System

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red.svg" alt="Laravel Version">
  <img src="https://img.shields.io/badge/Livewire-3.x-blue.svg" alt="Livewire Version">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP Version">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-green.svg" alt="TailwindCSS Version">
  <img src="https://img.shields.io/badge/PostgreSQL-Supported-orange.svg" alt="Database">
</div>

## 📖 Tentang Aplikasi

**DASEK** adalah sistem manajemen sekolah modern yang dibangun dengan Laravel dan Livewire. Aplikasi ini dirancang untuk mengelola data siswa, guru, dan kelas dengan antarmuka yang responsif dan user-friendly.

### ✨ Fitur Utama

- 🔐 **Sistem Autentikasi Multi-Role** (Super Admin, Guru, Siswa)
- 👥 **Manajemen Data Siswa** - CRUD lengkap dengan validasi
- 👨‍🏫 **Manajemen Data Guru** - Termasuk assignment kelas
- 🏫 **Manajemen Kelas** - Organisasi kelas dengan relasi
- ⚙️ **Pengaturan Profil** - Update profil dan password
- 🔔 **Notifikasi Toast** - Feedback real-time untuk user
- 📱 **Responsive Design** - Desktop dan mobile friendly
- ⚡ **Real-time Updates** - Powered by Livewire
- 🔍 **Search & Filter** - Pencarian data yang powerful
- ✅ **Konfirmasi Delete** - Safety confirmation untuk operasi berbahaya

## 🛠️ Tech Stack

### Backend
- **Laravel 12.x** - PHP Framework
- **Livewire 3.x** - Full-stack framework untuk Laravel
- **PostgreSQL** - Database dengan schema support
- **PHP 8.2+** - Server-side language

### Frontend
- **TailwindCSS 3.x** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Blade Templates** - Laravel templating engine
- **Heroicons** - Beautiful SVG icons

### Additional Packages
- **usernotnull/tall-toasts** - Toast notifications
- **Laravel Vite** - Modern build tool
- **UUID** - Primary keys untuk better security

## 📋 Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM atau Yarn
- PostgreSQL >= 12.x
- Git

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/Ardanrestun/dasek.git
cd dasek
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=dasek
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Database Migration & Seeding

```bash
# Create database (pastikan PostgreSQL sudah running)
createdb dasek

# Run migrations
php artisan migrate

# Seed database dengan data sample
php artisan db:seed
```

### 6. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 7. Start Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 👤 Default Users

Setelah seeding, Anda dapat login dengan akun berikut:

| Role | Email | Password | Deskripsi |
|------|-------|----------|-----------|
| Super Admin | admin@school.com | password123 | Full access ke semua fitur |
| Guru | ahmad.wijaya@school.com | password123 | Access terbatas untuk guru |
| Siswa | siswa1@school.com | password123 | Access untuk siswa |

## 📁 Struktur Database

### Schema `access`
- **users** - Data pengguna sistem
- **roles** - Role-based access control
- **sessions** - Session management

### Schema `public`
- **kelas** - Data kelas sekolah
- **siswa** - Data siswa dengan relasi ke users & kelas
- **guru** - Data guru dengan relasi ke users
- **kelas_guru** - Pivot table untuk many-to-many guru-kelas

## 🎯 Fitur Berdasarkan Role

### Super Admin
- ✅ Manajemen semua data (Kelas, Siswa, Guru)
- ✅ CRUD operations penuh
- ✅ Dashboard dengan overview
- ✅ Settings dan profile management

### Guru
- ✅ Settings profile

### Siswa
- ✅ Settings profile

---

<div align="center">
  Dibuat oleh Ardan Restu Nugroho
</div>