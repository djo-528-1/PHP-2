<?php
	use \Core\Route;
	
	return [
		new Route('/hello/', 'hello', 'index'), // роут для приветственной страницы, можно удалить

		new Route('/test/act1/', 'test', 'act1'),
		new Route('/test/act2/', 'test', 'act2'),
		new Route('/test/act3/', 'test', 'act3'),

		new Route('/num/:n1/:n2/:n3/', 'num', 'sum'),

		new Route('/user/all/', 'user', 'all'),
		new Route('/user/first/:n/', 'user', 'first'),
		new Route('/user/:id/', 'user', 'show'),
		new Route('/user/:id/:key/', 'user', 'info'),

		new Route('/page/:id/', 'page', 'one'),
		new Route('/page/', 'page', 'all'),

		new Route('/product/', 'product', 'all'),
		new Route('/product/:id/', 'product', 'one'),
	];
