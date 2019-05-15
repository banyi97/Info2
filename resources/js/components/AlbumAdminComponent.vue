<template>
    <div class="container mt-2">
        <div class="row justify-content-left">         
            <div class="row">
                <div>
                    <img v-if="(view_pic && !ismodify) || (view_pic && ismodify)" :src="view_pic" class="img-responsive" height="200" width="200"> <br>
                    <img v-if="!view_pic && ismodify" :src="'/storage/'+album.pic_url" class="img-responsive" height="200" width="200"> <br>
                    <input type="file" name="pic" ref="albumpic" id="image" v-on:change="onImageChange" accept="image/jpeg, image/png" />
                </div>
                <div>
                    <div>
                        <h3>Title: <input v-model="album.title" type="text"> </h3>
                        <h6>Year: <input v-model="album.year" type="number" min="1900" :max="actualYear" step="1">  </h6>
                    </div>
                </div>
            </div>
           <div> 
               <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">File</th>
                            <th v-if="ismodify" scope="col">Upload file</th>
                            <th scope="col">Length</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>       
                    <draggable 
                        v-model="album.songs" 
                        tag="tbody" 
                        :disabled="!enabled" 
                        @start="dragging = true"
                        @end="dragging = false">
                        <tr v-bind:class="classObjectv2(index)" v-for="(item, index) in album.songs" :key="item.id">
                            <td scope="row">{{index +1}}</td>
                            <td><input v-model.trim="item.title" required type="text" placeholder="Title"></td>
                            <td><input type="file" :id="index" v-on:change="onSongChange" ></td>
                            <td v-if="ismodify"><button class="btn btn-primary" @click="uploadSong(index)">Upload</button></td>
                            <td><div></div></td>
                            <td><button class="btn btn-danger" @click="removeRow(index)"> Remove </button></td>
                        </tr>
                    </draggable> 
                    <div>
                        <div v-show="create_successed === true" class="alert alert-success" role="alert">
                        <a class="btn btn-primary" :href="'/albums/'+this.album.id">Created - go to album</a>
                        </div>
                        <div v-show="create_successed === false" class="alert alert-warning" role="alert">
                        Error!!!
                        </div>
                        <div v-show="edit_successed === true" class="alert alert-success" role="alert">
                        Modify is success!!!
                        </div>
                        <div v-show="edit_successed === false" class="alert alert-warning" role="alert">
                        Error!!!
                        </div>
                    </div>               
                </table>       
           </div>
        </div>
        <div>
            <button class="btn btn-primary" @click="addNew">Add new song</button>
            <button class="btn btn-primary" v-show="!ismodify" @click="createAlbum">Create</button>
            <button class="btn btn-primary" v-show="ismodify" @click="editAlbum">Save</button>
            <button class="btn btn-primary" @click="returnToArtist">Return to Artist</button>     
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import draggable from 'vuedraggable';
import FileUpload  from 'vue-upload-component'
import util from 'util'
    export default {
        components: {
            draggable,
            FileUpload,
        },
        data: function () {
            return {
                create_successed: null,
                edit_successed: null,
                view_pic: null,
                enabled: true,
                dragging: false,
                album :{
                    title : '',
                    artistid: null,
                    songs: [{
                        title: '',
                        song_file: null,
                        number_of: null,
                        song_length: 0,
                        file: null,
                    }],
                    pic_url : null,
                    year : null,
                },
                albumfiles:{
                    albumpic: null,
                    albumsongs: [],
                },
                actualYear : null,
                createid : 0,
                ismodify : false,
            }           
        },
        created: function () {
            let date = new Date();
            this.actualYear = this.album.year = date.getFullYear();
            
            this.album.artistid = this.artist.album.artist_id;

            if(this.pismodify){
                this.album = this.artist.album;
                this.createid = 0;
                this.ismodify = true;
                this.album.songs.forEach(numb =>{
                    if(numb > this.createid){
                        this.createid = numb;
                    }
                })
            }
        },
        mounted() {
            console.log(this.artist.album.id)
        },
        props: {
            pismodify: Boolean,   
            artist:{    
                album :{
                    id: Number,
                    title : String,
                    artist_id: Number,
                    artist_name: String,
                    songs: [{
                        id: Number,
                        title: String,
                        number_of: Number,
                        song_length: Number,
                        song_url: String,
                        created_at: String,
                        updated_at: String,
                    }],
                    pic_url : String,
                    year : Number,
                }
            }
        },
        methods:{
            addNew(){
                let q = {
                    id : this.createid++,
                    title : '',
                    file : null,
                }
                this.album.songs.push(q);
            },
            removeRow(index){                
                if(this.ismodify){
                    axios.delete('/albums/song/'+ this.album.songs[index].id).then(resp =>{
                        this.album.songs.splice(index, 1);
                    })
                    .catch(error =>{

                    })
                }
                else{
                    this.album.songs.splice(index, 1);
                }
            },
            onSongChange(e){
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.album.songs[e.target.id].file = files[0];
            },
            onImageChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.albumfiles.albumpic = files[0];     
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.view_pic = e.target.result;              
                };
                reader.readAsDataURL(file);
            },
            returnToArtist(){
                window.location.href = "/artists/" + this.artist.album.artist_id;
            },
            uploadSong(index){
                if(this.album.songs[index].file == null){
                    return;
                }
                
                let fdata = new FormData();
                fdata.append('songfile', this.album.songs[index].file);
                console.log(fdata.get('songfile'))
                axios.post(
                    '/upload/songs/'+this.album.songs[index].id,
                    fdata,
                    {
                        headers: { "Content-Type": "multipart/form-data" }
                    }).then(resp => {
                        console.log(resp.data.success);
                    }).catch(error =>{
                        console.log(error.data)
                    }) 
            },
            createAlbum(){
                if(this.album.title == null || this.album.title == ''){
                    alert('Title is empty')
                    return;
                }
                if(this.album.songs.length === 0){
                    alert("Songs is empty")
                    return;
                }
                for(let i = 0; i < this.album.songs.length; i++){
                    this.album.songs[i].number_of = i + 1;
                    if(this.album.songs[i].title == null || this.album.songs[i].title == ''){
                        alert('Song title is empty');
                        return;
                    }
                }              
                axios.post('/albums', {album : this.album}).then(response => {      
                        this.album.id = response.data.success.album_id;
                        this.create_successed = true;
                        if(this.albumfiles.albumpic !== null){
                            let fdata = new FormData();
                            fdata.append('photo', this.albumfiles.albumpic);                       
                            axios.post(
                                '/upload/albumpic/' + response.data.success.album_id, 
                                fdata,
                                {
                                    headers: { "Content-Type": "multipart/form-data" }
                                })
                            .then(resp => {
                                this.view_pic = resp.data.success;
                                console.log(response.data);                            
                            })
                            .catch(error => {
                                console.log('pic upload FAILURE!!');                       
                            });  
                        }      
                    for(let i = 0; i < this.album.songs.length; i++){
                        if(this.album.songs[i].file){                        
                            let fdata = new FormData();
                            fdata.append('songfile', this.album.songs[i].file);
                            console.log(fdata.get('songfile'))
                            axios.post(
                                '/upload/songs/'+response.data.success.song_id[i],
                                fdata,
                                {
                                    headers: { "Content-Type": "multipart/form-data" }
                                }).then(resp => {  
                                    this.album.songs[i].is_success = true;                   
                                /*    axios.patch('/albums/songs/'+response.data.success.song_id[i], {length:666}).then(res => {
                                        console.log('long '+res.data.successq)
                                    }).catch(error => {
                                        console.log(error)
                                    }) */
                                }).catch(error =>{
                                    console.log("songupload fail "+error)
                                    this.album.songs[i].is_success = false;
                                });                           
                        }                  
                    }                                                              
                }).catch(error =>{
                    this.create_successed = false;
                    console.log(error);
                });;              
            },
            editAlbum(){
                if(this.album.title == null || this.album.title == ''){
                    alert('Title is empty')
                    return;
                }
                if(this.album.songs.length === 0){
                    alert("Songs is empty")
                    return;
                }
                for(let i = 0; i < this.album.songs.length; i++){
                    this.album.songs[i].number_of = i + 1;
                    if(this.album.songs[i].title == null || this.album.songs[i].title == ''){
                        alert('title is empty');
                        return;
                    }
                }
                axios.put('/albums/'+ this.artist.album.id, {album : this.album}).then(resp =>{
                    this.edit_successed = true;
                    console.log(resp.data.success)
                    if(this.albumfiles.albumpic === null){
                            this.album.songs.forEach(element => {
                                if(element.file != null){
                                    let fdata = new FormData();
                                    fdata.append('song', element.file);
                                    axios.post(
                                        '/upload/songs/'+element.id,
                                        fdata,
                                        {
                                            headers: { "Content-Type": "multipart/form-data" }
                                        }).then(resp => {

                                        }).catch(error =>{
                                            console.log(error)
                                        })
                                }
                            }); 
                            window.location.href = "/albums/" + this.artist.album.id;  
                    }
                    else{
                        let fdata = new FormData();
                        fdata.append('photo', this.albumfiles.albumpic);
                        axios.post(
                            '/upload/albumpic/' + this.artist.album.id, 
                            fdata,
                            {
                                headers: { "Content-Type": "multipart/form-data" }
                            })
                        .then(resp => {
                            this.album.songs.forEach(element => {
                                if(element.file != null){
                                    let fdata = new FormData();
                                    fdata.append('song', element.file);
                                    axios.post(
                                        '/upload/songs/'+element.id,
                                        fdata,
                                        {
                                            headers: { "Content-Type": "multipart/form-data" }
                                        }).then(resp => {

                                        }).catch(error =>{
                                            console.log(error)
                                        })
                                }
                            });  
                            window.location.href = "/albums/" + this.artist.album.id;           
                        })
                        .catch(error => {
                            console.log('upload FAILURE!!'); 
                            this.edit_successed = false;                       
                    });;   
                    }
                }); 
            },
            classObjectv2(index) {
                if(this.album.songs[index].is_success){
                    return {
                        'alert alert-success': this.album.songs[index].is_success,
                        'alert alert-warning': !this.album.songs[index].is_success
                    }
                }
            }
        },
        computed: {
            draggingInfo() {
                return this.dragging ? "under drag" : "";
            },
        },
    }
</script>
