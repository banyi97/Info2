<template>
    <div class="container">
        <div class="row justify-content-left">         
            <div class="row">
                <div>
                    <img v-if="album.pic_url" :src="album.pic_url" class="img-responsive" height="200" width="200"> <br>
                    <input type="file" name="pic" id="image" v-on:change="onImageChange" accept="image/jpeg, image/png" />
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
                            <input class="col-4" v-model="element.title" type="text" placeholder="Title">
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
            <button v-show="!artist.ismodify" @click="createAlbum">Create</button>
            <button v-show="artist.ismodify" @click="editAlbum">Save</button>
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
                enabled: true,
                dragging: false,
                album :{
                    title : '',
                    artistid: null,
                    songs: [],
                    pic_url : null,
                    year : null,
                },
                actualYear : null,
                createid : 0
            }           
        },
        created: function () {
            let date = new Date();
            this.actualYear = this.album.year = date.getFullYear();
            
            this.album.artistid = this.artist.album.artist_id;

            if(this.artist.ismodify){
                this.album = this.artist.album;
            }

        //    this.album = this.artist.album;
        },
        mounted() {
        },
        props: {
            artist:{
                ismodify: Boolean,       
                album :{
                    title : String,
                    artist_id: Number,
                    artist_name: String,
                    songs: [{
                        id: Number,
                        title: String,
                        number_of: Number,
                        song_length: Number,
                        song_url: String,
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
                this.album.songs.splice(index, 1);
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
                    vm.album.pic_url = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            returnToArtist(){
                window.location.href = "/artists/" + this.artist.album.artist_id;
            },
            createAlbum(){
                for(let i = 0; i < this.album.songs.length; i++){
                    this.album.songs[i].number_of = i + 1;
                }

                axios.post('/albums',{album: this.album}).then(response => {
                   if (response.data.success) {
                     window.location.href = "/albums/" + response.data.success;
                   }
                });              
            },
            editAlbum(){
                
            }    
        },
        computed: {
            draggingInfo() {
                return this.dragging ? "under drag" : "";
            }
        },
    }
</script>
