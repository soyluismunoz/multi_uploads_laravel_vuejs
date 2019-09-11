

require('./bootstrap');

window.Vue = require('vue');
import store from './store/index';
import ElementUi from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUi);


Vue.component('all-posts', require('./components/AllPosts.vue').default);
Vue.component('create-post', require('./components/CreatePosts.vue').default);


const app = new Vue({
    store,
    el: '#app'
});

