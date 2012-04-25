<div class="buttonbar" id="action_btns">
	<ul>
		<?php if (isset($action) AND $action == 'edit') : ?>
			
			<?php if ($this->fuel->auth->module_has_action('save')) : ?>
				<li><a href="#" class="ico ico_save save" title="<?=$keyboard_shortcuts['save']?> to save"><?=lang('btn_save')?></a></li>
			<?php endif; ?>
			
			<?php if (!empty($this->preview_path) AND $this->fuel->auth->module_has_action('view')) : ?>
				<li><a href="<?=site_url($this->preview_path)?>" class="ico ico_view view_action" title="<?=$keyboard_shortcuts['view']?> to view"><?=lang('btn_view')?></a></li>
			<?php endif; ?>

			<?php if ($this->fuel->auth->module_has_action('publish') AND $this->fuel->auth->has_permission($this->permission, 'publish')) : ?>
				<?php if (!empty($publish)) : ?>
			<li><a href="#" class="ico ico_<?=strtolower($publish)?> <?=strtolower($publish)?>_action"><?=lang('btn_'.strtolower($publish))?></a></li>
				<?php endif; ?>
			<?php endif; ?>
			<?php if ($this->fuel->auth->module_has_action('activate') AND $this->fuel->auth->has_permission($this->permission, 'activate')) :  ?>
				<?php if (!empty($activate))  : ?>
			<li><a href="#" class="ico ico_<?=strtolower($activate)?> <?=strtolower($activate)?>_action"><?=lang('btn_'.strtolower($activate))?></a></li>
				<?php endif; ?>
			<?php endif; ?>

		
			<?php if ($this->fuel->auth->module_has_action('delete') AND $this->fuel->auth->has_permission($this->permission, 'delete')) : ?>
				<li><a href="<?=fuel_url($this->module_uri.'/delete/'.$id, TRUE)?>" class="ico ico_delete delete_action"><?=lang('btn_delete')?></a></li>
			<?php endif; ?>
			
			<?php if ($this->fuel->auth->module_has_action('duplicate')) : ?>
				<li><a href="<?=fuel_url($this->module_uri.'/create', TRUE)?>" class="ico ico_duplicate duplicate_action"><?=lang('btn_duplicate')?></a></li>
			<?php endif; ?>
			
			<?php if ($this->fuel->auth->module_has_action('replace') AND !empty($others) AND $this->fuel->auth->has_permission($this->permission, 'edit') AND $this->fuel->auth->has_permission($this->permission, 'delete')) : ?>
				<li><a href="<?=fuel_url($this->module_uri.'/replace/'.$id, TRUE)?>" class="ico ico_replace replace_action"><?=lang('btn_replace')?></a></li>
			<?php endif; ?>
			
			<?php if ($this->fuel->auth->module_has_action('others')) : ?>
			<?php foreach($this->item_actions['others'] as $other_action => $label) : 
				$ico_key = str_replace('/', '_', $other_action);
				$lang_key = url_title($label, 'underscore', TRUE);
				if ($new_label = lang('btn_'.$lang_key)) $label = $new_label;
			?>
				<li><?=anchor(fuel_url($other_action, TRUE), $label, array('class' => 'submit_action ico ico_'.$ico_key))?></li>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php if ($this->fuel->auth->module_has_action('create')) : ?>
				<li class="end"><a href="<?=fuel_url($this->module_uri.'/create', TRUE)?>" class="ico ico_create"><?=lang('btn_create')?></a></li>
			<?php endif; ?>
			
			
		<?php elseif ($action == 'create' AND $this->fuel->auth->module_has_action('save')) : ?>
			<li class="end"><a href="#" class="ico ico_save save" title="<?=$keyboard_shortcuts['save']?> to save"><?=lang('btn_save')?></a></li>
		<?php endif; ?>
	</ul>
	<?php if (!empty($others) AND !$this->fuel->admin->is_inline()) {?><div id="other_items"><?=$this->form->select('fuel_other_items', $others, '', '', lang('label_select_another'))?></div><?php } ?>
</div>

<?php if (isset($action) AND $action == 'edit') : ?>
<div id="filters">
	<?php if (!empty($versions)) : ?>
		<div class="versions"><?=$this->form->select('fuel_restore_version', $versions, '', '', lang('label_restore_from_prev'))?></div>
		<?=$this->form->hidden('fuel_restore_ref_id', $id)?>
	<?php endif; ?>
</div>
<?php endif; ?>
