<?php
session_start();
$userModel = new \models\Users();
$user = $userModel->GetCurrentUser();
$adminModel = new \models\Admin();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/style.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"
    />
    <title><?= $MainTitle ?></title>
</head>
<body style="background-color: #d5eeff ">
<header class="p-3 mb-3 border-bottom bg-dark">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <img src="/img/logo.jpg" width="200" height="60" class="bi me-2" style="border-radius: 10px">
            </a>
            <ul class="nav col-12 col-lg-auto mb-3 mb-lg-0 me-lg-auto justify-content-center">
                <a href="/products/index" class="dropbtn btn btn-outline-light me-2 btn-lg">Каталог</a>
            </ul>
            <form class="d-flex">
                <?php if (!$userModel->IsUserAuthenticated()): ?>
                    <a href="/users/register" class="btn btn-outline-light me-2 btn-lg">Реєстрація</a>
                    <a href="/users/login" class="btn btn-outline-light me-2 btn-lg">Вхід</a>
                <?php else: ?>
                    <div class="dropdown text-end">
                        <a href="#" class="d-block link-light text-decoration-none dropdown-toggle btn-lg"
                           id="dropdownUser1"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <?= $user['firstname'] ?>
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="dropdownUser1" style="">
                            <li><a class="dropdown-item" href="/users/index">Особистий кабінет</a></li
                            <li><a class="dropdown-item" href="/admin/index">Admin акаунт</a></li>
                            <?php if ($adminModel->CheckAdmin($user)):?>
                                <li><a class="dropdown-item" href="/products/add">Додати товар</a></li>
                                <li><a class="dropdown-item" href="/products/allProducts">Редагування товарів</a>
                                </li>
                                <li><a class="dropdown-item" href="/order/allOrders">Замовлення</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="/order/index">Мої замовлення</a></li>
                            <li><a class="dropdown-item" href="/cart/index">Кошик</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a href="/users/logout" class="dropdown-item btn-lg">Вихід</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</header>
<div class="container">
    <h1 class="mt-5"><?= $PageTitle ?></h1>
    <?php if (!empty($MessageText)) : ?>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
        </svg>
        <div class="alert alert-<?= $MessageClass ?> d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="<?= $MessageClass ?>:">
                <use xlink:href="#exclamation-triangle-fill"></use>
            </svg>
            <div>
                <?= $MessageText ?>
            </div>
        </div>
    <?php endif ?>
    <?= $PageContent ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<?php if ($userModel->IsUserAuthenticated()): ?>
    <script src="/alien/build/ckeditor.js"></script>
    <script>
        let editors = document.querySelectorAll('.editor')
        for (let i in editors) {
            ClassicEditor
                .create(editors[i], {

                    licenseKey: '',


                })
                .then(editor => {
                    window.editor = editor;


                })
                .catch(error => {
                    console.error('Oops, something went wrong!');
                    console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
                    console.warn('Build id: ltcthi45yg70-nohdljl880ze');
                    console.error(error);
                });
        }
    </script>
<?php endif; ?>
</body>
</html>