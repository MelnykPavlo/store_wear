<?php

namespace models;

class Order
{
    public function AddOrder($userRow, $id_product, $user_id, $param)
    {
        if (is_array($this->Validate($userRow))) {
            return $this->Validate($userRow);
        }
        $date = date('Y-m-d H:i:s');
        $rowFiltered = ['id_buyer' => $user_id, 'id_products' => $id_product, 'counts' => $param['count'], 'sizes' => $param['size_cart'], 'lastname' => $userRow['lastname'], 'firstname' => $userRow['firstname'], 'phone' => $userRow['phone'], 'address' => $userRow['address'], 'post_index' => $userRow['index'], 'date' => $date];
        \core\Core::getInstance()->getDB()->insert('orders', $rowFiltered);
        return true;
    }

    public function AddOrders($userRow, $id_products, $user_id, $params)
    {
        if (is_array($this->Validate($userRow))) {
            return $this->Validate($userRow);
        }
        $date = date('Y-m-d H:i:s');
        $products = implode(', ', $id_products);
        $count = [];
        $size = [];
        foreach ($params as $param) {
            $count [] = $param['count'];
            $size [] = $param['size_cart'];
        }
        $counts = implode(', ', $count);
        $sizes = implode(', ', $size);
        $rowFiltered = ['id_buyer' => $user_id, 'id_products' => $products, 'counts' => $counts, 'sizes' => $sizes, 'lastname' => $userRow['lastname'], 'firstname' => $userRow['firstname'], 'phone' => $userRow['phone'], 'address' => $userRow['address'], 'post_index' => $userRow['index'], 'date' => $date];
        \core\Core::getInstance()->getDB()->insert('orders', $rowFiltered);
        return true;
    }

    public function GetOrdersById_Buyer($id_buyer)
    {
        return \core\Core::getInstance()->getDB()->select('orders', '*', ['id_buyer' => $id_buyer], ['date' => 'DESC']);
    }

    public function GetOrdersById($id)
    {
        return \core\Core::getInstance()->getDB()->select('orders', '*', ['id' => $id], ['date' => 'DESC']);
    }

    public function GetAllOrders()
    {
        return \core\Core::getInstance()->getDB()->select('orders', '*', null, ['date' => 'DESC']);
    }

    public function Validate($row)
    {
        $errors['errors'] = [];
        if (empty($row['lastname']))
            $errors['errors'] [] = 'Поле "Прізвище" не може бути порожнім';
        if (empty($row['firstname']))
            $errors['errors'] [] = 'Поле "Ім`я" текст не може бути порожнім';
        if (empty($row['phone']))
            $errors['errors'] [] = 'Поле "Номер телефону" текст не може бути порожнім';
        if (empty($row['address']))
            $errors['errors'] [] = 'Поле "Адреса" не може бути порожнім';
        if (empty($row['index']))
            $errors['errors'] [] = 'Поле "Поштовий індекс" не може бути порожнім';
        if (count($errors['errors']) > 0)
            return $errors;
        else
            return true;
    }
}