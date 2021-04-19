<template>
    <div class="row ml-2 mr-2 mb-2">
        <div class="col-3">
            <presentation-chat-head></presentation-chat-head>
        </div>
        <div class="col-9 chat-bubble-received">
            Hey! How are you?
        </div>
    </div>
</template>

<style scoped>
    .user-listing {
        height: 25px;
    }
    .icon {
        cursor: pointer;
        height: 15px;
        margin-right: 10px;
    }
</style>

<script>
    export default {
        props: {
            username: {
                type: String,
            },
            message: {
                type: String
            }
        },
        
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>