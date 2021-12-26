<template>
<div>
    <main>

        <section v-if="articles" class="articles container pt-5">
            <h2><i class="fa fa-tag  fa-rotate-90 tag_icon"></i> {{tag.name}} </h2>
            <div v-for="article in articles" :key="article.id" class="row article" style="padding-left: 63px">
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
                            <div class="article-footer">

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
                    description:'',
                    tags:'',
                    images:''
                },

                articles:{},
                tag:{}

            }
        },

        methods: {
            getArticles()
            {
                axios.get('http://127.0.0.1:8000/api/articles/tag/'+ this.$route.params.slug).then(response =>{
                    if (response.data.status == true){
                        this.articles = response.data.data;
                        this.tag = response.data.tag;
                    }

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
