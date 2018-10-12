<template>
    <a :class="colorClass" @click="select">
        <slot></slot>
    </a>
</template>

<script>
    export default {
        name: "ColorTag",

        props: ['color_class', 'task'],

        methods: {
            select() {
                this.task.color_class = this.color_class;
            }
        },

        computed: {
            colorClass() {
                return `tag ${this.color_class}` + (this.color_class === this.task.color_class ? ' is-active' : '');
            }
        }
    }
</script>

<style lang="less" scoped>
    .tag.is-active {
        font-weight: bold;
    }
</style>