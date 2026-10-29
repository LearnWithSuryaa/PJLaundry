<?php
/**
 * @var string $pageTitle
 */
?>
<!doctype html>
<html lang="id" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= ViewHelper::escape($pageTitle ?? 'PJ Laundry – Cuci Bersih, Tanpa Drama') ?></title>
    <meta
      name="description"
      content="PJ Laundry – Layanan laundry premium dengan arsitektur MVC PHP. Kiloan, satuan, karpet, dan sepatu. Antar-jemput tersedia. Order via WhatsApp!"
    />
    <link rel="stylesheet" href="/week-7/assets/css/style.css" />
    <script src="https://unpkg.com/lucide@latest"></script>
  </head>
  <body class="min-h-screen overflow-x-hidden bg-[#fafaf8] font-sans text-slate-800 antialiased">
    <header class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-200/80 transition-shadow duration-300">
      <nav id="navbar" class="mx-auto flex max-w-7xl items-center justify-between px-6 lg:px-12 py-4 transition-all duration-300 data-[state~=scrolled]:py-3 data-[state~=scrolled]:shadow-sm">
        <a href="#" class="font-serif text-2xl font-bold tracking-tight text-[#106367] transition-opacity hover:opacity-90">PJ LAUNDRY</a>

        <button id="navToggle" aria-label="Buka menu" class="md:hidden flex flex-col justify-center items-center gap-1.5 w-10 h-10 rounded-xl hover:bg-slate-100 transition-colors cursor-pointer">
          <span class="block w-6 h-0.5 bg-slate-800 rounded-full transition-all"></span>
          <span class="block w-6 h-0.5 bg-slate-800 rounded-full transition-all"></span>
          <span class="block w-6 h-0.5 bg-slate-800 rounded-full transition-all"></span>
        </button>

        <ul id="navLinks" class="hidden md:flex items-center gap-8 list-none max-md:absolute max-md:top-full max-md:left-0 max-md:right-0 max-md:bg-white/98 max-md:backdrop-blur-lg max-md:flex-col max-md:gap-5 max-md:p-6 max-md:border-b max-md:border-slate-200 max-md:shadow-xl max-md:data-[state~=open]:flex">
          <li><a href="#layanan" class="text-sm font-semibold text-slate-700 hover:text-[#106367] transition-colors relative py-1">Layanan</a></li>
          <li><a href="#aturan" class="text-sm font-semibold text-slate-700 hover:text-[#106367] transition-colors relative py-1">Aturan Cuci</a></li>
          <li><a href="#alur" class="text-sm font-semibold text-slate-700 hover:text-[#106367] transition-colors relative py-1">Alur Layanan</a></li>
          <li><a href="#faq" class="text-sm font-semibold text-slate-700 hover:text-[#106367] transition-colors relative py-1">FAQ</a></li>
          <li><a href="#kontak" class="text-sm font-semibold text-slate-700 hover:text-[#106367] transition-colors relative py-1">Kontak</a></li>
        </ul>

        <a href="https://wa.me/6281234567890" target="_blank" rel="noopener noreferrer" class="hidden md:inline-flex items-center gap-2 rounded-full bg-[#25d366] px-6 py-2.5 text-sm font-bold text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:bg-[#1eb956] hover:shadow-md whitespace-nowrap">
          Order via WhatsApp
        </a>
      </nav>
    </header>
