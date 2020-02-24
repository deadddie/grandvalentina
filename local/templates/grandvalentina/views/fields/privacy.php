<?php
/**
 * @var $id
 * @var bool $required
 * @var bool $hidden
 */

use LapkinLab\Core;

?>
<div class="form-field form-privacy">
    <input id="<?= $id ?>-form-privacy" type="checkbox" name="privacy" checked
        <?= $required ? 'required' : '' ?>
        <?= $hidden ? 'hidden' : '' ?>
    >
    <label for="<?= $id ?>-form-privacy">
        <span>Согласен на <?= Core::getPrivacyLink('/privacy/policy/', 'хранение и обработку моих персональных данных') ?></span>
        <?= renderIcon('check') ?>
    </label>
</div>
