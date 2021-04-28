<?php

namespace App\Controller;

use App\Model\ActualityManager;

class AdminActualityController extends AbstractController
{
    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productsManager = new ActualityManager();
            $productsManager->delete($id);
            header('location: /AdminActuality/index');
        }
    }
}
