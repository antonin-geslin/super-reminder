document.addEventListener('DOMContentLoaded', () => {
    const taskInput = document.getElementById('myInput');
    const addTaskButton = document.querySelector('.add_task button');
    const taskContainer = document.getElementById('taskContainer');

    addTaskButton.addEventListener('click', () => {
        const taskText = taskInput.value.trim();
        if (taskText) {
            console.log('Ajout de la tâche:', taskText);
            addTaskToContainer(taskText);
            taskInput.value = '';
        }
    });

    // Charger les tâches du localStorage
    loadTasksFromLocalStorage();
});

function addTaskToContainer(taskText) {
    const taskDiv = document.createElement('div');
    taskDiv.className = 'task';

    const checkbox = document.createElement('input');
    checkbox.type = 'checkbox';
    checkbox.addEventListener('change', () => {
        taskDiv.style.textDecoration = checkbox.checked ? 'line-through' : 'none';
    });

    const taskLabel = document.createElement('label');
    taskLabel.textContent = taskText;

    const deleteButton = document.createElement('button');
    deleteButton.textContent = '❌';
    deleteButton.style.color = 'red';
    deleteButton.addEventListener('click', () => {
        taskDiv.remove();
        removeTaskFromLocalStorage(taskText);
    });

    taskDiv.appendChild(checkbox);
    taskDiv.appendChild(taskLabel);
    taskDiv.appendChild(deleteButton);

    const taskContainer = document.getElementById('taskContainer');
    taskContainer.appendChild(taskDiv);

    console.log('Tâche ajoutée au conteneur:', taskText);
    
    // Enregistrer la nouvelle tâche dans le localStorage
    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks.push(taskText);
    localStorage.setItem('tasks', JSON.stringify(tasks));
}

// fonction pour charger les taches du localStorage
function loadTasksFromLocalStorage() {
    const taskContainer = document.getElementById('taskContainer');
    taskContainer.innerHTML = '';  // Vider le conteneur de tâches

    const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks.forEach(taskText => addTaskToContainer(taskText));
}

// fonction pour supprimer une tache du localStorage
function removeTaskFromLocalStorage(taskText) {
    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];
    tasks = tasks.filter(task => task !== taskText);
    localStorage.setItem('tasks', JSON.stringify(tasks));
}
