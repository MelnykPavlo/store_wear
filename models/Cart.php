<?php

namespace models;

use core\Utils;

class Cart
{
    public function Add($product_id, $user_id, $size, $count): bool
    {
        if (!empty($user_id) || !empty($product_id)) {
            $fields = ['user_id', 'product_id', 'size_cart', 'count'];
            $row['product_id'] = $product_id;
            $row['user_id'] = $user_id;
            $row['size_cart'] = $size;
            $row['count'] = $count;
            $rowFiltered = Utils::ArrayFilter($row, $fields);
            \core\Core::getInstance()->getDB()->insert('cart', $rowFiltered);
            return true;
        }
        return false;
    }

    public function Check($product_id, $user_id): bool
    {
        foreach ($this->GetAllCartUser($user_id) as $value)
            if ($value['product_id'] == $product_id)
                return true;
        return false;
    }

    public function DeleteCartProduct($id, $user_id): bool
    {
        $cartProducts = $this->GetAllCartUser($user_id);
        if (!empty($id))
            if (isset($cartProducts)) {
                foreach ($cartProducts as $value) {
                    if ($value['product_id'] == $id) {
                        \core\Core::getInstance()->getDB()->delete('cart', ['product_id' => $id]);
                        return true;
                    }
                }
            }
        return false;
    }

    public function GetAllCartUser($user_id)
    {
        return \core\Core::getInstance()->getDB()->select('cart', '*', ['user_id' => $user_id]);
    }

    public function DeleteCartProducts($user_id): bool
    {
        $cartProducts = $this->GetAllCartUser($user_id);
        if (isset($cartProducts)) {
            \core\Core::getInstance()->getDB()->delete('cart', ['user_id' => $user_id]);
            return true;
        }
        return false;
    }

}