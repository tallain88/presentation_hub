<template>
    <div
        class="container-fluid col-lg-3 chat-collapse accordion-body"
        id="chat-collapse"
    >
        <div class="card chat bg-gray list mt-2" ref="chat">
            <div v-for="historyMsg in history" v-bind:key="historyMsg.id" class="mt-2">
                <presentation-reaction-listing
                    v-if="historyMsg.userId !== userid && historyMsg.type === 'reaction'"
                    v-bind:emoji="historyMsg.text"
                    v-bind:username="historyMsg.username"
                    >
                </presentation-reaction-listing>
                <presentation-chat-listing-received
                    v-if="historyMsg.userId !== userid && historyMsg.type === 'message'"
                    v-bind:userid="historyMsg.userId"
                    v-bind:text="historyMsg.text"
                    v-bind:username="historyMsg.username"
                ></presentation-chat-listing-received>
                 <presentation-chat-listing-sent
                    v-if="historyMsg.userId === userid && historyMsg.type === 'message'"
                    v-bind:userid="historyMsg.userId"
                    v-bind:text="historyMsg.text"
                    v-bind:username="historyMsg.username"
                ></presentation-chat-listing-sent>
            </div>
            <div v-for="msg in vueChatMsg" v-bind:key="msg.id">
                <presentation-reaction-listing
                    v-if="msg.message.userId === userid && msg.message.type === 'reaction'"
                    v-bind:emoji="msg.message.text"
                    username='You'
                >
                </presentation-reaction-listing>
                <presentation-chat-listing-sent
                    v-if="msg.message.userId === userid && msg.message.type === 'message'"
                    v-bind:userid="msg.message.userId"
                    v-bind:text="msg.message.text"
                    v-bind:username="msg.message.username"
                ></presentation-chat-listing-sent>
            </div>
        </div>
        <div v-if='userId'>
            <textarea
                placeholder="Type here to chat..."
                class="input bg-main"
                v-model="text"
                @keydown.enter="submitMessageOnEnter"
            />
            <button class="btn send btn-secondary" v-on:click="submitMessage">
                Send
            </button>
        </div>
        <div v-if='!userId'>
            <button class="btn send btn-secondary" v-on:click="loginRedirect">
                Login to Chat.
            </button>
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
import PubNubVue from "pubnub-vue";
import { mapGetters } from "vuex";

function fetchHistory(store, presentationId) {
    PubNubVue.getInstance().history(
        {
            channel: presentationId,
            count: 20,
            stringifiedTimeToken: true // false is the default
        },
        (status, response) => {
            const messages = response.messages;
            messages.forEach(message => {
                store.commit("addHistory", { history: [message] });
            });
        }
    );
}

export default {
    data() {
        return {
            title: "PubNub & Vue Global Chat ",
            vueChatMsg: this.$pnGetMessage(this.$props.presentationid),
            text: '',
            userId: this.$props.userid,
        };
    },
    mounted() {
        this.$pnSubscribe({
            channels: [this.presentationid]
        });
        this.$nextTick(function() { fetchHistory(this.$store, this.presentationid); this.scrollBottom()});
    },
    props: ['presentationid', 'username', 'userid'],
    computed: {
        ...mapGetters({
            uuid: "getMyUuid"
        }),
        ...mapGetters({
            history: "getHistoryMsgs"
        }),
    },
    watch: {
        vueChatMsg: function() {
            this.$nextTick(this.scrollBottom);
        },
    },
    methods: {
        submitMessageOnEnter(event) {
            if (!event.shiftKey) {
                event.preventDefault();
            } else {
                return;
            }
            if (this.text === 0) {
                return;
            }
            this.$pnPublish({
                channel: this.$props.presentationid,
                message: {
                    text: this.text,
                    userId: this.$props.userid ?? uuid,
                    username: this.$props.username ?? uuid,
                    type: 'message'
                }
            });
            // Reset the text input
            this.text = "";
            this.scrollBottom();
        },
        submitMessage() {
            if (this.text.length === 0) {
                return;
            }

            const username = this.$props.username === '' ? this.uuid : this.$props.username;
            console.log('username = ' , username);

            this.$pnPublish({
                channel: this.$props.presentationid,
                message: {
                    text: this.text,
                    userId: this.$props.userid ?? this.uuid,
                    username: this.$props.username === '' ? this.uuid : this.$props.username,
                    type: 'message'
                }
            });
            
            // Reset the text input
            this.text = "";
            this.scrollBottom();
        },
        scrollBottom() {
            this.$refs.chat.scrollTo(0, this.$refs.chat.scrollHeight);
        },
        loginRedirect() {
            window.location.href = '/login';
        }
    }
};
</script>
