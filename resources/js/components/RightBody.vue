<template>
    <div id="right">
        <h1>Development</h1>

        <div class="horizontal">
            <img src="../images/horizontal.png">
        </div>

        <p>
            Testeam functia
        </p>

        <div class="task">
            <div class="add-task">
                <h2>Today's Task</h2>

                <div class="add-action">
                    <img src="../images/add.png">
                </div>
            </div>
            <ul class="task-list"></ul>
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
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>

export default {


}
</script>

<style>

</style>
