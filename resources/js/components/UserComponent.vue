<template>
    <div class="container-fluid">
       <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div>
                        <div class="card-header">Profile</div>
                        <div class="card-body">
                            <div>
                                <ul class="list-group">
                                    <li class="list-group-item">ID: {{user.id}}</li>
                                    <li class="list-group-item">Username: {{user.name}}</li>
                                    <li class="list-group-item">Email: {{user.email}}</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-header">Password change</div>
                        <div class="card-body">              
                            <div>
                                <form @submit.prevent="chancePassword">
                                    <div class="form-group">
                                        <label for="oldpass">Old password</label>
                                        <input v-model.trim="old_password" required minlength="8" type="password" class="form-control" id="oldpass" aria-describedby="emailHelp" placeholder="Your old password">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="newpass">New password</label>
                                        <input v-model.trim="new_password" required minlength="8" type="password" class="form-control" id="newpass" aria-describedby="emailHelp" placeholder="Your new password">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="newpassconf">Confirm new password</label><br>
                                        <input v-model.trim="new_pass_confirm" required id="newpassconf" class="form-control" type="password">
                                        <small v-show="!ispassed" class="form-text text-muted">Password is not equal with Confirm password</small>
                                    </div> 
                                    <div v-show="ret_succ" class="alert alert-success" role="alert">
                                        Password change is success!
                                    </div> 
                                    <div v-show="ret_error" class="alert alert-danger" role="alert">
                                        ERROR
                                    </div>              
                                        <button type="submit" class="btn btn-primary">Submit</button>           
                                </form>
                            </div>                      
                        </div> 
                        <div class="card-header">Remove your profile</div>
                        <div class="card-body">
                            <div>
                                <button class="btn btn-danger" @click="deleteMy">Delete this profile</button>
                            </div>
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
                old_password : '',
                new_password : '',
                new_pass_confirm : '',
                ispassed : true,
                ret_error: false,
                ret_succ: false,
            }
        },
        props:{
            user :{
                id : Number,
                name : String,
                email : String,
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            deleteMy(){
                axios.delete('/profile/me').then(resp=>{
                    alert("Successed!")
                    window.location.href = "/";
                }).catch(error => {
                    alert('Error');
                })
            },
            chancePassword(){
                if(this.new_password !== this.new_pass_confirm){
                    this.ispassed = false;
                    return;
                }
                else{
                    this.ispassed = true; 
                }
                console.log(this.old_password)
                console.log(this.new_password)
                axios.patch('/profile', {newpassword : this.new_password, oldpassword : this.old_password }).then(resp => {
                    console.log(resp.data)
                    this.ret_succ = true;
                    this.old_password = this.new_password = this.new_pass_confirm = '';
                }).catch(error => {
                    console.log(error);
                    this.ret_error = true;
                });
            }
        }
    }
</script>
