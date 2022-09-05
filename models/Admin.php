<?php

namespace models;

class Admin
{
    public function LoginAdmin($user): void
    {
        \core\Core::getInstance()->getDB()->update('users', ['access' => "1"], ['id' => $user['id']]);
    }

    public function LogoutAdmin($user): void
    {
        \core\Core::getInstance()->getDB()->update('users', ['access' => null], ['id' => $user['id']]);
    }

    public function CheckAdmin($user): bool
    {
        $access = \core\Core::getInstance()->getDB()->select("users", "access", ['id' => $user["id"]]);
        if ($access[0][0] == "1")
            return true;
        else
            return false;
    }

    public function FinishOrder($order)
    {
        if ($order['execute'] === "1")
            return false;
        else
            \core\Core::getInstance()->getDB()->update('orders', ['execute' => 1], ['id' => $order['id']]);
        return true;
    }
}