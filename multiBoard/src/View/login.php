<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>로그인</title>
</head>
<body class="vh-100">
  <?php require_once('View/inc/header.php'); ?>

  <main class="d-flex justify-content-center align-items-center h-75">
    <form style="width:300px;" action="/login" method="POST">
      <?php require_once('View/inc/errorMsg.php') ?>
      <div class="mb-3">
        <label for="u_email" class="form-label">이메일</label>
        <input type="email" class="form-control" id="u_email" name="u_email">
      </div>
      <div class="mb-3">
        <label for="u_password" class="form-label">비밀번호</label>
        <input type="password" class="form-control" id="u_password" name="u_password">
      </div>
      <button type="submit" class="btn btn-dark w-100 mb-3">로그인</button>
      <a href="/regist" class="btn btn-secondary w-100">회원가입</a>
    </form>
  </main>

  <!-- Footer -->
  <footer class="fixed-bottom bg-dark text-light text-center p-3">저작권</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>