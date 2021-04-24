<template>
    <div class="col-lg-6 container">
        <video id="video" class="container-fluid" :key=source controls="true" >
            <source :src=source type="video/mp4">
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
    import {eventBus} from "../../app";
    export default {
        data() {
            return {
                source: '',
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            // attach event listener
            eventBus.$on('source', this.updateSource);
        },
        beforeDestroy(){
           // remove event listener
           EventBus.$off("source", this.updateSource)
        },
        methods: {
            // update video source and create URL object
            updateSource(message){
                this.source = URL.createObjectURL(message);
                console.log(this.source);
            }
        }
    }
</script>
