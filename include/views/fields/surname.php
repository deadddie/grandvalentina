<?php
/**
 * @var $id
 * @var $required
 * @var $hidden
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
