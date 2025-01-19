<template>
    <router-link :to="{name:'Home'}">Home</router-link>
    <router-link :to="{name:'All'}">All cars</router-link>
    <router-view></router-view>
</template>

<script>
export default {
    name: "IndexComponent"
}
</script>

<style scoped>

</style>
