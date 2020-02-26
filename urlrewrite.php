<?php
$arUrlRewrite=array (
  5 =>
        array (
            'CONDITION' => '#^/offers/archive/#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/offers/archive.php',
            'SORT' => 100,
        ),
  7 =>
      array (
          'CONDITION' => '#^/(rooms|services|blog|events|restaurants|entertainment|offers)/\\??(.*)/#',
          'RULE' => 'ELEMENT_CODE=$2',
          'ID' => '',
          'PATH' => '/$1/detail.php',
          'SORT' => 100,
      ),
  10 =>
      array (
          'CONDITION' => '#^/(rooms|services|blog|events|restaurants|entertainment|offers)/#',
          'RULE' => '',
          'ID' => '',
          'PATH' => '/$1/index.php',
          'SORT' => 100,
      ),
  99 =>
  array (
    'CONDITION' => '#^/ajax/#',
    'RULE' => '/local/php_interface/ajax.php',
    'SORT' => 100,
  ),
);
