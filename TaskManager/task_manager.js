// referencias
const taskInput = document.getElementById('task-input');
const addTaskBtn = document.getElementById('add-task-btn');
const tasksContainer = document.getElementById('tasks');

// Adiciona a task pra lista
function addTask() {
    const taskText = taskInput.value.trim();
    if (taskText === '') return; // Don't add empty tasks

    const taskItem = document.createElement('div');
    taskItem.classList.add('task-item');
    taskItem.innerHTML = `
        <span>${taskText}</span>
        <button class="delete-task">Delete</button>
    `;

    // deleta a tarefa da lista
    taskItem.querySelector('.delete-task').addEventListener('click', () => {
        taskItem.remove();
    });

    tasksContainer.appendChild(taskItem);

    // limpa o campo do input
    taskInput.value = '';
}

// adiciona a tarefa quando clica no botão de add
addTaskBtn.addEventListener('click', addTask);

// add a tarefa quando é pressionado enter no campo do input
taskInput.addEventListener('keyup', (event) => {
    if (event.key === 'Enter') {
        addTask();
    }
});