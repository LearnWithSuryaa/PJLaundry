<?php
/**
 * ============================================================================
 * FUNCTIONS (FUNGSI PEMROSESAN SERVER-SIDE PHP)
 * ============================================================================
 * Modul Week 5 mewajibkan:
 * 1. Function sederhana digunakan untuk mengolah atau memformat data.
 * 2. Conditional (if-elseif-else) menentukan status outlet dan logika bisnis.
 * 3. Operator (aritmatika, perbandingan, logika, ternary) untuk komputasi data.
 * 4. Loop (foreach) untuk kalkulasi agregat statistik.
 */

/**
 * Format angka numerik ke format Rupiah standar Indonesia.
 * Contoh: 6000 -> "Rp 6.000"
 *
 * @param int|float $amount
 * @return string
 */
function format_rupiah($amount): string
{
    // Menggunakan fungsi bawaan PHP number_format()
    return "Rp " . number_format((float) $amount, 0, ',', '.');
}

/**
 * Evaluasi status outlet berdasarkan kondisi keaktifan dan persentase kapasitas.
 * Menerapkan conditional (if, elseif, else), operator perbandingan, dan operator aritmatika.
 *
 * @param array $outlet
 * @return array
 */
function get_outlet_status(array $outlet): array
{
    // 1. Kondisi jika outlet sedang nonaktif / tutup
    if ($outlet['is_active'] === false) {
        return [
            'code'           => 'closed',
            'label'          => 'Tutup Sementara',
            'badge_class'    => 'badge-closed',
            'dot_color'      => '#e63946',
            'is_open'        => false,
            'occupancy_pct'  => 0,
            'available_kg'   => 0,
            'description'    => 'Sedang pemeliharaan mesin berkala. Kunjungi cabang terdekat.'
        ];
    }

    // 2. Hitung persentase kapasitas terpakai menggunakan operator pembagian (/) dan perkalian (*)
    $capacity = (float) $outlet['capacity_kg'];
    $used     = (float) $outlet['used_capacity_kg'];
    
    // Operator ternary untuk mencegah pembagian dengan nol
    $occupancyPct = ($capacity > 0) ? round(($used / $capacity) * 100, 1) : 0;
    
    // Operator pengurangan (-) untuk menghitung sisa kapasitas
    $availableKg  = max(0, $capacity - $used);

    // 3. Conditional bersarang bertingkat untuk status kepadatan antrean
    if ($occupancyPct >= 90.0) {
        return [
            'code'          => 'busy',
            'label'         => 'Buka - Kuota Padat (' . $occupancyPct . '%)',
            'badge_class'   => 'badge-busy',
            'dot_color'     => '#f77f00',
            'is_open'       => true,
            'occupancy_pct' => $occupancyPct,
            'available_kg'  => $availableKg,
            'description'   => 'Antrean cucian cukup padat. Estimasi pengerjaan reguler +2 jam.'
        ];
    } elseif ($occupancyPct >= 50.0) {
        return [
            'code'          => 'normal',
            'label'         => 'Buka - Normal (' . $occupancyPct . '%)',
            'badge_class'   => 'badge-normal',
            'dot_color'     => '#0d9488',
            'is_open'       => true,
            'occupancy_pct' => $occupancyPct,
            'available_kg'  => $availableKg,
            'description'   => 'Operasional lancar. Menerima cucian kiloan, satuan, dan express.'
        ];
    } else {
        return [
            'code'          => 'available',
            'label'         => 'Buka - Kuota Lapang (' . $occupancyPct . '%)',
            'badge_class'   => 'badge-available',
            'dot_color'     => '#16a34a',
            'is_open'       => true,
            'occupancy_pct' => $occupancyPct,
            'available_kg'  => $availableKg,
            'description'   => 'Kapasitas sangat lapang. Cucian siap diproses secara instan!'
        ];
    }
}

/**
 * Menghitung agregat statistik seluruh outlet.
 * Menerapkan Loop (foreach), Operator Aritmatika (+, -, /, *), dan Conditional (if).
 *
 * @param array $outlets
 * @return array
 */
function calculate_outlet_statistics(array $outlets): array
{
    $totalCount        = count($outlets);
    $activeCount       = 0;
    $closedCount       = 0;
    $busyCount         = 0;
    $totalCapacityKg   = 0;
    $totalUsedKg       = 0;

    // Loop foreach untuk memproses setiap elemen array outlet
    foreach ($outlets as $outlet) {
        $totalCapacityKg += $outlet['capacity_kg'];
        $totalUsedKg     += $outlet['used_capacity_kg'];

        // Conditional pengecekan keaktifan outlet
        if ($outlet['is_active']) {
            $activeCount++;
            
            // Hitung rasio untuk kategori padat
            $ratio = ($outlet['capacity_kg'] > 0) 
                ? ($outlet['used_capacity_kg'] / $outlet['capacity_kg']) 
                : 0;

            if ($ratio >= 0.9) {
                $busyCount++;
            }
        } else {
            $closedCount++;
        }
    }

    // Operator aritmatika pengurangan
    $totalRemainingKg = $totalCapacityKg - $totalUsedKg;

    // Operator aritmatika pembagian & ternary
    $overallUtilization = ($totalCapacityKg > 0)
        ? round(($totalUsedKg / $totalCapacityKg) * 100, 1)
        : 0;

    $averageLoadPerActiveOutlet = ($activeCount > 0)
        ? round($totalUsedKg / $activeCount, 1)
        : 0;

    return [
        'total_outlets'        => $totalCount,
        'active_outlets'       => $activeCount,
        'closed_outlets'       => $closedCount,
        'busy_outlets'         => $busyCount,
        'total_capacity_kg'    => $totalCapacityKg,
        'total_used_kg'        => $totalUsedKg,
        'remaining_capacity_kg'=> $totalRemainingKg,
        'utilization_rate_pct' => $overallUtilization,
        'avg_load_per_outlet'  => $averageLoadPerActiveOutlet
    ];
}

