<form action="index.php" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="username">Product Name:</label>
        <input type="text" class="form-control" id="username" placeholder="Potato" name="potato" required>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="password">Price:</label>
        <input type="password" class="form-control" id="number" placeholder="0.99" name="price" required>
    </div>
    <button type="submit" name="action" value="product/add">Submit</button>
</form>
