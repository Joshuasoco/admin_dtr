let isEditMode = false;
let allStudentsCheckbox;
let lastSearchQuery = "";
let isDeletePopupOpen = false;

document.addEventListener("DOMContentLoaded", function () {
  const editButton = document.getElementById("edit_button");
  const hoursButtons = document.querySelectorAll(".hours-button");
  allStudentsCheckbox = document.getElementById("all_students_checkbox");

  // Initially hide elements
  if (allStudentsCheckbox) {
    allStudentsCheckbox.style.display = "none";
  }
  hoursButtons.forEach((button) => {
    button.style.display = "none";
  });

  // Toggle edit mode
  editButton.addEventListener("click", function () {
    if (!isEditMode) {
      // Entering edit mode
      enterEditMode();
    } else {
      // Check if there are selected checkboxes before showing delete popup
      const selectedCheckboxes = document.querySelectorAll(".student-checkbox:checked");
      if (selectedCheckboxes.length > 0) {
        show_delete_popup();
      } else {
        // If no checkboxes selected, exit edit mode directly
        exitEditMode();
      }
    }
  });

  // Handle "All students" checkbox click
  allStudentsCheckbox.addEventListener("change", function () {
    const checkboxes = document.querySelectorAll(".student-checkbox");
    const rows = document.querySelectorAll("tr");

    checkboxes.forEach((checkbox, index) => {
      checkbox.checked = allStudentsCheckbox.checked;

      if (rows[index + 1]) {
        // Skip the header row (index 0)
        if (allStudentsCheckbox.checked) {
          rows[index + 1].classList.add("checked");
        } else {
          rows[index + 1].classList.remove("checked");
        }
      }
    });
  });

  // Modify individual checkbox behavior
  const individualCheckboxes = document.querySelectorAll(".student-checkbox");
  individualCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      const row = this.closest("tr");
      if (this.checked) {
        row.classList.add("checked");
      } else {
        row.classList.remove("checked");

        // Uncheck the "All students" checkbox if any individual checkbox is unchecked
        allStudentsCheckbox.checked = false;
      }

      // Check if all checkboxes are selected to update "All students" checkbox
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

      // Update search state
      fetch("/ADMIN_DTR/backend/search_state.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: `searchQuery=${encodeURIComponent(searchQuery)}`,
      });

      // Clear previous timeout
      if (this.searchTimeout) {
        clearTimeout(this.searchTimeout);
      }

      // Set timeout for search
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

            // Update search state
            if (searchQuery.trim() === "") {
              // Reset search state and allow real-time updates
              fetch("/ADMIN_DTR/includes/reset.php");
            }

            // Maintain edit mode state after search
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
      }, 300); // Add debounce delay
    });
});

// Add this after your existing DOMContentLoaded event

// Modify fetchRealTimeData function
function fetchRealTimeData() {
  // Only fetch if we're not in edit mode, no search active, and no delete popup
  if (!lastSearchQuery && !isDeletePopupOpen && !isEditMode) {
    fetch("/ADMIN_DTR/backend/fetch_real_time.php")
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("tbody").innerHTML = data;
      })
      .catch((error) => console.error("Error data", error));
  }
}

// Update every 5 seconds (5000 milliseconds)
setInterval(fetchRealTimeData, 3000);

// Initial fetch
fetchRealTimeData();

// Existing delete popup functions
// Modify show_delete_popup function
function show_delete_popup() {
  isDeletePopupOpen = true; // Set flag when popup opens
  document.getElementById("delete_warning").style.display = "block";
}

// Modify hide_delete_popup function
function hide_delete_popup() {
  isDeletePopupOpen = false; // Reset flag when popup closes
  document.getElementById("delete_warning").style.display = "none";

  // Only handle checkbox state if the user clicked "No"
  if (this.event && !this.event.target.classList.contains("delete_button")) {
    // Keep edit mode active and checkboxes visible
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

  // Send delete request via AJAX
  fetch("/ADMIN_DTR/backend/delete.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `ids=${encodeURIComponent(JSON.stringify(studentIds))}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data.trim() === "success") {
        // Remove deleted rows from UI
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
