<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="/Lab8/project/webroot/style.css">
		<title><?= $title ?></title>
	</head>
	<body>
		<header>
			хедер сайта
			<img src="/Lab8/project/webroot/hubble.jpg" alt="Телеском Хаббл" style="height: 200px; vertical-align: middle">
		</header>
		<div class="container">
			<aside class="sidebar left">
				левый сайдбар
			</aside>
			<main>
				<?= $content ?>
			</main>
			<aside class="sidebar right">
				правый сайдбар
			</aside>
		</div>
		<footer>
			футер сайта
		</footer>
	</body>
</html>