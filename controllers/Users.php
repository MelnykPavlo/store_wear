<?php

namespace controllers;


class Users extends Controller
{
    protected $usersModel;
    protected $adminModel;
    protected $user;

    function __construct()
    {
        $this->usersModel = new \models\Users();
        $this->adminModel = new \models\Admin();
        $this->user = $this->usersModel->GetCurrentUser();
    }

    function actionIndex()
    {
        if (!empty($this->user)) {
            $count_orders = $this->usersModel->GetCountOrdersByUser($this->usersModel->GetUserById($this->user['id'])['id']);
            $count_comments = $this->usersModel->GetCountCommentsByUser($this->usersModel->GetUserById($this->user['id'])['id']);
            $check = false;
            $all_count_orders = 0;
            $all_count_comments = 0;
            if ($this->adminModel->CheckAdmin($this->usersModel->GetUserById($this->user['id']))) {
                $all_count_orders = $this->usersModel->GetCountOrders();
                $all_count_comments = $this->usersModel->GetCountComments();
                $check = true;
            }
            return $this->render('index', ['model' => $this->usersModel->GetUserById($this->user['id']),
                'count_orders' => $count_orders,
                'count_comments' => $count_comments,
                'check' => $check,
                'all_count_orders' => $all_count_orders,
                'all_count_comments' => $all_count_comments
            ], [
                'PageTitle' => 'Особистий кабінет',
                'MainTitle' => 'Особистий кабінет',
            ]);
        }
        return $this->render('forbidden', null, [
            'PageTitle' => 'Немає доступу',
            'MainTitle' => 'Немає доступу'
        ]);
    }

    function actionChange()
    {
        if (!empty($this->user)) {
            $id = $_GET['id'];
            if ($this->isPost()) {
                $result = $this->usersModel->UpdateUsers($_POST, $id);
                if ($result === true) {
                    return $this->renderMessage('ok', 'Дані успішно оновлені', null, [
                        'PageTitle' => 'Редагування даних',
                        'MainTitle' => 'Редагування даних'
                    ]);
                } else {
                    $message = implode('<br/>', $result);
                    return $this->render('change', ['model' => $this->usersModel->GetUserById($this->user['id'])],
                        [
                            'PageTitle' => 'Редагування даних',
                            'MainTitle' => 'Редагування даних',
                            'MessageText' => $message,
                            'MessageClass' => 'danger'
                        ]);
                }
            }
            if (!empty($_GET['id'] && $_GET['id'] === $this->user['id'])) {
                return $this->render('change', ['model' => $this->usersModel->GetUserById($this->user['id'])], [
                    'PageTitle' => 'Особистий кабінет',
                    'MainTitle' => 'Особистий кабінет',
                ]);
            }
        }
        return $this->render('forbidden', null, [
            'PageTitle' => 'Немає доступу',
            'MainTitle' => 'Немає доступу'
        ]);
    }

    function actionLogout()
    {
        if (!empty($this->user)) {
            unset($_SESSION['user']);
            $this->adminModel->LogoutAdmin($this->user);
            return $this->renderMessage('info', 'Ви вийшли з вашого акакунту', null, [
                'PageTitle' => 'Вихід',
                'MainTitle' => 'Вихід'
            ]);
        }
        return $this->render('forbidden', null, [
            'PageTitle' => 'Немає доступу',
            'MainTitle' => 'Немає доступу'
        ]);
    }

    function actionLogin()
    {
        if (isset($_SESSION['user']))
            return $this->renderMessage('ok', 'Ви вже увійшли на сайт', null, [
                'PageTitle' => 'Вхід',
                'MainTitle' => 'Вхід'
            ]);
        if ($this->isPost()) {
            $user = $this->usersModel->AuthUser($_POST['login'], $_POST['password']);
            if (!empty($user)) {
                $_SESSION['user'] = $user;
                return $this->renderMessage('ok', 'Ви успішно увійшли на сайт', null, [
                    'PageTitle' => 'Вхід',
                    'MainTitle' => 'Вхід'
                ]);
            } else
                return $this->render('login', null,
                    [
                        'PageTitle' => 'Вхід',
                        'MainTitle' => 'Вхід',
                        'MessageText' => 'Неправильний логін або пароль',
                        'MessageClass' => 'danger'
                    ]);
        } else {
            return $this->render('login', null, [
                'PageTitle' => 'Вхід',
                'MainTitle' => 'Вхід'
            ]);
        }
    }

    function actionRegister()
    {
        if ($this->isPost()) {
            $result = $this->usersModel->AddUser($_POST);
            if ($result === true)
                return $this->renderMessage('ok', 'Користувач успішно зареєстрований', null, [
                    'PageTitle' => 'Реєстрація',
                    'MainTitle' => 'Реєстрація'
                ]);
            else {
                $message = implode('<br/>', $result);
                return $this->render('register', null,
                    [
                        'PageTitle' => 'Реєстрація',
                        'MainTitle' => 'Реєстрація',
                        'MessageText' => $message,
                        'MessageClass' => 'danger'
                    ]);
            }
        } else {
            return $this->render('register', null, [
                'PageTitle' => 'Реєстрація',
                'MainTitle' => 'Реєстрація'
            ]);
        }
    }

    public function actionDelete()
    {
        if (!empty($this->user)) {
            if (empty($_GET['id']))
                return $this->renderMessage('error', 'Помилка', null, [
                    'PageTitle' => 'Видалення користувача',
                    'MainTitle' => 'Видалення користувача'
                ]);
            $id = $_GET['id'];
            if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
                if ($this->usersModel->DeleteUsers($id)) {

                    header('Location: /users/logout');
                } else
                    return $this->renderMessage('error', 'Помилка', null, [
                        'PageTitle' => 'Видалення користувача',
                        'MainTitle' => 'Видалення користувача'
                    ]);
            }
            $user = $this->usersModel->GetUserById($id);
            return $this->render('delete', ['model' => $user], [
                'PageTitle' => '',
                'MainTitle' => 'Видалення користувача'
            ]);
        } else
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
    }
}