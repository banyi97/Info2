<template>
    <div class="container mt-2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div v-if="met == 'create'">
                        <div class="card-header">Create new artist</div>
                        <div class="card-body">
                            <form @submit.prevent="create">
                                <div class="form-group">
                                    <label for="artistName">Artist name</label>
                                    <input v-model.trim="artist.name" type="text" required class="form-control" id="artistName" placeholder="Name of artist">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="pic">Image</label><br>
                                    <img :src="view_pic" alt="" class="img-responsive" height="200" width="200">
                                    <input type="file" name="pic" ref="artistpic" id="image" v-on:change="onImageChange" accept="image/jpeg, image/png">
                                </div>
                                    <button @click="create" class="btn btn-primary">Create</button>
                                    <a class="btn btn-primary" :href="'/home'">Home page</a>
                            </form>
                        </div>                       
                    </div>
                    
                    <div v-if="met == 'modify'">
                        <div class="card-header">Modify artist</div>
                        <div class="card-body">
                            <form @submit.prevent="modify">
                                <div class="form-group">
                                    <label for="artistName">Artist name</label>
                                    <input v-model.trim="artist.name" type="text" class="form-control" id="artistName" aria-describedby="emailHelp" placeholder="Artist name">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="pic">Image</label><br>
                                    <img :src="view_pic" alt="" class="img-responsive" height="200" width="200">
                                    <input type="file" name="pic" ref="artistpic" id="image" v-on:change="onImageChange" accept="image/jpeg, image/png">
                                </div>                
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a :href="'/artists/'+partist.id">Back to artist page</a>
                            </form>
                        </div>
                    </div>                   

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        data: function () {
            return {
               view_pic: null,
               pic_file: null,
               artist: {
                   name : '',
               },
               sended : false,
            }           
        },
        mounted() {
        },
        props: {
            met: String,
            partist: {
                id: Number,
                name: String,
                pic_url: String,
            }
        },
        created: function () {
            if(this.met === 'modify'){
                this.artist.name = this.partist.name;
                this.view_pic =  '/storage/' + this.partist.pic_url;
            }
        },
        methods: {
            create(){  
                if(this.sended == true){
                    return;         }
                if(this.artist.name == null || this.artist.name == ''){
                    return;
                }
                this.sended = true;
                console.log('start');
                axios.post('/artists/', {artist: this.artist}).then(resq => {
                    console.log('res ' + resq.data.success)
                    if(this.pic_file == null){
                        window.location.href = "/artists/" + resq.data.success; 
                        return;
                    }  
                    else{
                        console.log('file is not null')
                        const id = resq.data.success;
                        let fdata = new FormData();
                        fdata.append('photo', this.pic_file);
                        axios.post(
                            '/upload/artistpic/' + id, 
                            fdata,
                            {
                                headers: { "Content-Type": "multipart/form-data" }                          
                            }).then(res => {
                                if(res.data.success){
                                    console.log(res.data.success)
                                    window.location.href = "/artists/" + resq.data.success;
                                }
                            }).catch(error =>{
                                    console.log(error);
                                    this.sended = false;
                                    return;
                            })
                    }
                }).catch(error => {
                    console.log(error)
                    this.sended = false;
                    return;
                })          
            },
            modify(){
                if(this.sended == true){
                    return;         }
                if(this.artist.name == null || this.artist.name == ''){
                    return;
                }
                this.sended = true;
                console.log('start');
                axios.put('/artists/' + this.partist.id, {artist: this.artist}).then(resq => {
                    console.log('res ' + resq.data.success)
                    if(this.pic_file == null){
                        window.location.href = "/artists/" + this.partist.id; 
                        return;
                    }  
                    console.log('file is not null')
                    let fdata = new FormData();
                    fdata.append('photo', this.pic_file);
                    axios.post(
                        '/upload/artistpic/' + this.partist.id, 
                        fdata,
                        {
                            headers: { "Content-Type": "multipart/form-data" }                          
                        }).then(res =>{
                            console.log(res.data.success)
                            window.location.href = "/artists/" + this.partist.id;
                        }).catch(error =>{
                        console.log('File upload error: '+ error);
                        this.sended = false;
                        return;
                  })
                }).catch(error => {
                    console.log('Update error '+error)
                    this.sended = false;
                    return;
                })          
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;              
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.view_pic = e.target.result;
                    this.pic_file = this.$refs.artistpic.files[0];
                };
                reader.readAsDataURL(file);
            },
            
        }    
    }
    
</script>