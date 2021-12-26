<template>
    <div>
        <main>
            <section class="container pt-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3>Login</h3>
                        <div class="form-group mt-2">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" v-model="user.email" placeholder="Enter email">
                            <span class="form-text text-danger" v-if="errors.email">{{errors.email[0]}}</span>
                        </div>
                        <div class="form-group mt-2">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" v-model="user.password" placeholder="Password">
                            <span class="form-text text-danger" v-if="errors.password">{{errors.password[0]}}</span>
                        </div>

                        <button class="btn btn-primary mt-2" @click="login">Login</button>
                    </div>
                </div>


            </section>
        </main>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                user:{
                    email:'',
                    password:'',
                },

                errors: [],
            }
        },

        methods:{
            login(){
                axios.post('api/login', this.user).then(response =>{
                    if (response.data.status === true) {
                        toastr.success(response.data.msg);
                        this.errors = [];
                        this.user = {
                            email:'',
                            password:'',
                        }
                        this.$router.push('articles');
                    }
                    else if(response.data.status === false) {
                        this.errors = response.data.errors
                    }
                    else if(response.data.status === 'data_error') {
                        toastr.error(response.data.msg);
                    }

                })
            }
        }
    }
</script>

<style scoped>

</style>
