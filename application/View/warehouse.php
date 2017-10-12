<?php include_once 'header.php' ?>

<body>

<div class="top_buttons float-right">
    <button type="button" class="btn btn-primary" id="add_warehouse">Raktár hozzáadása</button>
</div>

<div class="clearfix"></div>
<h2>Raktárak listája:</h2>

<?php if (count($warehouses) > 0) : ?>
    <table class="table table-striped table-inverse table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Megnevezés</th>
                <th>Cím</th>
                <th>Maximális kapacitás</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($warehouses as $warehouse): ?>
            <tr>
                <th scope="row"><?php echo $warehouse['id']; ?></th>
                <td><?php echo $warehouse['name']; ?></td>
                <td><?php echo $warehouse['address']; ?></td>
                <td><?php echo $warehouse['capacity']; ?></td>
                <td><button type="button" class="btn btn-primary warehouse_product" data-id="<?php echo $warehouse['id']; ?>">Tételek kezelése</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Nincs raktár még rögzítve a rendszerben. A Raktár hozzáadása gombbal tud új raktárat felvinni.
<?php endif; ?>
</body>

