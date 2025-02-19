let isEditMode = false;
let allStudentsCheckbox;
let lastSearchQuery = "";
let isDeletePopupOpen = false;

document.addEventListener("DOMContentLoaded", function () {
    const editButton = document.getElementById("edit_button");
    const hoursButtons = document.querySelectorAll(".hours-button");
    allStudentsCheckbox = document.getElementById("all_students_checkbox");

    //Hide elements 
    if (allStudentsCheckbox) allStudentsCheckbox.style.display = "none";
    hoursButtons.forEach(button => button.style.display = "none");

    //edit mode button click
    editButton.addEventListener("click", function () {
        if (!isEditMode) {
            enterEditMode();
        } else {
            const selectedCheckboxes = document.querySelectorAll(".student-checkbox:checked");
            selectedCheckboxes.length > 0 ? show_delete_popup() : exitEditMode();
        }
    });

    //handle All students checkbox click
    allStudentsCheckbox.addEventListener("change", function () {
        const checkboxes = document.querySelectorAll(".student-checkbox");
        const rows = document.querySelectorAll("tr");

        checkboxes.forEach((checkbox, index) => {
            checkbox.checked = allStudentsCheckbox.checked;
            if (rows[index + 1]) {
                allStudentsCheckbox.checked ? rows[index + 1].classList.add("checked") : rows[index + 1].classList.remove("checked");
            }
        });
    });

    //handle individual checkbox changes
    document.querySelectorAll(".student-checkbox").forEach(checkbox => {
        checkbox.addEventListener("change", function () {
            const row = this.closest("tr");
            this.checked ? row.classList.add("checked") : row.classList.remove("checked");

            allStudentsCheckbox.checked = document.querySelectorAll(".student-checkbox:checked").length === document.querySelectorAll(".student-checkbox").length;
        });
    });

    //search input handling
    document.getElementById("search_input").addEventListener("input", function () {
        const searchQuery = this.value;
        if (this.searchTimeout) clearTimeout(this.searchTimeout);

        this.searchTimeout = setTimeout(() => {
            lastSearchQuery = searchQuery;
            fetch("/ADMIN_DTR/backend/search.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `searchQuery=${encodeURIComponent(searchQuery)}`
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById("tbody").innerHTML = data;
                if (!searchQuery.trim()) fetch("/ADMIN_DTR/includes/reset.php");
                if (isEditMode) maintainEditModeState();
            })
            .catch(error => console.error("Error:", error));
        }, 300);
    });
});

//fetch real-time data periodically
function fetchRealTimeData() {
    if (!lastSearchQuery && !isDeletePopupOpen && !isEditMode) {
        fetch("/ADMIN_DTR/backend/fetch_real_time.php")
        .then(response => response.text())
        .then(data => document.getElementById("tbody").innerHTML = data)
        .catch(error => console.error("Error fetching data", error));
    }
}
setInterval(fetchRealTimeData, 3000);
fetchRealTimeData();

//delete popup functions
function show_delete_popup() {
    isDeletePopupOpen = true;
    document.getElementById("delete_warning").style.display = "block";
}
function hide_delete_popup() {
    isDeletePopupOpen = false;
    document.getElementById("delete_warning").style.display = "none";
    if (isEditMode) maintainEditModeState();
}

//edit mode functions
function enterEditMode() {
    isEditMode = true;
    document.getElementById("edit_button").innerHTML = '&nbsp;&nbsp;&nbsp;<i class="bx bx-trash"></i>&nbsp;&nbsp;&nbsp;';
    document.getElementById("edit_button").classList.add("delete-mode");
    document.getElementById("edit_button").style.backgroundColor = "#E72E2E";
    document.getElementById("edit_button").style.color = "white";
    maintainEditModeState();
}

function exitEditMode() {
    isEditMode = false;
    document.getElementById("edit_button").innerHTML = '<i class="bx bxs-pencil"></i> Edit';
    document.getElementById("edit_button").classList.remove("delete-mode");
    document.getElementById("edit_button").style.backgroundColor = "";
    document.getElementById("edit_button").style.color = "";
    document.querySelectorAll(".student-checkbox, .hours-button").forEach(el => el.style.display = "none");
    if (allStudentsCheckbox) {
        allStudentsCheckbox.style.display = "none";
        allStudentsCheckbox.checked = false;
    }
    document.querySelectorAll("tr.checked").forEach(row => row.classList.remove("checked"));
}

function maintainEditModeState() {
    document.querySelectorAll(".student-checkbox, .hours-button").forEach(el => el.style.display = "inline-block");
    if (allStudentsCheckbox) allStudentsCheckbox.style.display = "inline-block";
}

//delete selected students
function delete_selected() {
    const selectedCheckboxes = document.querySelectorAll(".student-checkbox:checked");
    if (selectedCheckboxes.length === 0) return alert("No student selected for deletion.");

    hide_delete_popup();
    const studentIds = Array.from(selectedCheckboxes).map(checkbox => checkbox.dataset.id);
    fetch("/ADMIN_DTR/backend/delete.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `ids=${encodeURIComponent(JSON.stringify(studentIds))}`
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === "success") {
            selectedCheckboxes.forEach(checkbox => checkbox.closest("tr").remove());
            alert("Selected students deleted successfully!");
            exitEditMode();
        } else {
            console.error("Response:", data);
            alert(`Error: ${data}`);
        }
    })
    .catch(error => {
        console.error("Error deleting students", error);
        alert("An error occurred while deleting students.");
    });
}

//student hours button click
document.getElementById("tbody").addEventListener("click", function (e) {
    const button = e.target.closest(".hours-button");
    if (button) {
        const studentId = button.dataset.id;
        fetch(`/ADMIN_DTR/backend/getting_student.php?id=${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                sessionStorage.setItem("studentData", JSON.stringify(data.student));
                window.location.href = `hk.php?id=${studentId}`;
            } else {
                console.error("Error fetching student data:", data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    }
});
