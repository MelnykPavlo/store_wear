<?php

namespace models;

class Comments
{
    public function AddComment($product_id, $user_id, $text)
    {
        $date = date('Y-m-d H:i:s');
        $rowFiltered = ['id_product' => $product_id, 'id_author' => $user_id, 'text' => $text, 'date' => $date];
        \core\Core::getInstance()->getDB()->insert('comments', $rowFiltered);
    }

    public function GetComments($id)
    {
        return \core\Core::getInstance()->getDB()->select('comments', '*', ['id_product' => $id], ['date' => 'DESC']);
    }

    public function DeleteComment($id)
    {
        \core\Core::getInstance()->getDB()->delete('comments', ['id' => $id]);
    }

    public function GetComments2($id)
    {
        return \core\Core::getInstance()->getDB()->select('comments', '*', ['id' => $id], ['date' => 'DESC']);
    }

}