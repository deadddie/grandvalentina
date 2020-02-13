<?php
/**
 * @var $id
 * @var bool $required
 * @var bool $hidden
 */
?>
<div class="form-field form-field-text">
    <label for="<?= $id ?>-form-surname"></label>
    <input id="<?= $id ?>-form-surname" type="text" name="surname"
        placeholder="<?= $required ? '* ' : '' ?>Ваша фамилия"
        <?= $required ? 'required' : '' ?>
        <?= $hidden ? 'hidden' : '' ?>
    >
</div>
