<form method="post" action="">
    <div class="mb-3">
        <label for="login" class="form-label">Email</label>
        <input type="email" name="login" class="form-control" id="login" aria-describedby="emailHelp"
               value="<?= $_POST['login'] ?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword" class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword">
    </div>
    <button type="submit" class="btn btn-primary">Увійти</button>
</form>
