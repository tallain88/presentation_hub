<template>
    <div class="row ml-2 mr-2 mb-2">
        <div class="col-3">
            <presentation-chat-head></presentation-chat-head>
        </div>
        <div class="col-9 chat-bubble-received">
            {{ text }}
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
        userid: {
            type: String
        },
        text: {
            type: String
        },
        username: {
            type: String
        }
    },
    computed: {
        me() {
            let result = false;
            // Check if the client uuid of the message received is your client uuid
            if (this.$store.getters.getMyUuid === this.uuid) {
                result = true;
            }
            // Render the message bubble on the right side if it is from this client
            return result ? "me" : "";
        }
    }
};
</script>
