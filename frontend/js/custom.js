// to get current year
function getYear() {
  var currentDate = new Date();
  var currentYear = currentDate.getFullYear();
  document.querySelector("#displayYear").innerHTML = currentYear;
}

getYear();

// isotope js
// $(window).on("load", function () {
//   $(".filters_menu li").click(function () {
//     $(".filters_menu li").removeClass("active");
//     $(this).addClass("active");

//     var data = $(this).attr("data-filter");
//     $grid.isotope({
//       filter: data,
//     });
//   });

//   var $grid = $(".grid").isotope({
//     itemSelector: ".all",
//     percentPosition: false,
//     masonry: {
//       columnWidth: ".all",
//     },
//   });
// });

let active = true;
function showAllElements() {
  const foods = document.querySelectorAll(".foods");
  foods.forEach((food) => {
    food.style.display = active ? "none" : "block";
  });
  active = !active;
}

function showSelected() {
  const foods = document.querySelectorAll(".pizza");
  foods.forEach((food) => {
    food.style.display = active ? "none" : "block";
  });
  active = !active;
}

function filterFoods(category) {
  const foods = document.querySelectorAll(".foods");
  const buttons = document.querySelectorAll(".button");

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      buttons.forEach((btn) => {
        btn.classList.remove("active");
        button.classList.add("active");
      });
    });
  });

  foods.forEach((food) => {
    if (category === "all") {
      food.style.display = "flex";
    } else {
      food.style.display = food.classList.contains(category) ? "block" : "none";
    }
  });
}

// sign in toggler
// function formToggle(){
//   const login = document.getElementById("login-form");
//   const signin = document.getElementById("signin-form");
//   login.style.display = "none";
//   signin.style.display = "block";
// }

function showSignIn() {
  const signin = document.getElementById("signin-form");
  const login = document.getElementById("login-form");
  const heading = document.getElementById("login-heading");

  signin.style.display = "block";
  login.style.display = "none";
  heading.innerHTML = "Sign in";
}

function showLogIn() {
  const signin = document.getElementById("signin-form");
  const login = document.getElementById("login-form");
  const heading = document.getElementById("login-heading");

  signin.style.display = "none";
  login.style.display = "block";
  heading.innerHTML = "Log in";
}

function showMore() {
  const more = document.getElementById("read-more");
  const text = document.getElementById("more-text");

  if (text.style.display == "none") {
    text.style.display = "block";
    more.innerHTML = "Read less";
  } else {
    text.style.display = "none";
    more.innerHTML = "Read more";
  }
}

function addToCart(button) {
  const detailBox = button.closest(".detail-box");
  if (!detailBox) return;

  const foodName = detailBox.querySelector("h5").innerText.trim();

  const priceText = detailBox
    .querySelector(".options h6")
    .innerText.replace("$", "")
    .trim();

  const price = parseFloat(priceText);
  if (isNaN(price)) return;

  const table = document.getElementById("cart-table");
  const tbody = table.querySelector("tbody");

  const rows = tbody.querySelectorAll("tr");

  for (let row of rows) {
    const itemCell = row.cells[0];
    if (itemCell.innerText === foodName) {
      // Increase quantity by 1
      const quantityCell = row.cells[2];
      const totalCell = row.cells[3];

      let quantity = parseInt(quantityCell.dataset.quantity);
      quantity++;
      quantityCell.dataset.quantity = quantity;
      quantityCell.innerText = quantity;

      totalCell.innerText = "$" + (quantity * price).toFixed(2);
      return;
    }
  }

  const row = document.createElement("tr");

  row.innerHTML = `
    <td>${foodName}</td>
    <td>$${price.toFixed(2)}</td>
    <td data-quantity="1">
      <button class="decrease">-</button>
      <span>1</span>
      <button class="increase">+</button>
    </td>
    <td>$${price.toFixed(2)}</td>
  `;

  tbody.appendChild(row);

  const quantityCell = row.cells[2];
  const quantitySpan = quantityCell.querySelector("span");

  quantityCell.querySelector(".increase").addEventListener("click", () => {
    let quantity = parseInt(quantityCell.dataset.quantity);
    quantity++;
    quantityCell.dataset.quantity = quantity;
    quantitySpan.innerText = quantity;
    row.cells[3].innerText = "$" + (quantity * price).toFixed(2);
  });

  quantityCell.querySelector(".decrease").addEventListener("click", () => {
    let quantity = parseInt(quantityCell.dataset.quantity);
    if (quantity > 1) {
      quantity--;
      quantityCell.dataset.quantity = quantity;
      quantitySpan.innerText = quantity;
      row.cells[3].innerText = "$" + (quantity * price).toFixed(2);
    } else {
      row.remove();
    }
  });
}

// Example: Attach to a button with id 'toggleFoodsBtn'

// let active = true;
// function mock() {
//   const dugme = document.getElementById("mockButton");
//   const demo = document.getElementById("demo");

//   if (active) {
//     demo.style.display = "none";
//   } else {
//     demo.style.display = "block";
//   }

//   active = !active;
// }
// nice select
// $(document).ready(function () {
//   $("select").niceSelect();
// });

// client section owl carousel
$(".client_owl-carousel").owlCarousel({
  loop: true,
  margin: 0,
  dots: false,
  nav: true,
  navText: [],
  autoplay: true,
  autoplayHoverPause: true,
  navText: [
    '<i class="fa fa-angle-left" aria-hidden="true"></i>',
    '<i class="fa fa-angle-right" aria-hidden="true"></i>',
  ],
  responsive: {
    0: {
      items: 1,
    },
    768: {
      items: 2,
    },
    1000: {
      items: 2,
    },
  },
});
