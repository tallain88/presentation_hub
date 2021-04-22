<template>
    <div class="col-lg-6 container">
        <video id="video" class="container-fluid" controls>
            <source src="movie.mp4" type="video/mp4">
        </video>
    </div>
</template>

<style scoped>
    #video {
        z-index: 10;
    }
    .container {
        margin-bottom: 10px;
    }
</style>

<script>
    export default {
    }
</script>
