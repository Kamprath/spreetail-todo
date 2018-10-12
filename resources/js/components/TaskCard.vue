<template>
    <div :class="classString" @click="handleClick">
        <p class="title">{{ task.title }}</p>
        <p class="subtitle" v-if="task.description">{{ task.description }}</p>
    </div>
</template>

<script>
    import {EventBus} from '../eventbus';

    export default {
        name: 'TaskCard',

        props: ['task'],

        methods: {
            /**
             * Handle click event on tile/card
             */
            handleClick() {
                EventBus.$emit('show-modal', this.task, this.updateTask)
            },

            /**
             * Emit event to update the task
             * @param task
             */
            updateTask(task) {
                EventBus.$emit('update-task', task);
            }
        },

        computed: {
            classString() {
                return `tile notification ${this.task.color_class}`;
            }
        },
    }
</script>

<style lang="less" scoped>
    .tile {
        padding: 1em;
        margin-bottom: .3em;
        display: block;
        transition: box-shadow 120ms linear;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0);

        &:hover {
            cursor: pointer;
            box-shadow: 0 1px 8px rgba(0, 0, 0, 0.5);
        }
    }
    .title {
        font-size: 1.35em;
    }
    .subtitle {
        font-size: 1em;
    }
</style>