<template>
    <section class="section" v-if="tasks.length > 0">
        <div class="container">
            <h5 class="subtitle is-5">
                <slot></slot>
            </h5>

            <task-card v-for="task in tasks"
                       :task="task"
                       :key="task.id">
            </task-card>
        </div>
    </section>
</template>

<script>
    export default {
        name: "TasksSection",
        props: ['tasks']
    }
</script>

<style lang="less" scoped>
    .section {
        padding-top: 0;
    }
    .subtitle {
        margin-bottom: .5em;
    }
</style>