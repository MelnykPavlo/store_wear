<form method="post" action="">
    <div class="mb-3">
        <label for="lastname" class="form-label">Прізвище</label>
        <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $model['lastname'] ?>">
    </div>
    <div class=" mb-3">
        <label for="firstname" class="form-label">Ім`я</label>
        <input type="text" name="firstname" class="form-control" id="firstname" value="<?= $model['firstname'] ?>">
    </div>
    <div class=" mb-3">
        <label for="phone" class="form-label">Номер телефону</label>
        <input name="phone" class="form-control" id="phone" value="<?= $model['phone'] ?>"
               pattern="\d{3}-\d{3}-\d{2}-\d{2}" placeholder="067-777-77-77">
    </div>
    <div class=" mb-3">
        <label for="address" class="form-label">Адреса</label>
        <input name="address" class="form-control" id="address" value="<?= $model['address'] ?>">
    </div>
    <div class="mb-3">
        <label for="index" class="form-label">Поштовий індекс</label>
        <input name="index" type="number" class="form-control" id="index" value="<?= $model['index'] ?>">
    </div>
    <button type="submit" class="btn btn-primary">Купити</button>
</form>
