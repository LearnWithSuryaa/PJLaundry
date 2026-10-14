# Panduan Lengkap Demo & Evaluasi Sprint 04 (Week 5 - PHP Dasar)
**Project:** PJ Laundry  
**Tema:** Server-Side Processing dengan PHP (Company Profile & Manajemen Outlet)  
**Lingkungan:** PHP 8.4 (Laravel Herd / PHP Built-in Server `php -S localhost:8000`)

---

## 1. Ringkasan Pemenuhan Requirements (Checklist 14/14 Selesai)

### A. Requirements Fungsional
- [x] **Halaman profil bisnis laundry dapat dibuka melalui browser**: Akses via `http://project_web.test/week-5/` atau `http://localhost:8000`.
- [x] **Nama dan informasi usaha ditampilkan**: Menampilkan nama usaha (*PJ Laundry*), tagline (*"Cuci Bersih, Higienis, & Tanpa Drama"*), tahun berdiri (2021), jam operasional, kontak WhatsApp, dan statistik pencapaian.
- [x] **Informasi layanan atau program laundry ditampilkan**: Katalog 6 paket layanan (kiloan reguler, kilat express, premium, jas satuan, bed cover, sepatu) dan 4 nilai standar pelayanan bisnis.
- [x] **Konten HTML dihasilkan oleh PHP**: Seluruh data dinamis diinjeksi via tag `<?= $var ?>` dan template PHP Server-Side Rendering (SSR).
- [x] **Data outlet disimpan menggunakan variable/array PHP**: Tersimpan dalam array multidimensi `$outlets` di `includes/data.php`.
- [x] **Nama dan informasi setiap outlet ditampilkan**: Menampilkan nama outlet, kota/kecamatan, alamat lengkap, kontak, penanggung jawab, kapasitas harian, dan fasilitas.
- [x] **Conditional menentukan status outlet**: Fungsi `get_outlet_status()` menggunakan `if-elseif-else` untuk mengevaluasi apakah outlet *Tutup Sementara*, *Buka - Kuota Padat*, *Buka - Normal*, atau *Buka - Kuota Lapang*.
- [x] **Loop menampilkan beberapa outlet secara dinamis**: Menggunakan `foreach ($displayedOutlets as $outlet)` untuk merender kartu outlet secara otomatis.
- [x] **Function sederhana digunakan untuk mengolah atau memformat data**: Terdapat 5 fungsi modular di `includes/functions.php` (`format_rupiah()`, `get_outlet_status()`, `calculate_outlet_statistics()`, `filter_outlets()`, dan `calculate_order_estimate()`).
- [x] **Browser mengirim request ke server PHP**: Menggunakan parameter query GET (seperti `?status=active`, `?search=balen`, `?calculate=1`).
- [x] **PHP memproses data sebelum ditampilkan**: Menghitung statistik kapasitas agregat, memfilter outlet sesuai pencarian, serta menghitung estimasi biaya pesanan beserta diskon volume.
- [x] **PHP menghasilkan output HTML**: Menghasilkan dokumen HTML terstruktur yang dikirim kembali ke browser klien.
- [x] **Konten dinamis berasal dari data PHP, bukan ditulis satu per satu**: Jika data di array bertambah/diubah, tampilan langsung menyesuaikan tanpa mengubah markup HTML.
- [x] **Hasil ditampilkan dengan struktur halaman yang tetap baik**: Desain responsif modern dengan palet warna laundry mewah (*teal & amber*), progress bar kapasitas visual, dan kartu interaktif.

---

## 2. Tanya-Jawab Kunci untuk Sesi Demo (Sesuai Modul Hal. 16)

Berikut adalah jawaban lengkap dan terstruktur saat dosen/evaluator mengajukan pertanyaan demo:

### Q1: Data apa saja yang diproses dalam aplikasi ini?
> **Jawaban:**  
> 1. **Data Profil Usaha:** Nama merek, tagline, deskripsi, tahun berdiri, jam operasional, kontak resmi, dan statistik pencapaian (ton pakaian tercuci, jumlah pelanggan).
> 2. **Data Jaringan Outlet Cabang:** Array multidimensi berisi 6 outlet dengan atribut ID, nama cabang, kota, alamat, jam buka, kapasitas maksimal (kg), kuota terisi (kg), status aktif/tutup, penanggung jawab, dan fasilitas.
> 3. **Data Katalog Layanan:** Kategori, tarif per unit, durasi pengerjaan, dan icon.
> 4. **Data Input Simulasi Pesanan:** Pilihan paket layanan, bobot cucian (kg), opsi express, dan antar-jemput yang dikirim pengguna melalui formulir browser.

### Q2: Variabel apa saja yang digunakan dan apa tipe datanya?
> **Jawaban:**  
> Seluruh tipe data dasar PHP diimplementasikan di `includes/data.php`:
> - **String:** `$brandName` ("PJ Laundry"), `$baseCity`, `$businessHours`, `$contactWhatsapp`.
> - **Integer:** `$establishedYear` (2021), `$capacity_kg` (250), `$happyCustomers` (5840).
> - **Float:** `$averageRating` (4.9), `$standardMinKg` (3.0), persentase beban `$occupancyPct`.
> - **Boolean:** `$isOpenToday` (`true`), `$is_active` (`true`/`false` untuk status buka/tutup cabang).
> - **Array:** 
>   - Array 1 Dimensi / Asosiatif: `$brandValues`, `$promoPrograms`.
>   - Array Multidimensi Asosiatif: `$outlets` dan `$servicesCatalog`.

