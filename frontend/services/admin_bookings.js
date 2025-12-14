let AdminBookingsService = {
  loadBookings: function () {
    const token = localStorage.getItem("user_token");
    console.log("Token:", token);

    if (!token) {
      console.warn("No user token found, cannot load bookings");
      return;
    }

    // Decode token to get user role
    const payload = JSON.parse(atob(token.split(".")[1]));
    console.log("Decoded payload:", payload);

    if (payload.user.role !== "admin") {
      console.error("User is not admin, stopping loadBookings");
      return;
    }

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "bookings", // backend route for all bookings
      type: "GET",
      dataType: "json",
      success: function (result) {
        console.log("Bookings fetched:", result);

        const tbody = $("#admin-bookings-table tbody");
        tbody.empty();

        if (result && result.length > 0) {
          result.forEach((booking) => {
            const row = `
              <tr data-id="${booking.id}">
                <td>${booking.id}</td>
                <td><input type="number" class="edit-guest-number" value="${
                  booking.guest_number
                }" /></td>
                <td><input type="datetime-local" class="edit-date" value="${AdminBookingsService.formatDateTimeLocal(
                  booking.date
                )}" /></td>
                <td>${booking.user_id}</td>
                <td>
                  <button class="update-booking-btn" style="border-radius: 24px; background-color: green; color:white; margin-bottom: 8px;">Save</button>
                  <button class="delete-booking-btn" style="border-radius: 24px; background-color: red; color:white">Delete</button>
                </td>
              </tr>
            `;
            tbody.append(row);
          });

          // Bind delete handlers
          $(".delete-booking-btn").on("click", function () {
            const bookingId = $(this).closest("tr").data("id");
            AdminBookingsService.deleteBooking(bookingId);
          });

          // Bind update handlers
          $(".update-booking-btn").on("click", function () {
            const row = $(this).closest("tr");
            const bookingId = row.data("id");
            const guest_number = row.find(".edit-guest-number").val();
            const date = row.find(".edit-date").val();

            AdminBookingsService.updateBooking(bookingId, guest_number, date);
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

  deleteBooking: function (bookingId) {
    const token = localStorage.getItem("user_token");
    if (!token) return;

    if (!confirm("Are you sure you want to delete this booking?")) return;

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "bookings/" + bookingId,
      type: "DELETE",
      success: function (result) {
        alert("Booking deleted successfully");
        AdminBookingsService.loadBookings();
      },
      error: function (xhr) {
        console.error("Failed to delete booking", xhr);
      },
    });
  },

  updateBooking: function (bookingId, guest_number, date) {
    const token = localStorage.getItem("user_token");
    if (!token) return;

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "bookings/" + bookingId,
      type: "PUT",
      contentType: "application/json",
      headers: {
        Authorization: "Bearer " + token,
      },
      data: JSON.stringify({ guest_number: guest_number, date: date }),
      success: function (result) {
        alert("Booking updated successfully");
        AdminBookingsService.loadBookings();
      },
      error: function (xhr) {
        console.error("Failed to update booking", xhr);
      },
    });
  },

  formatDateTimeLocal: function (dateTimeString) {
    // Convert "YYYY-MM-DD HH:MM:SS" -> "YYYY-MM-DDTHH:MM"
    return dateTimeString.replace(" ", "T").slice(0, 16);
  },

  init: function () {
    // Load immediately
    AdminBookingsService.loadBookings();

    // Reload if hash changes
    $(window).on("hashchange", function () {
      if (window.location.hash === "#adminBookings") {
        AdminBookingsService.loadBookings();
      }
    });
  },
};

// Initialize when document is ready
$(document).ready(function () {
  AdminBookingsService.init();
});
