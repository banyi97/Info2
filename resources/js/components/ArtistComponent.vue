<template>
    <div class="container">
        <div class="row justify-content-left">           
            <div class="row">                            
                <div><h2>{{artist.name}}</h2></div>
            </div>
        </div> 
        <div v-bind:key="item.id" v-for="item in artist.albums">
            <div class='row text-center'>       
                <div>
                    <a :href="'/albums/' + item.id">
                        <div>
                            <div>
                                <img :src="'/storage/' + item.pic_url" alt="" width="200" height="200">
                            </div>
                        </div>
                        <h5>{{item.title}}</h5>
                    </a>
                    <a :href="'/artists/' + item.artist_id">{{item.artist_name}}</a>
                </div>
            </div>  
        </div>
        <a :href="'/albums/create/' + artist.id ">Create new Album</a>
    </div>
</template>

<script>
const axios = require('axios');
    export default {
        data: function () {
            return{           
            }
        },
        mounted() {
            console.log(this.artist.id)
        },
        props: 
        {        
            artist:{
                id: Number,
                name: String,
                pic_url: String,
                albums : {
                    id: Number,
                    title: String,
                    year: Number,
                    pic: String,
                    long: Number,
                    songs: [
                        {
                            id: Number,
                            title:String,
                            number_of:Number,
                            url: String,
                            song_length: Number
                        }
                    ]
                }
            }
        },
        methods: {
            testClick(){
                
            }
        }   
    }
</script>