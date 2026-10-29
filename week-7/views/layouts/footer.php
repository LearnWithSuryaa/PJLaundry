    <!-- FOOTER & KONTAK -->
    <footer id="kontak" class="bg-[#1a1a1a] text-slate-300 pt-16 pb-8 border-t border-white/5">
      <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-12 pb-14 border-b border-white/10">
          <!-- Brand -->
          <div class="flex flex-col gap-4">
            <span class="font-serif text-2xl font-bold text-white tracking-wide">PJ LAUNDRY</span>
            <p class="text-sm text-slate-400 leading-relaxed">
              Mitra terpercaya untuk cucian bersih, harum, dan rapi Anda sejak
              2018. Mengadopsi arsitektur MVC (Model-View-Controller) untuk performa dan struktur terstandar.
            </p>
            <div class="flex items-center gap-3 pt-2">
              <a href="#" aria-label="Instagram" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 flex items-center justify-center transition-all hover:-translate-y-0.5 text-white"><?= ViewHelper::lucideIcon('premium', 'h-5 w-5') ?></a>
              <a href="#" aria-label="Facebook" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 flex items-center justify-center transition-all hover:-translate-y-0.5 text-white"><?= ViewHelper::lucideIcon('shirt', 'h-5 w-5') ?></a>
              <a
                href="https://wa.me/6281234567890"
                aria-label="WhatsApp"
                target="_blank"
                rel="noopener noreferrer"
                class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 flex items-center justify-center text-lg transition-all hover:-translate-y-0.5 text-white"
              ><?= ViewHelper::lucideIcon('delivery', 'h-5 w-5') ?></a>
              <a href="#" aria-label="TikTok" class="w-10 h-10 rounded-full bg-white/10 hover:bg-white/20 border border-white/10 flex items-center justify-center transition-all hover:-translate-y-0.5 text-white"><?= ViewHelper::lucideIcon('express', 'h-5 w-5') ?></a>
            </div>
          </div>

          <!-- Links -->
          <div class="flex flex-col gap-3">
            <h4 class="text-xs font-bold tracking-widest uppercase text-slate-400 mb-2">Navigasi</h4>
            <a href="#layanan" class="text-sm text-slate-400 hover:text-white transition-colors">Katalog Layanan</a>
            <a href="#aturan" class="text-sm text-slate-400 hover:text-white transition-colors">Aturan Cuci</a>
            <a href="#alur" class="text-sm text-slate-400 hover:text-white transition-colors">Alur Layanan</a>
            <a href="#faq" class="text-sm text-slate-400 hover:text-white transition-colors">FAQ</a>
            <a
              href="https://wa.me/6281234567890"
              target="_blank"
              rel="noopener noreferrer"
              class="text-sm text-[#25d366] hover:text-[#1eb956] font-semibold transition-colors"
            >Order via WhatsApp</a>
          </div>

          <!-- Hours -->
          <div class="flex flex-col gap-3">
            <h4 class="text-xs font-bold tracking-widest uppercase text-slate-400 mb-2">Jam Operasional</h4>
            <ul class="flex flex-col gap-2.5 text-xs text-slate-400 mb-2">
              <li class="flex justify-between border-b border-white/5 pb-1"><span>Senin – Jumat</span><strong class="text-white font-semibold">08.00–20.00</strong></li>
              <li class="flex justify-between border-b border-white/5 pb-1"><span>Sabtu</span><strong class="text-white font-semibold">08.00–18.00</strong></li>
              <li class="flex justify-between border-b border-white/5 pb-1"><span>Minggu</span><strong class="text-white font-semibold">09.00–15.00</strong></li>
            </ul>
            <p class="text-xs text-slate-400 leading-relaxed">
              <span class="font-semibold text-slate-300">Telepon:</span> +62 812-3456-7890<br />
              <span class="font-semibold text-slate-300">Email:</span> halo@pjlaundry.id
            </p>
          </div>

          <!-- Map -->
          <div class="flex flex-col gap-3">
            <h4 class="text-xs font-bold tracking-widest uppercase text-slate-400 mb-2">Lokasi Outlet</h4>
            <p class="text-xs text-slate-400 leading-relaxed mb-1">
              Jl. Kelapa No. 141<br />Kel. Kabunan, Kabupaten Bojonegoro<br />1136
            </p>
            <div class="w-full h-32 rounded-xl overflow-hidden border border-white/10 shadow-inner">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521!2d106.8456!3d-6.2088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMzEuNiJTIDEwNsKwNTAnNDQuMiJF!5e0!3m2!1sen!2sid!4v1234567890"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Lokasi PJ Laundry"
                class="w-full h-full border-0"
              >
              </iframe>
            </div>
          </div>
        </div>

        <!-- Bottom bar -->
        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
          <p>&copy; <?= date('Y') ?> PJ Laundry. Hak cipta dilindungi undang-undang. Arsitektur MVC.</p>
          <p>Dibuat untuk pelanggan setia kami.</p>
        </div>
      </div>
    </footer>

    <script src="/week-7/script.js"></script>
    <script>
      lucide.createIcons();
    </script>
  </body>
</html>
