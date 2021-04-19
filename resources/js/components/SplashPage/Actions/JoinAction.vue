<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header bg-main">
                <h5 class="modal-title text-white" id="exampleModalLabel">Join a presentation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-main">
                <form>
                    <div class="form-group row">
                        <label for="title" class="col-sm-4 col-form-label text-white">Presentation ID</label>
                        <div class="col-sm-8">
                            <input id="title" name="title" type="text" placeholder="Presentation Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="viewer-limit" class="col-sm-4 col-form-label text-white">Password</label>
                        <div class="col-sm-8">
                        <input id="viewer-limit" name="viewer-limit" type="password" placeholder="password">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-main">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary">Save changes</button>
            </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {

        }
    }
</script>