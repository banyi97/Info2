<template>
    <div class="container">
        <div class="row justify-content-left">
            <div class="row">                            
                <div><img :src="'/img/albums/' + album.pic" width="150" height="150"></div>
                <div>
                    <h6>{{album.year}}</h6>
                    <h2><a :href=" '/albums/' + album.id ">{{album.title}}</a></h2>
                    <div v-show="!isInArtist">
                        <p>By: <a :href=" '/artists/' + album.artist_id">{{album.artist}}</a> </p>
                        <p>{{album.year}} * {{album.songs.length}} songs, {{ totalTime(album.songs) }}</p>
                    </div>
                </div>
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
        <a :href="'/albums/' + album.id + '/edit'">Edit</a>
        <button @click="deleteAlbum">Delete</button>
    </div>
</template>

<script>
//const {Howl, Howler} = require('howler');
import {Howl, Howler} from 'howler'; 
import axios from 'axios';  
    export default {
        data: function () {
            return {
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
                pic: String,
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
        },
        methods: {
            testClick(){
                var sound = new Howl({
                    src: ['/sound/sound.mp3']
                });
                sound.play();
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
                     window.location.href = "/albums/" + this.album.artist_id;
                   }
                });
            }
        },
        computed:{

        }  
    }
</script>
