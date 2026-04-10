<?php
require_once "RTX4000Controller.php";

class RTX4000ImageController extends RTX4000Controller
{
    public $template = "base_image.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $context['image'] = "/images/RTX4000image.jpg";
        return $context;
    }
}
