<?php

namespace controllers;

class Cart extends Controller
{
    protected $user;
    protected $userModel;
    protected $productsModel;
    protected $cartModel;

    public function __construct()
    {
        $this->userModel = new \models\Users();
        $this->productsModel = new \models\Products();
        $this->cartModel = new \models\Cart();
        $this->user = $this->userModel->GetCurrentUser();
    }


    public function actionAdd()
    {
        $id_product = $_GET['id'];
        $product = $this->productsModel->GetProductsByID($id_product);
        if (!empty($this->user)) {
            if (empty($_GET['id']))
                return $this->renderMessage('error', 'Помилка', null, [
                    'PageTitle' => 'Додавання товару в кошик',
                    'MainTitle' => 'Додавання товару в кошик'
                ]);
            if ($this->isPost()) {
                $size = $_POST['size_cart'];
                $count = $_POST['count'];
                if ($this->cartModel->Add($id_product, $this->user['id'], $size, $count))
                    header('Location: /products/index');
                else
                    return $this->renderMessage('error', 'Помилка', null, [
                        'PageTitle' => 'Додання товару в кошик',
                        'MainTitle' => 'Додання товару в кошик'
                    ]);
            } else
                return $this->render('form', ['model' => $product], [
                    'PageTitle' => 'Додання товару ' . $product['title'] . ' в кошик',
                    'MainTitle' => 'Додання товару в кошик',
                ]);
        }
        return $this->render('forbidden', null, [
            'PageTitle' => 'Немає доступу',
            'MainTitle' => 'Немає доступу'
        ]);
    }

    public function actionIndex()
    {
        $arrUser = [];
        if (!empty($this->user)) {
            $cart = $this->cartModel->GetAllCartUser($this->user['id']);
            if (isset($cart)) {
                foreach ($cart as $key => $value) {
                    $arrUser [$key] = $value['user_id'];
                }
                if (!in_array($this->user['id'], $arrUser))
                    return $this->render('index', null, [
                        'PageTitle' => '',
                        'MainTitle' => 'Кошик',
                    ]);
                $arrProducts = [];
                $params =[];
                foreach ($cart as $value) {
                    $arrProducts [] = $value['product_id'];
                    $params [] = ['size_cart' => $value['size_cart'], 'count' => $value['count']];
                }
                $products = [];
                foreach ($arrProducts as $product) {
                    $products [] = $this->productsModel->GetProductsByID($product);
                }
                return $this->render('index', ['model' => $products, 'params' => $params], [
                    'PageTitle' => 'Кошик',
                    'MainTitle' => 'Кошик'
                ]);
            }
            return $this->render('index', null, [
                'PageTitle' => '',
                'MainTitle' => 'Кошик',
            ]);
        }
        return $this->render('forbidden', null, [
            'PageTitle' => 'Немає доступу',
            'MainTitle' => 'Немає доступу'
        ]);
    }

    public function actionDelete()
    {
        session_start();
        $id = $_GET['id'];
        if (!empty($this->user)) {
            if (!empty($_GET['id']) && $this->cartModel->DeleteCartProduct($id, $this->user['id'])) {
                header('Location: /cart/index');
            } else
                return $this->renderMessage('error', 'Помилка', null, [
                    'PageTitle' => 'Видалення товару з кошика',
                    'MainTitle' => 'Видалення товару з кошика'
                ]);
        }
        return $this->render('forbidden', null, [
            'PageTitle' => 'Немає доступу',
            'MainTitle' => 'Немає доступу'
        ]);
    }

    public function actionDelete_all()
    {
        if (!empty($this->user)) {
            if ($this->cartModel->DeleteCartProducts($this->user['id'])) {
                header('Location: /cart/index');
            } else
                return $this->renderMessage('error', 'Помилка', null, [
                    'PageTitle' => 'Видалення товару з кошика',
                    'MainTitle' => 'Видалення товару з кошика'
                ]);
        }
        return $this->render('forbidden', null, [
            'PageTitle' => 'Немає доступу',
            'MainTitle' => 'Немає доступу'
        ]);
    }


}