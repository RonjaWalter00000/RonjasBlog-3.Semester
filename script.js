function sendMessage() {
  var name = $("#message_name").val();
  var email = $("#message_email").val();
  var message = $("#message_text").val();

  $.ajax({
    url: "http://localhost:8888/RonjasBlog/services/contactService.php",
    method: "POST",
    data: {
      name: name,
      email: email,
      message: message
    },
    success: function(data) {
      data = JSON.parse(data);
      if (data.success) {
        $(".contact.success").fadeIn();
        setTimeout(function() {
          $(".contact.success").fadeOut();
        }, 3000);
      } else {
        $(".contact.error").fadeIn();
        setTimeout(function() {
          $(".contact.error").fadeOut();
        }, 3000);
      }
    }
  });

  return false;
}
