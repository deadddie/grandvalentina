<?php
/**
 * @var $id
 * @var bool $required
 * @var bool $hidden
 */
?>
<div class="form-field form-field-text">
    <label for="<?= $id ?>-form-name"></label>
    <input id="<?= $id ?>-form-name" type="text" name="name"
        placeholder="<?= $required ? '* ' : '' ?>Ваше имя"
        <?= $required ? 'required' : '' ?>
        <?= $hidden ? 'hidden' : '' ?>
    >
</div>
