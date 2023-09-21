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
                checkbox.id = task.id;
                const done = task.done;
                if (done == 0) {
                    checkbox.checked = true;
                }
                checkbox.addEventListener('change', function (){
                    update_tasks(checkbox.id, done);
                });

                taskDiv.appendChild(h1);
                taskDiv.appendChild(checkbox);
                taskList.appendChild(taskDiv);
            });
        });


        function update_tasks(id, done) {
            if(done == 1) {
                done = 0;
            } else {
                done = 1;
            }
            
            fetch("./server/update_tasks.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json" // Spécifie le type de contenu JSON
                },  
                body: JSON.stringify({
                    id: id,
                    done: done
                })
                
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
        }
         /*checkboxes.forEach(checkbox => {
            console.log(checkbox.id);
            console.log("test");
            checkbox.addEventListener('change', function () {
                if(this.checked) {
                    fetch("./server/update_task.php", {
                        method: "POST",
                        body: JSON.stringify({
                            id: this.id,
                            done: 1
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    });
                } else {
                    /*fetch("./server/update_task.php", {
                        method: "POST",
                        body: JSON.stringify({
                            id: this.id,
                            done: 0
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    });
                }
            });
        });*/
});