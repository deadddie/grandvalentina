<?php
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
$APPLICATION->SetPageProperty('title', 'Пользовательское соглашение');
$APPLICATION->SetTitle('Пользовательское соглашение');
?>
<div class="page-privacy">
    <div class="container">
        <div class="row">
            <h1 class="page-title col-12 text-center h2"><?= $APPLICATION->GetTitle() ?></h1>
            <div class="col-12">
                <div class="page-privacy--content">
                    <p>Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. В то время
                        некий безымянный печатник создал большую коллекцию размеров и форм шрифтов, используя Lorem
                        Ipsum для распечатки образцов. Lorem Ipsum не только успешно пережил без заметных изменений пять
                        веков, но и перешагнул в электронный дизайн. Его популяризации в новое время послужили
                        публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и, в более недавнее время,
                        программы электронной вёрстки типа Aldus PageMaker, в шаблонах которых используется Lorem
                        Ipsum.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>
