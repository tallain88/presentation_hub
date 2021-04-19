<template>
    <div class="container-fluid col-lg-3 chat-collapse" id="chat-collapse">
        <div class="card chat bg-gray">
            <div class="list mt-2">
                <presentation-chat-listing-received></presentation-chat-listing-received>
                <presentation-chat-listing-sent></presentation-chat-listing-sent>

            </div>
        </div>
        <div >
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