### Q3: Bagaimana Conditional dan Loop bekerja di proyek ini?
> **Jawaban:**  
> - **Conditional (`if`, `elseif`, `else`):**
>   - Pada fungsi `get_outlet_status($outlet)`: jika `$outlet['is_active'] === false`, status otomatis menjadi *Tutup Sementara*. Jika aktif, sistem menghitung rasio utilisasi: $\ge 90\%$ dikategorikan *Buka - Kuota Padat*, $\ge 50\%$ *Buka - Normal*, dan $< 50\%$ *Buka - Kuota Lapang*.
>   - Pada fungsi `calculate_order_estimate()`: conditional mengevaluasi bobot cucian untuk memberikan diskon otomatis (10% jika $\ge 10\text{ kg}$, 15% jika $\ge 20\text{ kg}$).
> - **Loop (`foreach`):**
>   - `foreach ($displayedOutlets as $outlet)`: membaca setiap elemen array outlet dan merendernya ke dalam kartu HTML lengkap dengan badge status dan progress bar.
>   - `foreach ($outlet['facilities'] as $facility)`: loop bersarang (*nested loop*) untuk merender tag fasilitas di dalam setiap kartu outlet.
>   - `foreach` di `calculate_outlet_statistics()`: menjumlahkan total kapasitas dan beban terpakai seluruh cabang.

### Q4: Apa sebenarnya output dari PHP?
> **Jawaban:**  
> Output PHP adalah **string dokumen HTML utuh (Server-Side Rendered / SSR)** yang dikirim ke browser melalui protokol HTTP dengan header `Content-Type: text/html`. Browser klien hanya menerima markup HTML bersih beserta CSS, tanpa melihat kode mentah PHP maupun logika backend.

### Q5: Apa perbedaan mendasar antara PHP dan JavaScript?
> **Jawaban:**  
> | Aspek | PHP (Server-Side) | JavaScript (Client-Side) |
> | :--- | :--- | :--- |
> | **Tempat Eksekusi** | Dijalankan di web server sebelum dokumen dikirim ke pengguna. | Dijalankan di browser web klien setelah dokumen diterima. |
> | **Visibilitas Kode** | Kode sumber dan logika bisnis tersembunyi aman di server; pengguna hanya menerima output HTML. | Kode JavaScript dapat diinspeksi langsung melalui *DevTools / View Source*. |
> | **Akses Sistem** | Dapat mengakses database server, sistem file lokal, dan variabel environment server. | Berjalan di lingkungan *sandbox* browser; tidak dapat mengakses database server secara langsung. |
> | **Penggunaan** | Menyiapkan data awal, autentikasi, keamanan harga, dan perakitan struktur HTML utama. | Menangani interaksi mikro di layar (misal dropdown animasi, modal, manipulasi DOM dinamis tanpa reload). |

### Q6: Bagian halaman mana yang paling tepat diproses dengan PHP?
> **Jawaban:**  
> 1. **Kalkulasi Biaya & Diskon:** Menghindari manipulasi harga oleh pengguna jika dihitung di browser.
> 2. **Penyaringan & Agregasi Data Outlet:** Memfilter status dan menghitung sisa kuota kapasitas secara konsisten sebelum dirender.
> 3. **Injeksi Data Profil & Konfigurasi Bisnis:** Mengubah nomor telepon, jam buka, atau harga layanan cukup di satu file (`data.php`), dan seluruh halaman langsung terupdate otomatis.

---

## 3. Panduan Praktik Demo Langkah-demi-Langkah

1. **Buka Aplikasi:**
   Buka URL: `http://project_web.test/week-5/` atau `http://localhost:8000/week-5/`.
2. **Tunjukkan Company Profile:**
   Perlihatkan nama *PJ Laundry*, tagline, dan statistik (*5.840+ Pelanggan*, *135 Ton+ Pakaian*). Jelaskan bahwa angka-angka ini dihitung dinamis dari variable PHP.
3. **Uji Filter Outlet (Server-Side Processing):**
   - Klik tombol pill **"Tutup Sementara"**: Perhatikan URL berubah menjadi `?status=closed#outlets`. Server PHP hanya menampilkan cabang *Dander* dengan badge merah.
   - Klik tombol pill **"Kuota Padat"**: URL berubah menjadi `?status=busy#outlets`. Menampilkan cabang *Balen* dan *Kalitidu* dengan utilisasi $>90\%$.
   - Ketik **"Balen"** di form pencarian dan klik tombol **Cari**: Menunjukkan filter pencarian server-side bekerja sempurna.
4. **Uji Kalkulator Biaya:**
   - Masukkan layanan: *Cuci Reguler + Setrika*.
   - Masukkan berat: *12 kg* (melewati batas 10 kg).
   - Centang *Layanan Kilat Express* dan *Tambah Antar-Jemput*.
   - Klik **"Hitung di Server PHP"**.
   - Perhatikan nota yang muncul: menampilkan rincian harga, penambahan biaya express, penambahan ongkir, dan potongan diskon volume 10% secara akurat!
5. **Tunjukkan Tabel Evaluasi Konsep Teknis PHP:**
   Scroll ke section paling bawah (**Checklist Konsep Teknis PHP**). Ini menjadi bukti konkrit bahwa seluruh 9 poin modul telah terpenuhi secara fungsional.
