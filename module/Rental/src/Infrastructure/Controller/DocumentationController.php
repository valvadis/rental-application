<?php

namespace Rental\Infrastructure\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;

class DocumentationController extends AbstractActionController
{
    public function index(): ViewModel
    {
        return new ViewModel;
    }
}