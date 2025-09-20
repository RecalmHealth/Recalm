# Recalm-MentalHealth 
Recalm adalah sebuah platform berbasis website yang membantu individu dalam menjaga dan meningkatkan kesehatan mental melalui konten edukatif, fitur konsultasi, serta dukungan komunitas yang aman dan nyaman.
# Rules Contributor
**Writing Rules**
- Penamaan file tidak boleh di singkat gunakan tanda `-` ketika ada spasi : `contoh : /home-page`
- Untuk penamaan file lebih baik gunakan lowercase agar konsisten
- Hindari penamaan singkat (`landing-page.blade.php`) menjadi (`lndg-pge.blade.php`)

**File Rules**
- Segala sesuatu yang berhubungan dengan gambar simpan di dalam folder `public/assets/images/`
- Folder `layouts` berfungsi untuk menyimpan file kerangka (layout utama) yang digunakan sebagai template dasar.
- Folder `review/app` berfungsi untuk menyimpan halaman inti aplikasi (fitur utama yang hanya bisa diakses setelah login atau otentikasi).
- Folder `review/components` berfungsi untuk menyimpan komponen UI pendukung yang dapat digunakan ulang di berbagai halaman.
- Folder `review/pages` berfungsi untuk menyimpan halaman umum atau public-facing yang bisa diakses tanpa login.

**Catatan Penamaan Branch**
- Silahkan membuat `branch` anda sendiri sebelum mengerjakan fitur
- contoh : `nama/feature` = `budi/landing-pages`

# Warning
- Jangan pernah menghapus folder atau file apapun yg sudah ada atau bawaan dari laravel
- Jika ingin melakukan `git push` dan pull request pada project ini silahkan lakukan `git pull` ke branch `main` terlebih dahulu di lokal komputer
- Silahkan git push ke branch anda sendiri jangan langsung ke branch `main`
- Jika terjadi konflik silahkan perbaiki terlebih dahulu sebelum `push` ke branch anda
- Jika sudah selesai semua silahkan berikan `commit` yang jelas dan `pull request` ke branch `main`

## Instalation
Clone Repository
```sh
git clone https://github.com/RecalmHealth/Recalm.git
```
Tulis perintah dibawah in untuk menginstal depedensi yang di perlukan 
```sh
composer install

npm install
```

Lalu copy file .env 
```sh
cp .env.example .env
```

Setelah itu lakukan generate key
```sh
php artisan key:generate
```

Jalankan migration dan seeder
```sh
php artisan migrate

php artisan migrate:fresh --seed
```

## Running Project
```sh
php artisan serve    

npm run dev
```
