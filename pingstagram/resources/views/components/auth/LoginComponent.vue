<template>
    <div class="form-box">
        <p class="form-title">Login</p>
            <input v-model="userInfo.account" type="text" name="account" placeholder="ID">
            <input v-model="userInfo.password" type="password" name="password" placeholder="Password">
        <button @click="$store.dispatch('user/login', userInfo)" class="btn btn-submit btn-bg-black">Login</button>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

const userInfo = reactive({
    account: '',
    password: '',
});
</script>

<style>

</style>