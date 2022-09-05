<?php if (empty($model)): ?>
    <div class="container">
        <p>
        <h1 style="text-align: center">Cписок замовлень порожній</h1>
    </div>
<?php endif; ?>
<?php if (!empty($model)): ?>
    <div class="container">
        <?php foreach ($model as $key => $item): ?>
            <div class="row">
                <?php
                $productModel = new \models\Products(); ?>
                <?php if (explode(', ', $item['id_products']) != null):
                    $item['id_products'] = explode(', ', $item['id_products']);
                    $item['counts'] = explode(', ', $item['counts']);
                    $item['sizes'] = explode(', ', $item['sizes']);
                    ?>
                    <div class="col-4 border_new">
                        <?php
                        for ($i = 0;
                             $i < count($item['id_products']);
                             $i++):
                            $product = $productModel->GetProductsByID($item['id_products'][$i]);
                            ?>
                            <div class="col-12">
                                <div class="products-record ">
                                    <a href="/products/view?id=<?= $product['id'] ?>"
                                       class="text-decoration-none text-dark">
                                        <h3><?= $product['title'] ?></h3>
                                        <div class="photo">
                                            <?php if (is_file('files/products/' . $product['photo'] . '_s.jpeg')): ?>
                                                <img src="/files/products/<?= $product['photo'] ?>_s.jpeg"
                                                     class="bd-placeholder-img rounded float-start"/>
                                            <?php else : ?>
                                                <svg class="bd-placeholder-img rounded float-start" width="180"
                                                     height="180"
                                                     xmlns="http://www.w3.org/2000/svg" role="img"
                                                     aria-label="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera: 200x200"
                                                     preserveAspectRatio="xMidYMid slice" focusable="false">
                                                    <rect width="100%" height="100%" fill="#868e96"></rect>
                                                </svg>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <p>Ціна: <?= $product['price'] ?> $</p>
                                            <p>Розмір: <?= $item['sizes'][$i] ?></p>
                                            <p>Кількість: <?= $item['counts'][$i] ?></p>
                                            <p>Дата замовлення: <br><?= $item['date'] ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php else: $product = $productModel->GetProductsByID($item['id_products']); ?>
                    <div class="col-6">
                        <div class="products-record">
                            <a href="/products/view?id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                                <h3><?= $product['title'] ?></h3>
                                <div class="photo">
                                    <?php if (is_file('files/products/' . $product['photo'] . '_s.jpeg')): ?>
                                        <img src="/files/products/<?= $product['photo'] ?>_s.jpeg"
                                             class="bd-placeholder-img rounded float-start"/>
                                    <?php else : ?>
                                        <svg class="bd-placeholder-img rounded float-start" width="180" height="180"
                                             xmlns="http://www.w3.org/2000/svg" role="img"
                                             aria-label="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera: 200x200"
                                             preserveAspectRatio="xMidYMid slice" focusable="false">
                                            <rect width="100%" height="100%" fill="#868e96"></rect>
                                        </svg>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <p>Ціна: <?= $product['price'] ?> $</p>
                                    <p>Розмір: <?= $item['sizes'] ?></p>
                                    <p>Кількість: <?= $item['counts'] ?></p>
                                    <p>Дата замовлення: <br><?= $item['date'] ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="border_new col-8">
                    <div class="row">
                        <div class="col-6">
                            <h4>Дані покупця:</h4>
                            <p>Прізвище : <?= $item['lastname'] ?></p>
                            <p>Ім`я : <?= $item['firstname'] ?></p>
                            <p>Номер Телефон: <?= $item['phone'] ?></p>
                            <p>Адресса: <?= $item['address'] ?></p>
                            <p>Поштовий індекс: <?= $item['post_index'] ?></p>
                        </div>
                        <div class="col-6" style="text-align: center;margin-top: auto; margin-bottom: auto">
                            <p>Дата замовлення: <?= $item['date'] ?></p>
                            <h4>
                                Статус: <?php if ($item['execute'] !== '1'): echo '<b style="color: red">не виконано</b>';
                                else:
                                    echo '<b style="color: black">виконано</b>'; endif; ?></h4>
                            <?php if ($item['execute'] !== "1"):?>
                            <a href="/admin/execute?id_order=<?= $item['id'] ?>"
                               class="btn btn-success">Виконати</a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<div class="mt-5"></div>



