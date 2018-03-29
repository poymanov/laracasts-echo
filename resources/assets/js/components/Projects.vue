<template>
    <div>
        <ul class="list-group mb-3">
            <li class="list-group-item" v-for="project in projects">
                <a :href="`/projects/${project.id}`" v-text="project.name"></a>
            </li>
        </ul>

        <form @submit.prevent="addProject">
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="newProject" placeholder="Add new project...">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Add</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                projects: [],
                newProject: ''
            }
        },
        created() {
            axios.get('/api/projects').then((response) => {this.projects = response.data});
        },
        methods: {
            addProject() {
                axios.post('/api/projects', {name: this.newProject}).then((response) => {
                    this.projects.push(response.data);
                    this.newProject = '';
                });
            }
        }
    }
</script>