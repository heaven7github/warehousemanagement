<?php include_once 'header.php' ?>

<body>

<h2><?php echo $type ?></h2>

<form action="index.php?c=warehouse&a=add_warehouse" method="post">
    <div class="form-group">
        <label for="name">Megnevezés:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($warehouse['name']) ? $warehouse['name'] : '' ?>" />
    </div>
    <div class="form-group">
        <label for="address">Cím:</label>
        <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($warehouse['address']) ? $warehouse['address'] : '' ?>" />
    </div>
    <div class="form-group">
        <label for="capacity">Összes kapacitás:</label>
        <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo isset($warehouse['capacity']) ? $warehouse['capacity'] : '' ?>" />
    </div>
    <button type="submit" class="btn btn-primary">Hozzáadás</button>
</form>

</body>