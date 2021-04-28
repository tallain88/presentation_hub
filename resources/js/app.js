import PubNubVue from 'pubnub-vue'
import store from './store';

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue").default;

const publish_Key = process.env.MIX_PUBLISH_KEY;
const subscribe_Key = process.env.MIX_SUBSCRIBE_KEY;

// Make a unique uuid for each client
const myUuid = fourCharID();
const me = {
    uuid: myUuid
};

window.Vue = require('vue').default;
// window.Vue = require('firebase/firestore').default;

try {
    if (!publish_Key || !subscribe_Key) {
        throw "PubNub Keys are missing.";
    }
} catch (err) {
    console.log(err);
}

// Initialize the PubNub client API
Vue.use(
    PubNubVue,
    {
        subscribeKey: subscribe_Key,
        publishKey: publish_Key,
        ssl: true
    },
    store
);

// Execute when the Vue instance is created
function created() {
    this.$store.commit("setMe", { me });
}

/**
 * Get a new 4 character ID. It is recommended to use a standard 128-bit UUID
 *     in production apps instead.
 *
 * @return {string} A unique ID for each user.  */

function fourCharID() {
    const maxLength = 4;
    const possible = "abcdef0123456789";
    let text = "";

    for (let i = 0; i < maxLength; i++) {
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    return text;
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
// Base

// Splash Page Components
Vue.component(
    "splash-demo",
    require("./components/SplashPage/Demo.vue").default
);
Vue.component(
    "splash-controls",
    require("./components/SplashPage/Actions/Actions.vue").default
);
Vue.component(
    "splash-controls-action-join",
    require("./components/SplashPage/Actions/JoinAction.vue").default
);
Vue.component(
    "splash-controls-action-share",
    require("./components/SplashPage/Actions/ShareAction.vue").default
);

// Presentation
Vue.component(
    "presentation-controls",
    require("./components/Presentation/controls/Controls.vue").default
);
Vue.component(
    "presentation-controls-kick-viewer",
    require("./components/Presentation/controls/KickViewer.vue").default
);
Vue.component(
    "presentation-effects",
    require("./components/Presentation/controls/Effects.vue").default
);
Vue.component(
    "presentation-user-list",
    require("./components/Presentation/controls/UserList.vue").default
);
Vue.component(
    "presentation-user-listing",
    require("./components/Presentation/controls/UserListing.vue").default
);
Vue.component(
    "presentation-reactions",
    require("./components/Presentation/controls/Reactions.vue").default
);
Vue.component(
    "presentation-video",
    require("./components/Presentation/Video.vue").default
);
Vue.component(
    "presentation-chat",
    require("./components/Presentation/chat/Chat.vue").default
);
Vue.component(
    "presentation-chat-head",
    require("./components/Presentation/chat/ChatHead.vue").default
);
Vue.component(
    "presentation-chat-listing-received",
    require("./components/Presentation/chat/ChatListingReceived.vue").default
);
Vue.component(
    "presentation-chat-listing-sent",
    require("./components/Presentation/chat/ChatListingSent.vue").default
);
Vue.component(
    "presentation-reaction-listing",
    require("./components/Presentation/chat/Reaction.vue").default
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
export const eventBus = new Vue();

const app = new Vue({
    el: "#app",
    store,
    created
});
