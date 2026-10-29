    <!-- ALUR LAYANAN (How It Works) -->
    <section id="alur" class="py-20 md:py-24 bg-[#fafaf8] text-slate-800">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <span class="reveal inline-block text-xs font-bold tracking-widest uppercase text-[#106367] mb-3 transition-all duration-700 opacity-0 translate-y-6 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">Alur Layanan</span>
        <h2 class="reveal font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-slate-900 leading-tight mb-4 transition-all duration-700 opacity-0 translate-y-6 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">Proses Mudah, Hasil Pasti</h2>
        <p class="reveal text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl mb-14 transition-all duration-700 opacity-0 translate-y-6 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">
          Dari serah terima hingga pakaian kembali ke tangan Anda — semuanya
          terlacak.
        </p>

        <div class="relative flex flex-col md:flex-row items-start justify-between gap-8 md:gap-4 mt-6">
          <div class="hidden md:block absolute top-9 left-12 right-12 h-0.5 border-t-2 border-dashed border-[#8cc0eb]/60 z-0"></div>

          <div class="reveal relative z-10 flex flex-row md:flex-col items-start md:items-center text-left md:text-center gap-4 flex-1 w-full transition-all duration-700 opacity-0 translate-y-6 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">
            <div class="relative w-16 h-16 md:w-18 md:h-18 rounded-full bg-white border-2 border-[#8cc0eb] shadow-md flex items-center justify-center text-2xl shrink-0">
              <span class="absolute -top-1.5 -right-1.5 md:-top-2 md:right-1/2 md:translate-x-7 w-6 h-6 rounded-full bg-[#106367] text-white text-xs font-extrabold flex items-center justify-center shadow-xs">1</span>
              <?= ViewHelper::lucideIcon('laundry', 'h-7 w-7 text-[#106367]') ?>
            </div>
            <div class="flex flex-col gap-1.5">
              <p class="text-base font-bold text-slate-900">Serah Terima &amp; Cek Barang</p>
              <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
                Barang diterima, dihitung beratnya, dan diperiksa kondisinya
                bersama pelanggan. Nota diterbitkan saat itu juga.
              </p>
            </div>
          </div>

          <div class="reveal relative z-10 flex flex-row md:flex-col items-start md:items-center text-left md:text-center gap-4 flex-1 w-full transition-all duration-700 opacity-0 translate-y-6 delay-100 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">
            <div class="relative w-16 h-16 md:w-18 md:h-18 rounded-full bg-white border-2 border-[#8cc0eb] shadow-md flex items-center justify-center text-2xl shrink-0">
              <span class="absolute -top-1.5 -right-1.5 md:-top-2 md:right-1/2 md:translate-x-7 w-6 h-6 rounded-full bg-[#106367] text-white text-xs font-extrabold flex items-center justify-center shadow-xs">2</span>
              <?= ViewHelper::lucideIcon('premium', 'h-7 w-7 text-[#106367]') ?>
            </div>
            <div class="flex flex-col gap-1.5">
              <p class="text-base font-bold text-slate-900">Sortir &amp; Pra-Perawatan</p>
              <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
                Pakaian disortir per warna dan bahan. Noda besar ditangani
                dengan pre-treatment khusus sebelum masuk mesin.
              </p>
            </div>
          </div>

          <div class="reveal relative z-10 flex flex-row md:flex-col items-start md:items-center text-left md:text-center gap-4 flex-1 w-full transition-all duration-700 opacity-0 translate-y-6 delay-200 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">
            <div class="relative w-16 h-16 md:w-18 md:h-18 rounded-full bg-white border-2 border-[#8cc0eb] shadow-md flex items-center justify-center text-2xl shrink-0">
              <span class="absolute -top-1.5 -right-1.5 md:-top-2 md:right-1/2 md:translate-x-7 w-6 h-6 rounded-full bg-[#106367] text-white text-xs font-extrabold flex items-center justify-center shadow-xs">3</span>
              <?= ViewHelper::lucideIcon('express', 'h-7 w-7 text-[#106367]') ?>
            </div>
            <div class="flex flex-col gap-1.5">
              <p class="text-base font-bold text-slate-900">Proses Pencucian</p>
              <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
                Masuk mesin dengan program yang tepat. Deterjen eco-friendly,
                air bersih. Dimonitor oleh tim kami secara aktif.
              </p>
            </div>
          </div>

          <div class="reveal relative z-10 flex flex-row md:flex-col items-start md:items-center text-left md:text-center gap-4 flex-1 w-full transition-all duration-700 opacity-0 translate-y-6 delay-300 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">
            <div class="relative w-16 h-16 md:w-18 md:h-18 rounded-full bg-white border-2 border-[#8cc0eb] shadow-md flex items-center justify-center text-2xl shrink-0">
              <span class="absolute -top-1.5 -right-1.5 md:-top-2 md:right-1/2 md:translate-x-7 w-6 h-6 rounded-full bg-[#106367] text-white text-xs font-extrabold flex items-center justify-center shadow-xs">4</span>
              <?= ViewHelper::lucideIcon('delivery', 'h-7 w-7 text-[#106367]') ?>
            </div>
            <div class="flex flex-col gap-1.5">
              <p class="text-base font-bold text-slate-900">Pengeringan &amp; Finishing</p>
              <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
                Dikeringkan sempurna, dilipat atau digantung rapi, dan dikemas
                sesuai layanan yang dipilih.
              </p>
            </div>
          </div>

          <div class="reveal relative z-10 flex flex-row md:flex-col items-start md:items-center text-left md:text-center gap-4 flex-1 w-full transition-all duration-700 opacity-0 translate-y-6 delay-400 data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0">
            <div class="relative w-16 h-16 md:w-18 md:h-18 rounded-full bg-white border-2 border-[#8cc0eb] shadow-md flex items-center justify-center text-2xl shrink-0">
              <span class="absolute -top-1.5 -right-1.5 md:-top-2 md:right-1/2 md:translate-x-7 w-6 h-6 rounded-full bg-[#106367] text-white text-xs font-extrabold flex items-center justify-center shadow-xs">5</span>
              <?= ViewHelper::lucideIcon('bell', 'h-7 w-7 text-[#106367]') ?>
            </div>
            <div class="flex flex-col gap-1.5">
              <p class="text-base font-bold text-slate-900">Notifikasi &amp; Pengambilan</p>
              <p class="text-xs md:text-sm text-slate-600 leading-relaxed">
                Anda mendapat notifikasi WhatsApp saat cucian siap. Ambil
                langsung atau kami antar ke lokasi Anda.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
