<template>
    <div :class="modalClass">
        <form @submit="handleSubmit">
            <div class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">
                        <input type="text"
                               class="input"
                               placeholder="Task name"
                               name="title"
                               v-model="task.title"
                               required
                               autofocus>
                    </p>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Description</label>
                        <div class="control">
                            <textarea class="textarea"
                                      name="description"
                                      placeholder="Enter a description"
                                      v-model="task.description">
                            </textarea>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Priority</label>
                        <div class="control">
                            <div class="select is-fullwidth">
                                <select name="priority" v-model="task.priority">
                                    <option value="2">High</option>
                                    <option value="1">Medium</option>
                                    <option value="0">Low</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">Due Date</label>
                        <div class="control">
                            <input class="input" type="date" name="due_at" v-model="task.due_at">
                        </div>
                    </div>
                </section>

                <footer class="modal-card-foot">
                    <button class="button is-primary">Save</button>
                    <button class="button" type="button" @click="cancel">Cancel</button>
                </footer>
            </div>
        </form>
    </div>
</template>

<script>
    import {EventBus} from '../eventbus';
    import Task from "../models/Task";
    import axios from 'axios';

    export default {
        name: "TaskModal",

        data() {
            return {
                active: false,
                loading: false,
                task: new Task(),
                callback: null
            }
        },

        methods: {
            showModal(task, callback) {
                this.active = true;
                this.task = task;
                this.callback = callback;
            },

            handleSubmit(e) {
                e.preventDefault();

                // show loading indicator
                this.loading = true;

                console.log(this.task);

                // make API call
                axios.post('/api/tasks', this.task)
                    .then(this.handleSubmitResponse)
                    .catch(this.handleSubmitError);
            },

            handleSubmitResponse(response) {
                console.log(response);

                this.active = false;
                this.callback(this.task);
                this.task = new Task();
                this.loading = false;
            },

            handleSubmitError(response) {
                console.log('error', response);
                this.loading = false;
            },

            cancel() {
                this.active = false;
                this.task = new Task();
                this.callback = null;
                this.loading = false;
            }
        },

        computed: {
            modalClass() {
                return 'modal' + (this.active ? ' is-active' : '');
            }
        },

        mounted() {
            EventBus.$on('show-modal', this.showModal);
        }
    }
</script>

<style lang="less" scoped>
    form {
        width: 100%;
    }

    .modal-card {
        width: 95%;
        margin: auto;
    }

    .modal-card-title {
        .input {
            font-size: .8em;
        }
    }
</style>