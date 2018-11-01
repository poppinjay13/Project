function notifyMe(alertmsg) {
  var alertmsg = alertmsg;
//check if the browser supports notifications
  if (!("Notification" in window)) {
    alert("Unfortunately, this browser does not support desktop notifications.");
  }
  //check whether notification permissions have already been granted
  else if (Notification.permission === "granted") {
    // If it's okay let's create a notification
    new Notification(alertmsg);
  }
  //ask the user for permission
  else if (Notification.permission !== "denied") {
    Notification.requestPermission().then(function (permission) {
      // If the user accepts, recurse
      if (permission === "granted") {
        notifyMe(alertmsg);
      }
    });
  }
//if the user has denied notification access, no notification.
}
