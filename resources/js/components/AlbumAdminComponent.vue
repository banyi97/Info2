<template>
    <div class="container">
        <div class="row justify-content-left">         
            <div class="row">
                <div>
                    <img v-if="view_pic" :src="'/storage/'+view_pic" class="img-responsive" height="200" width="200"> <br>
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
               <draggable
                    :list="album.songs"
                    :disabled="!enabled"
                    class="list-group"
                    ghost-class="ghost"
                    @start="dragging = true"
                    @end="dragging = false"
                    >               
                    <div 
                    class="list-group-item"
                    v-for="(element, index) in album.songs"
                    :key="element.id">
                        <div class="row col-12">
                            <div class="col-1">{{index +1}}</div>
                            <input class="col-4" v-model.trim="element.title" type="text" placeholder="Title">
                            <input class="col-3" type="file" name="" id="">
                            <div class="col-2">Remove</div>
                            <button class="col-2" @click="removeRow(index)"> Remove </button>
                        </div>
                    </div>                  
                    </draggable>
           </div>
        </div>
        <div>
            <button @click="addNew">Add new song</button>
            <button v-show="!ismodify" @click="createAlbum">Create</button>
            <button v-show="ismodify" @click="editAlbum">Save</button>
            <button @click="returnToArtist">Return to Artist</button>     
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import draggable from 'vuedraggable';
    export default {
        components: {
            draggable
        },
        data: function () {
            return {
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
                    }],
                    pic_file : null,
                    year : null,
                },
                albumfiles:{
                    albumpic: null,
                    albumsongs: [],
                },
                actualYear : null,
                createid : 0
            }           
        },
        created: function () {
            let date = new Date();
            this.actualYear = this.album.year = date.getFullYear();
            
            this.album.artistid = this.artist.album.artist_id;

            if(this.ismodify){
                this.album = this.artist.album;
            }
        },
        mounted() {
            console.log(this.artist.album.id)
        },
        props: {
            ismodify: Boolean,   
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
                    title : ''
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
                    this.albumfiles.albumpic = this.$refs.albumpic.files[0];
                };
                reader.readAsDataURL(file);
            },
            returnToArtist(){
                window.location.href = "/artists/" + this.artist.album.artist_id;
            },
            createAlbum(){
                if(this.album.title == null || this.album.title == ''){
                    alert('Title is empty')
                    return;
                }
                if(this.album.songs.length === 0){
                    alert("Songs")
                    return;
                }
                for(let i = 0; i < this.album.songs.length; i++){
                    this.album.songs[i].number_of = i + 1;
                    if(this.album.songs[i].title == null || this.album.songs[i].title == ''){
                        alert('title is empty');
                        return;
                    }
                }
              
                axios.post('/albums', {album : this.album}).then(response => {             
                    if (response.data.success) {                   
                        if(this.albumfiles.albumpic === null)
                            return;
                        let fdata = new FormData();
                        fdata.append('photo', this.albumfiles.albumpic);
                        axios.post(
                            '/upload/albumpic/' + response.data.success.album_id, 
                            fdata,
                            {
                                headers: { "Content-Type": "multipart/form-data" }
                            })
                        .then(resp => {
                            console.log(resp.data.success);                 
                        })
                        .catch(error => {
                            console.log('upload FAILURE!!');                        
                    });;    
                     window.location.href = "/albums/" + response.data.success.album_id;      
                   }
                }).catch(error =>{
                    console.log('FAILURE!!');
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
                    console.log(resp.data.success)
                    if(this.albumfiles.albumpic === null){
                            window.location.href = "/albums/" + this.artist.album.id;
                            return;
                    }
                    console.log(this.view_pic);
                    console.log(this.albumfiles.albumpic)
                        let fdata = new FormData();
                        fdata.append('photo', this.albumfiles.albumpic);
                        axios.post(
                            '/upload/albumpic/' + this.artist.album.id, 
                            fdata,
                            {
                                headers: { "Content-Type": "multipart/form-data" }
                            })
                        .then(resp => {
                            console.log(resp.data.success);                 
                        })
                        .catch(error => {
                            console.log('upload FAILURE!!');                        
                    });;    
                   // window.location.href = "/albums/" + this.artist.album.id;
                }); 
            },
        },
        computed: {
            draggingInfo() {
                return this.dragging ? "under drag" : "";
            }
        },
    }
</script>
