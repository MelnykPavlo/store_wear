<?php

namespace models;

use core\Utils;

class Users
{
    public function Validate($formRow)
    {
        $errors = [];
        if (empty($formRow['login']))
            $errors [] = 'Поле "Email" не може бути порожнім';
        $user = $this->GetUserByLogin($formRow['login']);
        if (!empty($user))
            $errors [] = 'Такий користувач вже існує';
        if (empty($formRow['password']))
            $errors [] = 'Поле "Пароль" не може бути порожнім';
        if ($formRow['password'] != $formRow['password2'])
            $errors [] = 'Паролі не співпадають';
        if (empty($formRow['lastname']))
            $errors [] = 'Поле "Прізвище" не може бути порожнім';
        if (empty($formRow['firstname']))
            $errors [] = 'Поле "Ім`я" не може бути порожнім';
        if (empty($formRow['phone']))
            $errors [] = 'Поле "Номер телефону" не може бути порожнім';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function ValidateUpdate($formRow)
    {
        $errors = [];
        if (empty($formRow['login']))
            $errors [] = 'Поле "Email" не може бути порожнім';
        $user = $this->GetUserByLogin($formRow['login']);
        if (empty($formRow['lastname']))
            $errors [] = 'Поле "Прізвище" не може бути порожнім';
        if (empty($formRow['firstname']))
            $errors [] = 'Поле "Ім`я" не може бути порожнім';
        if (empty($formRow['phone']))
            $errors [] = 'Поле "Номер телефону" не може бути порожнім';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function AddUser($userRow)
    {
        if (is_array($this->Validate($userRow))) {
            return $this->Validate($userRow);
        }
        $fields = ['login', 'password', 'lastname', 'firstname', 'phone'];
        $userRowFiltered = Utils::ArrayFilter($userRow, $fields);
        $userRowFiltered['password'] = md5($userRowFiltered['password']);
        \core\Core::getInstance()->getDB()->insert('users', $userRowFiltered);
        return true;
    }

    public function UpdateUsers($userRow, $id)
    {
        if (is_array($this->ValidateUpdate($userRow))) {
            return $this->ValidateUpdate($userRow);
        }
        $fields = ['login', 'lastname', 'firstname', 'phone'];
        $userRowFiltered = Utils::ArrayFilter($userRow, $fields);
        \core\Core::getInstance()->getDB()->update('users', $userRowFiltered, ["id" => $id]);

        return true;
    }

    public function DeleteUsers($id)
    {
        $userModel = new \models\Users();
        $user = $userModel->GetCurrentUser();
        if (empty($user))
            return false;
        \core\Core::getInstance()->getDB()->delete('users', ['id' => $id]);
        return true;
    }

    public function AuthUser($login, $password)
    {
        $password = md5($password);
        $users = \core\Core::getInstance()->getDB()->select('users', '*',
            [
                'login' => $login,
                'password' => $password
            ]);
        if (count($users) == 1) {
            $user = $users[0];
            return $user;
        } else
            return false;
    }

    public function IsUserAuthenticated(): bool
    {
        session_start();
        return isset($_SESSION['user']);
    }


    public function GetUserByLogin($login)
    {
        $rows = \core\Core::getInstance()->getDB()->select('users', '*', ['login' => $login]);
        if (count($rows) > 0)
            return $rows[0];
        else
            return null;
    }

    public function GetUserById($id)
    {
        $rows = \core\Core::getInstance()->getDB()->select('users', '*', ['id' => $id]);
        if (count($rows) > 0)
            return $rows[0];
        else
            return null;
    }

    public function GetCurrentUser()
    {
        session_start();
        if ($this->IsUserAuthenticated())
            return $_SESSION['user'];
        else
            return null;
    }

    public function GetCountOrdersByUser($id): int
    {
        $count_orders = \core\Core::getInstance()->getDB()->Count("orders",['id_buyer' => $id]);
        return $count_orders;
    }

    public function GetCountCommentsByUser($id): int
    {
        $count_comments = \core\Core::getInstance()->getDB()->Count("comments",['id_author' => $id]);
        return $count_comments;
    }

    public function GetCountOrders(): int
    {
        $count_orders = \core\Core::getInstance()->getDB()->Count("orders");
        return $count_orders;
    }

    public function GetCountComments(): int
    {
        $count_comments = \core\Core::getInstance()->getDB()->Count("comments");
        return $count_comments;
    }



}