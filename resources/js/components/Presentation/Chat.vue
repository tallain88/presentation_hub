<template>
    <div class="container-fluid col-lg-3">
        <div class="card chat bg-gray chat-collapse" id="chat-collapse">
            <div class="card-body">
                <div class="list">
                </div>
            </div>
        </div>
        <div class="chat-collapse" id="chat-collapse">
        <textarea placeholder="Type here to chat..." class="input bg-main"/>
        <button class="btn send btn-secondary">Send</button>
        </div>
    </div>
</template>

<style scoped>
    .container-fluid {
        height: 80%;
    }
    @media all and (max-width: 990px) {
        .container-fluid {
            top: -100px;
            height: 30%;
        }
    }
    .chat {
        height: 80%;
        margin-bottom: 15px;
    }
    .input {
        height: 20%;
    }
    .send {
        width: 100%;
        height: 50px;
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