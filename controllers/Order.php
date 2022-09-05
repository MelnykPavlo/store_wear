<?php

namespace controllers;

class Order extends Controller
{
    protected $user;
    protected $userModel;
    protected $productsModel;
    protected $cartModel;
    protected $orderModel;
    protected $adminModel;
    protected $admin;

    public function __construct()
    {
        $this->userModel = new \models\Users();
        $this->productsModel = new \models\Products();
        $this->cartModel = new \models\Cart();
        $this->orderModel = new \models\Order();
        $this->adminModel = new \models\Admin();
        $this->user = $this->userModel->GetCurrentUser();
        $this->admin = $this->adminModel->CheckAdmin($this->user);
    }

    public function actionBuy()
    {
        if (empty($this->user))
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
        if (empty($_GET['id']))
            return $this->renderMessage('error', 'Помилка', null, [
                'PageTitle' => 'Оформлення товару',
                'MainTitle' => 'Оформлення товару'
            ]);
        $id = $_GET['id'];
        if ($this->isPost()) {
            $size = '';
            $count = '';
            foreach ($this->cartModel->GetAllCartUser($this->user['id']) as $value)
                if ($value['product_id'] == $id) {
                    $size = $value['size_cart'];
                    $count = $value['count'];
                    break;
                }
            $param = ['size_cart' => $size, 'count' => $count];
            $result = $this->orderModel->AddOrder($_POST, $id, $this->user['id'], $param);
            if (!isset($result['errors'])) {
                $this->cartModel->DeleteCartProduct($id, $this->user['id']);
                return $this->renderMessage('ok', 'Товар успішно оформлений', null, [
                    'PageTitle' => 'Оформлення товару',
                    'MainTitle' => 'Оформлення товару'
                ]);
            } else {
                $message = implode('<br/>', $result['errors']);
                return $this->render('buy', ['model' => $_POST],
                    [
                        'PageTitle' => 'Оформлення товару',
                        'MainTitle' => 'Оформлення товару',
                        'MessageText' => $message,
                        'MessageClass' => 'danger'
                    ]);
            }
        } else {
            $product = $this->productsModel->GetProductsByID($id);
            return $this->render('buy', null, [
                'PageTitle' => "Оформлення товару '{$product['title']}'",
                'MainTitle' => 'Оформлення товару'
            ]);
        }
    }

    public function actionIndex()
    {
        if (!empty($this->user)) {
            $id_buyer = $this->user['id'];
            $products = $this->orderModel->GetOrdersById_Buyer($id_buyer);
            return $this->render('index', ['model' => $products], [
                'PageTitle' => 'Покупки',
                'MainTitle' => 'Покупки'
            ]);
        } else
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
    }

    public function actionBuy_all()
    {
        session_start();
        if (empty($this->user))
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
        if ($this->isPost()) {
            $arrId = [];
            $params = [];
            foreach ($this->cartModel->GetAllCartUser($this->user['id']) as $value) {
                $arrId [] = $value['product_id'];
                $params [] = ['size_cart' => $value['size_cart'], 'count' => $value['count']];
            }
            $result = $this->orderModel->AddOrders($_POST, $arrId, $this->user['id'], $params);
            if (!isset($result['errors'])) {
                $this->cartModel->DeleteCartProducts($this->user['id']);
                return $this->renderMessage('ok', 'Товари успішно оформлені', null, [
                    'PageTitle' => 'Оформлення товарів',
                    'MainTitle' => 'Оформлення товарів'
                ]);
            } else {
                $message = implode('<br/>', $result['errors']);
                return $this->render('buy', ['model' => $_POST],
                    [
                        'PageTitle' => 'Оформлення товарів',
                        'MainTitle' => 'Оформлення товарів',
                        'MessageText' => $message,
                        'MessageClass' => 'danger'
                    ]);
            }
        } else {
            return $this->render('buy', null, [
                'PageTitle' => "Оформлення товарів",
                'MainTitle' => 'Оформлення товарів'
            ]);
        }
    }

    public function actionAllOrders()
    {
        if (empty($this->user) || !$this->admin)
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
        $orders = $this->orderModel->GetAllOrders();
        return $this->render('allOrders', ['model' => $orders], [
            'PageTitle' => 'Замовлення',
            'MainTitle' => 'Замовлення'
        ]);
    }
}