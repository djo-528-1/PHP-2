<h1><?= $h1; ?></h1>
<div id="content">
	<table>
		<tr>
			<th>id</th>
			<th>Название</th>
			<th>Цена</th>
            <th>Кол-во</th>
            <th>Категория</th>
            <th>Ссылка</th>
		</tr>
		<?php foreach ($products as $product): ?>
		<tr>
			<td><?= $product['id']; ?></td>
			<td><?= $product['name']; ?></td>
			<td><?= $product['price']; ?></td>
            <td><?= $product['quantity']; ?></td>
            <td><?= $product['category']; ?></td>
            <td><a href="/Lab8/product/<?= $product['id']; ?>/">Cсылка на продукт</a></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>