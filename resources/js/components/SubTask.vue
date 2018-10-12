<template>
    <label class="checkbox">
        <input type="checkbox" v-model="subtask.is_complete">
        <slot></slot>
    </label>
</template>

<script>
    export default {
        name: "SubTask",
        props: ['subtask']
    }
</script>

<style scoped>

</style>