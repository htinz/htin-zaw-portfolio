$(document).ready(function () {
  $("#submit-form").click(function (e) {
    e.preventDefault(); // Prevent the default form submission
    var formData = $("#contact-form").serialize();
    $.ajax({
      type: "POST",
      url: "forms/contact.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status === "success") {
          $(".sent-message").html("Your message has been sent. Thank you!");
          $(".sent-message").fadeIn(2000);
          // Hide the message after one second
          setTimeout(function() {
            $(".sent-message").fadeOut(2000);
          }, 1000);
          // Clear the form after successful submission
          $("#contact-form")[0].reset();
        } else {
          $(".error-message").html("Error: " + response);
          $(".error-message").show();
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      },
    });
  });
});

