<?php
class ObjectInfoController extends ObjectController
{
    public $template = "base_info.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        return $context;
    }
}
