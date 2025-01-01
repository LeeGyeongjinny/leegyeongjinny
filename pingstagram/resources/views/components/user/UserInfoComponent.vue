<template>
    <div class="user-info-box">
        <img :src="$store.state.user.userInfo.profile">
        <div class="user-info-content">
            <h2>{{ $store.state.user.userInfo.account }}</h2>
            <h3>작성글 수 : {{ $store.state.user.userInfo.boards_count }}</h3>
        </div>
        <router-link to="/boards/create"><button class="btn btn-submit">글 작성</button></router-link>
    </div>
</template> 

<script setup>

</script>

<style>
@import url('../../../css/userInfo.css');
</style>