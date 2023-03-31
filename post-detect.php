<?php
// posting information once a post is created
add_action('save_post', 'run_when_post_published', 100, 3);
function run_when_post_published($post_ID, $post, $update){
    if ( did_action('save_post') > 1 ) return;

    if( strpos( wp_get_raw_referer(), 'post-new' ) > 0 && $post->post_status != 'draft' && $update){
        $getCustomField = get_post_custom_values('send_notification', $post_ID);
        if ($getCustomField[0] == 'yes') {

            // getting the keys
            $notification_input_field = get_option('notification_settings_input_field');
            $notification_input_name_field = get_option('notification_settings_input_name_field');
            $apiValue = 'default';
            $nameValue = 'default';
            if (isset($notification_input_field)) {
                $apiValue = $notification_input_field;
            } else {
                $apiValue = 'bad';
            };
            if (isset($notification_input_name_field)) {
                $nameValue = $notification_input_name_field;
            } else {
                $nameValue = 'bad';
            };

            // setting aditional headers
            $additional_headers = array(
                "apiKey: $apiValue"
            );
            // getting the post information
            $postId = isset( $post->ID ) ? $post->ID : 'badId';
            $size = 'post-thumbnail';
            $postTitle = isset( $post->post_title ) ? $post->post_title : 'badTitle';
            $postName = isset( $post->post_name ) ? get_site_url() . '/' . $post->post_name : 'badName';
            $image_id = get_post_thumbnail_id($post_ID);
            $image = wp_get_attachment_image_url($image_id, 'thumbnail');

            // setting post fields
            $post = [
                'title' => $nameValue,
                'body' => $postTitle,
                'tag' => $postId,
                'url' => $postName,
                'icon' => $image,
            ];
            // getting the endpoint
            $notification_input_endpoint_field = get_option('notification_settings_input_endpoint_field');
            $endpoint = isset($notification_input_endpoint_field) ? esc_attr($notification_input_endpoint_field) : '';
            // initializing the request
            $ch = curl_init("$endpoint");
            curl_setopt($ch, CURLOPT_HTTPHEADER, $additional_headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // execute!
            $response = curl_exec($ch);
            // close the connection, release resources used
            curl_close($ch);

        };
	};
};

?>