<?php

namespace controllers;

class Admin extends Controller
{
    protected $user;
    protected $userModel;
    protected $productsModel;
    protected $cartModel;
    protected $admin;
    protected $order;

    public function __construct()
    {
        $this->userModel = new \models\Users();
        $this->productsModel = new \models\Products();
        $this->cartModel = new \models\Cart();
        $this->user = $this->userModel->GetCurrentUser();
        $this->admin = new \models\Admin();
        $this->order = new \models\Order();
    }

    public function actionIndex()
    {
        if (empty($this->user))
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
        if ($this->isPost() && $_POST['password_admin'] = 'admin') {
            if (!($this->admin->CheckAdmin($this->user))) {
                $this->admin->LoginAdmin($this->user);
                return $this->renderMessage('ok', 'Ви успішно уввійшли в режим редактування', null, [
                    'PageTitle' => 'Вхід в адміністративний акаунт',
                    'MainTitle' => 'Вхід в адміністративний акаунт'
                ]);
            }
            if ($this->admin->CheckAdmin($this->user)) {
                $this->admin->LogoutAdmin($this->user);
                return $this->renderMessage('ok', 'Ви успішно вийшли з режиму редактування', null, [
                    'PageTitle' => 'Вихід з адміністративного акаунту',
                    'MainTitle' => 'Вихід з адміністративного акаунту'
                ]);
            } else
                return $this->render('form', null,
                    [
                        'PageTitle' => 'Вхід',
                        'MainTitle' => 'Вхід',
                        'MessageText' => 'Неправильний пароль',
                        'MessageClass' => 'danger'
                    ]);
        } else {
            return $this->render('form', null, [
                'PageTitle' => 'Вхід в адміністративний акаунт',
                'MainTitle' => 'Вхід в адміністративний акаунт'
            ]);
        }
    }

    public function actionExecute()
    {
        if (empty($this->user) || !$this->admin->CheckAdmin($this->user))
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
        if (empty($_GET['id_order']))
            return $this->renderMessage('error', 'Помилка', null, [
                'PageTitle' => 'Завершення замовлення',
                'MainTitle' => 'Завершення замовлення'
            ]);
        $id = $_GET['id_order'];
        $order = $this->order->GetOrdersById($id);
        if (!empty($order)) {
            if ($this->admin->FinishOrder($order[0]))
                return $this->renderMessage('ok', 'Ви успішно завершили замовлення', null, [
                    'PageTitle' => 'Завершення замовлення',
                    'MainTitle' => 'Завершення замовлення'
                ]);
            else
                return $this->renderMessage('ok', 'Ви вже завершили це замовлення раніше', null, [
                    'PageTitle' => 'Завершенe замовлення',
                    'MainTitle' => 'Завершенe замовлення'
                ]);
        } else
            return $this->renderMessage('error', 'Помилка: такого замовлення не існує', null, [
                'PageTitle' => 'Завершення замовлення',
                'MainTitle' => 'Завершення замовлення'
            ]);
    }
}