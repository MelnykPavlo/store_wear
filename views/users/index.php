<!doctype html>
<html lang="!">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h5>Дані користувача</h5>
            <table class="table">
                <tbody>
                <tr>
                    <th scope="row">Логін</th>
                    <td><?= $model['login']?></td>
                </tr>
                <tr>
                    <th scope="row">Ім`я</th>
                    <td><?= $model['firstname']?></td>
                </tr>
                <tr>
                    <th scope="row">Прізвище</th>
                    <td><?= $model['lastname']?></td>
                </tr>
                <tr>
                    <th scope="row">Телефон</th>
                    <td><?= $model['phone']?></td>
                </tr>
                </tbody>
            </table>
            <a type="button" href="/users/change?id=<?= $model['id']?>" class="btn btn-dark btn-lg">Змінити дані</a>
            <a type="button" href="/users/delete?id=<?= $model['id']?>" class="btn btn-danger btn-lg">Видалити обліковий запис</a>
        </div>
        <div class="col-4">
            <h5>Статистика користувача</h5>
            <table class="table">
                <tbody>
                <tr>
                    <th scope="row">Кількість замовлень</th>
                    <td><?= $count_orders?></td>
                </tr>
                <tr>
                    <th scope="row">Кількість написаних коментарів</th>
                    <td><?= $count_comments?></td>
                </tr>
                <?php if($check):?>
                <tr>
                    <th scope="row">Загальна кількість замовлень на сайті</th>
                    <td><?= $all_count_orders?></td>
                </tr>
                <tr>
                    <th scope="row">Загальна кількість коментарів на сайті</th>
                    <td><?= $all_count_comments?></td>
                </tr>
                <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
    <div>
    </div>
</div>
</body>
</html>

