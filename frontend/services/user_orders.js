let UserOrdersService = {
  loadOrders: function () {
    const token = localStorage.getItem("user_token");
    if (!token) {
      console.warn("No user token found, cannot load orders");
      return;
    }

    // Decode token to get user_id
    const payload = JSON.parse(atob(token.split(".")[1]));
    const userId = payload.user.id;

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "orders/user/" + userId,
      type: "GET",
      dataType: "json",
      headers: {
        Authorization: "Bearer " + token,
      },
      success: function (result) {
        const tbody = $("#user-orders-table tbody");
        tbody.empty();

        if (result && result.length > 0) {
          result.forEach((order) => {
            const row = `
              <tr>
                <td>${order.id}</td>
                <td>${order.order_date}</td>
                <td>$${parseFloat(order.total_price).toFixed(2)}</td>
                <td>${order.status}</td>
              </tr>
            `;
            tbody.append(row);
          });
        } else {
          tbody.append(
            '<tr><td colspan="4" style="text-align:center">No orders found</td></tr>'
          );
        }
      },
      error: function (xhr) {
        console.error("Failed to fetch orders", xhr);
      },
    });
  },

  init: function () {
    // Load immediately
    UserOrdersService.loadOrders();
  },
};

$(document).ready(function () {
  UserOrdersService.init();
});
