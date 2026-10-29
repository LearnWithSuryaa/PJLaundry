    <section
      id="hero"
      aria-label="Beranda"
      class="relative flex min-h-screen w-full items-center overflow-hidden bg-[#122224] bg-cover bg-center bg-no-repeat pt-24 pb-16 md:py-28"
      style="background-image: url('/week-7/assets/images/hero.png')"
    >
      <div class="hero-overlay absolute inset-0" aria-hidden="true"></div>

      <div class="relative z-10 mx-auto flex w-full max-w-7xl flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16 px-6 sm:px-8 lg:px-12 py-8">
        <!-- LEFT -->
        <div class="hero-copy flex flex-1 flex-col gap-6 text-white max-w-xl">
          <div class="inline-flex w-fit items-center gap-2 rounded-full border border-white/20 bg-white/10 backdrop-blur-md px-4 py-1.5 text-xs sm:text-sm font-semibold text-white tracking-wide shadow-sm">
            <?= ViewHelper::lucideIcon('premium', 'h-4 w-4') ?> Laundry Premium &nbsp;·&nbsp; Harga Jujur
          </div>

          <h1 class="font-serif text-4xl sm:text-5xl lg:text-6xl font-bold leading-[1.12] text-white drop-shadow-sm">
            Cuci Bersih,<br />
            <em class="not-italic text-[#ffc857]">Tanpa Drama.</em>
          </h1>

          <p class="text-base sm:text-lg leading-relaxed text-white/85">
            Serahkan cucian Anda ke tangan yang tepat. Kami proses dengan
            deterjen eco-friendly, mesin modern, dan standar higienis yang ketat
            — siap sesuai jadwal.
          </p>

          <div class="flex flex-wrap items-center gap-4 pt-2">
            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-full bg-[#25d366] px-8 py-3.5 text-base font-bold text-white shadow-lg shadow-emerald-600/30 transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#1eb956]"> Order Sekarang </a>
            <a href="#layanan" class="inline-flex items-center justify-center gap-2 rounded-full border border-white/30 bg-white/10 backdrop-blur-md px-7 py-3.5 text-base font-semibold text-white transition-all duration-200 hover:-translate-y-0.5 hover:bg-white/20">Lihat Harga ↓</a>
          </div>
        </div>

        <!-- RIGHT CARD -->
        <div class="w-full max-w-md lg:w-110 rounded-3xl bg-white p-7 sm:p-8 flex flex-col gap-6 shadow-2xl text-slate-800 border border-white/20">
          <div class="flex flex-wrap gap-2">
            <span class="rounded-full bg-[#fff9d2] px-3 py-1 text-xs font-bold text-[#856404] uppercase tracking-wide">Premium</span>
            <span class="rounded-full bg-[#bfddf0] px-3 py-1 text-xs font-bold text-[#106367] uppercase tracking-wide">Express</span>
            <span class="rounded-full bg-[#ffebcc] px-3 py-1 text-xs font-bold text-[#9a3412] uppercase tracking-wide">Antar-Jemput</span>
          </div>
          <p id="service-title" class="text-xl sm:text-2xl font-bold leading-snug text-slate-900">
            Perawatan Khusus &amp; Profesional
          </p>
          <img
            src="/week-7/assets/images/hero-2.png"
            alt="Proses laundry profesional"
            loading="eager"
            fetchpriority="high"
            class="h-48 sm:h-52 w-full rounded-2xl object-cover shadow-sm"
          />
          <div class="grid grid-cols-3 gap-3 border-t border-slate-100 pt-5 text-center">
            <div class="flex flex-col gap-0.5">
              <strong class="block font-serif text-xl sm:text-2xl font-extrabold text-[#106367] leading-tight">5K+</strong>
              <span class="text-xs text-slate-500 font-medium">Pelanggan</span>
            </div>
            <div class="flex flex-col gap-0.5">
              <strong class="block font-serif text-xl sm:text-2xl font-extrabold text-[#106367] leading-tight">6 Thn</strong>
              <span class="text-xs text-slate-500 font-medium">Pengalaman</span>
            </div>
            <div class="flex flex-col gap-0.5">
              <strong class="block font-serif text-xl sm:text-2xl font-extrabold text-[#106367] leading-tight">99%</strong>
              <span class="text-xs text-slate-500 font-medium">Kepuasan</span>
            </div>
          </div>
        </div>
      </div>
    </section>
