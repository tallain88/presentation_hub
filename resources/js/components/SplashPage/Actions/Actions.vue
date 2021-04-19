<template>
    <div class="col-md-5 fill actions">
        <div class="row mb-2 justify-content-center title">
            <h1 class="text">Welcome to Presentation-Nexus</h1>
        </div>
        <div class="row mb-2 justify-content-center">
            <h3 class="text" id="catch-line">We help collaborators share their beautiful presentations across the internet with anyone.</h3>
        </div>
        <div class="row mb-2 justify-content-center" data-toggle="modal" data-target="#shareModal">
            <button class="presentation-btn btn btn-secondary">
                    Share a Presentation
            </button>
        </div>
        <div class="row justify-content-center">
            <button class="presentation-btn btn btn-secondary" data-toggle="modal" data-target="#joinModal">
                    Join a Presentation
            </button>
        </div>
        <img id="splashpage-image" alt="woman giving a presentation" height="300px" src="images/splashpage_image_1.svg"/>
        <splash-controls-action-share id="shareModal"></splash-controls-action-share>
        <splash-controls-action-join id="joinModal"></splash-controls-action-join>
    </div>
</template>

<style scoped>
    .actions {
        overflow: hidden;
    }
    .text {
        font-weight: bold;
        text-align: center;
    }

    .title {
        margin-bottom: 10%;
    }

    #catch-line {
        max-width: 500px;
        text-align: center;
        z-index: 2;
        margin-bottom: 10%;
    }

    .presentation-btn {
        height: 70px;
        width: 200px;
        z-index: 3;
        margin-bottom: 10%;
    }

    #splashpage-image {
        position: absolute;
        bottom: 15px;
        z-index: 1;
    }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {

        }
    }
</script>