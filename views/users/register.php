<form method="post" action="">
    <div class="mb-3">
        <label for="login" class="form-label">Email</label>
        <input type="email" name="login" class="form-control" id="login" aria-describedby="emailHelp"
               value="<?= $_POST['login'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword" class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword" minlength="8">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword2" class="form-label">Повторіть пароль</label>
        <input type="password" name="password2" class="form-control" id="exampleInputPassword2">
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Прізвище</label>
        <input type="text" name="lastname" class="form-control" id="lastname" value="<?= $_POST['lastname'] ?>">
    </div>
    <div class=" mb-3">
        <label for="firstname" class="form-label">Ім`я</label>
        <input type="text" name="firstname" class="form-control" id="firstname" value="<?= $_POST['firstname'] ?>">
    </div>
    <div class=" mb-3">
        <label for="phone" class="form-label">Номер телефону</label>
        <input name="phone" class="form-control" id="phone" value="<?= $_POST['phone'] ?>"
               pattern="\d{3}-\d{3}-\d{2}-\d{2}" placeholder="067-777-77-77">
    </div>
    <button type="submit" class="btn btn-primary">Зареєструватись</button>
</form>
