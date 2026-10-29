<?php
/**
 * @var LaundryService $service
 * @var int $index
 */

$theme = $service->getThemeClasses();
$delays = ['', 'delay-100', 'delay-200', 'delay-300', 'delay-400'];
$delay = $delays[$index] ?? '';
?>
<div class="service-card reveal relative flex flex-col justify-between rounded-2xl bg-white p-6 border border-slate-200/80 shadow-[0_4px_20px_rgba(0,0,0,0.05)] hover:shadow-[0_16px_36px_rgba(0,0,0,0.1)] hover:-translate-y-1.5 transition-all duration-300 overflow-hidden before:absolute before:top-0 before:left-0 before:right-0 before:h-1.5 <?= $theme['bar'] ?> data-[state~=visible]:opacity-100 data-[state~=visible]:translate-y-0 opacity-0 translate-y-6 <?= $delay ?>">
  <span class="w-14 h-14 rounded-2xl flex items-center justify-center mb-2 <?= $theme['icon'] ?>">
    <?= ViewHelper::lucideIcon($service->getIcon(), 'h-7 w-7') ?>
  </span>
  <p class="text-lg font-bold text-slate-900 leading-snug"><?= ViewHelper::escape($service->getName()) ?></p>
  <p class="text-sm text-slate-600 leading-relaxed mb-4 flex-1"><?= ViewHelper::escape($service->getDescription()) ?></p>
  <div class="flex items-center justify-between gap-2 pt-4 border-t border-slate-100 mt-auto">
    <span class="text-base font-extrabold text-[#106367]"><?= ViewHelper::escape($service->getPrice()) ?></span>
    <span class="text-xs font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full"><?= ViewHelper::escape($service->getDuration()) ?></span>
  </div>
</div>
