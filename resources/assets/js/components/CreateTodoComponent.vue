<template>
	<div>
		

		<div>

			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="card" style="margin-bottom: 11px; margin-top: 11px; ">
						<div class="card-header" style="color:#000000"><h2>Add todos</h2>
							<div class="alert alert-danger" v-if="errors.length > 0">
								<ul>
									<li v-for="error in errors">{{ error }}</li>

								</ul>
							</div></div>

							<div class="card-body1">


								<form @submit.prevent="todofxn">

									<div class="form-group">

										<select v-model='selectedtodolist_id'>
											<option disabled value="">Please select a todolist</option>
											<option v-for='todolist in todolists' :value='todolist.id'>{{todolist.list_name}}</option>
										</select>
									</div>

									<div class="form-group">

										<label>Title</label>
										<input type="text"  id="name" name="title" class="form-control" v-model="todo.title">
									</div>
									<div class="form-group">

										<label>Description</label>
										<textarea type="text"  id="name" name="description" class="form-control" v-model="todo.description">
										</textarea>	
									</div>



									<div class="form-group">
										<button type="submit" @click="saveTodos" class="btn btn-light btn-lg btn-block" style="background-color: #307e80">Submit</button>

									</div>

								</form> 



							</div>
						</div>
					</div>

				</div>
			</div>

			<div>



			</div>


		</div>
	</template>

	<script type="text/javascript">

	export default {


		props: ['todolist'],


	//name: 'create-todo',

	data: function(){
		return{
			todo: {

				title: '',
				description: '',
				todolist_id: ''
			},
			todos: [],
			todolists: '',
			errors: [],
			selectedtodolist_id: ''
			
		}
	},
	mounted() {
		console.log('Component mounted.')
	},
	created: function() {

		axios.get('/vueitems')
		.then((response) => {
			this.todolists = response.data
			console.log('trying to list todolist')
			console.log(response)
		})
		.catch((error) => {

		});
	}, 

	methods:{
		todofxn: function(){
			this.$emit('todo-create', this.todo);
			this.todo='';

		},

		saveTodos() {
			let vm = this;
			axios.post('/todo/store', {
				title: this.todo.title,
				description: this.todo.description,
				todolist_id: this.selectedtodolist_id,
			})
			.then(response => {
				this.reset();
				this.todos.push(response.data.todo);
				swal(
					'Created!',
					'Your Todo has been successfully created.',
					'success'
					)


			})
			
			.catch((error) => {
				          // Handle error
				          //console.log(error)
				          this.errors = [];
				          if (error.response.data.errors.title) {
				          	this.errors.push(error.response.data.errors.title[0]);
				          }

				          if (error.response.data.errors.description) {
				          	this.errors.push(error.response.data.errors.description[0]);
				          }
				          if (error.response.data.errors.todolist_id) {
				          	this.errors.push(error.response.data.errors.todolist_id[0]);
				          }
				      })

		},

		destroytodo: function(index) {
			axios.delete('/todo/' + this.todos[index].id)
			.then(response => {
				this.todos.splice(index, 1);
				swal(
					'Deleted!',
					'Your todo has been deleted.',
					'success'
					);
					//this.closeModal();
				})
			.catch(error => {

			});
		}, 





	} 

}
</script>