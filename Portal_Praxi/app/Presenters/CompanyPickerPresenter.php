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
        $form->addText('birthdate', 'Datum narození')
             ->setRequired();
        $companies = [
            $this->companies->getCompanies()
        ];
        $form->addSelect("company", "Firma", $companies)
            ->setRequired();
        $form->addText("companyAddress", "Adreda pracoviště")
            ->setRequired();
        $form->addText("companyID", "IČO")
            ->setRequired();
        $form->addText("companyWorker", "Vedoucí pracovník")
            ->setRequired();
        $form->addText("instructor", "Instruktor")
            ->setRequired();
        $form->addText("instructorPhoneNumber", "tel. číslo instruktora")
            ->setRequired();
        $form->addText("instructorBirthDate", "Datum narození instruktora")
            ->setRequired();
        $form->addText("email", "Email instruktora")
            ->setRequired();
        $form->addSubmit('export', 'Exportovat do PDF');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }
}
