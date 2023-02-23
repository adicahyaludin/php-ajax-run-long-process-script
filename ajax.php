<?php

try {

    $response = array();
    $form_data = $_GET;
    $is_valid = 1;

    if ( $is_valid ) :
    
        $total_rows = 300;		

        $current_row = $form_data['current_row'];
        $current_row++;

        $form_data['current_row'] = $current_row;

        if ( $current_row > $total_rows ) : 

            $response['result'] = 'COMPLETE'; 

        else:

            $response['result'] = 'NEXT';
            $response['form_data'] = json_encode($form_data);

        endif;
        
    else:
            
        $response['result'] = 'FAIL';

    endif;

} catch (Exception $e) {

    $response['result'] = 'FAIL';

}

$json = json_encode($response);
echo $json;
exit;