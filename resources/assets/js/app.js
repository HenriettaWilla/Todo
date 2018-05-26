import m from 'moment';
import Vue from 'vue';
import VueRouter from 'vue-router';
import swal from 'sweetalert';
import CreatTodolistComponent from './components/CreatTodolistComponent.vue';
import CreateTodoComponent from './components/CreateTodoComponent.vue';
import EditTodolist from './components/EditTodolist.vue';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 require('./bootstrap');

 window.Vue = require('vue');
 Vue.use(VueRouter);

 var routes = [
 {
 	path: '/create',

 	component: CreateTodoComponent	
 }];

 var router = new VueRouter({
 	routes: routes
 });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.component('example-component', require('./components/ExampleComponent.vue'));

 Vue.component('creattodolist', require('./components/CreatTodolistComponent.vue'));
 Vue.component('create-todo', require('./components/CreateTodoComponent.vue'));


 

 Vue.filter('readableDate', (dateTime) => {
 	console.log(dateTime)
 	return m(dateTime, 'YYYY-MM-DD h:mm:ss').format('LLLL');
 	

 })
 const app = new Vue({
 	el: '#app',
 	router: router,
 	data: {
 		'todolists': [],
 		'todos': []
 		
 	},
 	



 })
 
