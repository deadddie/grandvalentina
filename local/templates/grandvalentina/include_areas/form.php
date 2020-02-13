<?php

/**
 * Default form.
 *
 * @var $id
 * @var $title
 * @var $description
 * @var $submit_button
 * @var $fields
 * @var $required
 * @var $wrapper
 */

use Bitrix\Main\Security\Random;

$form_id = $id . '-form-' . Random::getString(32);
?>
<!--<?= $form_id ?>-->
<form class="form--form" id="<?= $form_id ?>">
    <?= bitrix_sessid_post() ?>
    <input type="hidden" name="id" value="<?= $id ?>">
    <input type="hidden" name="required" value="<?= base64_encode(implode(',', $required)) ?>">
    <input type="hidden" name="url" value="https://<?= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>">
    <?php if ($wrapper): ?><div class="form--wrapper"><?php endif; ?>
        <h2 class="form--title text-center"><?= $title ?></h2>
        <div class="form--description text-center"><?= $description ?></div>
        <div class="form--fields">
            <?php foreach ($fields as $field) {
                $field_params = [
                    'id' => $id,
                    'required' => in_array($field, $required, true),
                ];
                print view('fields.' . $field, $field_params, false);
            } ?>
        </div>
        <div class="form--actions">
            <div class="form-action">
                <button class="button btn btn-wide js-send-form" type="submit"><?= $submit_button ?></button>
            </div>
        </div>
    <?php if ($wrapper): ?></div><?php endif; ?>
</form>
