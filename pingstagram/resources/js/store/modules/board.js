import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        page:0,
        boardDetail: null,
        controllFlg: true,
        lastPageFlg: false,
        // deleteFlg: true,
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = state.boardList.concat(boardList);
        },
        setPage(state, page) {
            state.page = page;
        },
        setBoardDetail(state, board) {
            state.boardDetail = board;
        },
        setBoardListUnshift(state, board) {
            state.boardList.unshift(board);
        }, // 배열 맨 앞에 추가
        setControllFlg(state, flg) {
            state.controllFlg = flg;
        },
        setLastPageFlg(state, flg) {
            state.lastPageFlg = flg;
        },
        // setDeleteFlg(state, flg) {
        //     state.deleteFlg = flg;
        // },
    },
    actions: {
        // 게시글 획득
        boardListPagination(context) {
            // console.log(context.state.controllFlg);
            // 디바운싱
            if(context.state.controllFlg) {
                // console.log('디바운싱 들어옴');
                context.commit('setControllFlg', false);
                const url = '/api/boards?page=' + context.getters['getNextPage'];
                const config = {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    }
                }
    
                axios.get(url, config)
                .then(response => {
                    // console.log(response);
                    context.commit('setBoardList', response.data.boardList.data);
                    context.commit('setPage', response.data.boardList.current_page);

                    if(response.data.boardList.current_page >= response.data.boardList.last_page) {
                        context.commit('setLastPageFlg',  true);
                    } 
                }) 
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    context.commit('setControllFlg', true);
                });
            }
        },

        // Detail Modal
        showBoard(context, id) {
            context.dispatch(
                'user/chkTokenAndContinueProcess'
                , () => {
                    const url= '/api/boards/' + id;
                    const config = {
                        headers: {
                            'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                        }
                    }
                
                    axios.get(url, config)
                    .then(response => {
                        context.commit('setBoardDetail', response.data.board);
                    })
                    .catch(error => {
                        console.error(error);
                    });
                }
                , {root:true});
        },

        // insert
        storeBoard(context, data) {
            // 디바운싱
            if(context.state.controllFlg) {
                context.commit('setControllFlg', false);

                const url = '/api/boards';
                const config = {
                    headers: {
                        'Content-Type': 'multipart/form-data' ,
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    }
                }

                const formData = new FormData();
                formData.append('title', data.title);
                formData.append('content', data.content);
                formData.append('img', data.file);
    
                axios.post(url, formData, config)
                .then(response => {
                    context.commit('setBoardListUnshift', response.data.board);
                    context.commit('user/setUserInfoBoardsCount', null, {root: true}); // user 모듈 접근
    
                    router.replace('/boards');
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => {
                    context.commit('setControllFlg', true);
                });
            }
        },

        destroyBoard(context, id) {
                const url = '/api/boards/' + id;
                const config = {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    }
                }

                axios.delete(url, config)
                .then(response => {
                    alert('삭제 성공');
                    // 보드로 보내야해
                })
                .catch(error => {
                    console.error(error);
                    alert('삭제 실패');
                });
        }   
    },
    getters: {
        getNextPage(state) {
            return state.page + 1;
        },
    },
}