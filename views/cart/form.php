<form method="post">
    <div class="input-group input-group-lg mb-3">
        <span class="input-group-text" id="inputGroup-sizing-sm">Кількість</span>
        <input type="number" class="form-control" name="count"
               aria-label="Sizing example input"
               aria-describedby="inputGroup-sizing-sm" value="1" id="count" min="1">
    </div>
    <div class="input-group input-group-lg mb-3 col-2">
        <span class="input-group-text" id="inputGroup-sizing-sm">Розмір</span>
        <select class="form-control" aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm" name="size_cart">
            <?php $sizes = explode(', ', $model['size']);
            foreach ($sizes as $size):
                ?>
                <option value="<?= $size ?>"><?php echo $size ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <button type="submit" class="btn btn-lg btn-primary">Додати</button>
</form>