let isEditMode = false;
let allStudentsCheckbox;

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
    isEditMode = !isEditMode;
    console.log("Edit mode:", isEditMode);

    const checkboxes = document.querySelectorAll(".student-checkbox");
    const hoursButtons = document.querySelectorAll(".hours-button");

    if (isEditMode) {
      // Enter delete mode
      editButton.innerHTML = '&nbsp;&nbsp;&nbsp;<i class="bx bx-trash"></i>&nbsp;&nbsp;&nbsp;';
      editButton.classList.add("delete-mode");
      editButton.style.backgroundColor = "#E72E2E";
      editButton.style.color = "white";

      // Show elements
      checkboxes.forEach(
        (checkbox) => (checkbox.style.display = "inline-block")
      );
      hoursButtons.forEach((button) => (button.style.display = "block"));
      if (allStudentsCheckbox)
        allStudentsCheckbox.style.display = "inline-block";
    } else {
      // Exit delete mode
      const selectedCheckboxes = document.querySelectorAll(
        ".student-checkbox:checked"
      );

      if (selectedCheckboxes.length > 0) {
        show_delete_popup();
        return;
      }

      // Hide elements
      checkboxes.forEach((checkbox) => (checkbox.style.display = "none"));
      hoursButtons.forEach((button) => (button.style.display = "none"));
      if (allStudentsCheckbox) {
        allStudentsCheckbox.style.display = "none";
        allStudentsCheckbox.checked = false;
      }

      // Reset button state
      editButton.innerHTML = '<i class="bx bxs-pencil"></i> Edit';
      editButton.classList.remove("delete-mode");
      editButton.style.backgroundColor = "";
      editButton.style.color = "";
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

          // Maintain edit mode state after search
          if (isEditMode) {
            const checkboxes = document.querySelectorAll(".student-checkbox");
            const hoursButtons = document.querySelectorAll(".hours-button");

            checkboxes.forEach(
              (checkbox) => (checkbox.style.display = "inline-block")
            );
            hoursButtons.forEach((button) => (button.style.display = "block"));
            if (allStudentsCheckbox)
              allStudentsCheckbox.style.display = "inline-block";
          }
        })
        .catch((error) => console.error("Error:", error));
    });
});

// Existing delete popup functions
function show_delete_popup() {
  document.getElementById("delete_warning").style.display = "block";
}

function hide_delete_popup() {
  document.getElementById("delete_warning").style.display = "none";

  const allStudentsCheckbox = document.getElementById("all_students_checkbox");
  allStudentsCheckbox.checked = false;

  const checkboxes = document.querySelectorAll(".student-checkbox");
  const rows = document.querySelectorAll("tr");

  checkboxes.forEach((checkbox, index) => {
    checkbox.checked = false;
    if (rows[index + 1]) {
      // Skip the header row (index 0)
      rows[index + 1].classList.remove("checked");
    }
  });
}

function delete_selected() {
  const selectedCheckboxes = document.querySelectorAll(
    ".student-checkbox:checked"
  );
  if (selectedCheckboxes.length === 0) {
    alert("No student selected for deletion.");
    return;
  }

  // Hide popup and simulate deletion
  hide_delete_popup();

  selectedCheckboxes.forEach((checkbox) => {
    checkbox.closest("tr").remove(); // Remove the row
  });
  alert("Selected students deleted.");
}
