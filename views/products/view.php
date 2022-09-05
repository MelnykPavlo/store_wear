<?php
$userModel = new \models\Users();
$user = $userModel->GetCurrentUser();
$adminModel = new \models\Admin();
$check = $adminModel->CheckAdmin($user);
session_start();
?>
<div class="products row">
    <div class="col-6">
        <div>
            <?php if (is_file('files/products/' . $model['photo'] . '_m.jpeg')): ?>
                <?php if (is_file('files/products/' . $model['photo'] . '_b.jpeg')): ?>
                    <a href="/files/products/<?= $model['photo'] ?>_b.jpeg" data-fancybox="gallery">
                <?php endif; ?>
                <img src="/files/products/<?= $model['photo'] ?>_m.jpeg"
                     class="bd-placeholder-img rounded float-start"/>
                <?php if (is_file('files/products/' . $model['photo'] . '_b.jpeg')): ?>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div>
            <h3>Ціна: <?= $model['price'] ?>$</h3>
            <h3>Розмір: <?= $model['size'] ?></h3>
            <h3><?= $model['gender'] ?></h3>
        </div>
    </div>
    <div class="col-6">
        <div style="text-align: center">
            <h1>Детальніше:</h1>
            <?= $model['description'] ?>
            <?php if (!empty($user) && (!isset($_SESSION['cart'][$user['id']]) || !in_array(["user_id" => $user['id'], "product_id" => $model['id']], $_SESSION['cart'][$user['id']]))): ?>
                <a href="/cart/add?id=<?= $model['id'] ?>" class="btn btn-warning btn-lg">В
                    кошик</a>
            <?php endif; ?>
            <?php if (!empty($user) && isset($_SESSION['cart'][$user['id']]) && in_array(["user_id" => $user['id'], "product_id" => $model['id']], $_SESSION['cart'][$user['id']])): ?>
                <a href="/cart/index" class="btn btn-success btn-lg">В кошику</a>
            <?php endif; ?>
        </div>
    </div>
</div>
<h5>Дата публікації: <?= $model['datetime'] ?></h5>
<?php if (!empty($user)): ?>
    <h3>Ваш коментар:</h3>
    <form method="post">
        <div class="row">
            <div class="col-10">
            <textarea name="comment" class="form-control editor"
                      id="description" aria-label="Recipient's username" aria-describedby="button-addon2"
                      rows="1"></textarea>
            </div>
            <div class="col-2" style=" position: relative;bottom: 0">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">OK</button>
            </div>
        </div>
    </form>
<?php endif; ?>
<?php if (!empty($comments)): ?>
    <h2>Коментарі: </h2>
    <table class="table table-primary">
        <?php foreach ($comments as $comment):
            $author = $userModel->GetUserById($comment['id_author']);
            ?>
            <tr>
                <td>
                    <h5><?= $author['firstname'] ?></h5>
                </td>
                <td>
                    <h5><?= $comment['text'] ?></h5>
                </td>
                <td>
                    <h5><?= $comment['date'] ?></h5>
                </td>
                <td>
                    <?php if ($check || $user['id'] == $comment['id_author']): ?>
                    <a href="/products/deleteComment?id=<?= $comment['id'] ?>" class="text-decoration-none "><h5
                                class="text-decoration-none" style="color: red">Видалити</h5>
                        <?php endif;
                        ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
<div class="mb-5"></div>
