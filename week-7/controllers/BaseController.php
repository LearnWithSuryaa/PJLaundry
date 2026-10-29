<?php
declare(strict_types=1);

require_once __DIR__ . '/../helpers/ViewHelper.php';

abstract class BaseController
{
    /**
     * Render a view file with extracted data.
     *
     * @param string $view Relative view name (e.g. 'home')
     * @param array<string, mixed> $data Data to be passed to the view
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        $viewFile = __DIR__ . '/../views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            throw new RuntimeException(sprintf('View [%s] not found at %s', $view, $viewFile));
        }

        require $viewFile;
    }

    /**
     * Render a partial view template.
     *
     * @param string $partial Partial path relative to views/partials/
     * @param array<string, mixed> $data
     */
    public static function partial(string $partial, array $data = []): void
    {
        extract($data, EXTR_SKIP);

        $partialFile = __DIR__ . '/../views/partials/' . $partial . '.php';

        if (!file_exists($partialFile)) {
            throw new RuntimeException(sprintf('Partial [%s] not found at %s', $partial, $partialFile));
        }

        require $partialFile;
    }
}
