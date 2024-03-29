
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('album-component', require('./components/AlbumComponent.vue').default);
Vue.component('albumadmin-component', require('./components/AlbumAdminComponent.vue').default);
Vue.component('artist-component', require('./components/ArtistComponent.vue').default);
Vue.component('artistadmin-component', require('./components/ArtistAdminComponent.vue').default);
Vue.component('navmenu-component', require('./components/NavMenuComponent.vue').default);
Vue.component('search-component', require('./components/SearchComponent.vue').default);
Vue.component('player-component', require('./components/PlayerComponent.vue').default);
Vue.component('yourlib-component', require('./components/YourLibComponent.vue').default);
Vue.component('user-component', require('./components/UserComponent.vue').default);
Vue.component('admin-component', require('./components/AdminComponent.vue').default);
Vue.component('createplaylist-component', require('./components/CreatePlaylistComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});
