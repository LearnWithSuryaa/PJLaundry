<?php
declare(strict_types=1);

/**
 * Main Home View for Week-7 MVC Architecture.
 *
 * @var string $pageTitle
 * @var LaundryService[] $services
 * @var array<string, LaundryService[]> $servicesByCategory
 * @var string[] $categories
 * @var int $totalCount
 * @var string $activeTab
 */

require_once __DIR__ . '/layouts/header.php';
?>

<main id="main-content">
  <?php require __DIR__ . '/partials/hero.php'; ?>
  <?php require __DIR__ . '/partials/services.php'; ?>
  <?php require __DIR__ . '/partials/rules.php'; ?>
  <?php require __DIR__ . '/partials/flow.php'; ?>
  <?php require __DIR__ . '/partials/faq.php'; ?>
</main>

<?php require_once __DIR__ . '/layouts/footer.php'; ?>
