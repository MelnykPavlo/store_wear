<?php

namespace controllers;

use models\Comments;

/**
 * Контроллер для модуля Products
 */
class Products extends Controller
{
    protected $user;
    protected $userModel;
    protected $productsModel;
    protected $filtersModel;
    protected $adminModel;
    protected $admin;
    protected $commentModel;

    public function __construct()
    {
        $this->userModel = new \models\Users();
        $this->productsModel = new \models\Products();
        $this->filtersModel = new \models\Filters();
        $this->adminModel = new \models\Admin();
        $this->user = $this->userModel->GetCurrentUser();
        $this->admin = $this->adminModel->CheckAdmin($this->user);
        $this->commentModel = new Comments();

    }

    /**
     * Відображення початкової сторінки модуля
     */
    public function actionIndex()
    {
        if (empty($_GET['page']))
            $page = 0;
        else
            $page = $_GET['page'];
        $count = 8;
        if (empty($_POST)) {
            $lastProducts = $this->productsModel->GetLastProduct();
        } else {
            $lastProducts = $this->filtersModel->GetFilteredProducts($_POST);
        }
        $pageCount = floor(count($lastProducts) / $count);
        return $this->render('index', ['lastProducts' => $lastProducts, 'pageCount' => $pageCount, 'page' => $page, 'count' => $count], [
            'PageTitle' => '',
            'MainTitle' => 'Товари'
        ]);
    }


    public function actionView()
    {
        if (empty($_GET['id']))
            return $this->renderMessage('error', 'Помилка', null, [
                'PageTitle' => '',
                'MainTitle' => ''
            ]);
        $id = $_GET['id'];
        $products = $this->productsModel->GetProductsByID($id);
        if ($this->isPost()) {
            if (!empty($_POST['comment'])) {
                $this->commentModel->AddComment($id, $this->user['id'], $_POST['comment']);

            }
        }
        $comments = $this->commentModel->GetComments($id);
        return $this->render('view', ['model' => $products, 'comments' => $comments], [
            'PageTitle' => $products['title'],
            'MainTitle' => $products['title']
        ]);
    }

    public function actionDeleteComment()
    {
        if (empty($_GET['id']))
            return $this->renderMessage('error', 'Помилка', null, [
                'PageTitle' => '',
                'MainTitle' => ''
            ]);
        $id = $_GET['id'];
        $id_product = $this->commentModel->GetComments2($id)[0]['id_product'];
        $this->commentModel->DeleteComment($id);
        header("Location: /products/view?id=$id_product");
    }

    public function actionAdd()
    {
        if (empty($this->user) || !$this->admin) {
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
        }
        if ($this->isPost()) {
            $result = $this->productsModel->AddProducts($_POST);
            if ($result['error'] === false) {
                $allowed_types = ['image/png', 'image/jpeg'];
                if (is_file($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $allowed_types)) {
                    switch ($_FILES['file']['type']) {
                        case 'image/png' :
                            $extension = 'png';
                            break;
                        default:
                            $extension = 'jpeg';
                    }
                    $name = $result['id'] . '_' . uniqid() . '.' . $extension;
                    move_uploaded_file($_FILES['file']['tmp_name'], 'files/products/' . $name);
                    $this->productsModel->ChangePhoto($result['id'], $name);
                }
                return $this->renderMessage('ok', 'Товар успішно додано', null, [
                    'PageTitle' => 'Додавання товару',
                    'MainTitle' => 'Додавання товару'
                ]);
            } else {
                $message = implode('<br/>', $result['messages']);
                return $this->render('form', ['model' => $_POST],
                    [
                        'PageTitle' => 'Додавання товару',
                        'MainTitle' => 'Додавання товару',
                        'MessageText' => $message,
                        'MessageClass' => 'danger'
                    ]);
            }
        } else
            return $this->render('form', ['model' => $_POST], [
                'PageTitle' => 'Додавання товару',
                'MainTitle' => 'Додавання товару'
            ]);
    }

    public function actionEdit()
    {
        if (empty($this->user) || !$this->admin) {
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
        }
        if (empty($_GET['id']))
            return $this->renderMessage('error', 'Помилка', null, [
                'PageTitle' => 'Редагування товару',
                'MainTitle' => 'Редагування товару'
            ]);
        $id = $_GET['id'];
        $products = $this->productsModel->GetProductsByID($id);
        if ($this->isPost()) {
            $result = $this->productsModel->UpdateProducts($_POST, $id);
            if ($result === true) {
                $allowed_types = ['image/png', 'image/jpeg'];
                if (is_file($_FILES['file']['tmp_name']) && in_array($_FILES['file']['type'], $allowed_types)) {
                    switch ($_FILES['file']['type']) {
                        case 'image/png' :
                            $extension = 'png';
                            break;
                        default:
                            $extension = 'jpeg';

                    }
                    $name = $id . '_' . uniqid() . '.' . $extension;
                    move_uploaded_file($_FILES['file']['tmp_name'], 'files/products/' . $name);
                    $this->productsModel->ChangePhoto($id, $name);
                }
                return $this->renderMessage('ok', 'Товар успішно оновлено', null, [
                    'PageTitle' => 'Редагування товару',
                    'MainTitle' => 'Редагування товару'
                ]);
            } else {
                $message = implode('<br/>', $result);
                return $this->render('form', ['model' => $products],
                    [
                        'PageTitle' => 'Редагування товару',
                        'MainTitle' => 'Редагування товару',
                        'MessageText' => $message,
                        'MessageClass' => 'danger'
                    ]);
            }
        } else
            return $this->render('form', ['model' => $products], [
                'PageTitle' => 'Редагування товару',
                'MainTitle' => 'Редагування товару'
            ]);
    }

    public function actionDelete()
    {
        if (!empty($this->user) && $this->admin) {
            if (empty($_GET['id']))
                return $this->renderMessage('error', 'Помилка', null, [
                    'PageTitle' => 'Видалення товару',
                    'MainTitle' => 'Видалення товару'
                ]);
            $id = $_GET['id'];
            if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
                if ($this->productsModel->DeleteProducts($id)) {
                    header('Location: /products/allProducts');
                } else
                    return $this->renderMessage('error', 'Помилка', null, [
                        'PageTitle' => 'Видалення товару',
                        'MainTitle' => 'Видалення товару'
                    ]);
            }
            $products = $this->productsModel->GetProductsByID($id);
            return $this->render('delete', ['model' => $products], [
                'PageTitle' => '',
                'MainTitle' => 'Видалення товару'
            ]);
        } else
            return $this->render('forbidden', null, [
                'PageTitle' => 'Немає доступу',
                'MainTitle' => 'Немає доступу'
            ]);
    }

    public function actionAllProducts()
    {
        if (!empty($this->user) && $this->admin) {
            $products = $this->productsModel->allProducts();
            return $this->render('allProducts', ['model' => $products], [
                'PageTitle' => 'Усі товари',
                'MainTitle' => 'Усі товари'
            ]);
        }
        return $this->render('forbidden', null, [
            'PageTitle' => 'Немає доступу',
            'MainTitle' => 'Немає доступу'
        ]);
    }


}