<?php include_once 'header.php' ?>

<body>

<div class="clearfix"></div>
<h2>Termékek listája:</h2>

<?php if (count($products) > 0) : ?>
    <table class="table table-striped table-inverse table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Megnevezés</th>
                <th>Típus</th>
                <th>Cikkszám</th>
                <th>Ár</th>
                <th>Gyártó</th>
                <th>Súly</th>
                <th>Elemek</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <th scope="row"><?php echo $product->getId(); ?></th>
                <td><?php echo $product->getName(); ?></td>
                <td><?php echo $product->getType(); ?></td>
                <td><?php echo $product->getSku(); ?></td>
                <td><?php echo $product->getPrice(); ?></td>
                <td><?php echo $product->getManufacturer(); ?></td>
                <td><?php echo $product->getWeight(); ?></td>
                <td><?php echo $product->getItems(); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    Nincs egy termék sem.
<?php endif; ?>
</body>

