<template>
    <div class="container">
        <h1>Contct Us</h1>

        <div class="row">
            <div class="col-md-6">
                <h4>BoolPress</h4>
                <div>Lorem ipsum street, 99</div>
                <div>Ipsum, IT</div>
            </div>
            <div class="col-md-6">
                <div v-show="success"  class="alert alert-success" role="alert">
                    Messaggio inviato correttamente.
                </div>
                <h2 class="mb-4">Get it  touch with the form below</h2>

                <form @submit.prevent="postForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name" v-model="name">
                        <div
                            v-for="(error, i) in errors.name"
                            :key="`err-name-${i}`"
                            class="text-danger"
                        >
                            {{ error }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="name" class="form-control" id="email" v-model="email">
                        <div
                            v-for="(error, i) in errors.email"
                            :key="`err-email-${i}`"
                            class="text-danger"
                        >
                            {{ error }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" v-model="message"></textarea>
                        <div
                            v-for="(error, i) in errors.message"
                            :key="`err-message-${i}`"
                            class="text-danger"
                        >
                            {{ error }}
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">send</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Contact',
    data() {
        return {
            name: '',
            email: '',
            message: '',
            errors: {},
            success: false,
        }
    },
    methods: {
        postForm() {
            axios.post('http://127.0.0.1:8000/api/contacts', {
                name: this.name,
                email: this.email,
                message: this.message,
            })
            .then(res => {
                if(res.data.errors) {
                    this.errors = res.data.errors;
                    this.success = false;
                } else {
                    this.name = '';
                    this.email = '';
                    this.message = '';

                    // feedback
                    this.errors = {};
                    this.success = true;
                }
            })
        }
    }
}
</script>

<style>

</style>