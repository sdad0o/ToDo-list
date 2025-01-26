const modal = document.querySelector('.modal');
const overlay = document.querySelector('.overlay');
const btnCloseModal = document.querySelector('.close-modal');
const editLinks = document.querySelectorAll('.show-modal');
const taskInput = document.querySelector('#task-input');
const taskIdInput = document.querySelector('#task-id');
const editForm = document.querySelector('#edit-task-form');

// Function to open the modal and populate data
const openModal = function (e) {
    e.preventDefault();
    const taskId = this.dataset.id;
    const taskText = this.dataset.task;

    taskIdInput.value = taskId;
    taskInput.value = taskText;
    editForm.setAttribute('action', `/todos/${taskId}`); // Set dynamic form action

    modal.classList.remove('hidden');
    overlay.classList.remove('hidden');
};

// Attach click event to edit links
editLinks.forEach(link => {
    link.addEventListener('click', openModal);
});

// Close modal functions
const closeModal = function () {
    modal.classList.add('hidden');
    overlay.classList.add('hidden');
};

btnCloseModal.addEventListener('click', closeModal);
overlay.addEventListener('click', closeModal);

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
    }
});

// Handle form submission with AJAX
editForm.addEventListener('submit', function (e) {
    e.preventDefault();

    fetch(this.action, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            task: taskInput.value,
            _method: 'PATCH'
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        document.querySelector(`.show-modal[data-id="${taskIdInput.value}"]`).dataset.task = taskInput.value;
        closeModal();
        location.reload();  // Refresh page to reflect changes (optional)
    })
    .catch(error => console.error('Error:', error));
});
