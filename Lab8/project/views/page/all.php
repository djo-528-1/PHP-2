<h1><?= $h1; ?></h1>
<div id="content">
	<table>
		<tr>
			<th>id</th>
			<th>title</th>
			<th>ссылка</th>
		</tr>
		<?php foreach ($pages as $page): ?>
		<tr>
			<td><?= $page['id']; ?></td>
			<td><?= $page['title']; ?></td>
			<td><a href="/Lab8/page/<?= $page['id']; ?>/">ссылка на страницу</a></td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>