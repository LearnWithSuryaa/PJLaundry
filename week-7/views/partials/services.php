<?php
/**
 * @var array<string, LaundryService[]> $servicesByCategory
 * @var int $totalCount
 * @var string $activeTab
 */
?>
    <!-- KATALOG LAYANAN & ESTIMASI HARGA -->
    <section id="layanan" class="py-20 md:py-24 bg-[#f8fafc] text-slate-800">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <span class="reveal inline-block text-xs font-bold tracking-widest uppercase text-[#106367] mb-3 transition-all duration-700 opacity-0 translate-y-6 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">Katalog Layanan (MVC Model Data)</span>
        <h2 class="reveal font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 leading-tight mb-4 transition-all duration-700 opacity-0 translate-y-6 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">Pilih Layanan Anda</h2>
        <p class="reveal text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl mb-10 transition-all duration-700 opacity-0 translate-y-6 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">
          Harga transparan, tanpa biaya tersembunyi. Estimasi waktu dihitung
          dari barang diterima.
        </p>

        <!-- Tabs -->
        <div role="tablist" class="flex flex-wrap gap-3 mb-6">
          <button
            data-state="<?= $activeTab === 'kiloan' ? 'active' : '' ?>"
            data-tab="kiloan"
            role="tab"
            aria-selected="<?= $activeTab === 'kiloan' ? 'true' : 'false' ?>"
            id="tab-kiloan"
            class="tab-btn cursor-pointer rounded-full border border-slate-200 bg-white px-6 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-slate-900 hover:bg-slate-900 hover:text-white data-[state~=active]:border-slate-900 data-[state~=active]:bg-slate-900 data-[state~=active]:text-white"
          >
            Kiloan
          </button>
          <button
            data-state="<?= $activeTab === 'satuan' ? 'active' : '' ?>"
            data-tab="satuan"
            role="tab"
            aria-selected="<?= $activeTab === 'satuan' ? 'true' : 'false' ?>"
            id="tab-satuan"
            class="tab-btn cursor-pointer rounded-full border border-slate-200 bg-white px-6 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-slate-900 hover:bg-slate-900 hover:text-white data-[state~=active]:border-slate-900 data-[state~=active]:bg-slate-900 data-[state~=active]:text-white"
          >
            Satuan
          </button>
          <button
            data-state="<?= $activeTab === 'karpet' ? 'active' : '' ?>"
            data-tab="karpet"
            role="tab"
            aria-selected="<?= $activeTab === 'karpet' ? 'true' : 'false' ?>"
            id="tab-karpet"
            class="tab-btn cursor-pointer rounded-full border border-slate-200 bg-white px-6 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition-all hover:border-slate-900 hover:bg-slate-900 hover:text-white data-[state~=active]:border-slate-900 data-[state~=active]:bg-slate-900 data-[state~=active]:text-white"
          >
            Karpet &amp; Sepatu
          </button>
        </div>

        <p
          id="servicesStatus"
          role="status"
          aria-live="polite"
          class="min-h-6 mb-6 text-right text-sm font-medium text-emerald-600"
        >
          <?= (int)$totalCount ?> layanan berhasil dimuat dari server (Controller &rarr; Model).
        </p>

        <!-- Panel layanan dirender server-side dengan arsitektur MVC -->
        <div
          id="panel-kiloan"
          role="tabpanel"
          aria-labelledby="tab-kiloan"
          data-state="<?= $activeTab === 'kiloan' ? 'active' : '' ?>"
          class="services-panel hidden data-[state~=active]:grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
        >
          <?php foreach ($servicesByCategory['kiloan'] ?? [] as $index => $service): ?>
            <?php BaseController::partial('service_card', ['service' => $service, 'index' => $index]); ?>
          <?php endforeach; ?>
        </div>

        <div
          id="panel-satuan"
          role="tabpanel"
          aria-labelledby="tab-satuan"
          data-state="<?= $activeTab === 'satuan' ? 'active' : '' ?>"
          class="services-panel hidden data-[state~=active]:grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
        >
          <?php foreach ($servicesByCategory['satuan'] ?? [] as $index => $service): ?>
            <?php BaseController::partial('service_card', ['service' => $service, 'index' => $index]); ?>
          <?php endforeach; ?>
        </div>

        <div
          id="panel-karpet"
          role="tabpanel"
          aria-labelledby="tab-karpet"
          data-state="<?= $activeTab === 'karpet' ? 'active' : '' ?>"
          class="services-panel hidden data-[state~=active]:grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6"
        >
          <?php foreach ($servicesByCategory['karpet'] ?? [] as $index => $service): ?>
            <?php BaseController::partial('service_card', ['service' => $service, 'index' => $index]); ?>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
