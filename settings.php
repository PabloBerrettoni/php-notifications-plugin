<?php 
// adding tab in the admin dashboard
function notifications_plugin() {
    add_menu_page(
        __('Notifications Plugin', 'notifications-plugin'),
        __('Notifications Plugin', 'notifications-plugin'),
        'manage_options',
        'notifications-settings-page',
        'notifications_settings_template_callback',
        '',
        null
    );
}
add_action('admin_menu', 'notifications_plugin');

// template
function notifications_settings_template_callback() {
    ?>
    <div class="wrap">
        <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
        <form action="options.php" method="post">
            <?php
                settings_fields('notifications-settings-page');
                do_settings_sections('notifications-settings-page');
                submit_button('Save settings.')
            ?>
        </form>
    </div>
    <?php
}
// adding settings
function notifications_settings_init() {
    // starting custom tab
    add_settings_section(
        'notification_settings_section',
        'Notification Plugin Settings',
        '',
        'notifications-settings-page'
    );
    // registering and adding name field
    register_setting(
        'notifications-settings-page',
        'notification_settings_input_name_field',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );
    add_settings_field(
        'notification_settings_input_name_field',
        __('Title', 'notifications-plugin'),
        'notifications_settings_input_name_field_callback',
        'notifications-settings-page',
        'notification_settings_section'
    );
    // registering and adding api key field
    register_setting(
        'notifications-settings-page',
        'notification_settings_input_field',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );
    add_settings_field(
        'notification_settings_input_field',
        __('Api Key', 'notifications-plugin'),
        'notifications_settings_input_field_callback',
        'notifications-settings-page',
        'notification_settings_section'
    );
    // registering and adding api key field
    register_setting(
        'notifications-settings-page',
        'notification_settings_input_endpoint_field',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );
    add_settings_field(
        'notification_settings_input_endpoint_field',
        __('Webhook Endpoint', 'notifications-plugin'),
        'notifications_settings_input_endpoint_field_callback',
        'notifications-settings-page',
        'notification_settings_section'
    );
    // registering and adding subscription endpoint field
    register_setting(
        'notifications-settings-page',
        'notification_settings_input_subscription_endpoint_field',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );
    add_settings_field(
        'notification_settings_input_subscription_endpoint_field',
        __('Subscription Endpoint', 'notifications-plugin'),
        'notifications_settings_input_subscriptionEndpoint_field_callback',
        'notifications-settings-page',
        'notification_settings_section'
    );
    // registering and adding subscription endpoint field
    register_setting(
        'notifications-settings-page',
        'notification_settings_input_resubscription_endpoint_field',
        array(
            'type' => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default' => ''
        )
    );
    add_settings_field(
        'notification_settings_input_resubscription_endpoint_field',
        __('Re-Subscription Endpoint', 'notifications-plugin'),
        'notifications_settings_input_resubscriptionEndpoint_field_callback',
        'notifications-settings-page',
        'notification_settings_section'
    );
}
add_action('admin_init', 'notifications_settings_init');
// including inputs in the settings tab
function notifications_settings_input_field_callback() {
    $notification_input_field = get_option('notification_settings_input_field');
    ?>
    <input name="notification_settings_input_field" type="text" class="regular-text" value="<?php echo isset($notification_input_field) ? esc_attr($notification_input_field) : ''; ?>" />
    <?php
}
function notifications_settings_input_name_field_callback() {
    $notification_input_name_field = get_option('notification_settings_input_name_field');
    ?>
    <input name="notification_settings_input_name_field" type="text" class="regular-text" value="<?php echo isset($notification_input_name_field) ? esc_attr($notification_input_name_field) : ''; ?>" />
    <?php
}
function notifications_settings_input_endpoint_field_callback() {
    $notification_input_endpoint_field = get_option('notification_settings_input_endpoint_field');
    ?>
    <input name="notification_settings_input_endpoint_field" type="text" class="regular-text" value="<?php echo isset($notification_input_endpoint_field) ? esc_attr($notification_input_endpoint_field) : ''; ?>" />
    <?php
}
function notifications_settings_input_subscriptionEndpoint_field_callback() {
    $notification_input_subscription_endpoint_field = get_option('notification_settings_input_subscription_endpoint_field');
    ?>
    <input name="notification_settings_input_subscription_endpoint_field" type="text" class="regular-text" value="<?php echo isset($notification_input_subscription_endpoint_field) ? esc_attr($notification_input_subscription_endpoint_field) : ''; ?>" />
    <?php
}
function notifications_settings_input_resubscriptionEndpoint_field_callback() {
    $notification_input_resubscription_endpoint_field = get_option('notification_settings_input_resubscription_endpoint_field');
    ?>
    <input name="notification_settings_input_resubscription_endpoint_field" type="text" class="regular-text" value="<?php echo isset($notification_input_resubscription_endpoint_field) ? esc_attr($notification_input_resubscription_endpoint_field) : ''; ?>" />
    <?php
}
?>