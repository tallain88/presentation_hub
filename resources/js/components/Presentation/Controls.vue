<template>
   <div class="panel col-lg-2 card bg-second">
        <div class="card-body">
           <div class="container-fluid">
                <div class="row mb-3">
                    <button class="btn btn-third">Copy Link</button>
                </div>
                <div class="row mb-4">
                    <button class="btn btn-third">Select Presentation Source</button>
                </div>
           </div>
           <div class="row">
               <presentation-user-list></presentation-user-list>
           </div>
           <div class="row">
               <presentation-effects></presentation-effects>
           </div>
        </div>
   </div>
</template>

<style scoped>
    .panel {
        display: none;
        z-index: 20;
        position: fixed;
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