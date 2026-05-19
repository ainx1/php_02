<?php

class BaseVideocardsTwigController extends TwigBaseController
{
    public function getContext(): array
    {
        $context = parent::getContext();

        // создаем запрос к БД
        $query = $this->pdo->query("SELECT DISTINCT type FROM videocards_object ORDER BY 1");
        // стягиваем данные
        $types = $query->fetchAll();
        $context['types'] = $types;

        return $context;
    }
}
