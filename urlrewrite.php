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
  20 =>
      array (
          'CONDITION' => '#^/rooms/\\??(.*)/#',
          'RULE' => 'ELEMENT_CODE=$1',
          'ID' => 'bitrix:news',
          'PATH' => '/rooms/detail.php',
          'SORT' => 100,
      ),
  21 =>
      array (
          'CONDITION' => '#^/rooms/#',
          'RULE' => '',
          'ID' => 'bitrix:news',
          'PATH' => '/rooms/index.php',
          'SORT' => 100,
      ),
  100 =>
  array (
    'CONDITION' => '#^/ajax/#',
    'RULE' => '/local/php_interface/ajax.php',
    'SORT' => 100,
  ),
);
