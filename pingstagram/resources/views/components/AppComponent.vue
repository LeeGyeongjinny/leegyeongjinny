<template>
    <!-- Header -->
    <header>
        <div class="header-container">
            <div class="header-content">
                <div class="title">
                    <router-link to="/boards"><h1>Pingstagram</h1></router-link>
                </div>
                <img src="/hachu.png" alt="img-logo">
                <div class="btn-group">
                    <div v-if="!$store.state.user.authFlg">
                        <router-link to="/registration"><button class="btn btn-header btn-bg-black">회원가입</button></router-link>
                    </div>
                    <div v-else>
                        <button @click="$store.dispatch('user/logout')" class="btn btn-header btn-bg-black">로그아웃</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main -->
    <main>
        <!-- <button @click="$store.dispatch('user/chkTokenAndContinueProcess', () => {console.log('테스트')})">토큰 만료체크 후 삭제</button> -->
        <UserInfoComponent v-if="$store.state.user.authFlg" />
        <br>
        <div class="container">
            <router-view></router-view>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>ⓒ 2024. LeeGyeongjinny All rights reserved.</p>
    </footer>
</template>

<script setup>
import UserInfoComponent from './user/UserInfoComponent.vue';
</script>

<style>
    @import url('../../css/common.css');
</style>