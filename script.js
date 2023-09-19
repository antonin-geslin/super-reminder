document.addEventListener("DOMContentLoaded", function () {
    taskList = document.querySelector(".taskList");
    fetch("./server/get_tasks.php")
        .then(response => response.json())
        .then(data =>{
            data.forEach(task => {
                const taskDiv = document.createElement("div");
                taskDiv.classList.add("task"); 
                const h1 = document.createElement("h1");
                h1.textContent = task.task_name;  
                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.name = "check";
                console.log(task.done);
                if (task.done == 1) {
                    checkbox.checked = true;
                }
                taskDiv.appendChild(h1);
                taskDiv.appendChild(checkbox);
                taskList.appendChild(taskDiv);
            });
        })
        .catch(error => {
            console.error("Erreur lors de la récupération des tâches :", error);
        });

});