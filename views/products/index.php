<?php
$userModel = new \models\Users();
$user = $userModel->GetCurrentUser();
$cartModel = new \models\Cart();
?>
<div class="container">
    <div class="row">
        <div class="col-2 col-md-3">
            <h2>Фільтри:</h2>
            <form method="post">
                <br>
                <h4>Пошук:</h4>
                <input type="text" class="form-control" placeholder="Search..." aria-label="Search" name="search"
                       value="<?php if (!empty($_POST['search'])): echo $_POST['search'];endif; ?>">
                <br>
                <h4>Сортувати за:</h4>
                <select class="form-select mb-1" aria-label="Default select example" name="sort">
                    <option value="date"<?php if ($_POST['sort'] != 'min_price' && $_POST['sort'] != 'max_price'): echo 'selected'; endif; ?>>
                        За датою
                    </option>
                    <option value="min_price" <?php if ($_POST['sort'] == 'min_price'): echo 'selected'; endif; ?>>Від
                        дешевих до дорогих
                    </option>
                    <option value="max_price" <?php if ($_POST['sort'] == 'max_price'): echo 'selected'; endif; ?>>Від
                        дорогих до дешевих
                    </option>
                </select>
                <h4>Ціна:</h4>
                <div class="input-group mb-3">
                    <span class="input-group-text">Від, $</span>
                    <input type="number" class="form-control"
                           aria-label="Dollar amount (with dot and two decimal places)"
                           value="<?php if (!empty($_POST['ot'])): echo $_POST['ot'];endif; ?>" name="ot">
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text">До, $</span>
                    <input type="number" class="form-control"
                           aria-label="Dollar amount (with dot and two decimal places)"
                           value="<?php if (!empty($_POST['do'])): echo $_POST['do'];endif; ?>" name="do">
                </div>
                <h4>Розмір:</h4>
                <input class="form-check-input" type="checkbox" value="XS" id="XS"
                       name="size[]" <?php if (!empty($_POST['size']) && in_array('XS', $_POST['size'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="XS">
                    XS
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="S" id="S"
                       name="size[]" <?php if (!empty($_POST['size']) && in_array('S', $_POST['size'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="S">
                    S
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="M" id="M"
                       name="size[]" <?php if (!empty($_POST['size']) && in_array('M', $_POST['size'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="M">
                    M
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="L" id="L"
                       name="size[]" <?php if (!empty($_POST['size']) && in_array('L', $_POST['size'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="L">
                    L
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="XL" id="XL"
                       name="size[]" <?php if (!empty($_POST['size']) && in_array('XL', $_POST['size'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="XL">
                    XL
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="2XL" id="2XL"
                       name="size[]" <?php if (!empty($_POST['size']) && in_array('2XL', $_POST['size'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="2XL">
                    2XL
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="3XL" id="3XL"
                       name="size[]" <?php if (!empty($_POST['size']) && in_array('3XL', $_POST['size'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="3XL">
                    3XL
                </label>
                <h4>Категорія:</h4>
                <input class="form-check-input" type="checkbox" value="Одяг" id="Одяг"
                       name="kind[]" <?php if (!empty($_POST['kind']) && in_array('Одяг', $_POST['kind'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="Одяг">
                    Одяг
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="Взуття" id="Взуття"
                       name="kind[]" <?php if (!empty($_POST['kind']) && in_array('Взуття', $_POST['kind'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="Взуття">
                    Взуття
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="Аксесуари" id="Аксесуари"
                       name="kind[]" <?php if (!empty($_POST['kind']) && in_array('Аксесуари', $_POST['kind'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="Аксесуари">
                    Аксесуари
                </label>
                <h4>Для кого:</h4>
                <input class="form-check-input" type="checkbox" value="Для чоловіків" id="Для чоловіків"
                       name="gender[]" <?php if (!empty($_POST['gender']) && in_array('Для чоловіків', $_POST['gender'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="Для чоловіків">
                    Для чоловіків
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="Для жінок" id="Для жінок"
                       name="gender[]" <?php if (!empty($_POST['gender']) && in_array('Для жінок', $_POST['gender'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="Для жінок">
                    Для жінок
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="Для хлопчиків" id="Для хлопчиків"
                       name="gender[]" <?php if (!empty($_POST['gender']) && in_array('Для хлопчиків', $_POST['gender'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="Для хлопчиків">
                    Для хлопчиків
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="Для дівчаток" id="Для дівчаток"
                       name="gender[]" <?php if (!empty($_POST['gender']) && in_array('Для дівчаток', $_POST['gender'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="Для дівчаток">
                    Для дівчаток
                </label>
                <br>
                <input class="form-check-input" type="checkbox" value="Unisex" id="Unisex"
                       name="gender[]" <?php if (!empty($_POST['gender']) && in_array('Unisex', $_POST['gender'])): echo 'checked="checked"';endif; ?>>
                <label class="form-check-label" for="Unisex">
                    Unisex
                </label>
                <br>
                <br>
                <input type="submit" class="btn btn-success" value="Знайти"/>
            </form>
        </div>
        <div class="col-10 col-md-9">
            <?php if (empty($lastProducts)): ?>
                <div class="container">
                    <p>
                    <h1>По вашому запиту <?php if (isset($search)): echo ": '{$search}' "; endif; ?>нічого не знайдено
                        :(</h1>
                </div>
            <?php endif; ?>
            <div class="container">
                <div class="row">
                    <?php for ($i = $page * $count;
                               $i < ($page + 1) * $count;
                               $i++): ?>
                        <?php if (isset($lastProducts[$i])): ?>
                            <div class="products-record col-12 col-md-6">
                                <a href="/products/view?id=<?= $lastProducts[$i]['id'] ?>"
                                   class="text-decoration-none text-dark">
                                    <h3><?= $lastProducts[$i]['title'] ?></h3></a>
                                <div class="row">
                                    <div class="photo col-6">
                                        <?php if (is_file('files/products/' . $lastProducts[$i]['photo'] . '_s.jpeg')): ?>
                                            <img src="/files/products/<?= $lastProducts[$i]['photo'] ?>_s.jpeg"
                                                 class="bd-placeholder-img rounded float-start"/>
                                        <?php else : ?>
                                            <svg class="bd-placeholder-img rounded float-start" width="200"
                                                 height="200"
                                                 xmlns="http://www.w3.org/2000/svg" role="img"
                                                 aria-label="A generic square placeholder image with a white border around it, making it resemble a photograph taken with an old instant camera: 200x200"
                                                 preserveAspectRatio="xMidYMid slice" focusable="false">
                                                <rect width="100%" height="100%" fill="#868e96"></rect>
                                            </svg>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-6">
                                        <p>Ціна: <?= $lastProducts[$i]['price'] ?> $</p>
                                        <p>Розмір: <?= $lastProducts[$i]['size'] ?></p>
                                        <div>
                                            <?php if (!empty($user) && !$cartModel->Check($lastProducts[$i]['id'], $user['id'])): ?>
                                                <a href="/cart/add?id=<?= $lastProducts[$i]['id'] ?>"
                                                   class="btn btn-warning">В
                                                    кошик</a>
                                            <?php endif; ?>
                                            <?php if (!empty($user)  && $cartModel->Check($lastProducts[$i]['id'], $user['id'])): ?>
                                                <a href="/cart/index" class="btn btn-success">В кошику</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
        <div class="container row">
            <div class="col-2 col-md-3"></div>
            <div class="col-10 col-md-9">
                <b style="left: 50%; right: 50%;  position: absolute;">
                    <nav aria-label="Page navigation example" style="text-align: center">
                        <ul class="pagination">
                            <?php if (isset($page)): ?>
                                <?php for ($i = 0; $i <= $pageCount; $i++): ?>
                                    <li class="page-item"><a class="page-link" style="color: black"
                                                             href="/products/index?page=<?php echo $i ?>"><?php echo $i + 1 ?></a>
                                    </li>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </b>
            </div>
        </div>
    </div>
</div>


