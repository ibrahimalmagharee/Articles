<template>
    <div>

        <main>
            <section v-if="articles" class="articles container pt-5">

                <div v-for="article in articles" :key="article.id" class="row article">
                    <div class="w-50 my-2">
                        <div class="d-flex justify-content-start">
                        </div>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-8">
                                <router-link class="text-decoration-none" :to="'/article/'+ article.slug">

                                    <h3 class="bold text-dark">{{article.title}}</h3>
                                    <p class="description" style="color: black">
                                        {{article.short_description}}
                                    </p>

                                </router-link>
                                <div v-if="article.tags" class="article-footer">
                                    <div v-for="tag in article.tags">
                                        <router-link class="tag m2-2 mt-sm-2 me-1" :to="'/articles/tag/'+ tag.slug"> {{tag.name}}</router-link>

                                    </div>



                                    <small class="text-secondary mx-2 pt-2">Popular in Meduim</small>

                                </div>
                            </div>
                            <div v-if="article.images[0]" class="col-4">
                                <router-link class="text-decoration-none" :to="'/article/'+ article.slug">

                                    <img :src="getPhoto()+article.images[0].photo" class="article-img" alt="">
                                </router-link>

                            </div>
                        </div>
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
                article:{
                    id:'',
                    title:'',
                    slug:'',
                    short_description:'',
                    tags:'',
                    images:''
                },

                articles:{},

            }
        },

        methods: {
            getArticles()
            {
                axios.get('api/articles/').then(response =>{
                    this.articles = response.data.data
                })
            },

            getPhoto()
            {
                return 'http://127.0.0.1:8000/assets/images/article/';

            },


        },
        created(){
            this.getArticles();
        }

    }
</script>

<style scoped>

</style>
