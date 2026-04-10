<?php
require_once "TwigBaseController.php"; // импортим TwigBaseController

class RTX5000Controller extends TwigBaseController
{
    public $template = "__object.twig";
    public $title = "RTX5000";

    public function getContext(): array
    {
        $context = parent::getContext();
        return $context;
    }
}
