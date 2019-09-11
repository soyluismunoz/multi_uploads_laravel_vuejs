<template>
    <div class="card mt-4">
        <div class="card-header">
            New Post
        </div>
        <div class="card-body">
            <div class="alert" v-if="status_msg" :class="{'alert-sucess': status, 'alert-danger': !status}" role="alert">
                {{ status_msg }}
            </div>
            <form>
                <div class="form-group">
                  <label for="title">Title</label>
                  <input v-model="title" type="text" name="title" id="title" class="form-control" placeholder="post title" required>
                </div>
                <div class="form-group">
                  <label for="postbody">post content</label>
                  <textarea v-model="body" class="form-control" name="postbody" id="postbody" rows="3"></textarea>
                </div>
                <div class="">
                    <el-upload action="/" list-type="picture-card" 
                    :on-preview="handlePictureCardPreview"
                    :on-change="updateImageList"
                    :auto-upload="false">
                        <i class="el-icon-plus"></i>
                    </el-upload>
                    <el-dialog :visible.sync="dialogVisible">
                        <img :src="dialogImageUrl" class="img-thumbnail">
                    </el-dialog>
                </div>
            </form>
        </div>
        <div class="card-footer">
            <button @click="createPost" type="button" class="btn btn-success">
                {{ isCreatingPost ? 'Posting...' : 'Create post'}}
            </button>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
import { setTimeout } from 'timers';
export default {
    name: 'created-post',
    props: ['posts'],
    data() {
        return {
            dialogImageUrl: '',
            dialogVisible: false,
            imageList: [],
            status_msg: '',
            status: '',
            isCreatingPost: false,
            title: '',
            body: '',
        };
    },
    computed:{
        ...mapActions(['getAllPosts']),
    },
    methods:{
        updateImageList(file){
            this.imageList.push(file.raw);
        },
        handlePictureCardPreview(file){
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },
        showNotification(message){
            this.status_msg = message;
            setTimeout(() => {
                this.status_msg = '';
            }, 3000);
        },
        validateForm(){
            if (!this.title){
                this.status = false;
                this.showNotification('post title cannot be empty');
                return false;
            }
            if (!this.body){
                this.status = false;
                this.showNotification('post body cannot be empty');
                return false;
            }
            if(this.imageList.length < 1 ){
                this.status = false;
                this.showNotification('please select image');
                return false;
            }
            return true;
        },
        createPost(e){
            e.preventDefault();
            if(!this.validateForm()){
                return false;
            }

            this.isCreatingPost = true;
            let formData = new FormData();

            formData.append('title', this.title);
            formData.append('body', this.body);

            $.each(this.imageList, function(key, image){    
                formData.append(`images[${key}]`, image);
            });

            api.post('/post/create_post', formData, {headers: {'Content-type': multipart/form-data}})
            .then((res) => {
                this.title = this.body = '';
                this.status = true;
                this.showNotification('post created succesfully');
                this.isCreatingPost = false;
                this.getAllPosts(); 
            });
        },
    }
}
</script>