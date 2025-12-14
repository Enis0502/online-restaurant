let AdminUsersService = {
  loadUsers: function () {
    const token = localStorage.getItem("user_token");
    if (!token) return;

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "users",
      type: "GET",
      headers: {
        Authorization: "Bearer " + token,
      },
      success: function (result) {
        const tbody = $("#admin-users-table tbody");
        tbody.empty();

        if (result && result.length > 0) {
          result.forEach((user) => {
            const row = `
              <tr>
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${user.phone}</td>
                <td>${user.role}</td>
                <td>
                  <button class="delete-user-btn" data-id="${user.id}" style="border-radius: 24px; background-color: red; color:white">Delete</button>
                </td>
              </tr>
            `;
            tbody.append(row);
          });

          // <-- Attach the click handler for the delete buttons here
          $(".delete-user-btn").on("click", function () {
            const userId = $(this).data("id");

            if (!confirm("Are you sure you want to delete this user?")) return;

            $.ajax({
              url: Constants.PROJECT_BASE_URL + "users/" + userId,
              type: "DELETE",
              headers: {
                Authorization: "Bearer " + token,
              },
              success: function () {
                alert("User deleted successfully");
                AdminUsersService.loadUsers(); // Reload the table
              },
              error: function (xhr) {
                console.error("Failed to delete user", xhr);
                alert("Failed to delete user");
              },
            });
          });
        } else {
          tbody.append(
            '<tr><td colspan="6" style="text-align:center">No users found</td></tr>'
          );
        }
      },
      error: function (xhr) {
        console.error("Failed to fetch users", xhr);
      },
    });
  },

  init: function () {
    this.loadUsers();
  },
};

$(document).ready(function () {
  AdminUsersService.init();
});
