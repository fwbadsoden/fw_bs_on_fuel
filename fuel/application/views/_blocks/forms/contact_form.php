<form action="<?=is_object($form) ? $form->form_action : ''?>" method="POST">
{foreach $fields field }
<p class="label">{$field['label']}</p>
<p class="form">{$field['field']}</p>
{/foreach}
<p class="button"><input type="submit" name="sendeButton" value="<?=is_object($form) ? $form->submit_button_text : 'Formular senden'?>" class="submitButton" /></p>
</form>

