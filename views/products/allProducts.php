<?php if (empty($model)): ?>
    <div class="container">
        <p>
        <h1>У вас немає товарів</h1>
    </div>
<?php else: ?>
    <div class="container">
        <div class="row">
            <?php foreach ($model as $item): ?>
                <div class="products-record col-12 col-md-4">
                    <a href="/products/view?id=<?= $item['id'] ?>" class="text-decoration-none text-dark">
                        <h3><?= $item['title'] ?></h3>
                        <div class="photo">
                            <?php if (is_file('files/products/' . $item['photo'] . '_s.jpeg')): ?>
                                <img src="/files/products/<?= $item['photo'] ?>_s.jpeg"
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
                            <p>Ціна: <?= $item['price'] ?> $</p>
                            <p>Розмір: <?= $item['size'] ?></p>
                        </div>
                    </a>
                    <div>
                        <a href="/products/edit?id=<?= $item['id'] ?>"
                           class="btn btn-success mt-1 mb-1">Редагувати</a>
                        <a href="/products/delete?id=<?= $item['id'] ?>"
                           class="btn btn-danger mt-1 mb-1">Видалити</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>