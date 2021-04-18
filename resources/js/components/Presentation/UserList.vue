<template>
    <div class="container-fluid">
        <h5 class="label">Viewer List</h5>
        <hr/>
        <div class="list">
            <presentation-user-listing username="Conor"></presentation-user-listing>
        </div>
    </div>
</template>

<style scoped>
</style>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>