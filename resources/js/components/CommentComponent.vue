<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
			
				<a href="#" @click.prevent="getComments('desc')" :class="sorting == 'desc' ? 'active' : ''">Сначала свежие</a> | 
				<a href="#" @click.prevent="getComments('asc')" :class="sorting == 'desc' ? '' : 'active'">Сначала старые</a>
                
				<div class="card" v-for="comment in comments">
				  <div class="card-body">
					<div class="card-name"><strong>{{ comment.name }}</strong></div>
					<div class="card-text">{{ comment.content }}</div>
					<button :class="answers[comment.id] ? 'card-answers d-none' : 'card-answers'" @click="getAnswers(comment.id)">ответы: ({{ comment.answers }})</button>
					
					<div class="card" v-for="answer in answers[comment.id]">
					  <div class="card-body">
						<div class="card-name"><strong>{{ answer.name }}</strong></div>
						<div class="card-text">{{ answer.content }}</div>
					  </div>
					</div>
					
					<div :class="answers[comment.id] ? '' : 'd-none'">
						<div class="form-group">
							<input type="text" v-model="name[comment.id]" class="form-control" placeholder="Введите имя">
							<textarea rows="3" cols="45" v-model="answercom[comment.id]" class="form-control">Оставьте свой комментарий</textarea>
							<input @click.prevent="addAnswer(comment.id)" type="submit" class="btn btn-primary" value="Добавить">
						</div>
					</div>
				
				  </div>
				</div>
				
            </div>
        </div>
    </div>
</template>

<script>
    export default {
		
		name: 'CommentComponent',
		
		data() {
			return {
				sorting: 'desc',
				comments: null,
				answers: [],
				name: [],
				answercom: [],
			}
		},
		
        mounted() {
            this.getComments(this.sorting)
        },
		
		methods: {
			getComments(sort) {
				this.sorting = sort;
				axios.get('/api/comments/'+this.$parent.post_id+'/'+sort)
					.then( res => {
						this.comments = res.data
					})
			},
			getAnswers(id) {
				axios.get('/api/answers/'+id)
					.then( res => {
						this.answers[id] = res.data
					})
			},
			addAnswer(id) {
				axios.post('/api/comments', {name: this.name[id], comment: this.answercom[id], post_id: this.$parent.post_id, parent: id})
					.then( res => {
						console.log(res),
						this.name[id] = null,
						this.answercom[id] = null
					})
			}
		}
    }
</script>


<style scoped>

.active { text-decoration: none; color: #000; }

</style>