<?php

namespace App\Model;

use Nette;
use Nette\Security\SimpleIdentity;

final class Authenticator implements Nette\Security\Authenticator
{

    private Nette\Database\Explorer $database;
    private Nette\Security\Passwords $passwords;

    public function __construct(Nette\Database\Explorer $database, Nette\Security\Passwords $passwords)
    {
        $this->database = $database;
        $this->passwords = $passwords;
    }

    public function authenticate(string $user, string $password) : Nette\Security\SimpleIdentity
    {
        $row = $this->database->table('users')
             ->where('user_name', $user)
             ->fetch();

        if (!$row) {
            throw new Nette\Security\AuthenticationException('User not found.');
        }

        if (!$this->passwords->verify($password, $row->password)) {
            throw new Nette\Security\AuthenticationException('Invalid password.');
        }

        return new SimpleIdentity(
            $row->ID_user, $row->role, ['fullname' => $row->first_name . ' ' . $row->surname]
        );
    }
}