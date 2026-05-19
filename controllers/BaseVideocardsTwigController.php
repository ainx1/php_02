<?php

class BaseVideocardsTwigController extends TwigBaseController
{
    public function getContext(): array
    {
        $context = parent::getContext();

        // создаем запрос к БД
        $query = $this->pdo->query("SELECT id, title FROM videocards_types"); //В навигации выводить значения из этой таблицы
        $context['types'] = $query->fetchAll();

        return $context;
    }
}
