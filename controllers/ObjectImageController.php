<?php
class ObjectImageController extends ObjectController
{
    public $template = "base_image.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        return $context;
    }
}
