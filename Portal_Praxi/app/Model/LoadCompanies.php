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

    // projde firmy z tabulky a vrátí pole
    public function getCompanies(): array
    {
        $companies = array();
        $dbData = $this->database->table('companies');

        foreach ($dbData as $data) {
            $companies[] = $data->name . ',  ' . $data->town;
        }
        return $companies;
    }

    public function get(): array
    {
        $companies = array();
        $dbData = $this->database->table('companies');

        foreach ($dbData as $data) {
            $companies[] = $data->name . ',  ' . $data->town;
        }
        return $companies;
    }
}

