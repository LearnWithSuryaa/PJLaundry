# PJ Laundry – Web Application Project

![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![MVC Architecture](https://img.shields.io/badge/Architecture-MVC-FF6B6B?style=for-the-badge)
![Status](https://img.shields.io/badge/Status-Active_Development-success?style=for-the-badge)

Repositori ini berisi seluruh materi, latihan, dan tahapan pengembangan aplikasi web **PJ Laundry** ("Cuci Bersih, Higienis, & Tanpa Drama"). Proyek ini mendokumentasikan proses evolusi rekayasa web secara bertahap dari pemahaman dasar HTML/CSS, utilitas modern, interaktivitas DOM, pemrosesan sisi server (PHP dasar), Pemrograman Berorientasi Objek (OOP), hingga implementasi arsitektur **Model-View-Controller (MVC)** yang terstruktur dan siap skala.

---

## Daftar Isi

1. [Ringkasan Proyek](#ringkasan-proyek)
2. [Evolusi & Perkembangan Mingguan](#evolusi--perkembangan-mingguan)
   - [Week 1 & 2: Dasar HTML5 & CSS3](#week-1--2-dasar-html5--css3)
   - [Week 3: Utility-First CSS (Tailwind CDN)](#week-3-utility-first-css-tailwind-cdn)
   - [Week 4: JavaScript Interactivity, JSON Data & Node.js](#week-4-javascript-interactivity-json-data--nodejs)
   - [Week 5: PHP Dasar & Server-Side Rendering (SSR)](#week-5-php-dasar--server-side-rendering-ssr)
   - [Week 6: PHP Object-Oriented Programming (OOP)](#week-6-php-object-oriented-programming-oop)
   - [Week 7: Arsitektur MVC & Front Controller (Current Sprint)](#week-7-arsitektur-mvc--front-controller-current-sprint)
3. [Struktur Direktori Repositori](#struktur-direktori-repositori)
4. [Teknologi yang Digunakan](#teknologi-yang-digunakan)
5. [Panduan Instalasi & Menjalankan Proyek](#panduan-instalasi--menjalankan-proyek)
6. [Fitur Unggulan](#fitur-unggulan)
7. [Tim Pengembang](#tim-pengembang)

---

## Ringkasan Proyek

**PJ Laundry** adalah sistem web profil bisnis dan katalog layanan laundry komprehensif yang melayani cucian pakaian harian (kiloan), pakaian khusus/satuan (jas, dress, kebaya), perlengkapan rumah tangga (sprei, selimut), serta pembersihan sepatu dan karpet premium.

Proyek ini dirancang untuk menunjukkan:
- Transformasi dari halaman statis ke aplikasi berbasis *server-side rendering*.
- Refaktorisasi bertahap (*incremental refactoring*) dari kode prosedural monolitik menuju arsitektur MVC terpisah.
- Penerapan standar keamanan dasar (*XSS mitigation*, *strict typing*, enkapsulasi objek).

Akses utama root (`/index.php`) secara otomatis mengarahkan pengunjung ke implementasi sprint terkini (**Week 7 - MVC Edition**).

---

## Evolusi & Perkembangan Mingguan

### Week 1 & 2: Dasar HTML5 & CSS3
- **Direktori:** [`week-2/`](./week-2/)
- **Fokus:** Struktur semantik HTML5 dan penataan layout menggunakan CSS native murni.
- **Fitur & Capaian:**
  - Penataan tata letak menggunakan Flexbox dan CSS Grid.
  - Form estimasi dan pemesanan layanan.
  - Kompatibilitas tampilan desktop dan mobile.

### Week 3: Utility-First CSS (Tailwind CDN)
- **Direktori:** [`week-3/`](./week-3/)
- **Fokus:** Modernisasi antarmuka pengguna dengan framework utilitas Tailwind CSS.
- **Fitur & Capaian:**
  - Integrasi tipografi Google Fonts (*Outfit* & *Playfair Display*).
  - Skema warna elegan berbasis identitas laundry (*teal*, *amber/yellow*, dan *slate*).
  - Pemanfaatan utility classes untuk responsivitas tanpa file CSS manual yang besar.

### Week 4: JavaScript Interactivity, JSON Data & Node.js
- **Direktori:** [`week-4/`](./week-4/)
- **Fokus:** Pemisahan data dan logika presentasi menggunakan format JSON serta penanganan event DOM dinamis.
- **Fitur & Capaian:**
  - Ekstraksi katalog layanan ke berkas [`data/services.json`](./week-4/data/services.json).
  - Pembangunan pipeline aset menggunakan Tailwind CLI (`@tailwindcss/cli`).
  - Server statis berbasis Node.js & Express ([`server.js`](./week-4/server.js)).
  - Interaksi tab kategori layanan dan akordion FAQ dinamis melalui JavaScript vanilla.

### Week 5: PHP Dasar & Server-Side Rendering (SSR)
- **Direktori:** [`week-5/`](./week-5/)
- **Fokus:** Migrasi ke pemrosesan sisi server menggunakan bahasa PHP.
- **Fitur & Capaian:**
  - Pemisahan data ke dalam array PHP terstruktur di [`includes/data.php`](./week-5/includes/data.php).
  - Rendering dinamis kartu layanan menggunakan perulangan `foreach`.
  - Penulisan fungsi pembantu untuk sanitasi HTML sederhana.

### Week 6: PHP Object-Oriented Programming (OOP)
- **Direktori:** [`week-6/`](./week-6/)
- **Fokus:** Penerapan konsep dasar Pemrograman Berorientasi Objek.
- **Fitur & Capaian:**
  - Pembuatan class [`LaundryService`](./week-6/includes/LaundryService.php) dengan *Constructor Property Promotion* PHP 8.
  - Enkapsulasi data layanan laundry melalui metode *getter*.
  - Pemetaan array data mentah menjadi koleksi objek instansiasi class.

### Week 7: Arsitektur MVC & Front Controller (Current Sprint)
- **Direktori:** [`week-7/`](./week-7/)
- **Fokus:** Pemisahan kode skala profesional menggunakan arsitektur **Model-View-Controller (MVC)**.
- **Arsitektur & Komponen:**
  - **Front Controller (`index.php`):** *Single entry point* yang menangani routing aksi melalui query string (e.g. `?action=index`) serta registrasi autoloader dinamis (`spl_autoload_register`).
  - **Controllers (`controllers/`):**
    - `BaseController.php`: Controller induk yang menyediakan mesin render template (`render()`) dan partial view (`partial()`).
    - `LaundryController.php`: Menangani permintaan halaman beranda, pengelompokan kategori, filter tab aktif, serta opsi respons JSON (`?format=json`).
  - **Models (`models/`):**
    - `LaundryModel.php`: Berfungsi sebagai repositori data layanan, menyediakan metode `getAll()`, `getByCategory()`, `getGroupedByCategory()`, dan `findByName()`.
    - `LaundryService.php`: Entity model dengan tipe data ketat (*strict types*) dan metode serialisasi `toArray()`.
  - **Helpers (`helpers/`):**
    - `ViewHelper.php`: Menyediakan fungsi utilitas statis untuk pencegahan XSS (`escape()`) dan pembuat markup ikon Lucide (`lucideIcon()`).
  - **Views (`views/`):**
    - `layouts/header.php` & `layouts/footer.php`: Struktur tata letak global.
    - `home.php`: Template halaman utama.
    - `partials/`: Komponen UI modular terpisah (`hero.php`, `services.php`, `service_card.php`, `rules.php`, `flow.php`, `faq.php`).

---

## Struktur Direktori Repositori

```text
project_web/
├── index.php                      # Root Entrypoint: redirect otomatis ke sprint aktif (week-7/)
├── .gitignore                     # Konfigurasi file yang diabaikan Git
├── README.md                      # Dokumentasi komprehensif proyek
│
├── assets/                        # Aset gambar global bersama
│   ├── hero.png
│   └── hero-2.png
│
├── week-2/                        # Sprint 01 & 02: Fondasi HTML5 & CSS3 Native
│   ├── index.html
│   ├── 1.html / 2.html
│   └── style.css / 2.css
│
├── week-3/                        # Sprint 03: Tailwind CSS via CDN
│   └── index.html
│
├── week-4/                        # Sprint 04: Interaktivitas JS, Node.js & Tailwind CLI
│   ├── package.json
│   ├── server.js                  # Express static server
│   ├── script.js
│   ├── data/
│   │   └── services.json          # Dataset JSON
│   └── src/
│       ├── index.html
│       ├── input.css
│       └── output.css
│
├── week-5/                        # Sprint 05: PHP Dasar & Server-Side Rendering
│   ├── index.php
│   ├── script.js
│   ├── assets/
│   └── includes/
│       └── data.php
│
├── week-6/                        # Sprint 06: Pemrograman Berorientasi Objek (OOP)
│   ├── index.php
│   ├── script.js
│   ├── assets/
│   └── includes/
│       ├── LaundryService.php     # Model entity class
│       └── data.php
│
└── week-7/                        # Sprint 07: Arsitektur MVC Komprehensif
    ├── index.php                  # Front Controller & Autoloader
    ├── script.js                  # Skrip interaksi UI
    ├── assets/                    # Stylesheet & Gambar lokal
    │   ├── css/style.css
    │   └── images/
    ├── controllers/               # Lapisan Controller
    │   ├── BaseController.php
    │   └── LaundryController.php
    ├── models/                    # Lapisan Model & Entitas Data
    │   ├── LaundryModel.php
    │   └── LaundryService.php
    ├── helpers/                   # Fungsi pembantu & Sanitasi
    │   └── ViewHelper.php
    └── views/                     # Lapisan Presentasi
        ├── home.php               # Halaman utama
        ├── layouts/               # Layout induk
        │   ├── header.php
        │   └── footer.php
        └── partials/              # Komponen modular
            ├── hero.php
            ├── services.php
            ├── service_card.php
            ├── rules.php
            ├── flow.php
            └── faq.php
```

---

## Teknologi yang Digunakan

| Kategori | Teknologi / Library | Keterangan |
| :--- | :--- | :--- |
| **Backend Language** | PHP 8.4+ | Menggunakan *Strict Types*, Constructor Property Promotion, dan OOP murni |
| **Server Environment** | Laravel Herd / PHP CLI | Lingkungan lokal pengembangan web |
| **Node.js Environment** | Node.js & Express.js | Digunakan pada eksplorasi build tool dan server statis Week 4 |
| **CSS Framework** | Tailwind CSS v4 | Utilitas styling modern yang konsisten dan responsif |
| **Icons** | Lucide Icons | Paket ikon modern via CDN |
| **Fonts** | Google Fonts | Outfit (Body Text) & Playfair Display (Headings) |
| **Client-Side Script** | Vanilla JavaScript | Manipulasi DOM, Accordion FAQ, Tab Filter, dan Observer API |

---

## Panduan Instalasi & Menjalankan Proyek

### 1. Kebutuhan Sistem
- **PHP** versi 8.2 atau lebih tinggi (disarankan PHP 8.4).
- **Node.js** v18+ & **npm** (opsional, hanya untuk eksperimen di `week-4`).
- **Laravel Herd** (macOS/Windows) atau ekstensi web server lokal lainnya.

### 2. Menjalankan Menggunakan Laravel Herd
Jika Anda menggunakan **Laravel Herd** dan meletakkan folder ini di direktori `Herd`:
1. Pastikan domain terhubung (default: `http://project_web.test`).
2. Buka peramban (browser) dan akses:
   - `http://project_web.test` (langsung mengarah ke versi terbaru **Week 7**).

### 3. Menjalankan Menggunakan PHP Built-in Server
Anda dapat menjalankan server built-in PHP langsung dari root repositori:
```bash
php -S localhost:8000
```
Buka browser di alamat:
- Beranda utama (Week 7): [http://localhost:8000/](http://localhost:8000/)
- Mengakses sprint tertentu:
  - Week 2: `http://localhost:8000/week-2/`
  - Week 3: `http://localhost:8000/week-3/`
  - Week 4: `http://localhost:8000/week-4/src/index.html`
  - Week 5: `http://localhost:8000/week-5/`
  - Week 6: `http://localhost:8000/week-6/`
  - Week 7: `http://localhost:8000/week-7/`

### 4. Menjalankan Lingkungan Week 4 (Opsional)
Untuk menguji pipeline build dan server Node.js pada Week 4:
```bash
cd week-4
npm install
npm run build    # Kompilasi Tailwind CSS
npm start        # Menjalankan server express di port 3000
```

---

## Fitur Unggulan

- **Arsitektur Bersih (MVC):** Pemisahan tegas antara logika pengolahan data (*Model*), kendali alur (*Controller*), dan tampilan antarmuka (*View*).
- **Format Respons Ganda (HTML & JSON):** Pada Week 7, sistem mendukung output berbasis REST API dengan menambahkan parameter query:
  ```text
  GET /week-7/?format=json
  ```
- **Katalog Layanan Interaktif:** Tab navigasi dinamis untuk beralih antara kategori Kiloan, Satuan, dan Karpet/Sepatu.
- **Simulasi & Tata Tertib Laundry:** Menampilkan estimasi durasi pengerjaan, ketentuan pakaian berharga, dan alur pemesanan jelas.
- **FAQ Accordion Interaktif:** Pertanyaan yang sering diajukan dengan animasi transisi yang halus.
- **Keamanan XSS Terlindungi:** Seluruh output variabel dinamis dienkripsi menggunakan metode `ViewHelper::escape()`.

---

## Tim Pengembang

Proyek ini dikembangkan oleh:
- **Suryaa** ([@LearnWithSuryaa](https://github.com/LearnWithSuryaa))
- **Grendha** ([@grendaaaaa](https://github.com/grendaaaaa))

