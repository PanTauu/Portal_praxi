<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\LoadCompanies;
use Nette;
use Nette\Application\UI\Form;

final class CompanyPickerPresenter extends Nette\Application\UI\Presenter
{

    private LoadCompanies $companies;

    public function __construct(LoadCompanies $companies)
    {
        $this->companies = $companies;
    }

    protected function createComponentRegistrationForm() : Form
    {
        $form = new Form();
        $form->addText('name', "Jméno")
            ->setRequired();
        $form->addText('surname', 'Příjmení')
            ->setRequired();
        $form->addText('address', 'Adresa')
             ->setRequired();
        $gender = [
            'M' => 'Muž',
            'Z' => 'Žena'
        ];
        $form->addSelect('gender', 'Pohlaví:', $gender);
        $form->onSuccess[] = [$this, 'formSucceeded'];
        $form->addEmail("email", "Emailová adresa: ")
             ->setRequired();
        $form->addText("phone", "Telefonní číslo")
             ->setRequired();
        $form->addText("town", "Město")
            ->setRequired();
        $form->addText("townNumber", "PSČ")
            ->setRequired();
        // naplnit hodnotami z databáze
        $companies = [

        ];
        $form->addSelect("company", "Firma:", $companies)
            ->setRequired();
        $form->addText("companyAddress", "Adreda pracoviště")
            ->setRequired();
        $form->addText("companyID", "IČO")
            ->setRequired();
        $form->addText("contact", "Kontakt")
            ->setRequired();
        $form->addSubmit('export', 'Exportovat do PDF');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }
}
