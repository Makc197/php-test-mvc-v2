<h1> Read <?= $product->getType() ?> (ID: <?= $product->getID() ?> ) </h1>
<div class="formtable-div-block col-md-6">
    <table class="table">
        <thead> 
            <tr><th>Field name</th><th>Field value</th></tr>
        </thead>
        <tbody>

            <tr>
                <td> Title: </td><td><?= $product->getTitle(); ?></td>
            </tr>

            <tr>
                <td> Description: </td><td><?= $product->getDescription(); ?></td>
            </tr>

            <tr>
                <td> Price: </td><td><?= $product->getPrice(); ?></td>
            </tr>

        </tbody>
    </table>
</div>

