<?php
require_once "RTX5000Controller.php";

class RTX5000ImageController extends RTX5000Controller
{
    public $template = "base_image.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['image'] = "/images/RTX5000image.jpg";
        return $context;
    }
}
