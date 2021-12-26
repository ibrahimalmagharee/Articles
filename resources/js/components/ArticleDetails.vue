<template>
<div>
    <main>
        <section class="articles container pt-5">
            <div v-if="article" class="row article">
                <div class="w-50 my-2">
                    <h3 class="bold text-dark">{{article.title}}</h3>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="">
                            <div class="d-flex justify-content-between">
                            </div>


                            <div class="article-imgs p-3">
                                <div v-if="article.images[0]" class="w-lg-75 centering-img">
                                    <img :src="getPhoto()+article.images[0].photo" class="detail-article-img" id="expandedImg"  style="width:100%">
                                </div>

                                <div v-if="article.images"  class="d-flex w-lg-75 centering-img mt-5">

                                    <div v-for="image in article.images" class="col">
                                        <img :src="getPhoto()+image.photo" alt="" class="img-small" style="width:100%; padding-right: 15px">
                                    </div>

                                </div>
                            </div>
                            <p class="mt-4" v-html="article.description">
                            </p>

                            <div v-if="article.tags" class="article-footer">
                                <div v-for="tag in article.tags">
                                    <router-link class="tag m2-2 me-1" :to="'/articles/tag/'+ tag.slug"> {{tag.name}}</router-link>

                                </div>




                            </div>

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

            }
        },

        methods: {
            getArticleDetails()
            {
                axios.get('http://127.0.0.1:8000/api/article/'+ this.$route.params.slug).then(response =>{
                    if (response.data.status == true){
                        this.article = response.data.data
                    }

                })
            },

            getPhoto()
            {
                return 'http://127.0.0.1:8000/assets/images/article/';

            },

            myFunction(imgs) {
                var expandImg = document.getElementById("expandedImg");
                expandImg.src = imgs.src;
            }


        },
        created(){
            this.getArticleDetails();
        }

    }

</script>

<style scoped>

</style>
