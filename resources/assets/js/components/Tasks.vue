<template>
    <div>
        <ul class="list-group mb-3">
            <li class="list-group-item" v-for="task in tasks" v-text="task.title"></li>
        </ul>

        <form @submit.prevent="addTask">
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="newTask" placeholder="Add new task...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Add</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: ['project'],
        data() {
            return {
                tasks: [],
                newTask: ''
            }
        },
        created() {
            axios.get(`/api/projects/${this.project.id}/tasks`).then((response) => {this.tasks = response.data});



            window.Echo.private(`tasks.${this.project.id}`).listen('TaskCreated', ({task}) => {
                this.tasks.push(task);
            });
        },
        methods: {
            addTask() {
                axios.post(`/api/projects/${this.project.id}/tasks`, {title: this.newTask}).then((response) => {
                    this.tasks.push(response.data);
                    this.newTask = '';
                });
            }
        }
    }
</script>
