document.addEventListener("DOMContentLoaded", function() {
  const deleteButton = document.getElementById('deleteButton');
  const checkboxes = document.querySelectorAll('input[name="taskIds[]"]');

  function updateDeleteButton() {
      const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
      if (anyChecked) {
          deleteButton.classList.remove('disabled');
      } else {
          deleteButton.classList.add('disabled');
      }
  }

  checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', updateDeleteButton);
  });

  updateDeleteButton();
});

/* Filter tasks */
function filterTasks() {
const searchInput = document.getElementById('searchBar').value.toLowerCase();
const tableRows = document.getElementById('tasksTable').getElementsByTagName('tr');

for (let i = 0; i < tableRows.length; i++) {
    const cells = tableRows[i].getElementsByTagName('td');
    if (cells.length > 0) {
        const title = cells[0].innerText.toLowerCase();

        if (title.includes(searchInput)) {
            tableRows[i].style.display = '';
        } else {
            tableRows[i].style.display = 'none';
        }
    }
}
}

// Initialize the filter function to ensure any existing tasks are filtered on page load
filterTasks();