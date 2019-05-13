<template>
    <div class="container-fluid">
        <div ref="vuemodal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new playlist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="createNewPlaylist">
                    <div class="form-group">
                        <label for="artistName">Playlist name</label>
                        <input v-model.trim="createPlaylist.name" type="text" class="form-control" id="artistName" aria-describedby="emailHelp" placeholder="Playlist name">
                    </div>
                    <div class="form-group">
                        <label for="pic">Image</label><br>
                        <img :src="createPlaylist.view_pic" alt="" class="img-responsive" height="200" width="200">
                        <input type="file" name="pic" ref="artistpic" id="image" v-on:change="onImageChange" accept="image/jpeg, image/png">
                    </div>                
                    <button type="submit" class="btn btn-primary">Submit</button> 
                    <div v-show="createPlaylist.isResult === true" class="alert alert-success" role="alert">
                        Created
                    </div> 
                    <div v-show="createPlaylist.isResult === false" class="alert alert-danger" role="alert">
                        ERROR
                    </div>   
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Ok</button>
            </div>
            </div>
        </div>
        </div>
    </div>    
</template>

<script>
import axios from 'axios'
    export default {
        props:{          
            playlists :{

            }
        },
        data: function(){
            return{
                createPlaylist:{
                    name: '',
                    view_pic: '',
                    pic_file: null,
                    isResult: null,
                },
            }
        },
        mounted() {
            $(this.$refs.vuemodal).on("hidden.bs.modal", this.resetModal) 
            console.log('playlists:')
            console.log(this.playlists)             
        },
        methods:{           
            resetModal(){
                this.createPlaylist.name = '';
                this.createPlaylist.view_pic = '';
                this.createPlaylist.pic_file = null;
                this.createPlaylist.isResult = null;
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
                    vm.createPlaylist.view_pic = e.target.result;
                    vm.createPlaylist.pic_file = this.$refs.artistpic.files[0];
                };
                reader.readAsDataURL(file);
            },
            createNewPlaylist(){
                axios.post('/playlists/', {playlist: this.createPlaylist.name}).then(resq => {       
                    this.createPlaylist.isResult = true;
                    this.playlists.playlist.push({id:resq.data.id, name:resq.data.name, pic_url: resq.data.pic_url})
                    
                    if(this.createPlaylist.pic_file == null){
                        return;
                    }  
                    let fdata = new FormData();
                    fdata.append('photo', this.createPlaylist.pic_file);
                    axios.post(
                        '/upload/playlists/' + resq.data.id, 
                        fdata,
                        {
                            headers: { "Content-Type": "multipart/form-data" }                          
                        }).then(res =>{
                            console.log(res.data)
                            this.playlists.playlist[this.playlists.playlist.length-1].pic_url=res.data.success;        
                        }).catch(error =>{
                        console.log('File upload error: '+ error);          
                        return;
                  })
                }).catch(error => {
                    console.log('Update error '+error)
                    this.createPlaylist.isResult = false;
                    return;
                })          
            },
        },
    }
</script>
