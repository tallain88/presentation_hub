<template>
    <div class="user-listing mb-1 row">
        <div class="col-sm-8">
            <span class="label">{{ username }}</span>
        </div>
        <div class="col-sm-4">
            <img class="icon" src="/images/account.svg"/>
            <img class="icon" src="/images/close.svg" data-toggle="modal" data-target="#kick-user-modal"/>
        </div>
        <presentation-controls-kick-viewer id="kick-user-modal" :username="username"></presentation-controls-kick-viewer>
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
            username: {
                type: String,
            },
        },
    }
</script>