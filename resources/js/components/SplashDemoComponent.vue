<template>
    <div class="col-md-7">
        <!-- <div id="video"></div> -->
        <video id="video" controls>
            <source src="movie.mp4" type="video/mp4">
        </video>
    </div>
</template>

<style scoped>
@media screen and (min-width: 600px) {
    #video {
        height: 500px;
        width: 90%;
        margin-top: 100px;
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
