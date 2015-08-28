<?php
    class MY_custom_fields {
        
        function tagsinput($params) {
            
            $form_builder =& $params['instance'];

            // normalize value to not have the #
            if (!empty($params['value']))
            {
                $params['value'] = trim($params['value'], '#');
            }
            
            $js = '<script type="text/javascript">
                    $(function() {   
                        var availableTags = new Array();';
            foreach($params["autosuggests"] as $key => $wert) : 
                $js.= "\navailableTags[".$key."] = '".$wert->value."';\n";
            endforeach; 
            
            $js.= 'function split( val ) {
			         return val.split( /,\s*/ );
		           }
		           function extractLast( term ) {
			         return split( term ).pop();
		           }

                   $( "#weitere_kraefte" ).bind( "keydown", function( event ) {
				        if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "ui-autocomplete" ).menu.active ) {
					       event.preventDefault();
				        }
                   })
			       .autocomplete({
				        minLength: 0,                
                        position: { my : "left top", at: "right top" },
				        source: function( request, response ) {
			            response( $.ui.autocomplete.filter(	availableTags, extractLast( request.term ) ) );
				        },
    				    focus: function() {	return false; },
    				    select: function( event, ui ) {
        					var terms = split( this.value );
        					terms.pop();
        					terms.push( ui.item.value );
        					terms.push( "" );
        					this.value = terms.join( ", " );
        					return false;
				        }
			         });     
                    });
                  </script>';

            $form_builder->add_js($js);
            $params['type'] = 'textarea';
            return $form_builder->create_textarea($params);

        }
    }
?>