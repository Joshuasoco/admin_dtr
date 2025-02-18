function openModal(row) {

    const cells = row.cells;
    const modal = document.getElementById('form_popup');

    document.getElementById('edit_date').value = cells[0].textContent;
    document.getElementById('edit_timein').value = cells[1].textContent.toLowerCase().trim();
    document.getElementById('edit_timeout').value = cells[2].textContent.toLowerCase().trim();
    document.getElementById('remarks').value = cells[3].textContent;
    
    modal.style.display = 'flex';
}

function closeModal() {
    document.getElementById('form_popup').style.display = 'none';
}

document.querySelectorAll('.three-dot').forEach(icon => {
    icon.addEventListener('click', function() {
        const row = this.closest('tr');
        openModal(row);
    });
});

// close modal when clicking outside
document.getElementById('form_popup').addEventListener('click', function(e) {
    if(e.target === this) closeModal();
});
document.addEventListener('DOMContentLoaded', function() {
    const studentData = JSON.parse(sessionStorage.getItem('studentData'));
    if (studentData) {
        document.querySelector('.student-id-number').textContent = studentData.id;
        document.querySelector('.student-name').textContent = studentData.name;
        document.querySelector('.student-course').textContent = studentData.course_code;
        document.querySelector('.student-schedule').textContent = `${studentData.schedule_days}`;
        sessionStorage.removeItem('studentData');
    }
});