<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-4" v-text="project.name"></h2>
                <p v-if="activePeer" v-text="activePeer.name + ' is typing...'"></p>
                <ul class="list-group mb-3">
                    <li class="list-group-item" v-for="task in tasks" v-text="task.title"></li>
                </ul>

                <form @submit.prevent="addTask">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" v-model="newTask" placeholder="Add new task..." @keypress="notifyPeers">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <h2 class="mb-4">Active participants</h2>

                <ul class="list-group mb-3">
                    <li class="list-group-item" v-for="user in users" v-text="user.name"></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['project'],
        data() {
            return {
                tasks: [],
                newTask: '',
                activePeer: false,
                activePeerTimeout: '',
                users: []
            }
        },
        computed: {
            channel() {
                return window.Echo.join(`tasks.${this.project.id}`);
            }
        },
        created() {
            axios.get(`/api/projects/${this.project.id}/tasks`).then((response) => {this.tasks = response.data});

            this.channel.here((e) => {
                this.users = e;
            }
            ).joining((e) => {
                this.users.push(e);
            }).leaving((e) => {
                this.users.splice(this.users.indexOf(e), 1);
            }).listen('TaskCreated', ({task}) => {
                this.tasks.push(task);
                this.activePeer = false;
            });

            this.channel.listenForWhisper('typing', this.peerTyping);
        },
        methods: {
            peerTyping(e) {
                this.activePeer = e;

                if (this.activePeerTimeout) clearTimeout(this.activePeerTimeout);

                this.activePeerTimeout = setTimeout(() => {
                    this.activePeer = false;
                }, 3000);
            },
            addTask() {
                axios.post(`/api/projects/${this.project.id}/tasks`, {title: this.newTask}).then((response) => {
                    this.tasks.push(response.data);
                    this.newTask = '';
                });
            },
            notifyPeers() {
                this.channel.whisper('typing', { name: window.App.user.name });
            }
        }
    }
</script>
