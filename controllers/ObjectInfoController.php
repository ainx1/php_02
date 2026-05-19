<?php
class ObjectInfoController extends ObjectController
{
    public $template = "__object.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        return $context;
    }
}
