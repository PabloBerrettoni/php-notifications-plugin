let n;
self.addEventListener("push", function (i) { 
    if (!(self.Notification && self.Notification.permission === "granted")) { 
        console.log("Notifications aren't supported or permission not granted!"); 
        return 
    } 
    if (i.data) { 
        var t = i.data.json(); 
        return i.waitUntil(self.registration.showNotification(t.title, { body: t.body, icon: t.icon, actions: t.actions, tag: t.tag })), n = t.data.url 
    } 
}); 
self.addEventListener("notificationclick", function (i) { 
    return i.notification.close(), clients.openWindow(n) 
});
