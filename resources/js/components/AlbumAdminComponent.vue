<template>
    <div class="container">
        <div class="row justify-content-left">         
            <div class="row">
                <div>
                    <img v-if="view_pic && !ismodify" :src="view_pic" class="img-responsive" height="200" width="200"> <br>
                    <img v-if="!view_pic && ismodify" :src="'/storage/'+album.pic_url" class="img-responsive" height="200" width="200"> <br>
                    <img v-if="view_pic && ismodify" :src="view_pic" class="img-responsive" height="200" width="200"> <br>
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
                        <tr v-for="(item, index) in album.songs" :key="item.id">
                            <td scope="row">{{index +1}}</td>
                            <td><input v-model.trim="item.title" type="text" placeholder="Title"></td>
                            <td><input type="file" :id="index" v-on:change="onSongChange" ></td>
                            <td><div>Remove</div></td>
                            <td><button @click="removeRow(index)"> Remove </button></td>
                        </tr>
                    </draggable>                
                </table>          
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
            sendSong(id, file){
                let fdata = new FormData();
                fdata.append('song', file);
                axios.post(
                    '/upload/songs/'+id,
                    fdata,
                    {
                        headers: { "Content-Type": "multipart/form-data" }
                    }).then(resp => {

                    }).catch(error =>{
                        console.log(error)
                    })
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
                        if(this.albumfiles.albumpic === null){
                            window.location.href = "/albums/" + response.data.success.album_id;
                            return;
                        }
                        else{
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
                                window.location.href = "/albums/" + response.data.success.album_id;               
                            })
                            .catch(error => {
                                console.log('upload FAILURE!!');                        
                            });  
                        }                                      
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
                    });;   
                    }
                }); 
            },
        },
        computed: {
            draggingInfo() {
                return this.dragging ? "under drag" : "";
            },     

        },
    }
</script>
