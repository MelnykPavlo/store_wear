<?php

namespace models;

use core\Utils;
use Imagick;

class Products
{
    public function ChangePhoto($id, $file)
    {
        $folder = 'files/products/';
        $file_path = pathinfo($folder . $file);
        $file_big = $file_path['filename'] . '_b';
        $file_middle = $file_path['filename'] . '_m';
        $file_small = $file_path['filename'] . '_s';
        $products = $this->GetProductsByID($id);
        if (is_file($folder . $products['photo'] . '_b.jpeg') && is_file($folder . $file))
            unlink($folder . $products['photo'] . '_b.jpeg');
        if (is_file($folder . $products['photo'] . '_m.jpeg') && is_file($folder . $file))
            unlink($folder . $products['photo'] . '_m.jpeg');
        if (is_file($folder . $products['photo'] . '_s.jpeg') && is_file($folder . $file))
            unlink($folder . $products['photo'] . '_s.jpeg');
        $products['photo'] = $file_path['filename'];
        $im_b = new Imagick();
        $im_b->readImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . $file);
        $im_b->cropThumbnailImage(700, 700, true);
        $im_b->writeImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . '/' . $file_big . '.jpeg');
        $im_m = new Imagick();
        $im_m->readImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . $file);
        $im_m->cropThumbnailImage(300, 300, true);
        $im_m->writeImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . '/' . $file_middle . '.jpeg');
        $im_s = new Imagick();
        $im_s->readImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . $file);
        $im_s->cropThumbnailImage(180, 180, true);
        $im_s->writeImage($_SERVER['DOCUMENT_ROOT'] . '/' . $folder . '/' . $file_small . '.jpeg');
        unlink($folder . $file);
        $this->UpdateProducts($products, $id);
    }

    public function AddProducts($row): array
    {
        $userModel = new Users();
        $user = $userModel->GetCurrentUser();
        if ($user == null) {
            $result = [
                'error' => true,
                'messages' => ['Користувач не аутентифікований']
            ];
            return $result;
        }
        if (is_array($this->Validate($row))) {
            $result = [
                'error' => true,
                'messages' => $this->Validate($row)
            ];
            return $result;
        }
        $fields = ['title', 'price', 'description', 'kind', 'gender'];
        $rowFiltered = Utils::ArrayFilter($row, $fields);
        $rowFiltered['size'] = implode(', ', $row['size']);
        $rowFiltered['datetime'] = date('Y-m-d H:i:s');

        $id = \core\Core::getInstance()->getDB()->insert('products', $rowFiltered);
        return [
            'error' => false,
            'id' => $id
        ];
    }

    public function GetLastCountProduct($count)
    {
        return \core\Core::getInstance()->getDB()->select('products', '*', null, ['datetime' => 'DESC'], $count);
    }

    public function GetLastProduct()
    {
        return \core\Core::getInstance()->getDB()->select('products', '*', null, ['datetime' => 'DESC']);
    }

    public function GetProductsByID($id)
    {
        $products = \core\Core::getInstance()->getDB()->select('products', '*', ['id' => $id], ['datetime' => 'DESC']);
        if (!empty($products))
            return $products[0];
        else
            return null;
    }


    public function UpdateProducts($products, $id)
    {
        $userModel = new \models\Users();
        $user = $userModel->GetCurrentUser();
        if ($user == null)
            return false;
        if (is_array($this->Validate($products))) {
            return $this->Validate($products);
        }
        $fields = ['title', 'price', 'description', 'kind', 'gender', 'photo'];
        $rowFiltered = Utils::ArrayFilter($products, $fields);
        $rowFiltered['datetime_last_edit'] = date('Y-m-d H:i:s');
        $rowFiltered['size'] = implode(', ', $products['size']);
        \core\Core::getInstance()->getDB()->update('products', $rowFiltered, ['id' => $id]);
        return true;
    }

    public function DeleteProducts($id): bool
    {
        $products = $this->GetProductsByID($id);
        $userModel = new \models\Users();
        $user = $userModel->GetCurrentUser();
        if (empty($products) || empty($user))
            return false;
        \core\Core::getInstance()->getDB()->delete('products', ['id' => $id]);
        return true;
    }


    public function Validate($row)
    {
        $errors = [];
        if (empty($row['title']))
            $errors [] = 'Поле "Назва товару" не може бути порожнім';
        if (empty($row['size']))
            $errors [] = 'Поле "Розмір" текст не може бути порожнім';
        if (empty($row['price']))
            $errors [] = 'Поле "Ціна" текст не може бути порожнім';
        if (is_real($row['price']))
            $errors [] = 'Поле "Ціна" має бути числом';
        if (empty($row['description']))
            $errors [] = 'Поле "Опис" не може бути порожнім';
        if (empty($row['kind']))
            $errors [] = 'Поле "Категорія товару" не може бути порожнім';
        if (empty($row['gender']))
            $errors [] = 'Поле "Для кого" не може бути порожнім';
        if (count($errors) > 0)
            return $errors;
        else
            return true;
    }

    public function allProducts()
    {
        $userModel = new Users();
        $user = $userModel->GetCurrentUser();
        if (empty($user))
            return null;
        return \core\Core::getInstance()->getDB()->select('products', '*', null, ['datetime' => 'DESC']);
    }



}
