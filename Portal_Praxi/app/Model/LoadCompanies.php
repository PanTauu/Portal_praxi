<?php

namespace App\Model;

use Nette;

final class LoadCompanies
{
    private Nette\Database\Explorer $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        $this->database = $database;
    }

    public function getCompanies()
    {
        return $this->database->table('companies');
    }
}

