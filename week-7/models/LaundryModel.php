<?php
declare(strict_types=1);

require_once __DIR__ . '/LaundryService.php';

class LaundryModel
{
    /**
     * @var LaundryService[]
     */
    private array $services = [];

    public function __construct()
    {
        $this->loadData();
    }

    /**
     * Initialize services with domain data.
     */
    private function loadData(): void
    {
        $rawServices = [
            [
                'category' => 'kiloan',
                'name' => 'Cuci Reguler',
                'icon' => 'laundry',
                'description' => 'Cuci + keringkan + lipat. Deterjen standar berkualitas untuk pakaian sehari-hari.',
                'price' => 'Rp 6.000/kg',
                'duration' => '⏱ 1–2 hari',
                'theme' => 'yellow',
            ],
            [
                'category' => 'kiloan',
                'name' => 'Cuci Express',
                'icon' => 'express',
                'description' => 'Selesai dalam 3–5 jam dengan prioritas antrean. Minimal 3 kg.',
                'price' => 'Rp 12.000/kg',
                'duration' => '⏱ 3–5 jam',
                'theme' => 'blue',
            ],
            [
                'category' => 'kiloan',
                'name' => 'Cuci Premium',
                'icon' => 'premium',
                'description' => 'Deterjen premium, pewangi eksklusif, dan kemasan rapi untuk pakaian istimewa.',
                'price' => 'Rp 10.000/kg',
                'duration' => '⏱ 1–2 hari',
                'theme' => 'peach',
            ],
            [
                'category' => 'kiloan',
                'name' => 'Antar-Jemput',
                'icon' => 'delivery',
                'description' => 'Jemput dari rumah dan antar kembali setelah selesai. Gratis untuk area tertentu.',
                'price' => '+Rp 5.000 ongkir',
                'duration' => '⏱ Sesuai layanan',
                'theme' => 'teal',
            ],
            [
                'category' => 'satuan',
                'name' => 'Kemeja / Kaos',
                'icon' => 'shirt',
                'description' => 'Dicuci, dikeringkan, dan disetrika rapi untuk seragam kantor atau pakaian formal.',
                'price' => 'Rp 5.000/pcs',
                'duration' => '⏱ 1 hari',
                'theme' => 'yellow',
            ],
            [
                'category' => 'satuan',
                'name' => 'Dress / Gaun',
                'icon' => 'dress',
                'description' => 'Penanganan ekstra hati-hati untuk bahan halus dengan pengeringan gantung.',
                'price' => 'Rp 15.000/pcs',
                'duration' => '⏱ 1–2 hari',
                'theme' => 'blue',
            ],
            [
                'category' => 'satuan',
                'name' => 'Jas / Blazer',
                'icon' => 'jacket',
                'description' => 'Dry cleaning atau cuci manual, setrika uap, dan dikemas dengan hanger.',
                'price' => 'Rp 30.000/pcs',
                'duration' => '⏱ 2–3 hari',
                'theme' => 'peach',
            ],
            [
                'category' => 'satuan',
                'name' => 'Sprei / Selimut',
                'icon' => 'bedding',
                'description' => 'Mesin berkapasitas besar dengan deterjen antibakteri untuk hasil higienis.',
                'price' => 'Rp 20.000/pcs',
                'duration' => '⏱ 1–2 hari',
                'theme' => 'teal',
            ],
            [
                'category' => 'karpet',
                'name' => 'Karpet Kecil (s.d. 1m²)',
                'icon' => 'carpet',
                'description' => 'Pengerjaan manual dengan sikat khusus dan pengeringan sempurna.',
                'price' => 'Rp 20.000/pcs',
                'duration' => '⏱ 2–3 hari',
                'theme' => 'yellow',
            ],
            [
                'category' => 'karpet',
                'name' => 'Karpet Besar (>1m²)',
                'icon' => 'carpet',
                'description' => 'Proses mesin ekstra besar agar karpet bersih merata di setiap bagian.',
                'price' => 'Rp 15.000/m²',
                'duration' => '⏱ 3–5 hari',
                'theme' => 'blue',
            ],
            [
                'category' => 'karpet',
                'name' => 'Sepatu Biasa',
                'icon' => 'shoe',
                'description' => 'Cuci manual, sikat, dan pengeringan angin untuk sneaker dan sepatu olahraga.',
                'price' => 'Rp 20.000/pasang',
                'duration' => '⏱ 1–2 hari',
                'theme' => 'peach',
            ],
            [
                'category' => 'karpet',
                'name' => 'Sepatu Kulit / Premium',
                'icon' => 'shoe',
                'description' => 'Pembersihan khusus bahan kulit dengan conditioning untuk menjaga kilap.',
                'price' => 'Rp 40.000/pasang',
                'duration' => '⏱ 2–3 hari',
                'theme' => 'teal',
            ],
        ];

        $this->services = array_map(
            static fn(array $item): LaundryService => new LaundryService(
                $item['category'],
                $item['name'],
                $item['icon'],
                $item['description'],
                $item['price'],
                $item['duration'],
                $item['theme']
            ),
            $rawServices
        );
    }

    /**
     * Get all services.
     *
     * @return LaundryService[]
     */
    public function getAll(): array
    {
        return $this->services;
    }

    /**
     * Get services filtered by category.
     *
     * @param string $category
     * @return LaundryService[]
     */
    public function getByCategory(string $category): array
    {
        return array_values(
            array_filter(
                $this->services,
                static fn(LaundryService $service): bool => $service->getCategory() === $category
            )
        );
    }

    /**
     * Get all services grouped by category key.
     *
     * @return array<string, LaundryService[]>
     */
    public function getGroupedByCategory(): array
    {
        $grouped = [];
        foreach ($this->services as $service) {
            $grouped[$service->getCategory()][] = $service;
        }

        return $grouped;
    }

    /**
     * Get unique categories.
     *
     * @return string[]
     */
    public function getCategories(): array
    {
        return array_values(array_unique(array_map(
            static fn(LaundryService $s): string => $s->getCategory(),
            $this->services
        )));
    }

    /**
     * Get total count of available services.
     */
    public function getTotalCount(): int
    {
        return count($this->services);
    }

    /**
     * Find a service by name.
     */
    public function findByName(string $name): ?LaundryService
    {
        foreach ($this->services as $service) {
            if (strcasecmp($service->getName(), $name) === 0) {
                return $service;
            }
        }

        return null;
    }
}
