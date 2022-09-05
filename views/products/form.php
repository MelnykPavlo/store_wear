<form method="post" action="" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Назва товару</label>
        <input type="text" name="title" class="form-control" id="title" value="<?= $model['title'] ?>">
    </div>
    <?php $size = explode(', ', $model['size'])?>
    <div class="mb-3">
        <h3>Розміри:</h3>
        <input class="form-check-input" type="checkbox" value="XS" id="XS"
               name="size[]" <?php if (!empty($size) && in_array('XS', $size)): echo 'checked="checked"';endif; ?>>
        <label class="form-check-label" for="XS">
            XS
        </label>
        <br>
        <input class="form-check-input" type="checkbox" value="S" id="S"
               name="size[]" <?php if (!empty($size) && in_array('S', $size)): echo 'checked="checked"';endif; ?>>
        <label class="form-check-label" for="S">
            S
        </label>
        <br>
        <input class="form-check-input" type="checkbox" value="M" id="M"
               name="size[]" <?php if (!empty($size) && in_array('M', $size)): echo 'checked="checked"';endif; ?>>
        <label class="form-check-label" for="M">
            M
        </label>
        <br>
        <input class="form-check-input" type="checkbox" value="L" id="L"
               name="size[]" <?php if (!empty($size) && in_array('L', $size)): echo 'checked="checked"';endif; ?>>
        <label class="form-check-label" for="L">
            L
        </label>
        <br>
        <input class="form-check-input" type="checkbox" value="XL" id="XL"
               name="size[]" <?php if (!empty($size) && in_array('XL', $size)): echo 'checked="checked"';endif; ?>>
        <label class="form-check-label" for="XL">
            XL
        </label>
        <br>
        <input class="form-check-input" type="checkbox" value="2XL" id="2XL"
               name="size[]" <?php if (!empty($size) && in_array('2XL', $size)): echo 'checked="checked"';endif; ?>>
        <label class="form-check-label" for="2XL">
            2XL
        </label>
        <br>
        <input class="form-check-input" type="checkbox" value="3XL" id="3XL"
               name="size[]" <?php if (!empty($size) && in_array('3XL', $size)): echo 'checked="checked"';endif; ?>>
        <label class="form-check-label" for="3XL">
            3XL
        </label>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Ціна($)</label>
        <input type="number" name="price" class="form-control" id="price" value="<?= $model['price'] ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Опис</label>
        <textarea name="description" class="form-control editor"
                  id="description"><?= $model['description'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="kind" class="form-label">Категорія товару</label>
        <select id="kind" name="kind">
            <option disabled <?php if (empty($model)): ?> selected<?php endif; ?>>Оберіть категорія товару</option>
            <option value="Одяг" <?php if ($model['kind'] == 'Одяг'): ?> selected<?php endif; ?>>Одяг</option>
            <option value="Взуття" <?php if ($model['kind'] == 'Взуття'): ?> selected<?php endif; ?>>Взуття</option>
            <option value="Аксесуари" <?php if ($model['kind'] == 'Аксесуари'): ?> selected<?php endif; ?>>Аксесуари
            </option>
        </select>
    </div>
    <div class="mb-3">
        <label for="gender" class="form-label">Для кого</label>
        <select id="gender" name="gender">
            <option disabled <?php if (empty($model)): ?> selected<?php endif; ?>>Оберіть для кого товар</option>
            <option value="Для жінок" <?php if ($model['gender'] == 'Для жінок'): ?> selected<?php endif; ?>>Для жінок
            </option>
            <option value="Для чоловіків" <?php if ($model['gender'] == 'Для чоловіків'): ?> selected<?php endif; ?>>Для
                чоловіків
            </option>
            <option value="Для хлопчиків" <?php if ($model['gender'] == 'Для хлопчиків'): ?> selected<?php endif; ?>>Для
                хлопчиків
            </option>
            <option value="Для дівчаток" <?php if ($model['gender'] == 'Для дівчаток'): ?> selected<?php endif; ?>>Для
                дівчаток
            </option>
            <option value="Unisex" <?php if ($model['gender'] == 'Unisex'): ?> selected<?php endif; ?>>Unisex</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="file" class="form-label">Фото</label>
        <input type="file" name="file" class="form-control" id="file" accept="image/jpeg, image/png">
    </div>
    <div class="mb-3">
        <?php if (is_file('files/products/' . $model['photo'] . '_m.jpeg')): ?>
            <img src="/files/products/<?= $model['photo'] ?>_m.jpeg"/>
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-primary">Зберегти</button>
</form>