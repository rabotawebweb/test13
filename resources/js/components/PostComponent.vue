<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
				<strong>Комментарии к статье</strong>
            </div>
        </div>
		<div class="row justify-content-center">
            <div class="col-md-8">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<div class="form-group">
						<input type="text" v-model="name" class="form-control" placeholder="Введите имя">
						<textarea rows="3" cols="45" v-model="comment" class="form-control">Оставьте свой комментарий</textarea>
						<input @click.prevent="addComment" type="submit" class="btn btn-primary" value="Добавить">
					</div>
				</div>
			</div>
			<div class="col-md-8">
                <CommentComponent></CommentComponent>
            </div>
        </div>
    </div>
</template>

<script>

	import CommentComponent from './CommentComponent.vue';
	
    export default {
		
		name: 'PostComponent',
		
		data() {
			return {
				name: null,
				comment: null,
			}
		},
		
		props: [
			'post_id',
		],
		
		components: {
			CommentComponent
		},
		
		methods: {
			addComment() {
				axios.post('/api/comments', {name: this.name, comment: this.comment, post_id: this.post_id, parent: 0})
					.then( res => {
						console.log(res),
						this.name = null,
						this.comment = null
					})
			}
		}
    }
</script>
