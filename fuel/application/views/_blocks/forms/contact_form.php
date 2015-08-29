{foreach $fields field }
<p class="label">{$field['label']}</p>
<p class="form">{$field['field']}</p>
{/foreach}
<p class="button"><input type="submit" name="sendeButton" value="Formular Senden" class="submitButton" /></p>