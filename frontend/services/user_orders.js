let cart = []; // global cart array

function addToCart(button) {
  const box = $(button).closest(".box");
  const name = box.find(".food-name").text() || box.find("h5").text();
  const priceText = box.find(".food-price, h6").first().text();
  const price = parseFloat(priceText.replace("$", "")) || 0;

  const existingItem = cart.find((item) => item.name === name);
  if (existingItem) {
    existingItem.quantity += 1;
    existingItem.subtotal = existingItem.quantity * existingItem.price;
  } else {
    cart.push({ name, price, quantity: 1, subtotal: price });
  }

  renderCart();
}

function renderCart() {
  const tbody = $("#user-orders-table tbody");
  tbody.empty();
  let total = 0;

  cart.forEach((item, index) => {
    total += item.subtotal;
    const row = `
      <tr>
        <td>${item.name}</td>
        <td>$${item.price.toFixed(2)}</td>
        <td>
          <input type="number" value="${item.quantity}" min="1"
                 data-index="${index}" class="cart-qty">
        </td>
        <td>$${item.subtotal.toFixed(2)}</td>
        <td>
          <button class="btn-remove" data-index="${index}" 
          style="
                border-radius: 24px;
                color: white;
                background-color: red;
              ">Remove</button>
        </td>
      </tr>
    `;
    tbody.append(row);
  });

  $("#total-price").text("$" + total.toFixed(2));

  $(".cart-qty")
    .off()
    .on("input", function () {
      const idx = $(this).data("index");
      const val = parseInt($(this).val());
      if (val < 1) return;
      cart[idx].quantity = val;
      cart[idx].subtotal = val * cart[idx].price;
      renderCart();
    });

  $(".btn-remove")
    .off()
    .on("click", function () {
      const idx = $(this).data("index");
      cart.splice(idx, 1);
      renderCart();
    });
}

$(document).on("submit", "#user-order-form", function (e) {
  e.preventDefault();
  console.log("SUBMIT CLICKED");

  if (cart.length === 0) {
    alert("Cart is empty");
    return;
  }

  const token = localStorage.getItem("user_token");
  if (!token) {
    alert("Not logged in");
    return;
  }

  const payload = JSON.parse(atob(token.split(".")[1]));
  const userId = payload.user.id;

  const totalPrice = cart.reduce((sum, item) => sum + item.subtotal, 0);

  const now = new Date();
  const orderDate =
    now.getFullYear() +
    "-" +
    String(now.getMonth() + 1).padStart(2, "0") +
    "-" +
    String(now.getDate()).padStart(2, "0") +
    " " +
    String(now.getHours()).padStart(2, "0") +
    ":" +
    String(now.getMinutes()).padStart(2, "0") +
    ":" +
    String(now.getSeconds()).padStart(2, "0");

  const payloadData = {
    user_id: userId,
    total_price: totalPrice,
    status: "pending",
    order_date: orderDate,
  };

  console.log("Sending order:", payloadData);

  $.ajax({
    url: Constants.PROJECT_BASE_URL + "orders",
    type: "POST",
    headers: {
      Authorization: "Bearer " + token,
    },
    contentType: "application/json",
    data: JSON.stringify(payloadData),
    success: function () {
      alert("Order submitted successfully!");
      cart = [];
      renderCart();
    },
    error: function (xhr) {
      console.error("ORDER ERROR:", xhr.responseText);
      alert("Submit failed");
    },
  });
});
