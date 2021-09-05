<?php

function sc_api_call( $new_status, $old_status, $post ) {

    global $post;
    $prefix                         = SC_META_PREFIX;
    $sc_setting                     = get_option('sc_setting');
    $other_store_api_url            = !empty($sc_setting['other_store_api_url'])?$sc_setting['other_store_api_url']:'';
    $other_store_consumer_key       = !empty($sc_setting['other_store_consumer_key'])?$sc_setting['other_store_consumer_key']:'';
    $other_store_consumer_secret    = !empty($sc_setting['other_store_consumer_secret'])?$sc_setting['other_store_consumer_secret']:'';

    if( $other_store_api_url=='' || $other_store_consumer_key=='' || $other_store_consumer_secret=='' ){
        return;
    }

    if ( 'product' !== $post->post_type ) {
        return;
    }

    if ( 'publish' !== $new_status ) {
        return;
    }

   
    if ( 'publish' === $old_status ) {

        $post_id            = get_post_meta( $post->ID , $prefix.'other_store_linked_id', true );
        $update_url         = $other_store_api_url.'/'.$post_id;
        $price              = get_post_meta( $post->ID, '_regular_price', true);
        
        $api_response = wp_remote_post( $update_url , array(
            'method'    => 'PUT',
            'headers' => array(
                'Authorization' => 'Basic '. base64_encode( $other_store_consumer_key.':'.$other_store_consumer_secret )    
            ),
            'body' => array(
                    'name'          => $post->post_title, 
                    'regular_price' => $price, 
            )
        ) );

        $body = json_decode( $api_response['body'] );
       
    } else {

        $post_title     = $post->post_title;
        $price          = !empty($_POST['_regular_price'])?$_POST['_regular_price']:'';
        $api_response   = wp_remote_post( $other_store_api_url, array(
                                                'headers' => array(
                                                    'Authorization' => 'Basic '. base64_encode( $other_store_consumer_key.':'.$other_store_consumer_secret )    
                                                ),
                                                'body' => array(
                                                    'name'          => $post->post_title, 
                                                    'status'        => 'publish', 
                                                    'regular_price' => $price, 
                                                )
                                            ) );

        $body = json_decode( $api_response['body'] );
        if( !empty($body->id) ){
            update_post_meta( $post->ID, $prefix.'other_store_linked_id', $body->id );
        }

    }
}

add_action( 'transition_post_status', 'sc_api_call', 10, 3 );




