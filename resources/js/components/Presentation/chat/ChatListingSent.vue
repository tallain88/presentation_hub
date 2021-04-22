<template>
    <div class="row ml-2 mr-2 mb-2">
        <div class="col-9 chat-bubble-sent">
            {{ text }}
        </div>
        <div class="col-3 justify-content-center">
            <presentation-chat-head></presentation-chat-head>
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
        uuid: {
            type: String
        },
        text: {
            type: String
        },
        username: {
            type: String
        }
    },
    }
</script>