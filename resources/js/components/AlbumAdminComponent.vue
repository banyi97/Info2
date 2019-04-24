<template>
    <div class="container">
        <div class="row justify-content-center">
           <div v-bind:key="item.id" v-for="item in form">
               <input v-model="item.title" type="text">
           </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function(){
            form: [{
                id: Number,
                title: String
            }]
        },
        mounted() {
            console.log('Component mounted.')
        },
        props: {

        }
    }
</script>
