<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>    
                        <h3>{{album.title}}</h3>                   
                        <ul>
                            <li v-bind:key="item.id" v-for="item in album.songs">
                                <div>{{item.number_of}}</div>
                                <div>{{item.title}}</div>
                            </li>
                        </ul>
                    <div class="card-body">

                    </div>
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
                album:{
                    id:555234,
                    title: "The Source",
                    long: 56,
                    songs:[
                        {
                            title: "First song",
                            number_of: 1,
                            long: 4.43
                        },
                        {
                            title: "Secound song",
                            number_of: 2,
                            long: 6.32
                        }
                    ]
                }
            }
        },
        props: {
            albums : {
                id: String,
                title: String,
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
