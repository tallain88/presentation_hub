<template>
    <div class="container-fluid col-lg-3">
        <div class="card chat bg-gray">
            <div class="card-body">
                <div class="list">
                </div>
            </div>
        </div>
        <textarea placeholder="Type here to chat..." class="input bg-main"/>
        <button class="btn btn-secondary"></button>
    </div>
</template>

<style scoped>
        @media all and (max-width: 990px) {
            .container-fluid {
                top: -100px;
            }
        }
        /* margin-bottom: 50px; */
    .chat {
        height: 59%;
        margin-bottom: 35px;
    }
    .input {
        height: 20%;
    }
    .btn {
        width: 100%;
        height: 5%;
    }
    textarea {
        font-size: 20px;
        width: 100%;
        resize: none;
        border-top-left-radius: 10px;
        border-bottom-right-radius: 10px;
        color: whitesmoke;
    }
    textarea:focus {
        outline-width: 0;
    }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>