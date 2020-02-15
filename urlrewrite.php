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
          'ID' => '',
          'PATH' => '/rooms/detail.php',
          'SORT' => 100,
      ),
  21 =>
      array (
          'CONDITION' => '#^/rooms/#',
          'RULE' => '',
          'ID' => '',
          'PATH' => '/rooms/index.php',
          'SORT' => 100,
      ),
  30 =>
      array (
          'CONDITION' => '#^/services/\\??(.*)/#',
          'RULE' => 'ELEMENT_CODE=$1',
          'ID' => '',
          'PATH' => '/services/detail.php',
          'SORT' => 100,
      ),
  31 =>
      array (
          'CONDITION' => '#^/services/#',
          'RULE' => '',
          'ID' => '',
          'PATH' => '/services/index.php',
          'SORT' => 100,
      ),
  1000 =>
  array (
    'CONDITION' => '#^/ajax/#',
    'RULE' => '/local/php_interface/ajax.php',
    'SORT' => 100,
  ),
);
