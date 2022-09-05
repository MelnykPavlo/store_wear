<?php
if (empty($model)): ?>
    <div class="container">
        <p>
        <h1 style="text-align: center">Ваш список покупок порожній</h1>
    </div>
<?php endif; ?>
<?php
if (!empty($model)): ?>
<div class="container" style="  width: 100vw;
  height: 100vh;">
    <div class="row">
        <?php foreach ($model as $item): ?>
            <h4>Статус: <?php if ($item['execute'] !== '1'): echo '<b style="color: red">не виконано</b>';
                else:
                    echo '<b style="color: green">виконано</b>'; endif; ?></h4>
            <?php
            $productModel = new \models\Products();
            if (explode(', ', $item['id_products']) != null):
                $item['counts'] = explode(', ', $item['counts']);
                $item['sizes'] = explode(', ', $item['sizes']);
                $item['id_products'] = explode(', ', $item['id_products']);
                for ($i = 0; $i < count($item['id_products']); $i++):
                    $product = $productModel->GetProductsByID($item['id_products'][$i]);
                    ?>
                    <div class="products-record col-12 col-md-4 border_new">
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
                                <p>Розмір: <?= $item['sizes'][$i] ?></p>
                                <p>Кількість: <?= $item['counts'][$i]  ?></p>
                                <p>Дата замовлення: <br><?= $item['date'] ?></p>
                            </div>

                        </a>
                    </div>
                <?php endfor; ?>
            <?php else: $product = $productModel->GetProductsByID($item['id_products']); ?>
                <div class="products-record col-12 col-md-4 border_new">
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
                            <p>Кількість: <?= $item['counts']  ?></p>
                            <p>Дата замовлення: <br><?= $item['date'] ?></p>
                        </div>

                    </a>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
    <div class="mt-5"></div>
