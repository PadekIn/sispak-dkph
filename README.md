# SISPAK-DKPH Application

SISTEM PAKAR DETEKSI KERUSAKAN PADA HANDPHONE.

## Installation / Instalasi

Sebelum download project pastikan versi php minimal 8.2 atau yang paling terbaru

### Manual Setup

1.  Download project atau clone repo ke dalam komputer
2.  Jalankan perintah berikut untuk menginstal dependensi php:
    ```
    composer install
    ```
    dan jalankan perintah berikut untuk menginstall node module:
    ```
    npm i
    ```
3.  Buat file .env berdasarkan dari file .env.example dengan menjalankan perintah berikut:
    ```
    cp .env.example .env
    ```
4.  Setelah berhasil membuat file .env kita akan meng-generate key untuk dimasukkan ke APP_KEY di file .env , jalankan perintah berikut:
    ```
    php artisan key:generate
    ```
5.  Kemudian, jika aplikasi Laravel tersebut memiliki database, buatlah nama database baru. Lalu sesuaikan nama database, username, dan password database di file .env.
6.  Lalu jalankan perintah untuk meng-generate table yang dimiliki database aplikasi, caranya dengan menjalankan perintah:
    ```
    php artisan migrate
    ```
7.  Jika ingin melakukan testing atau ingin mengisi database dengan data dummym maka jalankan perintah:

    ```
    php artisan db:seed
    ```

8.  build app

    ```
    npm run build
    ```

9.  Terakhir, jalankan perintah berikut untuk menyalakan web server dan vite

    ```
    npm run dev
    ```

10. Setelah perintah di atas dijalankan, web app Anda bisa sudah bisa diakses di:
    ```
    http://localhost:8000
    ```

## Login

Untuk login aplikasi silakan masukkan surel dan kata sandi berikut

untuk admin:
| email | admin@admin.com |  
| ---------- | --------------- |
| Kata Sandi | admin123 |

untuk user:
| email | pengguna@pengguna.com |
| ---------- | --------------- |
| Kata Sandi | pengguna123 |
