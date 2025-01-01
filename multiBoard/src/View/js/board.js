(() => {
  document.querySelectorAll('.my-btn-detail').forEach(node => {
    node.addEventListener('click', e => {
      // console.log('버튼 클릭'); // 확인용
      // console.log(e.target.value); // 버튼 누르면 해당 pk값 출력됨
      const URL = '/boards/detail?b_id=' + e.target.value;
      // console.log(URL); // 확인용
      axios.get(URL)
      .then(response => {
        // console.log(response); // 확인용
        const TITLE = document.querySelector('#modalTitle');
        const CONTENT = document.querySelector('#modalContent');
        const IMG = document.querySelector('#modalImg');
        const USER = document.querySelector('#modalName');

        TITLE.textContent = response.data.b_title;
        CONTENT.textContent = response.data.b_content;
        IMG.setAttribute('src', response.data.b_img);
        USER.textContent = response.data.u_name;
        // 우리는 지금 여기 에러처리 다 제외한거임
      })
      .catch(error => {
        console.log(error);
      });
    });
  });

  document.querySelector('#btnInsert').addEventListener('click', () => {
    // console.log(e.target);
    // console.log(e.currentTarget);
    // window.location = '/boards/insert?bc_type=' + document.querySelector('#btnInsert').value;
    window.location = '/boards/insert?bc_type=' + document.querySelector('#inputBoardType').value;
  });

})();