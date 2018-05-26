<template>

	<div class="container">

		<div class="row">

			<div class="column" id="scroll" style="background-color:#fff;">
				<h1 class="text-center" >Todolist</h1>


				

				<div v-for="todolist,index in lists" :key="index" class="card">
					<div class="card-header1" style="font-size:15px">
						<p><a v-bind:href="('/todo')" title="view todos" >{{todolist.list_name}}</a></p>
						{{todolist.created_at | readableDate}}
					</div>
					<div class="card-body">

						
						<button v-on:click="destroy(index)" title="Delete todolist" aria-hidden="true"><i class="fa fa-trash"></i></button>
						
						<button v-on:click="initUpdate(update_index)" title="Edit todolist"><i class="fa fa-edit"></i></button>
						<button title="Share todolist"><i class="fa fa-share"></i></button>
						

						
					</div>

				</div>


			</div>

		</div>

		<div id="updateTaskModal" class="modal">
			<div class="modal-background"></div>
			<div class="modal-card">
				<p>hello</p>
			</div>
		</div> <!-- /updateTaskModal -->

	</div>
</template>

<script>

export default {
	props: ['todolist'],
	data() {
		return {
			index: null,
			update_index: '',
			errors: [],
			update_task: {},
			lists: '',
		}
	},
	mounted() {
		console.log(this.lists);
		console.log('Component mounted.')
	},
	methods: {
			// removeData: function(index){
			// 	this.lists.splice(index, 1); 
			// 	axios.post('delete-todolist', index);

			// },
			closeModal() {
				$(".modal").removeClass("is-active");
			},

			destroy: function(index) {
				axios.delete('/todolist/' + this.lists[index].id)
				.then(response => {
					this.lists.splice(index, 1);
					swal(
						'Deleted!',
						'Your Todolist has been deleted.',
						'success'
						);
				})
				.catch(error => {

				});
			}, 
			initUpdate(update_index) {
				this.errors = [];
				$("#updateTaskModal").addClass("is-active");
				this.update_task = this.lists[update_index];
			},

			updateTask() {

				axios.patch('/todolist/update' + this.update_task.id, {

					list_name: this.update_task.list_name,

				})
				.then(response => {
					this.closeModal();
				})
				.catch(error => {
					this.errors = [];
					if (error.response.data.errors.lists) {
						this.errors.push(error.response.data.errors.lists[0]);
					}


				});
			}, 

		},
		
		created: function() {

			axios.get('/vueitems')
			.then((response) => {
				this.lists = response.data
				console.log('trying to list todolist')
				console.log(response)
			})
			.catch((error) => {

			})
		},

	}


	</script>
