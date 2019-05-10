<template>
    <div class="container-fluid">
       <div>
           <button @click="createPlaylist">Create new</button>
       </div>
       <h2 class='mt-2 mx-2'>My playlists</h2>
                <div class="row"> 
                    <div v-bind:key="item.id" v-for="item in playlistdatas">
                        <div class='mt-2 mx-2 text-center'>       
                            <div>
                                <a :href="'/playlists/' + item.id">
                                    <div>
                                        <div>
                                            <img :src="'/storage/' + item.pic_url" alt="" width="200" height="200">
                                        </div>
                                    </div>
                                    <h5>{{item.name}}</h5>
                                </a>
                            </div>
                        </div>  
                    </div>
                </div>
    </div>
</template>

<script>
    export default {
        props:{
            playlists:{
                playlist : [{
                    id : Number,
                    name : String,
                    pic_url: String,
                }]
            }
        },
        data: function(){
            return{
                playlistdatas : []
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.playlists.playlist.forEach(element => {
                this.playlistdatas.push(element);
            });
        },
        methods:{
            createPlaylist(){
                alert("hejj")
            }
        },
    }
</script>
