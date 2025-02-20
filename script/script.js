function pass() {
  let passwordInput = document.getElementById("password");
  let passIcon = document.getElementById("pass-icon");

  if (passwordInput.type === "password") {
    passwordInput.type = "text";
    passIcon.src = "../images/eye-open-svgrepo-com.svg";
  } else {
    passwordInput.type = "password";
    passIcon.src = "../images/eye-closed-svgrepo-com.svg";
  }
}

const tosmodal = document.getElementById("tos_modal");
const openbutton = document.getElementById("tos_button");
const accept = document.getElementById("accept");
const decline = document.getElementById("decline");

/*wrap to prevent errors 
js won’t try to add event listeners to null elements.*/
if (accept) {
  accept.addEventListener("click", () => {
    tosmodal.style.display = "none";
    alert("Accepted Terms of Service");
  });
}

if (decline) {
  decline.addEventListener("click", () => {
    tosmodal.style.display = "none";
  });
}

if (openbutton) {
  openbutton.addEventListener("click", () => {
    if (tosmodal) tosmodal.style.display = "flex"; 
  });
}

if (tosmodal) {
  window.addEventListener("click", (e) => {
    if (e.target === tosmodal) {
      tosmodal.style.display = "none"; 
    }
  });
}
function show_logout() {
  document.getElementById("logout_warning").style.display = "block";
}

function hide_logout() {
  document.getElementById("logout_warning").style.display = "none";
}

function logout() {
  window.location.href = "/admin_dtr/backend/logout.php"; // Change to your actual logout file
}



function hide_logout() {
  console.log("show logout popup");
  document.getElementById("logout_warning").style.display = "none";
}
/*logout error handler*/
function logout() {
  console.log("logout");
  fetch("/admin_dtr/includes/logout.php")
    .then((response) => {
      if (response.ok) {
        window.location.href = "/admin_dtr/includes/login.php";
      }
    })
    .catch((error) => console.error("logout failed", error));
    

    /* NEW */
    function togglePassword() {
      let passwordInput = document.getElementById("password");
      let passIcon = document.getElementById("pass-icon");
  
      if (passwordInput && passIcon) {
          if (passwordInput.type === "password") {
              passwordInput.type = "text";
              passIcon.src = "../images/eye-open-svgrepo-com.svg";
          } else {
              passwordInput.type = "password";
              passIcon.src = "../images/eye-closed-svgrepo-com.svg";
          }
      }
  }
  
}
