<form method="post" action="">
    <div class="mb-3">
        <label for="login" class="form-label">Login</label>
        <input type="email" name="login" class="form-control" id="login" aria-describedby="emailHelp"
               value="<?= $model['login'] ?>">
    </div>
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
    <button type="submit" class="btn btn-primary">Зберегти</button>
</form>