<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div v-if="met == 'create'">
                        <div class="card-header">Create new artist</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="artistName">Artist name</label>
                                    <input type="email" class="form-control" id="artistName" placeholder="Name of artist">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="pic">Picture</label>
                                    <input type="file" class="form-control" id="pic">
                                </div>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </form>
                        </div>                       
                    </div>
                    
                    <div v-if="met == 'modify'">
                        <div v-if="met == 'modify'" class="card-header">Modify artist</div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="artistName">Artist name</label>
                                    <input type="email" class="form-control" id="artistName" aria-describedby="emailHelp" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                        </div>
                    </div>                   

                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:function (){

        },
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            met: String,
            albums : {
                id: String,
                title: String,
                long: Number,
                songs: [
                    {
                        title:String,
                        number_of:Number,
                        url: String,
                        long: Number
                    }
                ]
            }
        },
        methods: {
            testClick(){
                
            }
        }    
    }
</script>