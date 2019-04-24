<template>
    <div class="container">
        <div class="row justify-content-center">
           <div v-bind:key="item.id" v-for="(item, index) in createform">  
               Index: {{index}}           
               <test-component :formElem="item"></test-component><br>  
               <button v-on:click="removeRow(index)"> Remove</button>         
                
           </div>
        </div>
        <button @click="addNew">Add new line</button>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                createid : 0,
                createform: []
            }           
        },
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            forms : []
        },
        methods:{
            addNew(){
                let q = {
                    id : this.createid++,
                    title : ''
                }
                this.createform.push(q);
            },
            removeRow(index){
                this.createform.splice(index, 1);
            }
        }
    }
</script>
