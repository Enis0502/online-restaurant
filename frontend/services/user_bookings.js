let UserBookingsService = {
  loadBookings: function () {
    const token = localStorage.getItem("user_token");
    if (!token) {
      console.warn("No user token found, cannot load bookings");
      return;
    }

    const payload = JSON.parse(atob(token.split(".")[1]));
    const userId = payload.user.id;

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "bookings/user/" + userId,
      type: "GET",
      dataType: "json",
      headers: {
        Authorization: "Bearer " + token,
      },
      success: function (result) {
        const tbody = $("#user-bookings-table tbody");
        tbody.empty();

        if (result && result.length > 0) {
          result.forEach((booking) => {
            const row = `
              <tr>
                <td>${booking.id}</td>
                <td>${booking.guest_number}</td>
                <td>${booking.date}</td>
                <td>${booking.user_id}</td>
                <td>
                  <button class="btn-edit" data-id="${booking.id}" 
                    style="border-radius: 24px; background-color: orange; color:white">
                    Edit
                  </button>
                </td>
              </tr>
            `;
            tbody.append(row);
          });

          // Add edit handler
          $(".btn-edit").on("click", function () {
            const bookingId = $(this).data("id");
            UserBookingsService.editBooking(bookingId);
          });
        } else {
          tbody.append(
            '<tr><td colspan="5" style="text-align:center">No bookings found</td></tr>'
          );
        }
      },
      error: function (xhr) {
        console.error("Failed to fetch bookings", xhr);
      },
    });
  },

  editBooking: function (bookingId) {
    const newGuestNumber = prompt("Enter new guest number:");
    if (!newGuestNumber) return;

    const newDate = prompt("Enter new date (YYYY-MM-DD HH:MM:SS):");
    if (!newDate) return;

    const token = localStorage.getItem("user_token");
    if (!token) return;

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "bookings/" + bookingId,
      type: "PUT",
      contentType: "application/json",
      data: JSON.stringify({
        guest_number: newGuestNumber,
        date: newDate,
      }),
      headers: {
        Authorization: "Bearer " + token,
      },
      success: function (result) {
        alert("Booking updated successfully");
        UserBookingsService.loadBookings(); // reload table
      },
      error: function (xhr) {
        console.error("Failed to update booking", xhr);
      },
    });
  },

  init: function () {
    UserBookingsService.loadBookings();
  },
};

$(document).ready(function () {
  UserBookingsService.init();
});
