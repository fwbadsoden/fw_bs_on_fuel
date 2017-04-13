<div id="fuel_main_content_inner">
	<p class="instructions"><?=lang('tester_instructions')?></p>

	<?=$form?>

	<div class="clear"></div>
	
	<div style="text-align: center; margin: 0 0 30px 328px;" class="buttonbar">
		<ul>
			<li class="unattached"><a href="#" class="ico ico_tools_tester" id="run_tests"><?=lang('btn_run_tests')?></a></li>
		</ul>
	</div>

	<script type="text/javascript">
	//<![CDATA[
		$(function(){
			// $('#tests').supercomboselect();
			$('#run_tests').click(function(){
				$('.csadd').click();
				$('#form').submit();
				return false;
			});
		})
	//]]>
	</script>
</div>