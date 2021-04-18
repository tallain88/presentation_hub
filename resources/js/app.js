/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Base
Vue.component('panel', require('./components/common/panel.vue').default);

// Splash Page Components
Vue.component('splash-demo', require('./components/SplashPage/Demo.vue').default);
Vue.component('splash-controls', require('./components/SplashPage/Actions.vue').default);

// Presentation
Vue.component('presentation-controls', require('./components/Presentation/Controls.vue').default);
Vue.component('presentation-effects', require('./components/Presentation/Effects.vue').default);
Vue.component('presentation-user-list', require('./components/Presentation/UserList.vue').default);
Vue.component('presentation-user-listing', require('./components/Presentation/UserListing.vue').default);
// Vue.component('presentation-reactions', require('./components/Presentation/Reactions.vue').default);
// Vue.component('presentation-video', require('./components/Presentation/Video.vue').default);
// Vue.component('presentation-chat', require('./components/Presentation/Chat.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
