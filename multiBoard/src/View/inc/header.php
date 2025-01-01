<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">미니보드</a>
      <!-- 로그인페이지 버튼 안보이게 -->
      <?php if(!($_GET['url'] === 'login' ||  $_GET['url'] === 'regist')) { ?>
      <!-- 햄버거 버튼 -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              게시판
            </a>
            <ul class="dropdown-menu">
              <?php foreach($this->arrBoardNameInfo as $item){ ?> 
                <li><a class="dropdown-item" href="/boards?bc_type=<?php echo $item['bc_type'] ?>"><?php echo $item['bc_name'] ?></a></li>
              <?php } ?>
              <!-- db의 정보를 기반으로 dropdown 만들어 줘야한다 -> 거의 모든 게시판에 뜬다 -> controller에서 작업해주자 -->
            </ul>
          </li>
        </ul>
        <a href="/logout" class="navbar-nav nav-link text-light " role="button">로그아웃</a>
      </div>
      <?php } ?> <!-- 이까지 if문 -->
    </div>
  </nav>
</header>