/**
 * Filter dan pencarian data outlet di sisi server (Server-Side Processing).
 * Menerapkan conditional, operator logika (&&, ||), dan string comparison.
 *
 * @param array  $outlets
 * @param string $statusFilter 'all' | 'active' | 'closed' | 'busy' | 'available'
 * @param string $searchQuery  Kata kunci pencarian
 * @return array
 */
function filter_outlets(array $outlets, string $statusFilter = 'all', string $searchQuery = ''): array
{
    $filtered = [];
    $searchLower = strtolower(trim($searchQuery));

    foreach ($outlets as $outlet) {
        $statusInfo = get_outlet_status($outlet);

        // 1. Cek kecocokan Filter Status
        $matchesStatus = true;
        if ($statusFilter === 'active') {
            $matchesStatus = ($outlet['is_active'] === true);
        } elseif ($statusFilter === 'closed') {
            $matchesStatus = ($outlet['is_active'] === false);
        } elseif ($statusFilter === 'busy') {
            $matchesStatus = ($statusInfo['code'] === 'busy');
        } elseif ($statusFilter === 'available') {
            $matchesStatus = ($statusInfo['code'] === 'available');
        }

        // 2. Cek kecocokan Filter Pencarian Teks
        $matchesSearch = true;
        if ($searchLower !== '') {
            $targetText = strtolower(
                $outlet['name'] . ' ' . 
                $outlet['city'] . ' ' . 
                $outlet['address'] . ' ' . 
                $outlet['manager']
            );
            $matchesSearch = (strpos($targetText, $searchLower) !== false);
        }

        // 3. Gabungkan dengan operator logika AND (&&)
        if ($matchesStatus && $matchesSearch) {
            $filtered[] = $outlet;
        }
    }

    return $filtered;
}

/**
 * Menghitung estimasi biaya pesanan laundry secara dinamis di server PHP.
 *
 * @param array  $servicesCatalog
 * @param string $serviceKey
 * @param float  $weightOrQty
 * @param bool   $isExpress
 * @param bool   $isPickup
 * @return array|null
 */
function calculate_order_estimate(
    array $servicesCatalog,
    string $serviceKey,
    float $weightOrQty,
    bool $isExpress,
    bool $isPickup
): ?array {
    if (!isset($servicesCatalog[$serviceKey]) || $weightOrQty <= 0) {
        return null;
    }

    $service   = $servicesCatalog[$serviceKey];
    $basePrice = $service['price_per_unit'];

    // 1. Subtotal dasar (Operator perkalian)
    $subtotal = $basePrice * $weightOrQty;

    // 2. Biaya tambahan express (Operator ternary)
    // Layanan kilat menambah Rp4.000 per unit (hanya jika kiloan)
    $expressFee = ($isExpress && $service['category'] === 'Kiloan') ? (4000 * $weightOrQty) : 0;

    // 3. Biaya antar jemput
    $pickupFee = $isPickup ? 5000 : 0;

    // 4. Perhitungan diskon volume (Conditional & Operator Logika)
    $discountPct = 0;
    if ($service['category'] === 'Kiloan') {
        if ($weightOrQty >= 20.0) {
            $discountPct = 15; // 15% jika >= 20 kg
        } elseif ($weightOrQty >= 10.0) {
            $discountPct = 10; // 10% jika >= 10 kg
        }
    }

    $discountAmount = ($discountPct > 0) ? ($subtotal * ($discountPct / 100)) : 0;

    // 5. Total Akhir (Operator penjumlahan dan pengurangan)
    $grandTotal = ($subtotal + $expressFee + $pickupFee) - $discountAmount;

    return [
        'service_name'    => $service['name'],
        'category'        => $service['category'],
        'unit'            => $service['unit'],
        'quantity'        => $weightOrQty,
        'base_price'      => $basePrice,
        'subtotal'        => (int) $subtotal,
        'is_express'      => $isExpress,
        'express_fee'     => (int) $expressFee,
        'is_pickup'       => $isPickup,
        'pickup_fee'      => (int) $pickupFee,
        'discount_pct'    => $discountPct,
        'discount_amount' => (int) $discountAmount,
        'grand_total'     => (int) $grandTotal,
        'duration'        => $isExpress ? '3-5 Jam Kilat' : $service['duration']
    ];
}
