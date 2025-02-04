document.addEventListener("DOMContentLoaded", function () {
  const editButton = document.getElementById("edit_button");
  const allStudentsCheckbox = document.getElementById("all_students_checkbox");
  let isEditMode = false;

  // Initially hide just the checkbox
  allStudentsCheckbox.style.display = "none";

  editButton.addEventListener("click", function () {
    isEditMode = !isEditMode;
    // Toggle visibility of individual checkboxes
    const checkboxes = document.querySelectorAll(".student-checkbox");
    checkboxes.forEach((checkbox) => {
      checkbox.style.display =
        checkbox.style.display === "none" ? "inline-block" : "none";
    });

    // Toggle visibility of just the "All students" checkbox
    allStudentsCheckbox.style.display = isEditMode ? "inline-block" : "none";

    // Reset the "All students" checkbox when exiting edit mode
    if (!isEditMode) {
      allStudentsCheckbox.checked = false;
    }
  });

  // Handle "All students" checkbox click
  allStudentsCheckbox.addEventListener("change", function () {
    if (!isEditMode) return; // Only work in edit mode

    const checkboxes = document.querySelectorAll(".student-checkbox");
    checkboxes.forEach((checkbox) => {
      checkbox.checked = allStudentsCheckbox.checked;
    });
  });
});
