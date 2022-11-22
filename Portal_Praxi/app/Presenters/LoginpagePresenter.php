<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

final class LoginpagePresenter extends Nette\Application\UI\Presenter
{
    protected function createComponentLoginForm() : Form
    {
        $form = new Form();
        $form->addText('username', "Uživatelské jméno")
             ->setRequired();
        $form->addPassword('password', 'Heslo')
             ->setRequired();
        $form->addSubmit('login', 'Přihlásit se');
        $form->onSuccess[] = [$this, 'formSucceeded'];

        return $form;
    }

    public function formSucceeded(Form $form) : void
    {
        $values = $form->getValues();
        try {
            $this->getUser()->login($values->username, $values->password);
        } catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage($e->getMessage(), type: 'danger');
            $this->redirect('this');
        }
    }
}
