<?php 
    include("_header.php"); 

$param = uri_segment(3);

// check if there is a uri segment
if ($param)
{
	// if the uri segment is numeric, then search by key
	if (is_numeric($param))
	{
		$item = fuel_model("fahrzeuge", array('find' => 'key', 'where' => $param));
	}
	elseif($param="ausserdienst")
	{
		$data_where = array("retired" => "yes");
		$data = fuel_model("fahrzeuge", array('find' => 'all', 'where' => $data_where));
	}
	
	// if no item is found, then do a redirect or 404 if no redirect exists
	if (empty($item) && empty($data))
	{
		redirect_404();
	}
}
else
{
	// if no uri segment, then we do a query on the model to get a list of data
	if (empty($list_where))
	{
		$list_where = array();
	}
		$list_where = array("retired" => "no");
	$data = fuel_model("fahrzeuge", array('find' => 'all', 'where' => $list_where));
}
?>

<?php if (!empty($item)) : ?>

	<?=fuel_block(array('view' => "fahrzeuge_detail", 'data' => $item));  ?>

<?php else: ?>
	
	<?=fuel_block(array('view' => "fahrzeuge_uebersicht", 'data' => $data)); ?>

<?php 
    endif; 

    include("_footer.php");
?>