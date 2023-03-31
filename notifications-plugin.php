<?php
    /*
    Plugin Name: Notifications Plugin
    Description: Simple plugin made to connect with our aplication
    Author: PukaraIT
    Plugin URI: https://notification-app.dev.pukara.es/
    */
?>
<?php
    if ( ! defined ('ABSPATH') ) {
        die;
    }

    // adding subscription functionality
    add_action( 'wp_head', 'add_notifications' );
    function add_notifications() {
        if (!file_exists('sw.js')) {
            $rootUrl = 'sw.js';
            $source = 'wp-content/plugins/sw/sw.js';
            rename("$source", "$rootUrl");
        }

        $notification_input_field = get_option('notification_settings_input_field');
        $apiKey = isset($notification_input_field) ? $notification_input_field : 'bad';
        $notification_input_name_field = get_option('notification_settings_input_name_field');
        $title = isset($notification_input_name_field) ? $notification_input_name_field : 'bad';
        $apiKey = isset($notification_input_field) ? $notification_input_field : 'bad';
        $notification_input_subscription_endpoint_field = get_option('notification_settings_input_subscription_endpoint_field');
        $subscriptionEndpoint = isset($notification_input_subscription_endpoint_field) ? $notification_input_subscription_endpoint_field : 'bad';
        $apiKey = isset($notification_input_field) ? $notification_input_field : 'bad';
        $notification_input_resubscription_endpoint_field = get_option('notification_settings_input_resubscription_endpoint_field');
        $resubscriptionEndpoint = isset($notification_input_resubscription_endpoint_field) ? $notification_input_resubscription_endpoint_field : 'bad';
        ?>
        <script>
            var PUBLIC_KEY = "<?php echo $apiKey; ?>"
            var SITE = "<?php echo $title; ?>"
            var SUBENDPOINT = "<?php echo $subscriptionEndpoint; ?>"
            var RESUBENDPOINT = "<?php echo $resubscriptionEndpoint; ?>"
        </script>
        <script type="module" src="<?php echo plugin_dir_url( __FILE__ ) . 'enable-push.js'; ?>" defer></script>
<?php };
include 'settings.php';
include 'post-detect.php';
?>