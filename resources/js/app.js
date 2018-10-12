
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('app-component', require('./components/AppComponent'));
Vue.component('task-modal', require('./components/TaskModal'));
Vue.component('tasks-section', require('./components/TasksSection'));
Vue.component('task-card', require('./components/TaskCard'));
Vue.component('sub-task', require('./components/SubTask'));
Vue.component('color-tag', require('./components/ColorTag'));

const app = new Vue({
    el: '#app'
});
