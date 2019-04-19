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
                        <artist-component :album="item"></artist-component>
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
            console.log("run")
        },
        props: 
        {        
            artist:{
                id: Number,
                name: String,
                pic_url: String,
                album : {
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
                            long: Number
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