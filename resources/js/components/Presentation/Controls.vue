<template>
   <panel>
       <div class="row mb-3">
           <button class="btn btn-third">Copy Link</button>
       </div>
       <div class="row mb-4">
           <button class="btn btn-third">Select Presentation Source</button>
       </div>
       <div class="row">
           <presentation-user-list></presentation-user-list>
       </div>
       <div class="row">
           <presentation-effects></presentation-effects>
       </div>
   </panel>
</template>

<style scoped>
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