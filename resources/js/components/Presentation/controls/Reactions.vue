const emojis = require('emojis-list')

<template>
   <div class="col-lg-2 card bg-second">
        <div class="card-body">
           <div class="list">
           </div>
        </div>
   </div>
</template>

<style scoped>
    @media screen and (max-width: 1450px) {
        .card {
            position: fixed;
            z-index: 20;
        }
    }
    .card {
        height: 81%;
    }
    .btn {
        width: 90%;
    }
    .card {
        height: 80%;
    }
    .title {
        color: whitesmoke;       
    }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>