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

accept.addEventListener("click", ()=>{
  tosmodal.style.display ="none";
  alert("accepted Terms of Services");
});
decline.addEventListener("click", ()=>{
  tosmodal.style.display = "none";
});

openbutton.addEventListener("click", () => {
    tosmodal.style.display = "flex"; // Corrected modal reference
});

window.addEventListener("click", (e) => {
    if (e.target === tosmodal) {
        tosmodal.style.display = "none"; // Corrected modal reference
    }
});

function show_logout() {
  console.log("Show logout popup");
  document.getElementById("logout_warning").style.display = "block";
}

function hide_logout() {
  document.getElementById("logout_warning").style.display = "none";
}

function logout() {
  console.log("logout");
  fetch("/ADMIN_DTR/includes/logout.php")
    .then((response) => {
      if (response.ok) {
        window.location.href = "/ADMIN_DTR/includes/login.php";
      }
    })
    .catch((error) => console.error("logout failed try again", error));
}
