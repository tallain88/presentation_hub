<template>
    <div class="col-lg-6 container">
        <video id="video" autoplay class="container-fluid" :key=source.id  ref="webcam"></video>
            
        </video>
        <button v-if=isHost @click=stopStream>Stop Stream</button>
        <button v-if=isHost @click=startStream>Start Stream</button>
        <button v-else @click=connectToStream>Connect to Stream</button>
    </div>
</template>

<style scoped>
    #video {
        z-index: 10;
    }
    .container {
        margin-bottom: 10px;
    }
</style>

<script>
    import {eventBus} from "../../app";
    import Peer from "simple-peer";
    import {getPermissions} from "../../helper";
    import axios from 'axios';

    export default {
        props: {
            isHost: false,
            userId: null,
            turnServerUrl: null,
            turnServerUsername: null,
            turnServerCredential: null,
            presentation: null,

        },
        data() {
            return {
                source: '',
                broadcasterPeer: null,
                broadcasterId: null,
                presentationPassword: null,
                presentationTitle: null,
                presentationStreamChannel: null,
                streamingUsers: [],
                currentlyContactedUser: null,
                allPeers: {},
            }
        },
        mounted() {
            console.log('Component mounted.')
            console.log()
        },
        created() {
            // attach event listener
            eventBus.$on('source', this.updateSource);
            eventBus.$on('webcam', this.updateWebcam);

        },
        beforeDestroy(){
           // remove event listener
           EventBus.$off("source", this.updateSource)
           EventBus.$off("webcam", this.updateWebcam)
        },
        methods: {
            // update video source and create URL object
            updateSource(message){
                this.source = URL.createObjectURL(message);
                console.log(this.source);
                this.$refs.webcam.src = this.source;
            },
            updateWebcam(stream){
                console.log(stream);
                const videoTracks = stream.getVideoTracks();
                // window.stream = stream;
                this.source = stream;
                // this.$refs.webcam.srcObject = stream;
                
            },
            async startStream(){
                const stream = await getPermissions();
                this.$refs.webcam.srcObject = stream;
                this.initializeStreamChannel();
                this.initializeSignalAnswerChannel();
                console.log("stream started...");
            },
            stopStream(){
                let tracks = this.$refs.webcam.srcObject.getTracks();

                tracks.forEach(track => {
                    track.stop();
                });
            },
            connectToStream() {
                this.initializeViewerStreamChannel();
                this.initializeViewerSignalOfferChannel();
                console.log("connected to stream");
            },
            initializeViewerStreamChannel() {
                this.presentationStreamChannel = window.Echo.join(
                    `presentation-channel.${this.presentation.link}`
                );
            },
            initializeViewerSignalOfferChannel() {
                window.Echo.private(`presentation-signal-channel.${this.userId}`).listen (
                    "PresentationOffer",
                    ({data}) => {
                        console.log("signal offer from priv channel");
                        this.broadcasterId = data.broadcaster;
                        this.createViewerPeer(data.offer, data.broadcaster);
                    }
                );
            },
            initializeStreamChannel() {
                this.presentationStreamChannel = window.Echo.join(
                    `presentation-channel.${this.presentation.link}`
                );

                this.presentationStreamChannel.here((users) => {
                    this.streamingUsers = users;
                });

                this.presentationStreamChannel.joining((user) => {
                    console.log("New user joined", user);

                    // if user is not already joinedm, add
                    const joiningUserIndex = this.streamingUsers.findIndex(
                        (data) => data.id === user.id
                    );

                    if (joiningUserIndex < 0) {
                        this.streamingUsers.push(user);

                        // New user added, signal user
                        this.currentlyContactedUser = user.id;

                        this.$set(
                            this.allPeers,
                            `${user.id}`,
                            this.createPeer(
                                this.$refs.webcam.srcObject,
                                user,
                                this.signalCallback
                            )
                        );

                        // Create peer
                        this.allPeers[user.id].create();

                        // Init events
                        this.allPeers[user.id].initEvents();
                    }
                });

                this.presentationStreamChannel.leaving((user) => {
                    console.log(user.name, "left stream");

                    // destroy
                    this.allPeers[user.id].getPeer().destroy();

                    // remove peer object
                    delete this.allPeers[user.id];

                    // if broadcaster leaves, close streamingUsers
                    if (user.id === this.userId) {
                        this.streamingUsers = []; //empty
                    } else {
                        const leavingUserIndex = this.streamingUsers.findIndex(
                            (data) => data.id === user.id
                        );
                        this.streamingUsers.splice(leavingUserIndex, 1);
                    }
                })
            },
            initializeSignalAnswerChannel() {
                window.Echo.private(`presentation-signal-channel.${this.userId}`).listen(
                    "PresentaionAnswer",
                    ({data}) => {
                        console.log("Signal answer from channel");

                        if (data.answer.renegotiate) {
                            console.log("renegotiating");
                        }
                        if (data.answer.sdp) {
                            const updatedSignal = {
                                ...data.answer,
                                dsp: `${data.answer.sdp}\n`,
                            };

                            this.allPeers[this.currentlyContactedUser]
                                .getPeer()
                                .signal(updatedSignal);
                        }
                    }
                )
            },
            createPeer(){
                const config = {
                  iceServers: [
                    {
                      urls: "stun:stun.stunprotocol.org",
                    },
                    {
                        urls: this.turnServerUrl,
                        username: this.turnServerUsername,
                        credential: this.turnServerCredential,
                    }
                  ],
                };
            },
            createViewerPeer() {
                const peer = new Peer({
                    iniator: false,
                    trickle: false,
                    config: {
                        iceServers: [
                            {
                                urls: "stun:stun.stunprotocol.org",
                            },
                            {
                                urls: this.turnServerUrl,
                                username: this.turnServerUsername,
                                credential: this.turnServerCredential,
                            },
                        ],
                    },
                });

                // add transceivers for one-way only
                peer.addTransceiver("video", {direction: "recvonly"});
                peer.addTransceiver("audio", {direction: "recvonly"});

                // init peer events to connect to remote peer
                this.handlePeerEvents(
                    peer,
                    broadcaster,
                    this.removeBroadcastVideo
                );

                this.broadcasterPeer = peer;
            },

            handlePeerEvents(peer, offer, broadcaster, callback) {
                peer.on("signal", (data) => {
                    axios
                        .post("/presentation-answer", {
                            broadcaster,
                            answer: data,
                        })
                        .then((response) => {
                            console.log(response);
                        })
                        .catch((error) => {
                            console.log(error);
                        });
                });

                peer.on("stream", (stream) => {
                    // show stream
                    this.$refs.webcam.srcObject = stream;
                });

                peer.on("track", (track, stream) => {
                    consoe.log("On track");
                });

                peer.on("connect", () => {
                    console.log("viewer peer connected");
                });

                peer.on("close", () => {
                    console.log("viewer peer closed");
                    peer.destroy;
                    callback();
                });

                peer.on("error", (error) => {
                    console.log(error);
                });

                const updatedOffer = {
                    ...incomingOffer,
                    sdp: `${incomingOffer}\n`,
                };
                peer.signal(updatedOffer);
            },

            removeBroadcastVideo() {
                console.log("removing broadcast video");
                alert("Livestream ended by broadcaster");
                const tracks = this.$refs.webcam.srcObject.getTracks();
                tracks.forEach((track) => {
                    track.stop();
                });
                this.$refs.webcam.srcObject = null; //close
            },

            signalCallback(offer, user) {
                axios
                    .post("/presentation-offer", {
                        broadcaster: this.userId,
                        receiver: user,
                        offer,
                    })
                    .then ((response) => {
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            getPeer: () => peer,

            initEvents: () => {
                peer.on("signal", (data) => {
                    // send offer to peer
                    signalCallback(data, user);
                });

                peer.on("stream", (stream) => {
                    console.log("onStream");
                });
                
                peer.on("track", (track, stream) => {
                    console.log("onTrack");
                });
                
                peer.on("connect", () => {
                    console.log("Broadcaster Peer connected");
                });
                
                peer.on("close", () => {
                    console.log("Broadcaster Peer closed");
                });
                
                peer.on("error", (err) => {
                    console.log("handle error gracefully");
                });
            },
            
            



        }
    }
</script>
