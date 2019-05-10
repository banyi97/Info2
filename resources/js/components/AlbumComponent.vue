<template>
    <div class="container">
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
                        <th scope="col">Time</th>
                    </tr>
                </thead>
                    <tbody>
                        <tr v-bind:key="item.id" v-for="item in album.songs">
                        <th scope="row"> <a href="">{{item.number_of}}</a> </th>
                        <td>{{item.title}}</td>
                        <td>{{convertToTime(item.song_length)}}</td>
                    </tr>
                </tbody>                    
            </table>
        </div>
        <a :href="'/albums/' + album.id + '/edit'">Edit</a>
        <button @click="deleteAlbum">Delete</button>
        <button @click="startClick">Start</button>
        <button @click="stopClick">Stop</button>
    </div>
</template>

<script>
//const {Howl, Howler} = require('howler');
import {Howl, Howler} from 'howler'; 
import axios from 'axios';  
    export default {
        data: function () {
            return {
                sound: null,
            }           
        },
        props: {
            isInArtist: Boolean,
            album : {
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
                        song_length: String
                    }
                ]
            }
        },
        created: function () {
        },
        mounted() {           
            this.sound = new Howl({
                    src: ['/storage/a.mp3','/storage/b.mp3'],
                    autoplay: false,
                    html5: true,
                });
            Howler.volume(0.5);   
            this.album.songs.forEach(song => {
            })
        },
        methods: {
            startClick(){
                this.sound.play();
                console.log(this.sound.duration())
            },
            stopClick(){
                this.sound.pause();
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
