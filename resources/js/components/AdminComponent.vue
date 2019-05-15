<template>
    <div class="container-fluid mt-2">
       <div class="row justify-content-center">
            <div class="accordion col-12" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Users
                        </button>
                    </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Created date</th>
                                    <th scope="col">Latest update</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-bind:key="item.id" v-for="(item,index) in usersdata">
                                        <th scope="row"> {{index+1}} </th>
                                        <td>{{item.id}}</td>
                                        <td>{{item.name}}</td>
                                        <td>{{item.name}}</td>
                                        <td>{{item.created_at}}</td>
                                        <td>{{item.updated_at}}</td>
                                        <td><button @click="remove(index)" class="btn btn-danger" >Remove</button></td>
                                    </tr>
                            </tbody>                    
                        </table>  
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Artists
                        </button>
                    </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Created date</th>
                                    <th scope="col">Latest update</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-bind:key="item.id" v-for="(item,index) in artistsdata">
                                        <th scope="row"> {{index+1}} </th>
                                        <td>{{item.id}}</td>
                                        <td>{{item.name}}</td>
                                        <td>{{item.created_at}}</td>
                                        <td>{{item.updated_at}}</td>
                                        <td><a :href="'/artists/'+item.id">Goto</a></td>
                                        <td><a :href="'/artists/'+item.id+'/edit'">Edit</a></td>
                                </tr>
                            </tbody>                    
                        </table>  
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Albums
                        </button>
                    </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Artist</th>
                                    <th scope="col">Year</th>
                                    <th scope="col">Created date</th>
                                    <th scope="col">Latest update</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-bind:key="item.id" v-for="(item,index) in albumsdata">
                                        <th scope="row"> {{index+1}} </th>
                                        <td>{{item.id}}</td>
                                        <td>{{item.title}}</td>
                                        <td>{{item.artist_name}}</td>
                                        <td>{{item.year}}</td>
                                        <td>{{item.created_at}}</td>
                                        <td>{{item.updated_at}}</td>
                                        <td><a :href="'/albums/'+item.id">Goto</a></td>
                                        <td><a :href="'/albums/'+item.id+'/edit'">Edit</a></td>
                                </tr>
                            </tbody>                    
                        </table>  
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        data: function(){
            return {
                usersdata : [],
                artistsdata: [],
                albumsdata: [],
            }
        },
        props:{
            users : {
                user : [{
                id : Number,
                name : String,
                email : String,
                created_at: String,
                updated_at: String,
                }]
            },
            artists:{},
            albums:{},   
        },
        methods :{
            remove(index){
                axios.delete('/profile/'+this.usersdata[index].id).then(resp =>{
                    this.usersdata.splice(index, 1);
                }).catch(error => {
                    alert('hello')
                })
            },
        },
        mounted() {
            console.log('Component mounted.')
            this.users.user.forEach(element => {
                this.usersdata.push(element);
            });
            this.artists.artist.forEach(element => {
                this.artistsdata.push(element);
            });
            this.albums.album.forEach(element => {
                this.albumsdata.push(element);
            });
        }
    }
</script>
