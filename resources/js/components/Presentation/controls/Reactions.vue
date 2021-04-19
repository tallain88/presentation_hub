<template>
   <div class="col-lg-2 ml-2 card bg-second">
       <div class="row mt-2 justify-content-center">
            <button class="btn btn-third collapse-chat" data-toggle="collapse" href="#chat-collapse" data-target="#chat-collapse" aria-expanded="false" aria-controls="chat-collapse">Toggle chat</button>
        </div>
        <input class="search mt-2" placeholder="Search emojis" type="text" name="emoji-search" v-model="emojiSearch" v-on:input="emojiSearchHandler"/>
        <div class="card-body mt-2">
               <div v-for="(chunk, index) in emojiChunks" v-bind:key="index" class="row bg-gray">
                   <div v-for="(emoji, index) in chunk" v-bind:key="index" class="col-3 emoji" v-bind:title="emojiTitle(emoji)">{{emoji}}</div>
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
    const emoji = require("emoji-dictionary");

    export default {
        data: function () {
            return {
                searchResults: [],
                emojiSearch: '',
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        computed: {
            emojiChunks: function () {
               const chunkArray = this.searchResults.length > 0 ? this.searchResults : emoji.unicode;
               const CHUNK_SIZE = Math.min(4, chunkArray.length);
               const res = [];
                for (let i = 0; i < chunkArray.length; i += CHUNK_SIZE) {
                    const chunk = chunkArray.slice(i, i + CHUNK_SIZE);
                    res.push(chunk);
                }
                return res;
            },
        },
        methods: {
            emojiSearchHandler: function (event) {
                const search = event.target.value.toLowerCase().replace(" ", "_");
                this.searchResults = emoji.names.reduce((results, keyword) => { if (keyword.includes(search)) { results.push(emoji.getUnicode(keyword)); } return results; }, []);
                console.log(this.searchResults);
            },
            emojiTitle(emojiUnicode) {
                return emoji.getName(emojiUnicode);
            },
        }
    }
</script>