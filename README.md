# Not-app-plugin
Wordpress plugin for an app sends push notifications when a new post is published

# Instructions
- Compress the files into a .zip called 'sw.zip'.
- In your Wordpress site go to the plugins tab and install the 'sw.zip' file.
- Now go to the 'notifications plugin' tab and paste the API key that has been provided to you in the notifications site.
- Then you have to specify an endpoint for the notifications to go, otherwise the alerts of when a post is created won't work.
- If you want to notify your users when creating a post you'll have to add a custom field with the name 'send_notification' and send 'yes' as it's value.
- That's all, now your users should be able to suscribe and receive notifications as well as getting notified each time a new post is created.