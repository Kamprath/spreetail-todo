<template>
    <div>
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <span class="navbar-item">
                    <img src="/svg/spreetail_logo.svg">
                </span>
                <a role="button"
                   aria-label="menu"
                   aria-expanded="false"
                   data-target="navbarBasicExample"
                   :class="burgerClass"
                   @click="handleBurgerClick">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div :class="navbarMenuClass">
                <div class="navbar-start">
                    <a :class="getNavbarItemClass(0)" @click.prevent="() => { selectStatus(0) }">To Do</a>
                    <a :class="getNavbarItemClass(1)" @click.prevent="() => { selectStatus(1) }">In Progress</a>
                    <a :class="getNavbarItemClass(2)" @click.prevent="() => { selectStatus(2) }">Done</a>
                </div>
            </div>
        </nav>

        <section class="section">
            <button class="button is-secondary is-medium is-fullwidth" @click="handleAddTaskClick">Add Task</button>
        </section>

        <!-- Render tasks grouped by priority  -->
        <tasks-section :tasks="highPriorityTasks">High Priority</tasks-section>
        <tasks-section :tasks="mediumPriorityTasks">Medium Priority</tasks-section>
        <tasks-section :tasks="lowPriorityTasks">Low Priority</tasks-section>

        <task-modal></task-modal>
    </div>
</template>

<script>
    import Task from '../models/Task';
    import {EventBus} from "../eventbus";

    // import Bulma CSS framework (https://bulma.io/)
    import 'bulma/css/bulma.css';

    export default {
        name: 'AppComponent',

        props: ['taskdata'],

        data() {
            return {
                tasks: this.taskdata,
                isMenuActive: false,
                selectedStatus: 0
            }
        },

        methods: {
            /**
             * Handle click event on Add Task button
             */
            handleAddTaskClick() {
                const task = new Task();

                // call method to show dialog, passing it a blank Task object
                EventBus.$emit('show-modal', task, this.updateTask);
            },

            /**
             * Handle click event on burger icon
             */
            handleBurgerClick() {
                this.isMenuActive = !this.isMenuActive;
            },

            /**
             * Update or add a new Task
             * @param {Task} updatedTask
             */
            updateTask(updatedTask) {
                let index = -1;

                this.tasks.find((task, i) => {
                    if (task.id !== updatedTask.id) {
                        return false;
                    }

                    index = i;
                    return true;
                });

                if (index >= 0) {
                    this.tasks.splice(index, 1, updatedTask);
                } else {
                    this.tasks.push(updatedTask);
                }
            },

            /**
             * Delete a task
             * @param {int} id
             */
            deleteTask(id) {
                this.tasks.find((task, i) => {
                    if (task.id !== id) {
                        return false;
                    }

                    this.tasks.splice(i, 1);

                    return true;
                });
            },

            /**
             * @param {int} priority
             * @returns {Array}
             */
            getTasksByPriority(priority) {
                const results = [];

                this.tasks.forEach(task => {
                    // return if task is not the selected priority or status
                    if (task.priority !== priority || task.status !== this.selectedStatus) {
                        return;
                    }

                    results.push(task);
                });

                return results;
            },

            /**
             * Get class for navbar item
             * @param {int} status
             */
            getNavbarItemClass(status) {
                return 'navbar-item' + (status === this.selectedStatus ? ' is-active' : '');
            },

            /**
             * Set status to view tasks for
             * @param {int} status
             */
            selectStatus(status) {
                this.selectedStatus = status;
                this.isMenuActive = false;
            }
        },

        computed: {
            burgerClass() {
              return 'navbar-burger burger' + (this.isMenuActive ? ' is-active' : '');
            },

            navbarMenuClass() {
                return 'navbar-menu' + (this.isMenuActive ? ' is-active' : '');
            },

            highPriorityTasks() {
                return this.getTasksByPriority(2);
            },

            mediumPriorityTasks() {
                return this.getTasksByPriority(1);
            },

            lowPriorityTasks() {
                return this.getTasksByPriority(0);
            }
        },

        mounted() {
            EventBus.$on('update-task', this.updateTask);
            EventBus.$on('delete-task', this.deleteTask);
        }
    }
</script>

<style lang="less" scoped>
    @color-gray-darkest: #333;
    @color-gray-light: #888;
    @color-primary: #67D4C8;

    body {
        background-color: #dadada;
    }

    nav {
        background-color: @color-gray-darkest;
    }
    .section {
        padding: 1em;
    }
    .navbar-burger {
        color: @color-gray-light;
        transition: color 80ms linear;

        &:hover, &.is-active {
            color: white;
            background: none;
        }
    }
    .navbar-menu.is-active {
        background-color: #222;
        .navbar-item {
            background: none;
            border: none;
        }

    }
    .navbar-item {
        color: @color-gray-light;
        transition: color 80ms linear;

        &.is-active {
            color: white;
            font-weight: bold;
            border-bottom: 2px solid @color-primary;
        }
        &:hover {
            background: none;
            color: white;
        }
    }
</style>