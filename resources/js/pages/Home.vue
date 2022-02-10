<template>
    <div class="container">
        <h1 class="my-5">Our Blog</h1>

        <div v-if="posts">
            <article
                class="mb-4 card p-2"
                v-for="post in posts" :key="`post-${post.id}`"
            >
                <h2>{{ post.title }}</h2>
                <div class="mb-4">{{ formatData(post.created_at) }}</div>
                <p>{{ getExcerpt(post.content, 50) }}</p>
                <div>
                    <router-link class="btn btn-primary" :to="{name: 'postDetail'}">View Deatils</router-link>
                </div>
            </article>

            <button
                @click="getPosts(pagination.current - 1)"
                :disabled="pagination.current === 1"
                class="btn btn-primary"
            >
                Prev
            </button>

            <button
                v-for="i in pagination.last" :key="`page-${i}`"
                @click="getPosts(i)"
                class="btn mx-1"
                :class="pagination.current === i ? 'btn-primary' : 'btn-secondary'"
            >
                {{ i }}
            </button>

            <button
                @click="getPosts(pagination.current + 1)"
                :disabled="pagination.current === pagination.last"
                class="btn btn-primary"
            >
                Prev
            </button>
        </div>
        <div v-else>
            Loading posts...
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Home',
    components: {},
    data() {
        return {
            posts: null,
            pagination: null,
        }
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            axios.get(`http://127.0.0.1:8000/api/posts?page=${page}`)
                .then(res => {
                    this.posts = res.data.data;
                    this.pagination = {
                        current: res.data.current_page,
                        last: res.data.last_page,
                    }
                })
        },
        getExcerpt(text, maxLenght) {
            if (text.length > maxLenght) {
                return text.substr(0, maxLenght) + '...';
            }
            return text;
        },
        formatData(postDate) {
            const date = new Date(postDate);

            const formatted = new Intl.DateTimeFormat('it-IT').format(date);
            
            return formatted;
        },
    }
}
</script>

<style lang="scss">
</style>