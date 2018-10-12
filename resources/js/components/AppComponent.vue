<template>
    <div>
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="https://bulma.io">
                    <img src="/svg/spreetail_logo.svg">
                </a>
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
                    <a class="navbar-item is-active">
                        To Do
                    </a>

                    <a class="navbar-item">
                        In Progress
                    </a>

                    <a class="navbar-item">
                        Done
                    </a>
                </div>
            </div>
        </nav>

        <section class="section">
            <button class="button is-primary is-fullwidth" @click="handleAddTaskClick">Add Task</button>
        </section>

        <task-modal></task-modal>
    </div>
</template>

<script>
    // import Bulma CSS framework (https://bulma.io/)
    import 'bulma/css/bulma.css';
    import Task from '../models/Task';
    import {EventBus} from "../eventbus";

    export default {
        name: 'AppComponent',

        props: ['taskdata'],

        data() {
            return {
                tasks: this.taskdata,
                isMenuActive: false
            }
        },

        methods: {
            handleAddTaskClick() {
                const task = new Task();

                // call method to show dialog, passing it a blank Task object
                EventBus.$emit('show-modal', task, this.updateTask)
            },

            handleBurgerClick() {
                this.isMenuActive = !this.isMenuActive;
            },

            showTaskModal(task) {

            },

            updateTask(task) {
                console.log('updateTask()', task);
                // iterate through tasks

                // if id matches task, replace object in array and return

                // otherwise add task to array
            }
        },

        computed: {
            burgerClass() {
              return 'navbar-burger burger' + (this.isMenuActive ? ' is-active' : '');
            },

            navbarMenuClass() {
                return 'navbar-menu' + (this.isMenuActive ? ' is-active' : '');
            }
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