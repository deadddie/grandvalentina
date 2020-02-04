<?php
$arUrlRewrite=array (
	1 => 
		array (
			'CONDITION' => '#^/news/#',
			'RULE' => '',
			'ID' => 'bitrix:news',
			'PATH' => '/news/index.php',
			'SORT' => 100,
		),
    100 =>
        array(
            'CONDITION' => '#^/ajax/#',
            'RULE'      => '/local/php_interface/ajax.php',
            'SORT'      => 100,
        ),
);
