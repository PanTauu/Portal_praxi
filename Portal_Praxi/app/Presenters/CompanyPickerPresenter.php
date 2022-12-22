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
        $form->addText('name', "Jméno");
        $form->addText('surname', 'Príjmení');
        $form->addText('birthdate', 'Datum narození');
        $companies = [
            $this->companies->getCompanies()
        ];
        $form->addSelect("company", "Firma", $companies);
        $form->addText("companyAddress", "Adreda pracoviště");
        $form->addText("companyID", "IČO");
        $form->addText("companyWorker", "Vedoucí pracovník");
        $form->addText("instructor", "Instruktor");
        $form->addText("instructorPhoneNumber", "tel. číslo instruktora");
        $form->addText("instructorBirthDate", "Datum narození instruktora");
        $form->addText("email", "Email instruktora");
        $form->addSubmit('export', 'Exportovat do PDF');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded() : void
    {
        try {
            $this->redirect('CompanyPicker:default');
        } catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage("Export selhal");
        }
    }
}
