<?php include_once 'header.php' ?>

<h2><?php echo $warehouse['name'] ?> termékeinek a kezelése </h2>
<?php if (count($warehouseProducts) >0): ?>
    <table class="table table-striped table-inverse table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Mennyiség</th>
            <th>Megnevezés</th>
            <th>Típus</th>
            <th>Cikkszám</th>
            <th>Ár</th>
            <th>Gyártó</th>
            <th>Súly</th>
            <th>Elemek</th>
            <th>Kikérendő mennyiség</th>
            <th>Művelet</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($warehouseProducts as $product): ?>
            <?php $productObject = $product['product']; ?></td>
            <tr>
                <th scope="row"><?php echo $productObject->getId(); ?></th>
                <td><?php echo $product['qty']; ?></td>
                <td><?php echo $productObject->getName(); ?></td>
                <td><?php echo $productObject->getType(); ?></td>
                <td><?php echo $productObject->getSku(); ?></td>
                <td><?php echo $productObject->getPrice(); ?></td>
                <td><?php echo $productObject->getManufacturer(); ?></td>
                <td><?php echo $productObject->getWeight(); ?></td>
                <td><?php echo $productObject->getItems(); ?></td>
                <td><input type="text" maxlength="5" id="remove_product_id_<?php echo $productObject->getId(); ?>" /></td>
                <td><button type="button" class="btn btn-primary remove_product" data-id="<?php echo $productObject->getId(); ?>">Kikér</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Nincs még termék a raktárban
<?php endif; ?>
<h3>Új termék hozzáadása a raktárhoz</h3>

<form action="index.php?c=warehouse&a=warehouse_add_product" method="post">
    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $warehouse['id'] ?>" />
    <div class="form-group">
        <label for="product_id">Termék:</label>

        <select name="product_id" class="form-control">
            <?php foreach ($products as $product): ?>
                <option value="<?php echo $product->getId()?>"><?php echo $product->getName()?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="qty">Mennyiség:</label>
        <input type="text" class="form-control" id="qty" name="qty" value="" />
    </div>

    <button type="submit" class="btn btn-primary">Hozzáadás</button>
</form>

