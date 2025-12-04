# Sistem Informasi Manajemen Aset

Aplikasi web untuk mengelola dan mencatat data aset organisasi termasuk tanah, bangunan, ruangan, dan barang-barang.

## Fitur Utama

- **Autentikasi Pengguna**: Sistem login dan register dengan keamanan password bcrypt
- **Manajemen Aset**: CRUD operasi untuk:
  - Tanah (Lahan)
  - Bangunan
  - Ruangan
  - Barang/Peralatan
  - Kategori
- **Manajemen Pengguna**: Kelola data pengguna dengan role-based access
- **Dashboard**: Ringkasan statistik aset dan aktivitas sistem
- **Responsive Design**: Interface dengan tema hijau yang modern dan user-friendly

## Tech Stack

- **Framework**: Laravel 12
- **Database**: MySQL
- **Frontend**: Blade Templating Engine
- **Build Tool**: Vite
- **Authentication**: Laravel Auth (built-in)

## Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL 5.7+
- Node.js & npm
- Laragon (atau web server lainnya)

### Langkah Instalasi

1. **Clone atau ekstrak project**
   ```bash
   cd c:\laragon\www\projek-dzk28
   ```

2. **Install dependencies PHP**
   ```bash
   composer install
   ```

3. **Setup environment file**
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**
   ```bash
   php artisan key:generate
   ```

5. **Konfigurasi database** - Edit file `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel12
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Install dependencies Node.js**
   ```bash
   npm install
   ```

7. **Jalankan migrasi database**
   ```bash
   php artisan migrate
   ```

8. **Jalankan seeder (opsional)**
   ```bash
   php artisan db:seed
   ```

9. **Build frontend assets**
   ```bash
   npm run build
   ```
   
   Atau untuk development dengan hot reload:
   ```bash
   npm run dev
   ```

10. **Jalankan aplikasi**
    ```bash
    php artisan serve
    ```
    
    Akses aplikasi di: `http://127.0.0.1:8000`

## Struktur Project

```
projek-dzk28/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php      # Login & Register
│   │   │   ├── TanahController.php     # Manage Tanah
│   │   │   ├── BangunanController.php  # Manage Bangunan
│   │   │   ├── RuanganController.php   # Manage Ruangan
│   │   │   ├── BarangController.php    # Manage Barang
│   │   │   ├── KategoriController.php  # Manage Kategori
│   │   │   └── UsersController.php     # Manage Users
│   │   └── Middleware/
│   └── Models/
│       ├── User.php
│       ├── Tanah.php
│       ├── Bangunan.php
│       ├── Ruangan.php
│       ├── Barang.php
│       └── Kategori.php
├── database/
│   ├── migrations/      # Database schema files
│   ├── seeders/         # Database seeders
│   └── factories/       # Model factories
├── resources/
│   ├── css/             # CSS files
│   ├── js/              # JavaScript files
│   └── views/
│       ├── auth/        # Login & Register pages
│       ├── layouts/     # Layout templates
│       ├── tanah/       # Tanah CRUD views
│       ├── bangunan/    # Bangunan CRUD views
│       ├── ruangan/     # Ruangan CRUD views
│       ├── barang/      # Barang CRUD views
│       ├── kategori/    # Kategori CRUD views
│       ├── users/       # User management views
│       └── dashboard.blade.php
├── routes/
│   ├── web.php          # Web routes
│   └── console.php      # Console routes
├── public/              # Static files
├── storage/             # File storage
├── tests/               # Unit & feature tests
└── vendor/              # Composer packages
```

## Routing

### Public Routes (Tanpa Login)
- `GET /` → Redirect ke login
- `GET /login` → Halaman login
- `POST /login` → Proses login (route name: `login.process`)
- `GET /register` → Halaman register
- `POST /register` → Proses register (route name: `register.process`)

### Protected Routes (Memerlukan Login)
- `POST /logout` → Logout user
- `GET /dashboard` → Dashboard
- `GET|POST /tanah` → CRUD Tanah
- `GET|POST /bangunan` → CRUD Bangunan
- `GET|POST /ruangan` → CRUD Ruangan
- `GET|POST /barang` → CRUD Barang
- `GET|POST /kategori` → CRUD Kategori
- `GET|DELETE /users` → Manage Users

