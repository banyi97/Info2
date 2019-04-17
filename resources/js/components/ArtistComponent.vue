<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">                 
                    <div class="card-header">
                        <div class="row">                            
                            <div><img :src="artist.pic_url" width="150" height="150"></div>
                            <div><h2>{{artist.name}}</h2></div>
                        </div>
                    </div> 
                    <div v-bind:key="item.id" v-for="item in artist.albums">
                        <album-component :album="item"></album-component>
                    </div>
                </div>
            </div>
        </div>
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
            console.log(artist.name)
        },
        props: ['artist'],
       // {        
            
        /*    artist:{
                id: Number,
                name: String,
                pic_url: String,
                albums : {
                    id: String,
                    title: String,
                    year: Number,
                    pic: String,
                    artistName: String,
                    artistId: Number,
                    songs: [
                        {
                            title:String,
                            number_of:Number,
                            url: String,
                            long: Number
                        }
                    ]
                }
            } */
      //  },
        methods: {
            testClick(){
                
            }
        }    
    }
</script>