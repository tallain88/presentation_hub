<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-main">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Share a Presentation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-main">
                    <form method="POST" action="/presentation">
                        <div class="form-group row">
                            <label for="title" class="col-sm-4 col-form-label text-white">Presentation Name</label>
                            <div class="col-sm-8">
                                <input id="title" name="title" placeholder="Presentation Name" value="" required v-model=title>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="viewer-limit" class="col-sm-4 col-form-label text-white">Viewer Limit</label>
                            <div class="col-sm-8">
                                <input id="viewer-limit" name="viewer-limit" type="number" placeholder=5 value=5 required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-sm-4 col-form-label text-white">Password (optional)</label>
                            <div class="col-sm-8">
                                <input id="password" name="password" type="password" placeholder="Password" v-model=password>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-main">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary" @click=handleStartPresentation>Start Presentation</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .input-group {
        padding-right: 0;
        padding-left: 0;
    }
</style>

<script>
    export default {
        data() {
            return {
                password: null,
                title: null,
                
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            handleStartPresentation() {
                var self = this;
                const body = {
                    "title": this.title,
                    'password': this.password,
                };
                console.log(body);
                console.log(process.env.MIX_APP_URL);
                axios.post(process.env.MIX_APP_URL + '/presentation', body)
                .then((response) => {
                    console.log(response.data);
                    window.location.href='/presentation/' + response.data.link;
                }, (error) => {
                    console.log(error);
                });
            }
        }
    }
</script>