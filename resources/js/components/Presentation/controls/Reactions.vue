<template>
    <div class="col-lg-2 ml-2 card bg-second">
        <div class="row mt-2 justify-content-center">
            <button
                class="btn btn-third collapse-chat"
                data-toggle="collapse"
                href="#chat-collapse"
                data-target="#chat-collapse"
                aria-expanded="true"
                aria-controls="chat-collapse"
            >
                Hide Chat
            </button>
        </div>
        <input
            class="search mt-2"
            placeholder="Search emojis"
            type="text"
            name="emoji-search"
            v-model="emojiSearch"
            v-on:input="emojiSearchHandler"
        />
        <div class="card-body mt-2">
            <div
                v-for="(chunk, index) in emojiChunks"
                v-bind:key="index"
                class="row bg-gray"
            >
                <div
                    v-for="(emoji, index) in chunk"
                    v-bind:key="index"
                    class="col-2 emoji m-2"
                    @click="sendReaction(emoji)"
                    v-bind:title="emojiTitle(emoji)"
                >
                    {{ emoji }}
                </div>
            </div>
            <div class="mt-2"></div>
        </div>
    </div>
</template>

<style scoped>
@media screen and (max-width: 1450px) {
    .card {
        position: fixed;
        z-index: 20;
    }
}
.card-body {
    border-radius: 10px;
}
.card {
    height: 81%;
    overflow-y: scroll;
}
.emoji {
    user-select: none;
    font-size: 20px;
    cursor: pointer;
}
.btn {
    width: 90%;
}
.card {
    height: 80%;
}
.title {
    color: whitesmoke;
}
</style>

<script>
import PubNubVue from "pubnub-vue";
import { mapGetters } from "vuex";

const emoji = require("emoji-dictionary");

function fetchHistory(store, presentationId) {
    PubNubVue.getInstance().history(
        {
            channel: presentationId,
            count: 20,
            stringifiedTimeToken: true // false is the default
        },
        (status, resposne) => {
            const messages = resposne.messages;
            messages.forEach(message => {
                store.commit("addHistory", { history: [message] });
            });
        }
    );
}

export default {
    data: function() {
        return {
            searchResults: [],
            vueChatMsg: this.$pnGetMessage(this.$props.presentationid),
            emojiSearch: "",
            userId: this.$props.userid
        };
    },
    mounted() {
        this.$pnSubscribe({
            channels: [this.presentationid]
        });
    },
    computed: {
        emojiChunks: function() {
            const chunkArray =
                this.searchResults.length > 0
                    ? this.searchResults
                    : emoji.unicode;
            const CHUNK_SIZE = Math.min(4, chunkArray.length);
            const res = [];
            for (let i = 0; i < chunkArray.length; i += CHUNK_SIZE) {
                const chunk = chunkArray.slice(i, i + CHUNK_SIZE);
                res.push(chunk);
            }
            return res;
        },
        ...mapGetters({
            uuid: "getMyUuid"
        }),
        ...mapGetters({
            history: "getHistoryMsgs"
        })
    },
    methods: {
        emojiSearchHandler: function(event) {
            let a = "";
            const search = event.target.value
                .toLowerCase()
                .replaceAll(" ", "_");
            console.log(search);
            this.searchResults = emoji.names.reduce((results, keyword) => {
                if (keyword.includes(search)) {
                    results.push(emoji.getUnicode(keyword));
                }
                return results;
            }, []);
            console.log(this.searchResults);
        },
        emojiTitle(emojiUnicode) {
            return emoji.getName(emojiUnicode);
        },
        sendReaction(emoji) {
            console.log(this.$props.username);
            this.$pnPublish({
                channel: this.$props.presentationid,
                message: {
                    text: emoji,
                    type: 'reaction',
                    userId: this.$props.userid ?? uuid,
                    username: this.$props.username ?? uuid,
                }
            });

            // Reset the text input
            this.text = "";
            this.scrollBottom();
        }
    },
    props: ['userid', 'presentationid', 'username']
};
</script>
