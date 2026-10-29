<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../models/LaundryModel.php';

class LaundryController extends BaseController
{
    private LaundryModel $model;

    public function __construct(?LaundryModel $model = null)
    {
        $this->model = $model ?? new LaundryModel();
    }

    /**
     * Handle the main landing page request.
     */
    public function index(): void
    {
        $activeTab = isset($_GET['tab']) && is_string($_GET['tab']) ? trim($_GET['tab']) : 'kiloan';
        $services = $this->model->getAll();
        $servicesByCategory = $this->model->getGroupedByCategory();
        $categories = $this->model->getCategories();
        $totalCount = $this->model->getTotalCount();

        // Support optional JSON output for API demonstrations (e.g. ?format=json)
        if (isset($_GET['format']) && $_GET['format'] === 'json') {
            header('Content-Type: application/json; charset=UTF-8');
            echo json_encode([
                'status' => 'success',
                'total' => $totalCount,
                'data' => array_map(
                    static fn(LaundryService $s): array => $s->toArray(),
                    $services
                ),
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            exit;
        }

        $this->render('home', [
            'pageTitle' => 'PJ Laundry – Cuci Bersih, Tanpa Drama (MVC Edition)',
            'services' => $services,
            'servicesByCategory' => $servicesByCategory,
            'categories' => $categories,
            'totalCount' => $totalCount,
            'activeTab' => $activeTab,
        ]);
    }
}
