<?php

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) {
    die();
}

//delayed function must return a string
if (empty($arResult)) return '';

$strReturn = '';
$strReturn .= '<!--breadcrumb--><nav aria-label="breadcrumb" class="breadcrumb--wrapper"><div class="container"><div class="row"><ul class="breadcrumb col-12" itemprop="http://schema.org/breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for ($index = 0; $index < $itemSize; $index++) {
	$title = htmlspecialcharsex($arResult[$index]['TITLE']);

	if ($arResult[$index]['LINK'] <> '' && $index != $itemSize - 1) {
		$strReturn .= '
			<li class="breadcrumb-item" id="bx_breadcrumb_'.$index.'" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
				<a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item"><span itemprop="name">'.$title.'</span></a>
				<meta itemprop="position" content="'.($index + 1).'">
			</li>';
	} else {
		$strReturn .= '<li class="breadcrumb-item"><span>'.$title.'</span></li>';
	}
}

$strReturn .= '</ul></div></div></nav><!--/breadcrumb-->';

return $strReturn;
