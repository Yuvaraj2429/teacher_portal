function showAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'block';
}

function closeAddStudentModal() {
    document.getElementById('addStudentModal').style.display = 'none';
}

// Close the modal 
window.onclick = function(event) {
    const modal = document.getElementById('addStudentModal');
    if (event.target === modal) {
        closeAddStudentModal();
    }
}

function showEditStudentModal(id, name, subject, marks) {
    document.getElementById('edit_student_id').value = id;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_subject').value = subject;
    document.getElementById('edit_marks').value = marks;
    document.getElementById('editStudentModal').style.display = 'block';
}

function closeEditStudentModal() {
    document.getElementById('editStudentModal').style.display = 'none';
}

function toggleDropdown(id) {
    const dropdown = document.getElementById(`dropdown-${id}`);
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}

// Close dropdown 
window.onclick = function(event) {
    if (!event.target.matches('.dropdown-btn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.style.display === 'block') {
                openDropdown.style.display = 'none';
            }
        }
    }
};

