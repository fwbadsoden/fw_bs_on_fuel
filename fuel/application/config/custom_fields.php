<?php 
/*
|--------------------------------------------------------------------------
| Form builder 
|--------------------------------------------------------------------------
|
| Specify field types and other Form_builder configuration properties
| This file is included by the fuel/modules/fuel/config/form_builder.php file
*/
$fields['tagsinput'] = array(
                                'class'     => 'MY_custom_fields',
                                'function'  => 'tagsinput',
                                //'css'       => 'colorpicker/colorpicker',
                                //'js'        => array(
                                //    'colorpicker/colorpicker',
                                //    'colorpicker/eye',
                                //    'colorpicker/utils'
                                //),
                                //'represents' => array('name' => 'color')
                            );
$fields['photographer_input'] = array(
                                'class'     => 'MY_custom_fields',
                                'function'  => 'photographer_input',
                            );

include(FUEL_PATH.'config/custom_fields.php');

/* End of file form_builder.php */
/* Location: ./application/config/form_builder.php */