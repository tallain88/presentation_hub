<template>
    <div class="row ml-2 mr-2 mb-2">
        <h4>{{ emoji }} {{ username }} sent a reaction!</h4>
    </div>
</template>

<style scoped>
.row {
    justify-content: center;
}
h4 {
    color: gray;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
</style>

<script>
export default {
    props: ["emoji", "username"]
};
</script>
