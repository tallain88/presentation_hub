<template>
    <div class="container-fluid">
        <h5 class="label">Effects</h5>
        <hr/>
        <div class="list col">
            <div class="row mb-2">
           <button class="btn btn-third">Negative</button>
            </div>
            <div class="row mb-2">
           <button class="btn btn-third">Sepia</button>
            </div>
            <div class="row mb-2">
           <button class="btn btn-third">Sunglasses</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
  .btn {
      width: 90%;
  }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>