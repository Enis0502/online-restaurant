$(document).ready(function () {
  $("#booking-form").on("submit", function (e) {
    e.preventDefault();

    const token = localStorage.getItem("user_token");
    if (!token) {
      alert("You must be logged in to make a booking.");
      return;
    }

    // Decode token to get user ID
    const payload = JSON.parse(atob(token.split(".")[1]));
    const userId = payload.user.id;

    // Collect form values
    const guestNumber = parseInt($("#booking-form select").val());
    const dateValue = $("#booking-form input[type='date']").val();

    if (!guestNumber || !dateValue) {
      alert("Please fill all required fields.");
      return;
    }

    const bookingData = {
      user_id: userId,
      guest_number: guestNumber,
      date: dateValue + "T00:00:00", // ensure correct date format
    };

    // AJAX request to create booking
    $.ajax({
      url: Constants.PROJECT_BASE_URL + "bookings",
      type: "POST",
      contentType: "application/json",
      headers: {
        Authorization: "Bearer " + token,
      },
      data: JSON.stringify(bookingData),
      success: function (response) {
        alert("Booking created successfully!");
        // Optionally clear form
        $("#booking-form")[0].reset();
      },
      error: function (xhr) {
        console.error("Failed to create booking", xhr.responseText);
        alert("Failed to create booking. Please check your data.");
      },
    });
  });
});
