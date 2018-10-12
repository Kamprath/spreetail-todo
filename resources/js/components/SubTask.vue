<template>
    <label :class="classString">
        <input type="checkbox" v-model="subtask.is_complete">
        <span><slot></slot></span>
    </label>
</template>

<script>
    export default {
        name: "SubTask",
        props: ['subtask'],
        computed: {
            classString() {
                return 'checkbox' + (this.subtask.is_complete ? ' is-complete' : '');
            }
        },
    }
</script>

<style lang="less" scoped>
    .checkbox {
        display: block;

        &:last-of-type {
            margin-bottom: 1em;
        }
    }
    input, span {
        vertical-align: middle;
        line-height: 1em;
    }
    .is-complete span {
        color: #888;
        text-decoration: line-through;
    }
</style>