<?php

class SetWelcomeController extends BaseController
{
    public function get(array $context)
    {
        $url = $_SERVER['HTTP_REFERER'];
        header("Location: $url");
        exit;
    }
}