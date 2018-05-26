<template>

	<div class="container">


		<div class="row">
			<div class="column" style="background-color:#307e80;">
				<h1 class="text-center " >Create todolist</h1>
				<create-todo></create-todo>

			</div>

			<div class="column" style="background-color:#fff;">
				<todolist></todolist>
			</div>

		</div>

	</div>  



</template>

<script>
export default {
	mounted() {
		console.log('Component mounted.')
	}
}
</script>
