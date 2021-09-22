<h1>Detail de la catégorie : <?= $category->name ?></h1>
<h2>Produit de cette catégorie :</h2>
<ul>
    <?php foreach ($category->products as $product) {?>
        <li>
            <?= $product->name?>
        </li>
    <?php } ?>
</ul>