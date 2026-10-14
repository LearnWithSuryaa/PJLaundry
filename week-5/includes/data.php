<?php
/**
 * ============================================================================
 * DATA PERUSAHAAN & OUTLET PJ LAUNDRY (WEEK 5 - PHP FUNDAMENTALS)
 * ============================================================================
 * File ini mendefinisikan seluruh state & data awal aplikasi PJ Laundry:
 * 1. Variable & Datatypes (String, Integer, Float, Boolean, Array)
 * 2. Profil Bisnis (Company Profile)
 * 3. Program Layanan & Nilai Tambah
 * 4. Data Outlet Cabang (Multidimensional Associative Array)
 */

// ==========================================
// 1. VARIABLE & TIPE DATA DASAR (Company Profile)
// ==========================================
// String (Teks)
$brandName        = "PJ Laundry";
$brandTagline     = "Cuci Bersih, Higienis, & Tanpa Drama";
$brandDescription = "Layanan laundry profesional terpercaya di Bojonegoro dan sekitarnya. " .
                    "Menggunakan teknologi deterjen ramah lingkungan, mesin berstandar hotel berbintang, " .
                    "serta tim berpengalaman untuk memastikan pakaian Anda wangi, rapi, dan awet.";
$baseCity         = "Bojonegoro, Jawa Timur";
$contactWhatsapp  = "6281234567890";
$contactPhone     = "0812-3456-7890";
$contactEmail     = "halo@pjlaundry.id";
$businessHours    = "Senin – Minggu: 07.00 – 21.00 WIB";

// Integer (Bilangan Bulat)
$establishedYear  = 2021;
$activeYearCount  = (int) date('Y') - $establishedYear; // Operasi pengurangan integer
$happyCustomers   = 5840;
$totalWashedTons  = 135;

// Float (Bilangan Desimal)
$averageRating    = 4.9;
$standardMinKg    = 3.0;

// Boolean (Kondisi Logika)
$isOpenToday      = true;
$isPickupAvailable = true;

// ==========================================
// 2. ARRAY 1D: NILAI UNGGULAN & PROGRAM PROMO
// ==========================================
$brandValues = [
    [
        "icon" => "🌱",
        "title" => "Deterjen Ramah Lingkungan",
        "description" => "Formula eco-friendly bebas fosfat yang lembut untuk serat kain dan aman bagi kulit sensitif."
    ],
    [
        "icon" => "⚡",
        "title" => "Mesin Komersial Canggih",
        "description" => "Putaran stabil dan pengering gas otomatis menghasilkan cucian higienis tanpa bau apek."
    ],
    [
        "icon" => "⚖️",
        "title" => "Timbangan Digital Transparan",
        "description" => "Penimbangan langsung di depan pelanggan atau foto nota digital sebelum proses pencucian."
    ],
    [
        "icon" => "🛡️",
        "title" => "Garansi Cuci Ulang 100%",
        "description" => "Jika hasil cucian masih kotor atau kurang wangi, kami cuci ulang tanpa biaya tambahan."
    ]
];

$promoPrograms = [
    [
        "code" => "PROMO-HEMAT",
        "title" => "Diskon Cuci Kiloan 10%",
        "requirement" => "Minimal cuci 10 kg untuk semua layanan reguler",
        "tag" => "Hemat Kuota"
    ],
    [
        "code" => "FREE-PICKUP",
        "title" => "Gratis Antar-Jemput",
        "requirement" => "Khusus area dalam radius 3 km dari outlet terdekat",
        "tag" => "Favorit Pelanggan"
    ],
    [
        "code" => "MEMBER-PLUS",
        "title" => "Poin Membership PJ Club",
        "requirement" => "Tiap transaksi kelipatan Rp50.000 dapat 1 stamp cuci gratis",
        "tag" => "Member Loyal"
    ]
];

// ==========================================
// 3. ARRAY MULTIDIMENSI: KATALOG LAYANAN
// ==========================================
$servicesCatalog = [
    "kiloan_reguler" => [
        "name" => "Cuci Reguler + Setrika",
        "category" => "Kiloan",
        "price_per_unit" => 6000,
        "unit" => "kg",
        "duration" => "1-2 Hari",
        "icon" => "🧺",
        "description" => "Cuci bersih, setrika uap rapi, dan packing plastik kedap udara.",
        "is_popular" => true
    ],
    "kiloan_express" => [
        "name" => "Cuci Kilat Express",
        "category" => "Kiloan",
        "price_per_unit" => 12000,
        "unit" => "kg",
        "duration" => "3-5 Jam",
        "icon" => "⚡",
        "description" => "Antrean prioritas langsung diproses pada mesin terpisah, siap pakai.",
        "is_popular" => true
    ],
    "kiloan_premium" => [
        "name" => "Cuci Premium Anti-Bakteri",
        "category" => "Kiloan",
        "price_per_unit" => 9000,
        "unit" => "kg",
        "duration" => "1 Hari",
        "icon" => "✨",
        "description" => "Sanitasi uap panas, pelembut premium, serta pewangi tahan lama 14 hari.",
        "is_popular" => false
    ],
    "satuan_jas" => [
        "name" => "Jas & Blazer Formal",
        "category" => "Satuan",
        "price_per_unit" => 25000,
        "unit" => "pcs",
        "duration" => "2 Hari",
        "icon" => "👔",
        "description" => "Perawatan dry cleaning khusus agar bentuk kerah dan busa pundak terjaga.",
        "is_popular" => false
    ],
    "satuan_bedcover" => [
        "name" => "Bed Cover Jumbo",
        "category" => "Satuan",
        "price_per_unit" => 35000,
        "unit" => "pcs",
        "duration" => "2 Hari",
        "icon" => "🛏️",
        "description" => "Pencucian tabung besar drum 20 kg memastikan serat dacron mengembang optimal.",
        "is_popular" => true
    ],
    "satuan_sepatu" => [
        "name" => "Deep Clean Sepatu / Sneakers",
        "category" => "Satuan",
        "price_per_unit" => 30000,
        "unit" => "pasang",
        "duration" => "2-3 Hari",
        "icon" => "👟",
        "description" => "Pembersihan upper, insole, midsole & outsole dengan deterjen khusus sepatu.",
        "is_popular" => false
    ]
];

