<template>
    <div class="container mt-2">
        <div v-show="!isPlayListView">
            <div class="justify-content-left">
            <div class="row">                            
                <div class="mt-2 mx-2"><img :src="'/storage/' + album.pic_url" width="150" height="150"></div>
                <div class="mt-2 ">
                    <h6>{{album.year}}</h6>
                    <h2>{{album.title}}</h2>
                    <p>By: <a :href=" '/artists/' + album.artist_id">{{album.artist}}</a> </p>
                    <p>{{album.year}} * {{album.songs.length}} songs, {{ totalTime(album.songs) }}</p>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col"></th>
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr v-bind:key="item.id" v-for="item in album.songs">
                        <th scope="row"> <a href="">{{item.number_of}}</a> </th>
                        <td>{{item.title}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ...
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" data-toggle="modal" data-target="#exampleModal" type="button">New playlist</button>
                                    <hr>
                                    <div v-bind:key="playlist.id" v-for="playlist in playlists.playlist">
                                        <button @click="addToPlaylist(playlist.id, item.id)" class="dropdown-item" type="button">{{playlist.name}}</button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{convertToTime(item.song_length)}}</td>
                    </tr>
                </tbody>                    
            </table>
            </div>
            <a class="btn btn-primary" :href="'/albums/' + album.id + '/edit'">Edit</a>
            <button class="btn btn-danger" @click="deleteAlbum">Delete</button>
            <button class="btn" @click="startClick">Start</button>
            <button class="btn" @click="stopClick">Stop</button>
        </div>

        <div v-show="isPlayListView">
            <div class="justify-content-left">
            <div class="row">                            
                <div class="mt-2 mx-2"><img :src="'/storage/' + album.pic_url" width="150" height="150"></div>
                <div class="mt-2 ">
                    <h2>{{album.title}}</h2>
                    <p> {{album.songs.length}} songs, {{ totalTime(album.songs) }}</p>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Artist</th>
                        <th scope="col">Album</th>
                        <th scope="col">Added date</th>
                        <th scope="col">Time</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                    <tbody v-show="album.songs">
                        <tr v-bind:key="item.id" v-for="(item,index) in album.songs">
                        <th scope="row"> <a href="">{{item.number_of}}</a> </th>
                        <td>{{item.title}}</td>
                        <td><a :href="'/artists/'+item.artist_id">{{item.artist_name}}</a></td>
                        <td><a :href="'/albums/'+item.album_id">{{item.album_title}}</a></td>
                        <td>{{item.element_created}}</td>
                        <td>{{convertToTime(item.song_length)}}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ...
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button @click="removeToPlaylist(item.id, index)" class="dropdown-item" type="button">Remove</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>                    
            </table>
        </div>
        <button @click="startClick">Start</button>
        <button @click="stopClick">Stop</button>
        </div>

        <createplaylist-component :playlists='playlists'></createplaylist-component>
    </div>
</template>

<script>
//const {Howl, Howler} = require('howler');
import {Howl, Howler} from 'howler'; 
import axios from 'axios';  
import draggable from 'vuedraggable';
    export default {
        data: function () {
            return {
                sound: null,
                isPlayListView: false,
                playlists: [],
                album : null
            }           
        },
        props: {
            playlistview: Boolean,
            palbum : {
                id: Number,
                artist_id: Number,
                artist: String,
                title: String,
                year: Number,
                pic_url: String,
                songs: [
                    {
                        id: Number,
                        title:String,
                        number_of:Number,
                        url: String,
                        song_length: String,
                        artist_name : String,                     
                        album_title : String,
                        artist_id : Number,                     
                        album_id : Number,
                        element_created: String,
                    }
                ]
            },
        },
        created: function () {
            this.album = this.palbum;
        },
        mounted() {
            if(this.playlistview === true){
                this.isPlayListView = true;
            }
            else{
                
            }  
            axios.get('/yourlib').then(resp =>{
                    console.log(resp.data)
                    this.playlists = resp.data.playlists;
                }).catch(error => {
                    console.log(error)
                });
            this.sound = new Howl({
                    src: ['/storage/a.mp3','/storage/b.mp3'],
                    autoplay: false,
                    html5: true,
                });
            Howler.volume(0.5);   
            this.album.songs.forEach(song => {
            }); 
        },
        methods: {
            startClick(){
                this.sound.play();
                console.log(this.sound.duration())
            },       
            stopClick(){
                this.sound.pause();
            },
            addToPlaylist(playlistId, songId){             
                axios.post('/playlists/element',{playlistElement:
                    {playlistId:playlistId, songId: songId}}).then(resp =>{
                        console.log(resp.data)
                }).catch(error => {
                    console.log(error)
                });
            },
            removeToPlaylist(id,index){
                axios.delete('/playlists/element/'+id).then(resp=>{
                    this.album.songs.splice(index, 1);
                }).catch(error =>{
                    console.log(error)
                });
            },
            convertToTime(length){
                const hour = Math.floor(length/3600);
                const min = Math.floor((length-hour*3600)/60);
                const sec = Math.floor(length-(hour*3600+min*60));
                if(hour === 0)
                {
                    if(min < 10 && sec < 10)
                        return new String('0'+ min + ':' + '0' + sec);
                    else if(min < 10 && sec > 9)
                        return new String('0'+ min + ':' + sec);
                    else if(min > 9 && sec < 10)
                        return new String(min + ':' + '0' + sec);
                    else 
                        return new String(min + ':' + sec);
                }
                else
                {
                    if(min < 10 && sec < 10)
                        return new String(hour + ':' + '0'+ min + ':' + '0' + sec);
                    else if(min < 10 && sec > 9)
                        return new String(hour + ':' + '0'+ min + ':' + sec);
                    else if(min > 9 && sec < 10)
                        return new String(hour + ':' + min + ':' + '0' + sec);
                    else 
                        return new String(hour + ':' + min + ':' + sec);
                }
            },
            totalTime(songs){
                var sec = 0;
                songs.forEach(element => {
                    sec += element.song_length;
                });                           
            return this.convertToTime(sec);   
            },
            deleteAlbum(){
                axios.delete('/albums/' + this.album.id).then(response => {
                   if (response.data.success) {
                     window.location.href = "/artists/" + this.album.artist_id;
                   }
                });
            },
            play(){

            }
        },
        computed:{

        }  
    }
</script>
