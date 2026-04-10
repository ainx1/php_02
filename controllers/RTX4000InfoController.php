<?php
require_once "RTX4000Controller.php";

class RTX4000InfoController extends RTX4000Controller
{
    public $template = "RTX4000_info.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        return $context;
    }
}
