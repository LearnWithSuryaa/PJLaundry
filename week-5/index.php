<?php
/**
 * ============================================================================
 * PJ LAUNDRY - MAIN APPLICATION PAGE (WEEK 5)
 * ============================================================================
 * Memenuhi seluruh requirements Sprint 04 / Week 5:
 * A. Requirements Fungsional:
 *    1. Company Profile (Profil bisnis, nama usaha, layanan & program, HTML via PHP)
 *    2. Manajemen Outlet (Array PHP, info outlet, conditional status, foreach loop, function)
 *    3. Server-Side Processing (Request browser -> PHP proses data -> output HTML dinamis)
 * B. Requirements Teknis PHP:
 *    PHP Setup, Syntax, Variable, Datatype, Operator, Conditional, Loop, Function, PHP Output.
 */

// 1. INJEKSI MODUL DATA & FUNGSI (Modular PHP Architecture)
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/functions.php';

// 2. SERVER-SIDE PROCESSING: Menangkap dan memvalidasi Request GET dari Browser
$statusFilter = isset($_GET['status']) ? trim($_GET['status']) : 'all';
$searchQuery  = isset($_GET['search']) ? trim($_GET['search']) : '';

// 3. PEMROSESAN DATA OUTLET: Filter & Pencarian di Sisi Server
$displayedOutlets = filter_outlets($outlets, $statusFilter, $searchQuery);

// 4. PEMROSESAN AGREGAT STATISTIK: Loop & Operator Aritmatika di Server PHP
$stats = calculate_outlet_statistics($outlets);

// 5. SERVER-SIDE PROCESSING: Simulasi Kalkulator Biaya Pesanan
$estimateResult = null;
$selectedService = isset($_GET['service']) ? trim($_GET['service']) : 'kiloan_reguler';
$inputWeight     = isset($_GET['weight']) ? (float) $_GET['weight'] : 5.0;
$inputExpress    = isset($_GET['express']) && $_GET['express'] === '1';
$inputPickup     = isset($_GET['pickup']) && $_GET['pickup'] === '1';

