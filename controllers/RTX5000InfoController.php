<?php
require_once "RTX5000Controller.php";

class RTX5000InfoController extends RTX5000Controller
{
    public $template = "RTX5000_info.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        return $context;
    }
}
