<template>
    <div class="container-fluid">
       <div class="row justify-content-center">
           <h4>Users</h4>
           <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Created time</th>
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
                            <td><button @click="remove(index)" >Remove</button></td>
                        </tr>
                </tbody>                    
            </table>    
        </div>
    </div>
</template>

<script>
import axios from 'axios'
    export default {
        data: function(){
            return {
                usersdata : []
            }
        },
        props:{
            users : {
                user : [{
                id : Number,
                name : String,
                email : String,
                created_at: String,
                }]
            }      
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
        }
    }
</script>
