<template>
   <div class="panel col-lg-2 card bg-second">
        <div class="card-body">
           <div class="container-fluid">
                <div class="row mb-3">
                    <button class="btn btn-third">Copy Link</button>
                </div>
                <div class="row mb-3">
                    <button class="btn btn-third">Select Presentation Source</button>
                </div>
                <div class="row mb-4">
                    <button class="btn btn-third collapse-chat" data-toggle="collapse" href="#chat-collapse" data-target="#chat-collapse" aria-expanded="false" aria-controls="chat-collapse">Toggle chat</button>
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
    @media screen and (max-width: 1450px) {
        .panel {
            position: fixed;
            z-index: 20;
            min-width: 250px;
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