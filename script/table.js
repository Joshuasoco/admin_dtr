let isEditMode = false;
let allStudentsCheckbox;
let lastSearchQuery = "";
let isDeletePopupOpen = false;

document.addEventListener("DOMContentLoaded", function () {
  const editButton = document.getElementById("edit_button");
  const hoursButtons = document.querySelectorAll(".hours-button");
  allStudentsCheckbox = document.getElementById("all_students_checkbox");

 
  if (allStudentsCheckbox) {
    allStudentsCheckbox.style.display = "none";
  }
  hoursButtons.forEach((button) => {
    button.style.display = "none";
  });

  editButton.addEventListener("click", function () {
    if (!isEditMode) {
      enterEditMode();
    } else {
      const selectedCheckboxes = document.querySelectorAll(".student-checkbox:checked");
      if (selectedCheckboxes.length > 0) {
        show_delete_popup();
      } else {
        exitEditMode();
      }
    }
  });

  // all students checkbox click
  allStudentsCheckbox.addEventListener("change", function () {
    const checkboxes = document.querySelectorAll(".student-checkbox");
    const rows = document.querySelectorAll("tr");

    checkboxes.forEach((checkbox, index) => {
      checkbox.checked = allStudentsCheckbox.checked;

      if (rows[index + 1]) {
        // skip the header row (index 0)
        if (allStudentsCheckbox.checked) {
          rows[index + 1].classList.add("checked");
        } else {
          rows[index + 1].classList.remove("checked");
        }
      }
    });
  });

  // individual checkbox behavior
  const individualCheckboxes = document.querySelectorAll(".student-checkbox");
  individualCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      const row = this.closest("tr");
      if (this.checked) {
        row.classList.add("checked");
      } else {
        row.classList.remove("checked");

        allStudentsCheckbox.checked = false;
      }
      // check all the td when the all student checkbox is clicked
      const checkedBoxes = document.querySelectorAll(
        ".student-checkbox:checked"
      );
      allStudentsCheckbox.checked =
        checkedBoxes.length === individualCheckboxes.length;
    });
  });

  // Update search handler to maintain edit mode state
  document
    .getElementById("search_input")
    .addEventListener("input", function () {
      const searchQuery = this.value;
      fetch("/ADMIN_DTR/backend/search.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `searchQuery=${encodeURIComponent(searchQuery)}`,
      });

      if (this.searchTimeout) {
        clearTimeout(this.searchTimeout);
      }

      this.searchTimeout = setTimeout(() => {
        lastSearchQuery = searchQuery;

        fetch("/ADMIN_DTR/backend/search.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `searchQuery=${encodeURIComponent(searchQuery)}`,
        })
          .then((response) => response.text())
          .then((data) => {
            document.getElementById("tbody").innerHTML = data;

            if (searchQuery.trim() === "") {
              fetch("/ADMIN_DTR/includes/reset.php");
            }
            if (isEditMode) {
              const checkboxes = document.querySelectorAll(".student-checkbox");
              const hoursButtons = document.querySelectorAll(".hours-button");

              checkboxes.forEach(
                (checkbox) => (checkbox.style.display = "inline-block")
              );
              hoursButtons.forEach(
                (button) => (button.style.display = "block")
              );
              if (allStudentsCheckbox)
                allStudentsCheckbox.style.display = "inline-block";
            }
          })
          .catch((error) => console.error("Error:", error));
      }, 300); //delay
    });
});



//realtime update
function fetchRealTimeData() {

  if (!lastSearchQuery && !isDeletePopupOpen && !isEditMode) {
    fetch("/ADMIN_DTR/backend/fetch_real_time.php")
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("tbody").innerHTML = data;
      })
      .catch((error) => console.error("Error data", error));
  }
}

setInterval(fetchRealTimeData, 3000);
fetchRealTimeData();


function show_delete_popup() {
  isDeletePopupOpen = true; 
  document.getElementById("delete_warning").style.display = "block";
}

function hide_delete_popup() {
  isDeletePopupOpen = false; 
  document.getElementById("delete_warning").style.display = "none";
  if (this.event && !this.event.target.classList.contains("delete_button")) {
    if (isEditMode) {
      const checkboxes = document.querySelectorAll(".student-checkbox");
      const hoursButtons = document.querySelectorAll(".hours-button");

      checkboxes.forEach(checkbox => checkbox.style.display = "inline-block");
      hoursButtons.forEach(button => button.style.display = "block");
      if (allStudentsCheckbox) {
        allStudentsCheckbox.style.display = "inline-block";
      }
    }
  }
}

function enterEditMode() {
  isEditMode = true;
  const editButton = document.getElementById("edit_button");
  const checkboxes = document.querySelectorAll(".student-checkbox");
  const hoursButtons = document.querySelectorAll(".hours-button");

  editButton.innerHTML = '&nbsp;&nbsp;&nbsp;<i class="bx bx-trash"></i>&nbsp;&nbsp;&nbsp;';
  editButton.classList.add("delete-mode");
  editButton.style.backgroundColor = "#E72E2E";
  editButton.style.color = "white";

  checkboxes.forEach(checkbox => checkbox.style.display = "inline-block");
  hoursButtons.forEach(button => button.style.display = "block");
  if (allStudentsCheckbox) allStudentsCheckbox.style.display = "inline-block";
}

function exitEditMode() {
  isEditMode = false;
  const editButton = document.getElementById("edit_button");
  const checkboxes = document.querySelectorAll(".student-checkbox");
  const hoursButtons = document.querySelectorAll(".hours-button");

  editButton.innerHTML = '<i class="bx bxs-pencil"></i> Edit';
  editButton.classList.remove("delete-mode");
  editButton.style.backgroundColor = "";
  editButton.style.color = "";

  checkboxes.forEach(checkbox => {
    checkbox.style.display = "none";
    checkbox.checked = false;
  });
  hoursButtons.forEach(button => button.style.display = "none");
  if (allStudentsCheckbox) {
    allStudentsCheckbox.style.display = "none";
    allStudentsCheckbox.checked = false;
  }

  document.querySelectorAll("tr.checked").forEach(row => row.classList.remove("checked"));
}

function delete_selected() {
  const selectedCheckboxes = document.querySelectorAll(
    ".student-checkbox:checked"
  );

  if (selectedCheckboxes.length === 0) {
    alert("No student selected for deletion.");
    return;
  }

  // Always hide the popup when deletion is confirmed
  hide_delete_popup();

  // Gather selected student IDs
  const studentIds = Array.from(selectedCheckboxes).map(
    (checkbox) => checkbox.dataset.id
  );

  // send delete request via AJAX
  fetch("/ADMIN_DTR/backend/delete.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `ids=${encodeURIComponent(JSON.stringify(studentIds))}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data.trim() === "success") {
        
        selectedCheckboxes.forEach((checkbox) =>
          checkbox.closest("tr").remove()
        );
        alert("Selected students deleted successfully!");
      } else {
        alert("Error deleting students. Please try again.");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("An error occurred while deleting students.");
    });
}
document.getElementById("tbody").addEventListener("click", function (e) {
  const button = e.target.closest(".hours-button");
  if (button) {
    const studentId = button.dataset.id;
    window.location.href = `hk.php?id=${studentId}`;
  }
});