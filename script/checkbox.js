document.addEventListener("DOMContentLoaded", function () {
    // Get the edit button element
    const editButton = document.getElementById("edit_button");
    
    // Track edit mode state
    let isEditMode = false;

    // Add click event listener to edit button
    editButton.addEventListener("click", function () {
        // Toggle edit mode state
        isEditMode = !isEditMode;
        
        if (isEditMode) {
            // Change to delete mode
            editButton.innerHTML ='&nbsp;&nbsp;&nbsp;<i class="bx bx-trash"></i> &nbsp;&nbsp;&nbsp;';
            editButton.classList.add("delete-mode");
        } else {
            // Change back to edit mode
            editButton.innerHTML = '<i class="bx bxs-pencil"></i> Edit';
            editButton.classList.remove("delete-mode");
        }
        
        // Log the current state (for debugging)
        console.log('Edit mode:', isEditMode);
    });
});