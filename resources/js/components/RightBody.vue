<template>
    <div id="right">
        <h1>Development</h1>

        <div class="horizontal">
            <img src="../images/horizontal.png">
        </div>

        <p>
            Testam functia
        </p>

        <div class="tasks">
            <div class="add-task">
                <h2>Today's Task</h2>

                <div class="add-action">
                    <img src="../images/add.png" style="position:absolute; right: 0px; bottom: 0px;">
                </div>
            </div>
            <ul class="tasks-list">
                <li v-for="task in todayTask" v-bind:key="task.id">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input type="checkbox"
                                       name="test"
                                       :checked="task.complete"
                                       @change="updateTodayTask(task.taskId)"
                                >
                                <span></span>
                            </label>
                            <h4>{{task.title}}</h4>
                        </div>
                        <div class="right">
                            <img src="../images/edit.png" alt="">
                            <img src="../images/del.png" alt="" @click="deleteTask(task.taskId)">

                            <button
                            v-bind:class="{
                                inprogress: !task.approved,
                                approved: task.approved,
                            }">
                                {{ task.approved ? "Approved" : "In progress" }}
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="upcoming">
            <div class="add-tasks">
                <h2>Upcoming</h2>

                <div class="add-action">
                    <img src="../images/add.png">
                </div>
             </div>
            <form action="" @submit="addUpcomingTask">
                <input type="text" v-model="newTask">
            </form>

            <ul class="tasks-list">
                <li v-for="upcomingtask in upcoming" v-bind:key="upcomingtask.id">
                    <div class="info">
                        <div class="left">
                            <label class="myCheckbox">
                                <input type="checkbox"
                                       name="test"
                                       :checked="upcomingtask.complete"
                                       @change="checkUpcoming(upcomingtask.taskId)"
                                >
                                <span></span>
                            </label>
                            <h4>{{upcomingtask.title}}</h4>
                        </div>
                        <div class="right">
                            <img src="../images/edit.png" alt="">
                            <img src="../images/del.png" alt="" @click="delUpcoming(upcomingtask.taskId)">

                            <button
                            v-bind:class="{
                                inprogress: !upcoming.waiting,
                            }">
                            Waiting
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            todayTask: [],
            upcoming: [],
            newTask: "",
        };
    },

    created() {
        this.fetchTodayTasks();
        this.fetchUpcoming();
    },

    methods:
        {
            //UPCOMING TASK

            fetchUpcoming() {
                fetch('/api/upcoming')
                    .then(res => res.json())
                    .then(({data}) => {
                        this.upcoming = data;
                        console.log(data);
                    })
                    .catch((err) => console.log(err));
            },

            addUpcomingTask(e){
                e.preventDefault();

                const newTask={
                    title: this.newTask,
                    waiting: true,
                    taskId: Math.random().toString(36).substring(7),
                };

                fetch("/api/upcoming",{
                    method:"POST",
                    headers:{
                        "content-type":"application/json",
                    },
                    body:JSON.stringify(newTask),
                }).then(()=>this.upcoming.push(newTask));

                this.newTask="";
            },

            delUpcoming(taskId){
                if(confirm("Are you sure?"))
                {
                    fetch(`/api/upcoming/${taskId}`,{
                        method: 'delete',
                    }).then((res)=>res.json())
                        .then(()=>{
                            this.upcoming=this.upcoming.filter(({taskId: id})=>id!=taskId);
                        }).catch((err)=>console.log(err));
                }
            },

            checkUpcoming(taskId){
                this.addDailyTask(taskId);

                fetch(`/api/upcoming/${taskId}`,{method:"delete"}).then(()=>{
                    this.upcoming=this.upcoming.filter(({taskId: id})=>id!=taskId);
                })
            },

            //Today

            fetchTodayTasks() {
                fetch("/api/today")
                    .then((res)=>res.json())
                    .then(({data})=>{
                        this.todayTask=data;
                    }).catch((err)=>console.log(err));
            },

            addDailyTask(taskId) {
                const task=this.upcoming.filter(({taskId: id})=>id==taskId)[0];

                fetch('/api/today',{
                    method: "POST",
                    headers: {
                        'content-type':'aplication/json'
                    },
                    body: JSON.stringify(task),
                }).then(()=>this.todayTask.unshift(task))
                    .catch((err)=>console.log(err));
            },

            updateTodayTask(taskId){
                if(confirm("Did you complete your task?")){
                    fetch(`/api/today/${taskId}`,{method: "delete"})
                        .then(()=>{})
                        .then(()=>{
                            this.todayTask=this.todayTask.filter(
                                ({taskId:id})=>id!==taskId
                            );
                        })
                        .catch((err)=>console.log(err));
                }
            },

            deleteTask(taskId){
                if(confirm("Are you sure?")){
                  fetch(`/api/today/${taskId}`,{
                      method:"delete",
                  })
                      .then((res)=>res.json())
                      .then(
                          ()=>
                              (this.todayTask=this.todayTask.filter(
                                  ({taskId:id})=>id!==taskId
                              ))
                      )
                      .catch((err)=>console.log(err));
                }
            },

        }
}
</script>

<style>

</style>
