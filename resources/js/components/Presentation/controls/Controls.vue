<template>
   <div class="col-lg-2 card bg-second">
        <div class="card-body">
           <div class="container-fluid">
               <!--  <div class="row mb-3">
                    <button class="btn btn-third" @click=copyPresentationId>Copy Presentation Id</button>
                </div> -->
                <div class="row mb-3">
                  <button @click=handleScreenShareSelect class="btn btn-third">Screen Share</button>

                </div>
                <div class="row mb-4">
                    <button @click=handleWebcamSelect class="btn btn-third">Select Webcam</button>
                    
                  </div>
                <div class="row mb-4">
                    <button class="btn btn-third collapse-chat" data-toggle="collapse" href="#chat-collapse" data-target="#chat-collapse" aria-expanded="true" aria-controls="chat-collapse">Hide Chat</button>
                </div>
           </div>
           <div class="row">
               <presentation-user-list></presentation-user-list>
           </div>
           <div class="row">
               <presentation-effects></presentation-effects>
           </div>
        </div>
   </div>
</template>

<style scoped>
    @media screen and (max-width: 1450px) {
        .card {
            position: fixed;
            z-index: 20;
            min-width: 250px;
        }
    }
    .card {
        height: 81%;
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
    import {eventBus} from "../../../app";

    export default {
        methods: {
          handleWebcamSelect(e){
            const constraints = window.constraints = {
              audio: false,
              video: true
            };
            
            navigator.mediaDevices
              .getUserMedia(constraints)
              .then(stream => {
                eventBus.$emit('webcam', stream);
              })
              .catch(error => {
                alert("Browser not supported");
              })
            
          },
          handleScreenShareSelect(e){
            console.log('bus');
            eventBus.$emit('setScreenShare', e);
          }
        },
        
    }
</script>