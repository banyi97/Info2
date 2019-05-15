<template>
    <div class="container-fluid mt-2">
       <div class="d-flex justify-content-center">
           <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" type="button">Create new</button>
       </div>
       <h2 class='mt-2 mx-2'>My playlists</h2>
                <div class="row"> 
                    <div v-bind:key="item.id" v-for="item in playlists.playlist">
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
        <createplaylist-component :playlists='playlists'></createplaylist-component>
    </div>
</template>

<script>
    export default {
        props:{          
            
        },
        data: function(){
            return{
                playlists : [],
            }
        },
        mounted() {          
            axios.get('/yourlib').then(resp =>{
                    console.log(resp.data)
                    this.playlists = resp.data.playlists;
                }).catch(error => {
                    console.log(error)
                });     
        },
        methods:{
            
        },
    }
</script>
