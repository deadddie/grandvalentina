<?php
/**
 * @var $id
 * @var bool $required
 * @var bool $hidden
 */
?>
<div class="form-field form-field-text">
    <label for="<?= $id ?>-form-phone"></label>
    <input id="<?= $id ?>-form-phone" type="tel" name="phone"
        placeholder="<?= $required ? '* ' : '' ?>Ваш телефон"
        <?= $required ? 'required' : '' ?>
        <?= $hidden ? 'hidden' : '' ?>
    >
</div>
