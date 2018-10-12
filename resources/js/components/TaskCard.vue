<template>
    <article class="tile notification is-primary">
        <p class="title">{{ task.title }}</p>
        <p class="subtitle" v-if="task.description">{{ task.description }}</p>
    </article>
</template>

<script>
    export default {
        name: 'TaskCard',

        props: ['task']
    }
</script>

<style lang="less" scoped>
    .tile {
        padding: 1em;
        margin-bottom: .3em;
        display: block;
    }
    .title {
        font-size: 1.35em;
    }
    .subtitle {
        font-size: 1em;
    }
</style>