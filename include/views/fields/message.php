<?php
/**
 * @var $id
 * @var bool $required
 * @var bool $hidden
 */
?>
<div class="form-field form-field-textarea" <?= $hidden ? 'hidden' : '' ?>>
    <label for="<?= $id ?>-form-message"></label>
    <textarea id="<?= $id ?>-form-message" name="message"
        placeholder="<?= $required ? '* ' : '' ?>Напишите ваше сообщение"
        <?= $required ? 'required' : '' ?>
        <?= $hidden ? 'hidden' : '' ?>
    ></textarea>
</div>
