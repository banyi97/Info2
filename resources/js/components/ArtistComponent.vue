<template>
    <div class="container">
        <div class="justify-content-left">           
            <div class="row">  
                <div>
                    <img :src="'/storage/'+artist.pic_url" class="img-responsive" height="200" width="200">    
                </div>                          
                <div>
                    <h2>{{artist.name}}</h2>
                    <a :href="'/artists/' + artist.id + '/edit'">Edit</a>
                    <button @click="deleteAlbum">Delete</button>
                </div>
            </div>
        </div> 
        <div>
            <h2 class='mt-2 mx-2'>Albums</h2>
                <div class="row"> 
                    <div v-bind:key="item.id" v-for="item in artist.albums">
                        <div class='mt-2 mx-2 text-center'>       
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
                </div>
        </div>
        <a :href="'/albums/create/' + artist.id ">Create new Album</a>  
    </div>
</template>

<script>
import axios from 'axios';
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
            deleteAlbum(){
                axios.delete('/artists/' + this.artist.id).then(resq =>{
                    window.location.href = "/home";
                }).catch(error => {
                    console.log(error)
                })
            }
        }   
    }
</script>