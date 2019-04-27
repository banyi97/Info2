<template>
    <div class="container">
        <div class="row justify-content-left">         
            <div class="row">
                <div>
                    <img v-if="album.pic_url" :src="'/img/albums/' + album.pic_url" class="img-responsive" height="200" width="200"> <br>
                    <input type="file" name="pic" id="image" v-on:change="onImageChange" accept="image/jpeg, image/png" />
                </div>
                <div>
                    <div>
                        <h3>Title: <input v-model="album.title" type="text"> </h3>
                        <h6>Year: <input v-model="album.year" type="number" min="1900" :max="actualYear" step="1">  </h6>
                    </div>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">File</th>
                        <th scope="col">Time</th>
                        <th scope="col">Remove</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr v-bind:key="item.id" v-for="(item, index) in album.songs">
                        <th scope="row"> {{index + 1}} </th>
                        <td> <input v-model="item.title" type="text"> </td>                        
                        <td> <input type="file" name="" id=""> </td>
                        <td> Remove </td>
                        <td><button @click="removeRow(index)"> Remove </button> </td>
                    </tr>
                </tbody>                    
            </table>
        </div>
        <button @click="addNew">Add new song</button>
        <div>
            <button v-show="!artist.ismodify" @click="createAlbum">Create</button>
            <button v-show="artist.ismodify" @click="editAlbum">Save</button>
            <button @click="returnToArtist">Return to Artist</button>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        data: function () {
            return {
                album :{
                    title : '',
                    artistid: null,
                    songs: [],
                    pic_url : 'nopic.png',
                    year : null,
                },
                actualYear : null,
                createid : 0
            }           
        },
        created: function () {
            let date = new Date();
            this.actualYear = date.getFullYear();
            this.album.year = date.getFullYear();
            
            this.album.artistid = this.artist.album.artist_id;

            if(this.artist.ismodify){
                this.album = this.artist.album;
            }

        //    this.album = this.artist.album;
        },
        mounted() {
            console.log(this.album.pic_url)
            console.log(this.album.artistid)
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
                    vm.album.pic = e.target.result;
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
        }
    }
</script>
