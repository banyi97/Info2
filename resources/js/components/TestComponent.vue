<template>
    <div class="container">
        <div class="row justify-content-center">
            <input v-model="formElem.title" type="text">
            <p>{{formElem.title}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        props:{
            formElem : {
                id: Number,
                title: String
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
