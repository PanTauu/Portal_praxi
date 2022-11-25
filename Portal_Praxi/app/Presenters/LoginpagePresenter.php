<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Authenticator;
use Nette;
use Nette\Application\UI\Form;

final class LoginpagePresenter extends Nette\Application\UI\Presenter
{
    private Nette\Database\Explorer $database;
    private Nette\Security\Passwords $passwords;
    private $authenticator;

    public function __construct(Nette\Database\Explorer $database, Nette\Security\Passwords $passwords,
                                 Authenticator $authenticator)
    {
        $this->database = $database;
        $this->passwords = $passwords;
        $this->authenticator = $authenticator;
    }

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

    // pokud je formulář úspěšně odeslán
    public function formSucceeded(Form $form, \stdClass $data) : void
    {
        // pokud údaje sedí, přihlásí uživatele a přesměruje do výběru firem
        try {
            $this->getUser()->login($data->username, $data->password);
            $this->redirect('CompanyPicker:default');
        } catch (Nette\Security\AuthenticationException $e) {
            $form->addError('Nesprávné přihlašovací jméno nebo heslo.');
        }
    }
}
