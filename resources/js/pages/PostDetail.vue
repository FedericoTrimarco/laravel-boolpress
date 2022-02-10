<template>
  <div class="container mt-5">
      <div v-if="post != null">
        <h1>{{ post.title }}</h1>
        <span>Category: {{ post.category.name }}</span>
        <p>{{ post.content }}</p>
        <span v-for="tag in post.tags" :key="`tag-${tag.id}`" class="badge bg-primary me-2">{{ tag.name }}</span>
    </div>
    <span v-else>lello</span>
  </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'PostDetail',
    data() {
        return {
            post: null,
        }
    },
    created(){
        this.getPostDetail();
    },
    methods: {
        getPostDetail() {
            axios.get(`http://127.0.0.1:8000/api/posts/${this.$route.params.slug}`)
                .then(res => {
                    if (res.data.not_found) {
                        this.$router.push({ name: 'not-found'})
                    } else {
                        this.post = res.data;
                    }
                })
                .catch(err => log.error(err));
        }
    }
}
</script>

<style>

</style>