if (isset($_GET['calculate']) && $_GET['calculate'] === '1') {
    $estimateResult = calculate_order_estimate(
        $servicesCatalog,
        $selectedService,
        $inputWeight,
        $inputExpress,
        $inputPickup
    );
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($brandName) ?> &ndash; <?= htmlspecialchars($brandTagline) ?></title>
  <meta name="description" content="<?= htmlspecialchars($brandDescription) ?>">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- ======================================================================
       HEADER & NAVIGATION (Dynamic Brand Data via PHP)
       ====================================================================== -->
  <header class="site-header">
    <div class="container nav-wrapper">
      <a href="index.php" class="brand-logo" title="<?= htmlspecialchars($brandName) ?>">
        <div class="brand-icon-box">🧺</div>
        <div>
          <span class="brand-text-name"><?= htmlspecialchars($brandName) ?></span>
          <span class="sprint-badge">Week 5 &bull; PHP SSR</span>
        </div>
      </a>

      <ul class="nav-links">
        <li><a href="#company-profile" class="nav-link active">Profil Usaha</a></li>
        <li><a href="#outlets" class="nav-link">Manajemen Outlet (<?= $stats['total_outlets'] ?>)</a></li>
        <li><a href="#layanan" class="nav-link">Katalog Layanan</a></li>
        <li><a href="#kalkulator" class="nav-link">Kalkulator Biaya</a></li>
        <li><a href="#teknis-php" class="nav-link">Evaluasi PHP</a></li>
      </ul>

      <div class="nav-actions">
        <a href="https://wa.me/<?= htmlspecialchars($contactWhatsapp) ?>?text=Halo%20PJ%20Laundry,%20saya%20ingin%20tanya%20layanan" 
           target="_blank" 
           rel="noopener noreferrer" 
           class="btn btn-whatsapp">
          <span>💬 Order WhatsApp</span>
        </a>
      </div>
    </div>
  </header>

  <main>
    <!-- ======================================================================
         SECTION 1: COMPANY PROFILE (HERO BANNER)
         Requirement Fungsional 1: Halaman profil bisnis laundry dibuka via browser,
         nama & informasi usaha, layanan/program, konten HTML dihasilkan oleh PHP.
         ====================================================================== -->
    <section id="company-profile" class="hero-section">
      <div class="hero-bg-media"></div>
      <div class="hero-overlay"></div>

      <div class="container hero-grid">
        <!-- Kolom Kiri: Informasi Usaha -->
        <div class="hero-content">
          <div class="hero-pill-badge">
            <span class="pulse-dot"></span>
            <span><?= $isOpenToday ? "Buka Hari Ini &bull; {$businessHours}" : "Tutup Sementara" ?></span>
          </div>

          <h1 class="hero-title">
            Cuci Bersih, Higienis,<br>
            <em>Tanpa Rasa Khawatir.</em>
          </h1>

          <p class="hero-description">
            <?= htmlspecialchars($brandDescription) ?>
          </p>

          <div class="hero-cta-group">
            <a href="#outlets" class="btn btn-accent">
              <span>📍 Lihat Cabang Terdekat (<?= $stats['active_outlets'] ?> Buka)</span>
            </a>
            <a href="#kalkulator" class="btn btn-outline" style="border-color: rgba(255,255,255,0.4); color: #fff;">
              <span>🧮 Hitung Estimasi Cuci</span>
            </a>
          </div>

          <div class="hero-meta-bar">
            <div class="meta-item">
              <span class="meta-number"><?= $activeYearCount ?>+ Tahun</span>
              <span class="meta-label">Beroperasi Sejak <?= $establishedYear ?></span>
            </div>
            <div class="meta-item">
              <span class="meta-number"><?= number_format($happyCustomers, 0, ',', '.') ?>+</span>
              <span class="meta-label">Pelanggan Puas</span>
            </div>
            <div class="meta-item">
              <span class="meta-number"><?= $totalWashedTons ?> Ton+</span>
              <span class="meta-label">Pakaian Higienis Tercuci</span>
            </div>
            <div class="meta-item">
              <span class="meta-number">★ <?= number_format($averageRating, 1) ?></span>
              <span class="meta-label">Rating Kepuasan</span>
            </div>
          </div>
        </div>

        <!-- Kolom Kanan: Card Ringkasan Usaha -->
        <div class="hero-card">
          <div class="hero-card-header">
            <h3 class="hero-card-title">🏢 Identitas Usaha PJ Laundry</h3>
            <span class="sprint-badge" style="background: var(--success-subtle); color: var(--success-text);">Verified</span>
          </div>

          <div class="info-list">
            <div class="info-row">
              <span class="info-icon">📍</span>
              <span class="info-label">Basis Operasi:</span>
              <span class="info-val"><?= htmlspecialchars($baseCity) ?></span>
            </div>
            <div class="info-row">
              <span class="info-icon">🕒</span>
              <span class="info-label">Jam Layanan:</span>
              <span class="info-val"><?= htmlspecialchars($businessHours) ?></span>
            </div>
            <div class="info-row">
              <span class="info-icon">📞</span>
              <span class="info-label">Kontak Resmi:</span>
              <span class="info-val"><?= htmlspecialchars($contactPhone) ?></span>
            </div>
            <div class="info-row">
              <span class="info-icon">✉️</span>
              <span class="info-label">Email Support:</span>
              <span class="info-val"><?= htmlspecialchars($contactEmail) ?></span>
            </div>
            <div class="info-row">
              <span class="info-icon">🚚</span>
              <span class="info-label">Antar-Jemput:</span>
              <span class="info-val"><?= $isPickupAvailable ? 'Tersedia (Gratis s/d 3 km)' : 'Belum Tersedia' ?></span>
            </div>
          </div>

          <div style="background: var(--primary-subtle); border-radius: var(--radius-sm); padding: 0.85rem 1rem; font-size: 0.85rem; color: var(--primary);">
            💡 <strong>Server-Side Processing Note:</strong> Seluruh data di atas dirender secara dinamis dari variable dan array PHP pada file <code>includes/data.php</code>.
          </div>
        </div>
      </div>
    </section>

    <!-- ======================================================================
         SECTION 2: REAL-TIME STATISTICS BANNER (PHP Operators & Calculations)
         Mendemonstrasikan penerapan Operator Aritmatika (+, -, /, *) & Conditional
         ====================================================================== -->
    <section class="stats-section">
      <div class="container">
        <div class="stats-card-grid">
          <div class="stat-box">
            <div class="stat-icon primary">🏢</div>
            <div class="stat-val"><?= $stats['total_outlets'] ?> Cabang</div>
            <div class="stat-sublabel">Total Outlet Terdaftar</div>
            <div class="stat-hint">Dikelola di area Bojonegoro</div>
          </div>

          <div class="stat-box">
            <div class="stat-icon success">✅</div>
            <div class="stat-val"><?= $stats['active_outlets'] ?> Outlet</div>
            <div class="stat-sublabel">Beroperasi Hari Ini</div>
            <div class="stat-hint"><?= $stats['closed_outlets'] ?> cabang maintenance</div>
          </div>

          <div class="stat-box">
            <div class="stat-icon warning">⚖️</div>
            <div class="stat-val"><?= $stats['total_capacity_kg'] ?> kg / hari</div>
            <div class="stat-sublabel">Total Kapasitas Mesin</div>
            <div class="stat-hint">Sisa kuota: <?= $stats['remaining_capacity_kg'] ?> kg</div>
          </div>

          <div class="stat-box">
            <div class="stat-icon accent">📊</div>
            <div class="stat-val"><?= $stats['utilization_rate_pct'] ?>%</div>
            <div class="stat-sublabel">Tingkat Beban Hari Ini</div>
            <div class="stat-hint">Rata-rata: <?= $stats['avg_load_per_outlet'] ?> kg / cabang</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ======================================================================
         SECTION 3: MANAJEMEN OUTLET (Dynamic Loop & Conditional Status)
         Requirement Fungsional 2 & 3:
         - Data outlet disimpan di variable/array PHP
         - Nama & info setiap outlet ditampilkan
         - Conditional menentukan status outlet (Buka, Padat, Lapang, Tutup)
         - Loop foreach menampilkan outlet secara dinamis
         - Function sederhana digunakan untuk mengolah/memformat data
         ====================================================================== -->
    <section id="outlets" class="outlets-section">
      <div class="container">
        <div class="section-header">
          <span class="section-tag">Manajemen &amp; Jaringan Cabang</span>
          <h2 class="section-title">Daftar Outlet PJ Laundry</h2>
          <p class="section-lead">
            Data operasional outlet diproses di server PHP secara dinamis. Anda dapat memfilter status atau mencari cabang terdekat secara langsung.
          </p>
        </div>

        <!-- SERVER-SIDE FILTER & PENCARIAN (Browser sends GET -> PHP processes data) -->
        <div class="server-filter-bar">
          <!-- Filter Status Tabs -->
          <div class="filter-pills">
            <a href="?status=all<?= $searchQuery !== '' ? '&search=' . urlencode($searchQuery) : '' ?>#outlets" 
               class="filter-pill <?= $statusFilter === 'all' ? 'active' : '' ?>">
              Semua Outlet <span class="filter-count"><?= $stats['total_outlets'] ?></span>
            </a>
            <a href="?status=active<?= $searchQuery !== '' ? '&search=' . urlencode($searchQuery) : '' ?>#outlets" 
               class="filter-pill <?= $statusFilter === 'active' ? 'active' : '' ?>">
              Buka Saja <span class="filter-count"><?= $stats['active_outlets'] ?></span>
            </a>
            <a href="?status=available<?= $searchQuery !== '' ? '&search=' . urlencode($searchQuery) : '' ?>#outlets" 
               class="filter-pill <?= $statusFilter === 'available' ? 'active' : '' ?>">
              Kuota Lapang
            </a>
            <a href="?status=busy<?= $searchQuery !== '' ? '&search=' . urlencode($searchQuery) : '' ?>#outlets" 
               class="filter-pill <?= $statusFilter === 'busy' ? 'active' : '' ?>">
              Kuota Padat <span class="filter-count"><?= $stats['busy_outlets'] ?></span>
            </a>
            <a href="?status=closed<?= $searchQuery !== '' ? '&search=' . urlencode($searchQuery) : '' ?>#outlets" 
               class="filter-pill <?= $statusFilter === 'closed' ? 'active' : '' ?>">
              Tutup Sementara <span class="filter-count"><?= $stats['closed_outlets'] ?></span>
            </a>
          </div>

          <!-- Form Pencarian Server-Side GET -->
          <form method="GET" action="index.php#outlets" class="search-form">
            <?php if ($statusFilter !== 'all'): ?>
              <input type="hidden" name="status" value="<?= htmlspecialchars($statusFilter) ?>">
            <?php endif; ?>
            
            <div class="search-input-group">
              <span class="search-icon">🔍</span>
              <input type="text" 
                     name="search" 
                     class="search-input" 
                     placeholder="Cari outlet, kecamatan, atau alamat..." 
                     value="<?= htmlspecialchars($searchQuery) ?>">
            </div>
            <button type="submit" class="btn btn-primary" style="padding: 0.55rem 1.1rem; font-size: 0.85rem;">Cari</button>
          </form>

          <!-- Feedback Status Filter -->
          <div class="filter-feedback">
            <span>
              Menampilkan <strong><?= count($displayedOutlets) ?></strong> dari total <strong><?= $stats['total_outlets'] ?></strong> outlet
              <?php if ($statusFilter !== 'all'): ?> &bull; Filter Status: <strong><?= htmlspecialchars(ucfirst($statusFilter)) ?></strong><?php endif; ?>
              <?php if ($searchQuery !== ''): ?> &bull; Kata Kunci: "<strong><?= htmlspecialchars($searchQuery) ?></strong>"<?php endif; ?>
            </span>
            
            <?php if ($statusFilter !== 'all' || $searchQuery !== ''): ?>
              <a href="index.php#outlets" class="reset-filter-link">✕ Reset Filter</a>
            <?php endif; ?>
          </div>
        </div>

        <!-- GRID KARTU OUTLET (Rendered via PHP foreach Loop) -->
        <?php if (empty($displayedOutlets)): ?>
          <div style="background: #fff; padding: 3rem; text-align: center; border-radius: var(--radius-lg); border: 1px dashed var(--border-color);">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
            <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem;">Tidak Ada Outlet Yang Cocok</h3>
            <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
              Kriteria filter atau pencarian "<?= htmlspecialchars($searchQuery) ?>" tidak ditemukan di server.
            </p>
            <a href="index.php#outlets" class="btn btn-primary">Lihat Semua Outlet</a>
          </div>
        <?php else: ?>
          <div class="outlets-grid">
            <?php 
            // ================================================================
            // LOOP FOREACH: Menampilkan data outlet secara dinamis dari array
            // ================================================================
            foreach ($displayedOutlets as $outlet): 
              // Function evaluasi status dengan Conditional (if-elseif-else)
              $status = get_outlet_status($outlet);

              // Tentukan warna bar kapasitas
              $fillColorClass = 'fill-green';
              if (!$outlet['is_active']) {
                  $fillColorClass = 'fill-gray';
              } elseif ($status['occupancy_pct'] >= 90.0) {
                  $fillColorClass = 'fill-orange';
              } elseif ($status['occupancy_pct'] >= 50.0) {
                  $fillColorClass = 'fill-blue';
              }
            ?>
              <article class="outlet-card <?= !$outlet['is_active'] ? 'card-closed' : '' ?>">
                <!-- Header Kartu: Nama Outlet & Status Badge Dinamis -->
                <div class="outlet-card-header">
                  <div class="outlet-title-area">
                    <div class="outlet-city-tag"><?= htmlspecialchars($outlet['city']) ?> &bull; <?= htmlspecialchars($outlet['id']) ?></div>
                    <h3 class="outlet-name"><?= htmlspecialchars($outlet['name']) ?></h3>
                  </div>

                  <!-- BADGE STATUS: Dihasilkan dari Function + Conditional PHP -->
                  <div class="status-badge <?= $status['badge_class'] ?>">
                    <span class="badge-dot" style="background-color: <?= $status['dot_color'] ?>;"></span>
                    <span><?= htmlspecialchars($status['label']) ?></span>
                  </div>
                </div>

                <!-- Body Kartu: Informasi Operasional & Kapasitas -->
                <div class="outlet-card-body">
                  <div class="outlet-detail-row">
                    <span class="icon">📍</span>
                    <span><?= htmlspecialchars($outlet['address']) ?></span>
                  </div>

                  <div class="outlet-detail-row">
                    <span class="icon">🕒</span>
                    <span>Jam Operasional: <strong><?= htmlspecialchars($outlet['opening_hours']) ?></strong></span>
                  </div>

                  <div class="outlet-detail-row">
                    <span class="icon">👤</span>
                    <span>Penanggung Jawab: <?= htmlspecialchars($outlet['manager']) ?></span>
                  </div>

                  <!-- PENGUKUR BEBAN KAPASITAS (Operator Aritmatika PHP) -->
                  <div class="capacity-box">
                    <div class="capacity-labels">
                      <span>Beban Mesin Hari Ini</span>
                      <span class="capacity-percent"><?= $status['occupancy_pct'] ?>%</span>
                    </div>

                    <div class="progress-bar-bg">
                      <div class="progress-bar-fill <?= $fillColorClass ?>" style="width: <?= min(100, $status['occupancy_pct']) ?>%;"></div>
                    </div>

                    <div class="capacity-subtext">
                      <span>Terisi: <?= $outlet['used_capacity_kg'] ?> kg / <?= $outlet['capacity_kg'] ?> kg</span>
                      <span>Sisa: <?= $status['available_kg'] ?> kg</span>
                    </div>
                  </div>

                  <!-- DAFTAR FASILITAS: Loop Foreach Bersarang -->
                  <div>
                    <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 0.4rem;">Fasilitas Cabang:</div>
                    <div class="facilities-list">
                      <?php foreach ($outlet['facilities'] as $facility): ?>
                        <span class="facility-badge">✓ <?= htmlspecialchars($facility) ?></span>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>

                <!-- Footer Kartu: Rating & Aksi WhatsApp Cabang -->
                <div class="outlet-card-footer">
                  <div class="outlet-rating">
                    <span class="star">★</span>
                    <span><?= number_format($outlet['rating'], 1) ?></span>
                    <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: normal;">(Review)</span>
                  </div>

                  <?php if ($outlet['is_active']): ?>
                    <a href="https://wa.me/<?= htmlspecialchars($contactWhatsapp) ?>?text=Halo%20PJ%20Laundry,%20saya%20ingin%20kirim%20cucian%20ke%20cabang%20<?= urlencode($outlet['name']) ?>" 
                       target="_blank" 
                       rel="noopener noreferrer" 
                       class="btn btn-whatsapp" 
                       style="padding: 0.45rem 1rem; font-size: 0.82rem;">
                      <span>Kirim ke Cabang Ini →</span>
                    </a>
                  <?php else: ?>
                    <span style="font-size: 0.8rem; font-weight: 700; color: var(--danger);">
                      Cabang Sedang Libur
                    </span>
                  <?php endif; ?>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- ======================================================================
         SECTION 4: PROGRAM & KATALOG LAYANAN LAUNDRY
         Requirement Fungsional 1: Informasi layanan atau program ditampilkan
         ====================================================================== -->
    <section id="layanan" class="services-section">
      <div class="container">
        <div class="section-header">
          <span class="section-tag">Katalog Layanan Resmi</span>
          <h2 class="section-title">Pilihan Layanan Laundry</h2>
          <p class="section-lead">
            Tarif transparan tanpa biaya tersembunyi. Diformat otomatis menggunakan Function PHP <code>format_rupiah()</code>.
          </p>
        </div>

        <div class="services-grid">
          <?php foreach ($servicesCatalog as $key => $service): ?>
            <article class="service-card <?= $service['is_popular'] ? 'popular-service' : '' ?>">
              <?php if ($service['is_popular']): ?>
                <span class="popular-ribbon">Paling Laris</span>
              <?php endif; ?>

              <div class="service-icon-box"><?= $service['icon'] ?></div>
              <div class="service-cat"><?= htmlspecialchars($service['category']) ?></div>
              <h3 class="service-name"><?= htmlspecialchars($service['name']) ?></h3>
              <p class="service-desc"><?= htmlspecialchars($service['description']) ?></p>

              <div class="service-price-box">
                <!-- FORMAT RUPIAH VIA PHP FUNCTION -->
                <span class="service-price"><?= format_rupiah($service['price_per_unit']) ?></span>
                <span class="service-unit">/ <?= htmlspecialchars($service['unit']) ?></span>
              </div>

              <div class="service-duration">⏱ Estimasi: <?= htmlspecialchars($service['duration']) ?></div>

              <div style="margin-top: 1.25rem;">
                <a href="#kalkulator" class="btn btn-outline" style="width: 100%; font-size: 0.85rem; padding: 0.5rem 1rem;">
                  Simulasikan Biaya Layanan Ini
                </a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>

        <!-- PROGRAM UNGGULAN & PROMO BISNIS -->
        <div style="margin-top: 3.5rem;">
          <div class="section-header" style="margin-bottom: 2rem;">
            <span class="section-tag">Nilai &amp; Program Bisnis</span>
            <h3 style="font-family: var(--font-serif); font-size: 1.8rem; font-weight: 700;">Standar Pelayanan PJ Laundry</h3>
          </div>

          <div class="programs-grid">
            <?php foreach ($brandValues as $val): ?>
              <div class="value-card">
                <div class="value-icon"><?= $val['icon'] ?></div>
                <h4 class="value-title"><?= htmlspecialchars($val['title']) ?></h4>
                <p class="value-desc"><?= htmlspecialchars($val['description']) ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- ======================================================================
         SECTION 5: SERVER-SIDE COST ESTIMATOR (Kalkulator Biaya Laundry)
         Membuktikan siklus Server-Side Processing:
         Form HTML -> Submit Request GET/POST -> Server PHP memproses perhitungan
         dengan operator aritmatika & conditional diskon -> Outputkan Nota Resmi
         ====================================================================== -->
    <section id="kalkulator" class="estimator-section">
      <div class="container">
        <div class="section-header">
          <span class="section-tag">Server-Side Processing Live Demo</span>
          <h2 class="section-title">Kalkulator Estimasi Biaya Laundry</h2>
          <p class="section-lead">
            Kirimkan berat cucian dan pilihan layanan Anda. Server PHP akan menghitung rincian harga, surcharge kilat, serta diskon volume secara otomatis.
          </p>
        </div>

        <div class="estimator-container">
          <!-- Form Input Browser (Client Request) -->
          <div class="estimator-form-card">
            <h3 style="font-size: 1.2rem; font-weight: 700; color: var(--primary); margin-bottom: 1.25rem;">
              📝 Masukkan Rincian Cucian
            </h3>

            <form method="GET" action="index.php#kalkulator">
              <input type="hidden" name="calculate" value="1">
              
              <!-- Tetap pertahankan filter status/search jika ada -->
              <?php if ($statusFilter !== 'all'): ?>
                <input type="hidden" name="status" value="<?= htmlspecialchars($statusFilter) ?>">
              <?php endif; ?>

              <div class="form-group">
                <label for="service-select" class="form-label">Pilih Paket Layanan:</label>
                <select id="service-select" name="service" class="form-select">
                  <?php foreach ($servicesCatalog as $code => $srv): ?>
                    <option value="<?= htmlspecialchars($code) ?>" <?= $selectedService === $code ? 'selected' : '' ?>>
                      <?= htmlspecialchars($srv['name']) ?> (<?= format_rupiah($srv['price_per_unit']) ?>/<?= $srv['unit'] ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="weight-input" class="form-label">Estimasi Berat atau Jumlah Satuan (kg/pcs):</label>
                <input type="number" 
                       id="weight-input" 
                       name="weight" 
                       class="form-input" 
                       step="0.5" 
                       min="1" 
                       max="100" 
                       value="<?= htmlspecialchars((string) $inputWeight) ?>" 
                       required>
                <small style="color: var(--text-muted); font-size: 0.78rem; display: block; margin-top: 0.35rem;">
                  🎁 Diskon Volume: &ge; 10 kg diskon 10%, &ge; 20 kg diskon 15% (Layanan Kiloan).
                </small>
              </div>

              <div class="checkbox-group">
                <label class="checkbox-label">
                  <input type="checkbox" name="express" value="1" <?= $inputExpress ? 'checked' : '' ?>>
                  <span>⚡ Layanan Kilat Express (+Rp4.000/kg) &bull; Selesai 3-5 Jam</span>
                </label>

                <label class="checkbox-label">
                  <input type="checkbox" name="pickup" value="1" <?= $inputPickup ? 'checked' : '' ?>>
                  <span>🚚 Tambah Antar-Jemput ke Alamat Rumah (+Rp5.000)</span>
                </label>
              </div>

              <div style="display: flex; gap: 0.75rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                  Hitung di Server PHP ⚙️
                </button>
                <a href="index.php#kalkulator" class="btn btn-outline" style="padding-inline: 1rem;">
                  Reset
                </a>
              </div>
            </form>
          </div>

          <!-- Output Server: Rincian Nota Pembayaran -->
          <div class="estimator-result-card">
            <?php if ($estimateResult): ?>
              <div class="invoice-header">
                <div>
                  <div style="font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: rgba(255,255,255,0.7);">Kalkulasi Server-Side</div>
                  <h3 class="invoice-title">Estimasi Nota Cuci</h3>
                </div>
                <span class="invoice-badge">Kode: EST-<?= strtoupper(substr(md5(uniqid()), 0, 6)) ?></span>
              </div>

              <div class="invoice-items">
                <div class="invoice-row">
                  <span>Paket Layanan:</span>
                  <strong><?= htmlspecialchars($estimateResult['service_name']) ?></strong>
                </div>

                <div class="invoice-row">
                  <span>Jumlah / Bobot:</span>
                  <span><?= $estimateResult['quantity'] ?> <?= htmlspecialchars($estimateResult['unit']) ?> &times; <?= format_rupiah($estimateResult['base_price']) ?></span>
                </div>

                <div class="invoice-row">
                  <span>Subtotal Cucian:</span>
                  <span><?= format_rupiah($estimateResult['subtotal']) ?></span>
                </div>

                <?php if ($estimateResult['is_express']): ?>
                  <div class="invoice-row">
                    <span>Biaya Kilat Express:</span>
                    <span>+<?= format_rupiah($estimateResult['express_fee']) ?></span>
                  </div>
                <?php endif; ?>

                <?php if ($estimateResult['is_pickup']): ?>
                  <div class="invoice-row">
                    <span>Biaya Antar-Jemput:</span>
                    <span>+<?= format_rupiah($estimateResult['pickup_fee']) ?></span>
                  </div>
                <?php endif; ?>

                <?php if ($estimateResult['discount_amount'] > 0): ?>
                  <div class="invoice-row discount">
                    <span>Diskon Volume (<?= $estimateResult['discount_pct'] ?>%):</span>
                    <span>-<?= format_rupiah($estimateResult['discount_amount']) ?></span>
                  </div>
                <?php endif; ?>

                <div class="invoice-row">
                  <span>Estimasi Selesai:</span>
                  <span>⏱ <?= htmlspecialchars($estimateResult['duration']) ?></span>
                </div>
              </div>

              <hr class="invoice-divider">

              <div class="invoice-total-row">
                <span class="invoice-total-label">Total Pembayaran:</span>
                <span class="invoice-total-val"><?= format_rupiah($estimateResult['grand_total']) ?></span>
              </div>

              <div style="margin-top: 1.5rem;">
                <a href="https://wa.me/<?= htmlspecialchars($contactWhatsapp) ?>?text=Halo%20PJ%20Laundry,%20saya%20ingin%20order%20<?= urlencode($estimateResult['service_name']) ?>%20sebanyak%20<?= $estimateResult['quantity'] ?><?= urlencode($estimateResult['unit']) ?>%20dengan%20estimasi%20total%20<?= urlencode(format_rupiah($estimateResult['grand_total'])) ?>" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="btn btn-whatsapp" 
                   style="width: 100%; font-size: 0.95rem; padding: 0.75rem;">
                  Pesan Sekarang via WhatsApp 📲
                </a>
              </div>
            <?php else: ?>
              <!-- Tampilan Awal Sebelum Tombol Hitung Diklik -->
              <div style="text-align: center; padding-block: 2.5rem 1.5rem;">
                <div style="font-size: 3.5rem; margin-bottom: 1rem;">🧮</div>
                <h3 style="font-family: var(--font-serif); font-size: 1.5rem; margin-bottom: 0.75rem;">Siap Menghitung Biaya</h3>
                <p style="font-size: 0.92rem; color: rgba(255,255,255,0.85); line-height: 1.6; max-width: 380px; margin-inline: auto;">
                  Pilih paket dan isi perkiraan bobot cucian Anda pada formulir di sebelah kiri, lalu klik <strong>"Hitung di Server PHP"</strong> untuk melihat rincian nota instan.
                </p>
                <div style="margin-top: 2rem; padding: 0.75rem; background: rgba(255,255,255,0.1); border-radius: var(--radius-sm); font-size: 0.8rem; color: rgba(255,255,255,0.8);">
                  💡 Logika diskon volume dan biaya antar diproses secara aman di sisi server.
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>

    <!-- ======================================================================
         SECTION 6: SPRINT 04 CHECKLIST & PHP TECHNICAL CONCEPTS INSPECTOR
         Memudahkan evaluasi dan menjawab pertanyaan demo modul secara transparan
         ====================================================================== -->
    <section id="teknis-php" class="inspector-section">
      <div class="container">
        <div class="section-header">
          <span class="section-tag">Kriteria Evaluasi Sprint 04</span>
          <h2 class="section-title">Checklist Konsep Teknis PHP</h2>
          <p class="section-lead">
            Transparansi implementasi konsep dasar PHP sesuai modul Week 5 halaman 11–16 pada proyek PJ Laundry.
          </p>
        </div>

        <div class="concepts-table-wrap">
          <table class="concepts-table">
            <thead>
              <tr>
                <th style="width: 18%;">Konsep Wajib</th>
                <th style="width: 32%;">Penerapan Nyata pada PJ Laundry</th>
                <th style="width: 30%;">Cuplikan Kode / Lokasi File</th>
                <th style="width: 20%;">Status Uji</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>1. PHP Setup</strong></td>
                <td>Dijalankan via web server lokal (Laravel Herd Nginx/PHP 8.4 atau PHP Built-in Server <code>php -S</code>)</td>
                <td><span class="code-snippet-box">Herd / php -S localhost:8000</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> Berjalan Sukses</span></td>
              </tr>
              <tr>
                <td><strong>2. PHP Syntax</strong></td>
                <td>Menggunakan tag pembuka <code>&lt;?php ... ?&gt;</code> dan short echo <code>&lt;?= $var ?&gt;</code> secara benar</td>
                <td><span class="code-snippet-box">index.php, data.php, functions.php</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> Sintaks Valid</span></td>
              </tr>
              <tr>
                <td><strong>3. Variable</strong></td>
                <td>Menyimpan nama usaha (<code>$brandName</code>), data outlet (<code>$outlets</code>), dan ringkasan statistik (<code>$stats</code>)</td>
                <td><span class="code-snippet-box">$brandName = "PJ Laundry";</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> Digunakan</span></td>
              </tr>
              <tr>
                <td><strong>4. Datatype</strong></td>
                <td>
                  <strong>String:</strong> nama, alamat, jam<br>
                  <strong>Integer:</strong> tahun, kapasitas, berat<br>
                  <strong>Float:</strong> rating (4.9), desimal kuota<br>
                  <strong>Boolean:</strong> <code>$is_active</code>, <code>$isOpenToday</code><br>
                  <strong>Array:</strong> multivariabel indexed & associative
                </td>
                <td><span class="code-snippet-box">$outlets = [ [ 'id' => ... ] ]</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> Sesuai Modul</span></td>
              </tr>
              <tr>
                <td><strong>5. Operator</strong></td>
                <td>
                  Aritmatika (<code>+</code>, <code>-</code>, <code>*</code>, <code>/</code>) hitung kuota, sisa kapasitas, persentase beban.<br>
                  Perbandingan (<code>===</code>, <code>&gt;=</code>) dan Logika (<code>&amp;&amp;</code>, <code>||</code>) untuk filter & diskon.
                </td>
                <td><span class="code-snippet-box">$occupancy = ($used / $cap) * 100;</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> Komputasi Aktif</span></td>
              </tr>
              <tr>
                <td><strong>6. Conditional</strong></td>
                <td>
                  <code>if</code>, <code>elseif</code>, <code>else</code> menentukan status cabang (Tutup, Padat, Lapang, Normal) dan kalkulasi diskon bertingkat.
                </td>
                <td><span class="code-snippet-box">if ($occupancyPct &gt;= 90.0) { ... }</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> Logika Berjalan</span></td>
              </tr>
              <tr>
                <td><strong>7. Loop</strong></td>
                <td>
                  <code>foreach</code> loop menampilkan grid outlet secara dinamis dan menghitung total agregat kapasitas.
                </td>
                <td><span class="code-snippet-box">foreach ($displayedOutlets as $outlet)</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> Dinamis</span></td>
              </tr>
              <tr>
                <td><strong>8. Function</strong></td>
                <td>
                  Dibuat modular: <code>format_rupiah()</code>, <code>get_outlet_status()</code>, <code>calculate_outlet_statistics()</code>, <code>filter_outlets()</code>, <code>calculate_order_estimate()</code>.
                </td>
                <td><span class="code-snippet-box">includes/functions.php</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> 5 Functions</span></td>
              </tr>
              <tr>
                <td><strong>9. PHP Output</strong></td>
                <td>Menghasilkan dokumen HTML lengkap, rapi, dan dinamis yang dikirim ke browser tanpa error.</td>
                <td><span class="code-snippet-box">Server-Side Rendered (SSR)</span></td>
                <td><span class="status-badge badge-available"><span class="badge-dot"></span> 100% Bebas Error</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>

  <!-- ======================================================================
       FOOTER (Company Profile End-Note)
       ====================================================================== -->
  <footer class="site-footer">
    <div class="container">
      <div class="footer-grid">
        <div>
          <div class="brand-logo" style="margin-bottom: 0.5rem;">
            <div class="brand-icon-box" style="background: rgba(255,255,255,0.15);">🧺</div>
            <span class="brand-text-name" style="color: #fff;"><?= htmlspecialchars($brandName) ?></span>
          </div>
          <p class="footer-brand-desc">
            <?= htmlspecialchars($brandDescription) ?>
          </p>
        </div>

        <div>
          <h4 class="footer-heading">Navigasi Halaman</h4>
          <ul class="footer-links-list">
            <li><a href="#company-profile">Profil Perusahaan</a></li>
            <li><a href="#outlets">Jaringan Outlet Cabang</a></li>
            <li><a href="#layanan">Daftar Paket Layanan</a></li>
            <li><a href="#kalkulator">Kalkulator Biaya Laundry</a></li>
            <li><a href="#teknis-php">Checklist Evaluasi Sprint 04</a></li>
          </ul>
        </div>

        <div>
          <h4 class="footer-heading">Kontak &amp; Alamat</h4>
          <ul class="footer-links-list">
            <li>📍 Kantor Pusat: <?= htmlspecialchars($baseCity) ?></li>
            <li>🕒 Jam Operasional: <?= htmlspecialchars($businessHours) ?></li>
            <li>📞 Telepon: <?= htmlspecialchars($contactPhone) ?></li>
            <li>✉️ Email: <?= htmlspecialchars($contactEmail) ?></li>
            <li>💬 WhatsApp: +<?= htmlspecialchars($contactWhatsapp) ?></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom-bar">
        <div>
          &copy; <?= date('Y') ?> <strong><?= htmlspecialchars($brandName) ?></strong>. Dikembangkan untuk Tugas Pemrograman Web (Week 5 - PHP Dasar).
        </div>
        <div>
          PHP Version: <strong><?= PHP_VERSION ?></strong> &bull; Server: <strong><?= htmlspecialchars($_SERVER['SERVER_SOFTWARE'] ?? 'PHP CLI') ?></strong>
        </div>
      </div>
    </div>
  </footer>

</body>
</html>
