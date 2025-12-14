let AdminOrdersService = {
  loadOrders: function () {
    const token = localStorage.getItem("user_token");
    if (!token) return;

    // Decode token to check role
    const payload = JSON.parse(atob(token.split(".")[1]));
    if (payload.user.role !== "admin") return; // only admin can view

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "orders",
      type: "GET",
      headers: {
        Authorization: "Bearer " + token,
      },
      success: function (result) {
        const tbody = $("#admin-orders-table tbody");
        tbody.empty();

        if (result && result.length > 0) {
          result.forEach((order) => {
            const row = `
              <tr>
                <td>${order.id}</td>
                <td>${order.order_date}</td>
                <td>$${parseFloat(order.total_price).toFixed(2)}</td>
                <td>${order.status}</td>
                <td>${order.user_id}</td>
              </tr>
            `;
            tbody.append(row);
          });
        } else {
          tbody.append(
            '<tr><td colspan="5" style="text-align:center">No orders found</td></tr>'
          );
        }
      },
      error: function (xhr) {
        console.error("Failed to fetch orders", xhr);
      },
    });
  },

  init: function () {
    this.loadOrders();
  },
};

$(document).ready(function () {
  AdminOrdersService.init();
});