// ==========================================
// 4. ARRAY MULTIDIMENSI: DATA OUTLET CABANG
// ==========================================
$outlets = [
    [
        "id" => "OUT-001",
        "name" => "PJ Laundry Pusat - Teuku Umar",
        "city" => "Bojonegoro Kota",
        "address" => "Jl. Teuku Umar No. 42, Kadipaten",
        "phone" => "0812-3456-7801",
        "opening_hours" => "07.00 - 21.00 WIB",
        "capacity_kg" => 250,        // Kapasitas harian maksimal
        "used_capacity_kg" => 175,   // Kuota cucian saat ini
        "is_active" => true,         // Status operasional
        "manager" => "Budi Santoso",
        "facilities" => ["Antar Jemput Gratis", "Dry Cleaning", "Setrika Uap", "Lounge WiFi"],
        "rating" => 4.9
    ],
    [
        "id" => "OUT-002",
        "name" => "PJ Laundry Cabang Balen",
        "city" => "Balen",
        "address" => "Jl. Raya Balen - Sumberrejo No. 88, Balen",
        "phone" => "0812-3456-7802",
        "opening_hours" => "07.30 - 20.30 WIB",
        "capacity_kg" => 160,
        "used_capacity_kg" => 148,   // 92.5% kapasitas terpakai (status padat)
        "is_active" => true,
        "manager" => "Siti Nurhaliza",
        "facilities" => ["Cuci Kiloan", "Express 3 Jam", "Antar Jemput"],
        "rating" => 4.8
    ],
    [
        "id" => "OUT-003",
        "name" => "PJ Laundry Cabang Kapas",
        "city" => "Kapas",
        "address" => "Jl. Raya Bojonegoro - Cepu Km 4, Kapas",
        "phone" => "0812-3456-7803",
        "opening_hours" => "08.00 - 20.00 WIB",
        "capacity_kg" => 140,
        "used_capacity_kg" => 55,    // 39% kapasitas (lapang/siap tampung)
        "is_active" => true,
        "manager" => "Rian Wijaya",
        "facilities" => ["Cuci Bed Cover", "Pewangi Impor", "Parkir Luas"],
        "rating" => 4.7
    ],
    [
        "id" => "OUT-004",
        "name" => "PJ Laundry Cabang Dander",
        "city" => "Dander",
        "address" => "Jl. Raya Dander No. 15, Dander",
        "phone" => "0812-3456-7804",
        "opening_hours" => "Tutup Sementara",
        "capacity_kg" => 100,
        "used_capacity_kg" => 0,
        "is_active" => false,        // Status tutup (maintenance mesin boiler)
        "manager" => "Hendra Pratama",
        "facilities" => ["Cuci Kiloan", "Cuci Sepatu"],
        "rating" => 4.6
    ],
    [
        "id" => "OUT-005",
        "name" => "PJ Laundry Cabang Baureno",
        "city" => "Baureno",
        "address" => "Jl. Pasar Baureno No. 12, Baureno",
        "phone" => "0812-3456-7805",
        "opening_hours" => "07.00 - 20.00 WIB",
        "capacity_kg" => 180,
        "used_capacity_kg" => 90,    // 50% kapasitas terpakai
        "is_active" => true,
        "manager" => "Dewi Lestari",
        "facilities" => ["Express 4 Jam", "Antar Jemput", "Kemasan Vakum"],
        "rating" => 4.8
    ],
    [
        "id" => "OUT-006",
        "name" => "PJ Laundry Cabang Kalitidu",
        "city" => "Kalitidu",
        "address" => "Jl. Poros Kalitidu No. 27, Kalitidu",
        "phone" => "0812-3456-7806",
        "opening_hours" => "07.30 - 20.00 WIB",
        "capacity_kg" => 120,
        "used_capacity_kg" => 110,   // 91.6% kapasitas (padat)
        "is_active" => true,
        "manager" => "Ahmad Fauzi",
        "facilities" => ["Cuci Kiloan", "Setrika Uap", "Layanan Kilat"],
        "rating" => 4.7
    ]
];
