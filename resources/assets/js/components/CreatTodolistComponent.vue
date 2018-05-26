<template>

	<div class="todolist">
		<div class="create">
			<h1>Create Todolist</h1>
			<div class="alert alert-danger" v-if="errors.length > 0">
				<ul>
					<li v-for="error in errors">{{ error }}</li>
				</ul>
			</div>
			<div class="col-8 mx-auto" >
				<div class="input-group">

					<input type="text" v-model="todolist.list_name" class="form-control" id="todo" name="list_name">

					<span><button  @click="saveTodo"  class="btn btn-info" style="background-color: #307e80;">Submit</button></span>

				</div>
				


			</div>

		</div>
		
		<div class="row">


			<div class="column1" id="scroll">
				<p style="float:right"><form class="form-inline my-2 my-lg-0">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
				</form></p>
				<h1 class="text-center">Todolist</h1>
				

				<transition-group name="list" tag="p">
					<div v-for="todolist,index in lists" :key="index" class="card" >
						<div class="card-header" style="background-color: #307e80;" >
							{{todolist.created_at | readableDate}}

						</div>
						<div class="card-body">

							<p class="list-item">

								{{todolist.list_name}}
							</p>


							<div style="margin-buttom:5px">
								<button  @click="initUpdate(index)" title="Edit todo"  data-toggle="modal" data-target="#edittodolist" ><i class="fa fa-edit"></i></button>

								<button v-on:click="destroytodolist(index)"  title="Delete todo" ><i class="fa fa-trash" ></i></button>

								<button title="Share todolist" ><i class="fa fa-share"></i></button>

								<button v-on:click="showTodo(todolist.id)"data-toggle="modal" data-target=".bd-example-modal-lg" style="float:right; margin-right:5px" >View todos</button>
								


							</div>

						</div>



					</div>
				</transition-group>
				
			</div>

		</div>



		

		<!-- Modal to view todos-->
		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Todos</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">

						<!-- <div class="card" v-for="todo,index in todos" :key="index" >
							<div class="card-header1" style="padding-left:20px; float:right" >


								{{todo.title}}
								
							</div>


						</div> -->
						
						<table id="customers">
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Description</th>
								<th>Actions</th>
							</tr>

							<tr v-for="todo,index in todos" :key="index" >


								<td>{{index + 1}}</td>
								<td>{{ todo.title }}</td>
								<td>{{ todo.description }}</td>
								<td>


									

									<button @click="initUpdatetodo(index)" title="Edit todo"  data-toggle="modal"  ><i class="fa fa-edit"></i></button>

									<button v-on:click="destroytodo(index)"  title="Delete todo"  ><i class="fa fa-trash" ></i></button>

								</td>
							</tr>

						</table>

						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

						</div>
					</div>
				</div>
			</div>
		</div>
		
		



		<!-- Modal to edit todolist-->

		<div class="modal fade" id="edittodolist" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit todolist</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="input-group">

							<input type="text" class="form-control" id="todo" name="list_name"  v-model="update_todolist.list_name">

						</div>

					</div>
					<div class="modal-footer">
						<button type="button"  @click="updateTodolist"  class="btn btn-info">Save changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>

		</div>



		<!-- Modal to edit todo-->
		<div class="modal fade" id="edittodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Edit todo</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body" style="text-align:left">
						<label><b>Title</b></label>
						<div class="form-group">

							<input type="text" class="form-control" name="title"  v-model="update_todo.title">

						</div>
						
						
						<div class="form-group">

							<label><b>Description</b></label>
							<textarea type="text"  name="description" class="form-control" v-model="update_todo.description">
							</textarea>	
						</div>


					</div>
					<div class="modal-footer">
						<button type="button"  @click="updateTodo"  class="btn btn-info">Save changes</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>

		</div>


	</div>
</template>

<script src="vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript">

export default {
	//name: 'creattodolist',
	props: ['todo'],

	data() {
		return {
			todolist:{
				id: '',
				list_name: '',
				created_at: ''
			},


			index: null,
			update_index: '',
			update_todolist: {},
			lists: [],

			update_todo: {},
			todos: [],
			errors: [],
			show: true,
			search: '',


		}
	},
	mounted() {
		console.log('Component mounted.')
	},
	created: function() {
//let uri = 'http://localhost//:8000/todos/' + this.$route.params.id

axios.get('/vueitems')
.then((response) => {
	this.lists = response.data
	console.log('trying to list todolist')
	console.log(response)
})
.catch((error) => {

})

},
methods:{

	saveTodo() {
		let vm = this;
		axios.post('creattodolist', {
//id: this.todolist.id,
list_name: this.todolist.list_name,

})
		.then((response) => {
// Handle successful response creattodolist
console.log(response.data)
vm.lists.unshift(response.data.todolist)
vm.todolist = {}


})
		.catch((error) => {
// Handle error
if (error.response.data.errors.list_name) {
	vm.errors.push(error.response.data.errors.list_name[0]);
}

})



	}, 


	destroytodolist: function(index) {
		axios.delete('/todolist/' + this.lists[index].id)
		.then(response => {
			this.lists.splice(index, 1);
//this.lists.splice(this.randomIndex(), 1)
swal(
	'Deleted!',
	'Your todolist has been successfully deleted.',
	'success'
	);
//this.closeModal();
})
		.catch(error => {

		});
	}, 

	destroytodo: function(index) {
		axios.delete('/todo/' + this.todos[index].id)
		.then(response => {
			this.todos.splice(index, 1);
//this.lists.splice(this.randomIndex(), 1)
swal(
	'Deleted!',
	'Your todo has been successfully deleted.',
	'success'
	);
//this.closeModal();
})
		.catch(error => {

		});
	}, 


	initUpdate(index)
	{
		this.errors = [];
		$("#edittodolist").modal("show");
		this.update_todolist = this.lists[index];
	},
	updateTodolist() {
		let vm1 = this;
		axios.patch('/todolist/' + vm1.update_todolist.id, {


			list_name: vm1.update_todolist.list_name,

		})
		.then(response => {
			$("#edittodolist").modal("hide");
			vm1.closeModal();
		})
		.catch(error => {
			vm1.errors = [];
			if (error.response.data.errors.list_name) {
				vm1.errors.push(error.response.data.errors.list_name[0]);
			}


		});
	}, 

	showTodo(id) {
		axios.get(`/todos/${id}`)
		.then((response) => {
			this.todos = response.data

			console.log(response)
		})
		.catch((error) => {

		})
	},

	initUpdatetodo(index)
	{
		this.errors = [];
		$("#edittodo").modal("show");
		this.update_todo = this.todos[index];
	},

	updateTodo() {
		let vm1 = this;
		axios.patch('/todo/' + vm1.update_todo.id, {

			title: vm1.update_todo.title,
			description: vm1.update_todo.description,


		})
		.then(response => {
			$("#edittodo").modal("hide");
			vm1.closeModal();
		})
		.catch(error => {
			vm1.errors = [];
			if (error.response.data.errors.title) {
				vm1.errors.push(error.response.data.errors.title[0]);
			}
			if (error.response.data.errors.description) {
				this.errors.push(error.response.data.errors.description[0]);
			}


		});
	},
},



computed: {
	filteredList() {
		var self=this;
		return self.todolist.filter(todolist => {
			return todolist.list_name.toLowerCase().includes(self.search.toLowerCase())
			
		})
	}
}





}
</script>
