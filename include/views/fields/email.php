<?php
/**
 * @var $id
 * @var bool $required
 * @var bool $hidden
 */
?>
<div class="form-field form-field-text">
    <label for="<?= $id ?>-form-email"></label>
    <input id="<?= $id ?>-form-email" type="text" name="email"
        placeholder="<?= $required ? '* ' : '' ?>Ваш email"
        <?= $required ? 'required' : '' ?>
        <?= $hidden ? 'hidden' : '' ?>
    >
</div>
