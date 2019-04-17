<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        Property: {{propMessage}} <br>
                        Message 1: {{propMessages[0]}} <br>
                        Message 2: {{propMessages[1]}} <br>
                        Number: {{albums[0].title}} <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            propMessage: String,
            propMessages: [],
            albums: { id:Number, artist_id: Number, title:String,release_date: String}
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
