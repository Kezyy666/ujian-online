## 🚀 Langkah Instalasi

### 1. Clone Repositori
Jalankan perintah berikut untuk menyalin source code ke komputer kamu:
"git clone https://github.com/Kezyy666/ujian-online.git"
cd ujian-online
### 2. Salin file konfigurasi .env
cp .env.example .env
Kemudian buka file .env dan ubah konfigurasi database sesuai dengan pengaturan MariaDB:
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database
### 3. Install dependency Laravel (PHP):
"composer install"
### 4. Install dependency frontend (Vite, dsb.):
"npm install"
### 5. Build asset frontend:
"npm run dev"
### 6.Generate key aplikasi:
"php artisan key:generate"
### 7. Jalankan migrasi database:
"php artisan migrate"
### 8. Jalankan server lokal Laravel:
"php artisan serve"

///untuk login admin
username:admin123
password:admin