## User Roles

- **Admin**: Akses penuh ke semua fitur
- **User**: Akses ke fitur standard (default role)

## Database Schema

### Users Table
| Kolom | Type | Nullable | Default |
|-------|------|----------|---------|
| id | int | No | Auto Increment |
| name | varchar | No | - |
| email | varchar | No | Unique |
| password | varchar | No | - |
| role | varchar | No | 'user' |
| email_verified_at | timestamp | Yes | NULL |
| remember_token | varchar | Yes | NULL |
| created_at | timestamp | No | - |
| updated_at | timestamp | No | - |

### Tanah Table
| Kolom | Type | Nullable |
|-------|------|----------|
| id | int | No |
| nama_tanah | varchar | No |
| lokasi | text | No |
| luas | integer | No |
| kondisi | varchar | No |
| created_at | timestamp | No |
| updated_at | timestamp | No |

### Bangunan Table
| Kolom | Type | Nullable |
|-------|------|----------|
| id | int | No |
| nama_bangunan | varchar | No |
| lokasi | text | No |
| luas | integer | No |
| tahun_pembangunan | integer | No |
| kondisi | varchar | No |
| created_at | timestamp | No |
| updated_at | timestamp | No |

### Ruangan Table
| Kolom | Type | Nullable |
|-------|------|----------|
| id | int | No |
| nama_ruangan | varchar | No |
| lokasi | text | No |
| luas | integer | No |
| kondisi | varchar | No |
| created_at | timestamp | No |
| updated_at | timestamp | No |

### Barang Table
| Kolom | Type | Nullable |
|-------|------|----------|
| id | int | No |
| nama_barang | varchar | No |
| kategori_id | int | No |
| kondisi | varchar | No |
| lokasi | text | No |
| created_at | timestamp | No |
| updated_at | timestamp | No |

### Kategori Table
| Kolom | Type | Nullable |
|-------|------|----------|
| id | int | No |
| nama_kategori | varchar | No |
| deskripsi | text | Yes |
| created_at | timestamp | No |
| updated_at | timestamp | No |

## User Credentials Default

Jika menggunakan seeder, gunakan akun ini:
```
Email: admin@example.com
Password: password
Role: user
```

Silakan buat akun baru melalui halaman register untuk pengguna tambahan.

## Fitur Keamanan

- ✅ Password hashing dengan bcrypt
- ✅ CSRF protection on all forms
- ✅ Session management
- ✅ Middleware authentication untuk routes terlindungi
- ✅ SQL injection prevention via Eloquent ORM
- ✅ Secure logout dengan session invalidation dan token regeneration

## Styling & UI

