import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        authFlg: localStorage.getItem('accessToken') ? true : false,
        userInfo: localStorage.getItem('userInfo') ? JSON.parse(localStorage.getItem('userInfo')) : {},
    }),
    mutations: {
        setAuthFlg(state, flg) {
            state.authFlg = flg;
        },
        setUserInfo(state, userInfo) {
            state.userInfo = userInfo;
        },
        setUserInfoBoardsCount(state) {
            state.userInfo.boards_count++;
            localStorage.setItem('userInfo', JSON.stringify(state.userInfo));
        },
    },
    actions: {

        /**
         * 로그인
         * 
         * @param {*} context 
         * @param {*} userInfo 
         */
        login(context, userInfo) {
            const url = '/api/login';

            const data = JSON.stringify(userInfo);

            // config는 axios.js

            axios.post(url, data)
            .then(response => {
                // 토큰 저장
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);
                localStorage.setItem('userInfo', JSON.stringify(response.data.data));
                context.commit('setAuthFlg', true);
                context.commit('setUserInfo', response.data.data);

                router.replace('/boards');
            })
            .catch(error => {
                let errorMsgList = [];
                const errorData = error.response.data;

                if(error.response.status === 422) {
                    if(errorData.data.account) {
                        errorMsgList.push(errorData.data.account[0]);
                    }
                    if(errorData.data.password) {
                        errorMsgList.push(errorData.data.password[0]);
                    }
                } else if(error.response.status === 401) {
                    errorMsgList.push(errorData.msg);
                } else {
                    errorMsgList.push('예기치 못한 오류 발생');
                }

                alert(errorMsgList.join('\n'));
            });
        },

        /**
         * 로그아웃
         * 
         * @param {*}   context
         */
        logout(context) {
            const url = '/api/logout';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.post(url, null, config)
            .then(response => {
                alert('로그아웃 완료');
            })
            .catch(error => {
                alert('문제가 발생하여 로그아웃 처리');
            })
            .finally(() => {
                localStorage.clear();
    
                context.commit('setAuthFlg', false);
                context.commit('setUserInfo', {});
    
                router.replace('/login');
            });
        },

        // 회원가입
        registration(context, userInfo) {
            const url = '/api/registration';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'        
                }
            }

            const formData = new FormData();
            formData.append('account', userInfo.account);
            formData.append('password', userInfo.password);
            formData.append('password_chk', userInfo.password_chk);
            formData.append('name', userInfo.name);
            formData.append('gender', userInfo.gender);
            formData.append('profile', userInfo.profile);

            axios.post(url, formData, config)
            .then(response => {
                alert('회원가입 성공\n가입한 계정으로 로그인하세요');
                
                router.replace('/login');
            })
            .catch(error => {
                alert('회원가입 실패');
            });
        },

        // 토큰 만료 후 처리
        chkTokenAndContinueProcess(context, callbackProcess) {
            // payload 획득
            const payload = localStorage.getItem('accessToken').split('.')[1];
            const base64 = payload.replace(/-/g, '+').replace(/_/g, '/');
            const objPayload = JSON.parse(window.atob(base64));
            // console.log(payload, base64, objPayload);

            const now = new Date();
            if((objPayload.exp * 1000) > now.getTime()){
                // console.log('토큰 유효');
                // 토큰 유효
                callbackProcess(); // 유저가 하려던 처리?
            } else {
                // console.log('토큰 만료');
                 // 토큰 만료 -> 재발급
                context.dispatch('reissueAccessToken', callbackProcess);
            }
        },

        // 토큰 재발급
        reissueAccessToken(context, callbackProcess) {
            // console.log('토큰 재발급 처리');
            callbackProcess(); 

            const url = '/api/reissue';
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('refreshToken'),
                }
            }

            axios.post(url, null, config)
            .then(response => {
                localStorage.setItem('accessToken', response.data.accessToken);
                localStorage.setItem('refreshToken', response.data.refreshToken);

                callbackProcess();
            })
            .catch(error => {
                console.error(errorr);
            });
        },
    },
    getters: {

    }
}