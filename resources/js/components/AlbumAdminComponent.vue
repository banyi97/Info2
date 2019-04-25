<template>
    <div class="container">
        <div class="row justify-content-left">         
            <div class="row">
                <div>
                    <img v-if="album.pic" :src="album.pic" class="img-responsive" height="200" width="200"> <br>
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
                        <td><input v-model="item.title" type="text"> </td>                        
                        <td> <input type="file" name="" id=""> </td>
                        <td> Remove </td>
                        <td><button @click="removeRow(index)"> Remove </button> </td>
                    </tr>
                </tbody>                    
            </table>
        </div>
        <button @click="addNew">Add new song</button>
        <div>
            <button @click="createAlbum">Create</button>
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
                    pic : '/img/albums/nopic.png',
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
            this.album.artistid = this.artist.artistid;
        },
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            artist:{
                artistid: Number,
                artistname: String,
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
                window.location.href = "/artists/" + this.artist.artistid;
            },
            createAlbum(){
                axios.post('/albums',{album: this.album}).then(response => {
                   if (response.data.success) {
                     alert(response.data.success);
                   }
                });
            }
        }
    }
</script>
