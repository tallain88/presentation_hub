<template>
<div>
    <img class="rounded-circle mt-1 mb-1" height="80px" src="/images/sender_image_placeholder.svg">
    <p class="name">{{username}}</p>
</div>
</template>

<style scoped>
    .name {
        text-align: center;
    }
</style>

<script>
    export default {
        props: ['username']
    }
</script>