- Tema warna hijau (#157347) sebagai primary color
- Hover color (#0f5a37) untuk interaksi
- Responsive design untuk desktop dan mobile
- Custom CSS dengan inline styles untuk consistency
- Alert system untuk success (hijau #28a745) dan error (merah #dc3545) messages
- Table styling dengan striped rows dan hover effects
- Form styling dengan proper validation feedback
- Button styling dengan transitions dan hover effects

## Development

### Menjalankan dalam development mode
```bash
# Terminal 1 - Development server
npm run dev

# Terminal 2 - PHP server
php artisan serve
```

### Membuat migration baru
```bash
php artisan make:migration create_table_name
php artisan migrate
```

### Membuat model baru
```bash
php artisan make:model ModelName -m
```

### Membuat controller baru
```bash
php artisan make:controller ControllerName
```

### View all routes
```bash
php artisan route:list
```

## Troubleshooting

### Route [login.process] not defined
- Pastikan routes di `routes/web.php` memiliki nama dengan `.name('login.process')`
- Jalankan `php artisan route:list` untuk verifikasi

### Route tidak ditemukan
- Pastikan nama route sesuai dengan route definition di `routes/web.php`
- Lakukan `php artisan route:list` untuk melihat semua route
- Clear route cache: `php artisan route:clear`

### Database error
- Pastikan koneksi database di `.env` sudah benar
- Jalankan `php artisan migrate` untuk membuat tables
- Cek bahwa database sudah dibuat di MySQL
- Verifikasi database name, username, dan password

### Assets tidak terupdate
- Jalankan `npm run build` untuk production
- Atau `npm run dev` dengan --watch untuk development
- Clear browser cache (Ctrl+Shift+Delete)

### CSRF token error
- Pastikan form memiliki `@csrf` directive
- Clear browser cache dan cookies
- Verifikasi session configuration di `config/session.php`

### Unable to read file error
- Pastikan path file benar dan ada di workspace
- Verify file permissions
- Check if file exists before reading

## API Endpoints

Berikut adalah endpoint yang tersedia:

### Authentication
- `POST /login` → Login user
- `POST /register` → Register user
- `POST /logout` → Logout user

### Tanah Management
- `GET /tanah` → List semua tanah
- `GET /tanah/create` → Halaman create tanah
- `POST /tanah` → Store tanah baru
- `GET /tanah/{id}/edit` → Halaman edit tanah
- `PUT /tanah/{id}` → Update tanah
- `DELETE /tanah/{id}` → Delete tanah

### Bangunan Management
- `GET /bangunan` → List semua bangunan
- `GET /bangunan/create` → Halaman create bangunan
- `POST /bangunan` → Store bangunan baru
- `GET /bangunan/{id}/edit` → Halaman edit bangunan
- `PUT /bangunan/{id}` → Update bangunan
- `DELETE /bangunan/{id}` → Delete bangunan

### Ruangan Management
- `GET /ruangan` → List semua ruangan
- `GET /ruangan/create` → Halaman create ruangan
- `POST /ruangan` → Store ruangan baru
- `GET /ruangan/{id}/edit` → Halaman edit ruangan
- `PUT /ruangan/{id}` → Update ruangan
- `DELETE /ruangan/{id}` → Delete ruangan

### Barang Management
- `GET /barang` → List semua barang
- `GET /barang/create` → Halaman create barang
- `POST /barang` → Store barang baru
- `GET /barang/{id}/edit` → Halaman edit barang
- `PUT /barang/{id}` → Update barang
- `DELETE /barang/{id}` → Delete barang

### Kategori Management
- `GET /kategori` → List semua kategori
- `GET /kategori/create` → Halaman create kategori
- `POST /kategori` → Store kategori baru
- `GET /kategori/{id}/edit` → Halaman edit kategori
- `PUT /kategori/{id}` → Update kategori
- `DELETE /kategori/{id}` → Delete kategori

### Users Management
- `GET /users` → List semua users
- `DELETE /users/{id}` → Delete user

## Git Commands

### Initialize git dan push ke repository
```bash
# Initialize git
git init

# Add all files
git add .

# Commit
git commit -m "Initial commit - Asset Management System"

# Add remote origin
git remote add origin https://github.com/username/projek-dzk28.git

# Push to repository
git push -u origin master
```

## Performance Tips

1. **Database Optimization**
   - Gunakan eager loading untuk prevent N+1 queries
   - Tambahkan index pada foreign keys
   - Optimize complex queries

2. **Caching**
   - Implement caching untuk data yang jarang berubah
   - Gunakan Redis jika tersedia

3. **Asset Optimization**
   - Minify CSS dan JS dengan `npm run build`
   - Compress images sebelum upload
   - Lazy load images jika ada

4. **Code Quality**
   - Follow PSR-12 coding standards
   - Gunakan meaningful variable dan method names
   - Add comments untuk logic yang kompleks

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support & Contact

Untuk pertanyaan atau issue:
- Buat issue di GitHub repository
- Email: support@example.com
- Documentation: Check the docs folder

---

**Project Name**: Sistem Informasi Manajemen Aset
**Last Updated**: December 4, 2025
**Version**: 1.0.0
**Author**: Dzikril28
**Status**: Active Development
