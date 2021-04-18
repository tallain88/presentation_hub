<template>
    <div class="col-md-2">
    <div class="card bg-second">
        <div class="card-body">
            <slot></slot>
        </div>
    </div>
    </div>
</template>

<style scoped>
    .card {
        height: 80%;
    }
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>