<?php $form = $this->fuel->forms->get($form_name); ?>
<form action="<?=$form->form_action?>" method="POST">
{foreach $fields field }
<p class="label">{$field['label']}</p>
<p class="form">{$field['field']}</p>
{/foreach}
<p class="button"><input type="submit" name="sendeButton" value="<?=$form->submit_button_text?>" class="submitButton" /></p>