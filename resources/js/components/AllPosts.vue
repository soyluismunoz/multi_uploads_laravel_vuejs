<template>
    <div class="row">
        <div class="col-md-6" v-for="(post, i) in posts" :key=i>
            <div class="card mt-4">
                <img class="card-img-top" v-if="post.post_images.length" :src="post.post_images[0].post_image_path" :alt="post.post_images[0].post_image_caption">
                <div class="card-body">
                    <h4>{{ post.title}}</h4>
                    <p class="card-text">
                        {{ truncateText(post.body) }}
                    </p>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-block btn-primary" @click="viewPost(i)">Ver Mas</button>
            </div>
        </div>
        <el-dialog v-if="currentPost" :visible.sync="postDialogVisible" width="50%">
            <span>
                <h3>{{ currentPost.title }} </h3> 
                <div class="row">
                    <div class="col-md-6" v-for="(img, i) in currentPost.post_images" :key=i>
                        <img class="img-thumbnail" src="img.post_image_path" alt="">
                    </div>
                </div>
                <hr>
                <p> {{ currentPost.body }} </p>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button type="primary" @click="postDialogVisible">okay</el-button>
            </span>
        </el-dialog>
    </div>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name: 'all-posts',
        data()  {
            return {
                postDialogVisible: false,
                currentPost: '',
            };
        },
        computed: {
            ...mapState(['posts'])
        },
        beforeMount(){
            this.$store.dispatch('getAllPosts');
        },
        methods: {
            truncateText(text) {
                if(text.length > 24) {
                    return `${text.substr(0, 24)}...`;
                }
                return text;
            },
            viewPost(postIndex){
                const post = this.post[postIndex];
                this.currentPost = post;
                this.postDialogVisible = true;
            }
        },
    }
</script>
