<template>
    <div class="container mt-5">
        <div v-if="post != null">
            <h1>{{ post.title }}</h1>
            <span>Category: {{ post.category.name }}</span>
            <p>{{ post.content }}</p>
            <Tags :list="post.tags"/>
        </div>
        <div class="spinner-border" role="status" v-else>
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Tags from '../components/Tags.vue';

export default {
    name: 'PostDetail',
    components: {
        Tags,
    },
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