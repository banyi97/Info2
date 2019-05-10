<template>
    <div class="container-fluid">
       <div>
           <button @click="createPlaylist">Create new</button>
       </div>
    </div>
</template>

<script>
    export default {
        props:{
        },
        data: function(){
            return{
                newPlaylist : {
                    name : '',
                    view_pic : null,
                    disc: '',
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            createPlaylist(){
                alert("hejj")
            }
        },
    }
</script>
