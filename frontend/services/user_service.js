let UserService = {
  init: function () {
    $("#login-form").validate({
      rules: {
        name: "required",
        
      }
    })
    // Check if user is already logged in
    var token = localStorage.getItem("user_token");
    if (token && token !== undefined) {
      window.location.hash = "#home";
      return;
    }

    $("#login-form").validate({
      submitHandler: function (form, event) {
        event.preventDefault();
        let entity = Object.fromEntries(new FormData(form).entries());
        UserService.login(entity);
      },
    });

    $("#signin-form").on("submit", function (event) {
      event.preventDefault();
      let entity = Object.fromEntries(new FormData(this).entries());
      UserService.register(entity);
    });
  },

  login: function (entity) {
    console.log("LOGIN CALLED", entity);

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/login",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        console.log("LOGIN SUCCESS", result);
        alert("Successfull login");
        localStorage.setItem("user_token", result.data.token);
        UserService.renderAuthUI();
        window.location.hash = "#home";
      },
      error: function (xhr) {
        console.error("LOGIN FAILED", xhr.responseText);
      },
    });
  },

  register: function (entity) {
    console.log("REGISTER CALLED", entity);
    entity.role = "customer";

    $.ajax({
      url: Constants.PROJECT_BASE_URL + "auth/register",
      type: "POST",
      data: JSON.stringify(entity),
      contentType: "application/json",
      dataType: "json",
      success: function (result) {
        console.log("REGISTER SUCCESS", result);
        alert("Registration successful. You can now log in.");

        // Clear form
        $("#signin-form")[0].reset();

        // Switch back to login form
        showLogIn();
      },
      error: function (xhr) {
        console.error("REGISTER FAILED", xhr.responseText);
        alert("Registration failed.");
      },
    });
  },

  renderAuthUI: function () {
    const token = localStorage.getItem("user_token");

    if (token) {
      const payload = JSON.parse(atob(token.split(".")[1]));
      const role = payload.user.role; // Get the user's role from token

      // Hide login button
      $("#login-btn").hide();

      // Add logout button if not already present
      if ($("#logout-btn").length === 0) {
        $("#nav-auth").append(`
        <button id="logout-btn" class="order_online" style="margin-right: 10%;">
          Logout
        </button>
      `);

        $("#logout-btn").on("click", function () {
          UserService.logout();
        });
      }

      // Add navigation link depending on role
      if ($("#nav-logged-item").length === 0) {
        if (role === "admin") {
          $(".navbar-nav.mx-auto").append(`
          <li class="nav-item" id="nav-logged-item">
            <a class="nav-link" href="#dashboard">Dashboard</a>
          </li>
        `);
        } else {
          $(".navbar-nav.mx-auto").append(`
          <li class="nav-item" id="nav-logged-item">
            <a class="nav-link" href="#userOrders">My orders/bookings</a>
          </li>
        `);
        }
      }
    } else {
      // No token → show login button, remove logout
      $("#login-btn").show();
      $("#logout-btn").remove();
      $("#nav-logged-item").remove();
    }
  },

  logout: function () {
    localStorage.removeItem("user_token");
    window.location.hash = "#login";
    location.reload();
  },
};

$(document).ready(function () {
  UserService.init();
  UserService.renderAuthUI();
});
