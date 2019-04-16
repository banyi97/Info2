<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">                            
                            <div>
                                <img :src="album.pic" width="150" height="150">
                                </div>
                            <div>
                                <h6>{{album.year}}</h6>
                                <h2>{{album.title}}</h2>
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
                                 <th scope="row">{{item.number_of}}</th>
                                <td>{{item.title}}</td>
                                <td>{{item.long}}</td>
                            </tr>
                        </tbody>                    
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//const {Howl, Howler} = require('howler');
import {Howl, Howler} from 'howler';   
    export default {
        data: function () {
            return {
                message : "Hello User",
                albums:{
                    id:555234,
                    title: "The Source",
                    pic: "https://upload.wikimedia.org/wikipedia/en/thumb/5/5e/Ayreon_-_The_Source.jpg/220px-Ayreon_-_The_Source.jpg",
                    long: 56,
                    artistName: "",
                    artistId: 123,
                    songs:[
                        {
                            title: "The Day That the World Breaks Down",
                            number_of: 1,
                            long: 12*60+31,
                        },
                        {
                            title: "Sea of Machines",
                            number_of: 2,
                            long: 6.32
                        },
                        {
                            title: "Everybody Dies",
                            number_of: 3,
                            long: 12*60+31,
                        },
                        {
                            title: "Star of Sirrah",
                            number_of: 4,
                            long: 12*60+31,
                        },
                        {
                            title: "All That Was",
                            number_of: 5,
                            long: 12*60+31,
                        },
                        {
                            title: "Run! Apocalypse! Run!",
                            number_of: 6,
                            long: 12*60+31,
                        },
                        {
                            title: "Condemned to Live",
                            number_of: 7,
                            long: 12*60+31,
                        },
                        {
                            title: "Aquatic Race",
                            number_of: 8,
                            long: 12*60+31,
                        },
                    ]
                }
            }
        },
        props: {
            album : {
                id: String,
                title: String,
                year: Number,
                pic: String,
                long: Number,
                songs: [
                    {
                        title:String,
                        number_of:Number,
                        url: String,
                        long: Number
                    }
                ]
            }
        },
        mounted() {
            
            console.log('Component mounted.')
        },
        methods: {
            testClick(){
                var sound = new Howl({
                    src: ['/sound/sound.mp3']
                });
                sound.play();
            }
        }    
    }
</script>
