<template>
    <div class="container">
        <div class="justify-content-center">           
            <div>
                <h4> <input v-on:keyup="onChange" v-model.trim="param" type="text" placeholder="Start typing"> </h4>
            </div>
            <div>
                <ul class="list-group" v-show="returns.artists">
                    <h3>Artists:</h3>
                    <li class="list-group-item" v-bind:key="item.id" v-for="item in returns.artists">
                        <div class='row text-center'>       
                            <a :href="'/artists/' + item.id">
                                <div>
                                    <div>
                                        <img :src="'/storage/' + item.pic_url" alt="" width="200" height="200">
                                    </div>
                                </div>
                                <h5>{{item.name}}</h5>
                            </a>
                        </div>
                    </li>
                </ul>

                <ul class="list-group" v-show="returns.albums">
                    <h3>Albums:</h3>
                    <li class="list-group-item" v-bind:key="item.id" v-for="item in returns.albums">
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
                    </li>
                </ul>

                <ul class="list-group" v-show="returns.songs">
                    <h3>Songs:</h3>
                    <li class="list-group-item" v-bind:key="item.id" v-for="item in returns.songs">
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
                    </li>
                </ul>

            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        data: function () {
            return{     
                param : '', 
                returns: {
                    songs: null,
                    albums: null,
                    artists: null,
                },
            }
        },
        props:{
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            onChange(){
                if(this.param.length < 1){
                    this.returns.songs = null;
                    this.returns.albums = null;
                    this.returns.artists = null;
                    return;
                }                
                   
                axios.post('/search/'+ this.param).then(response => {
                    if (response.data.success) {
                        this.returns = response.data.success;
                    }
                });
            },
        }
    }
</script>
