<template>

	<div>
		<div class="row">

			<div class="column1" id="scroll">
				<h1 class="text-center" >Todos</h1>

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
							

							<button title="Edit todo"><i class="fa fa-edit"></i></button>

							<button v-on:click="destroytodo(index)" title="Delete todo"><i class="fa fa-trash"></i></button>

						</td>
					</tr>
					
				</table>
			</div>

		</div>
		<div id="updateTodo" class="modal">
			<div class="modal-background"></div>
			<div class="modal-card">
				
				<p>hello</p>
			</div>
		</div>
	</div>
</template>
<script>

export default {
	props: ['todo'],

	data() {
		return {
			
			todos: [],
			
			
		}
	},
	created: function() {

		axios.get('/todos')
		.then((response) => {
			this.todos = response.data
			
			console.log(response)
		})
		.catch((error) => {

		})
	}, 
	
	
	mounted() {
		console.log(this.todo);
		console.log('Component mounted.')
	},
	methods: {
		

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
		
	},
	


}


</script>