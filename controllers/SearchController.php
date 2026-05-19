<?php
require_once "BaseVideocardsTwigController.php";

class SearchController extends BaseVideocardsTwigController
{
    public $template = "search.twig";
    public function getContext(): array
    {
        $context = parent::getContext();

        return $context;
    }
}
