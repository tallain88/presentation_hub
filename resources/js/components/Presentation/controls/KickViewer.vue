<template>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header bg-main">
                <h5 class="modal-title text-white" id="exampleModalLabel">Are you sure you want to kick <em id="username-emphasis">{{username}}</em>?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer bg-main">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-secondary">Kick <em id="username-emphasis">{{username}}</em></button>
            </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    #username-emphasis {
        color: cyan;
    }
</style>

<script>
    export default {
        props: {
            username: {
                type: String,
            },
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>