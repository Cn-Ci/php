<h1>Liste des produits</h1>

<ul> 
    <?php foreach ($products as $product ) { ?>
        <li>
            <a href="/product/read/<?= $product->id?>"><?= $product->category->name?></a>
        </li>
    <?php } ?>
</ul>


<a href="product/create" class="btn btn-sm btn-success mb-3">Nouveau Produit</a>