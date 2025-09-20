# Recalm-MentalHealth 
Recalm adalah sebuah platform berbasis website yang membantu individu dalam menjaga dan meningkatkan kesehatan mental melalui konten edukatif, fitur konsultasi, serta dukungan komunitas yang aman dan nyaman.
# Rules Contriobutor
**Writing Rules**
- Penamaan file tidak boleh di singkat gunakan tanda `-` ketika ada spasi : `contoh : /home-page`
- Untuk penamaan file lebih baik gunakan lowercase agar konsisten
- Hindari penamaan singkat (`landing-page.blade.php`) menjadi (`lndg-pge.blade.php`)

**Catatan Penamaan Branch**
- Silahkan membuat `branch` anda sendiri sebelum mengerjakan fitur
- contoh : `nama/feature` = `budi/landing-pages`

**File Rules**
- Segala sesuatu yang berhubungan dengan gambar simpan di dalam folder `public/assets/images/`
- Folder `layouts` Berfungsi untuk menyimpan file kerangka (layout utama) yang digunakan sebagai template dasar.
- Folder `review/app` Berfungsi untuk menyimpan halaman inti aplikasi (fitur utama yang hanya bisa diakses setelah login atau otentikasi).
- Folder `review/components` Berfungsi untuk menyimpan komponen UI pendukung yang dapat digunakan ulang di berbagai halaman.
- Folder `review/pages` Berfungsi untuk menyimpan halaman umum atau public-facing yang bisa diakses tanpa login.

# Penjelasan Environment Branch

Jangan langsung mengedit code di dalam 5 branch ini, jika ingin mengedit code harus berdasarkan aturan yang berlaku yaitu membuat branch baru.
- `main` adalah branch utama yang menyimpan versi terbaru dari aplikasi dengan fitur-fitur yang sudah digabungkan (merge).
- `develop`  merupakan branch yang berfungsi untuk menyimpan perubahan fitur-fitur yang sudah di merger untuk sementara.
- `testing` berfungsi untuk menyimpan perubahan setelah fitur-fitur tersebut di develop, lalu jika tidak ada error atau bug maka bisa langsung di merge ke brnach main.
- `staging` adalah hasil dari merging dari branch main, namun dibagian staging ini harus mengubah configurasi menjadi configurasi production, untuk mengetes apakah ada bug atau error ketika sudah di deploy untuk sementara.
- `production` adalah hasil akhir jika keseluruhan aplikasi tidak mengalami kendala lagi seperti adanya bug dan error. Hal ini juga sudah bisa di akses oleh users.

# Warning
- Jangan pernah menghapus folder atau file apapun yg sudah ada atau bawaan dari laravel
- Jika ingin melakukan `git push` dan pull request pada project ini silahkan lakukan `git pull` ke branch `main` terlebih dahulu di lokal komputer
- Silahkan git push ke branch anda sendiri jangan langsung ke branch `main` atau `develop`
- Jika terjadi konflik silahkan perbaiki terlebih dahulu sebelum `push` ke branch anda
- Jika sudah selesai semua silahkan berikan `commit` yang jelas dan `pull request` ke branch `develop`

## Instalation
Clone Repository
```sh
git clone https://github.com/Recalm-Health/Recalm.git
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
