<template>
    <div class="col-lg-7 container">
        <video id="video" class="container-fluid" controls>
            <source src="movie.mp4" type="video/mp4">
        </video>
    </div>
</template>

<style scoped>
    #video {
        z-index: 10;
    }
    @media all and (max-width: 800px) {
        .container {
            height: 1%;
        }
    }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
