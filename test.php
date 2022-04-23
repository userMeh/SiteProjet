<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include "includes/head.php" ?>
    <title>Test</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<header>
  <?php include "includes/header.php" ?>
</header>
<body>
  <div class="container">

      <button id="btnCheck" type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#checkCaptcha" onclick="random()">
        <i id="check" class=bi-square></i>
      </button>

    <div class="modal fade" id="checkCaptcha" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="checkCaptchaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body">
        <div class="d-flex justify-content-center">
          <img id="cap1-1" width="110px" height="110px" class="captcha" src="captcha/debug/1.jpg" onclick="captcha(this.id)" alt="">
          <img id="cap2-2" width="110px" height="110px" class="captcha" src="captcha/debug/2.jpg" onclick="captcha(this.id)" alt="">
          <img id="cap3-3" width="110px" height="110px" class="captcha" src="captcha/debug/3.jpg" onclick="captcha(this.id)" alt="">
        </div>
        <div class="d-flex justify-content-center">
          <img id="cap4-4" width="110px" height="110px" class="captcha" src="captcha/debug/4.jpg" onclick="captcha(this.id)" alt="">
          <img id="cap5-5" width="110px" height="110px" class="captcha" src="captcha/debug/5.jpg" onclick="captcha(this.id)" alt="">
          <img id="cap6-6" width="110px" height="110px" class="captcha" src="captcha/debug/6.jpg" onclick="captcha(this.id)" alt="">
        </div>
        <div class="d-flex justify-content-center">
          <img id="cap7-7" width="110px" height="110px" class="captcha" src="captcha/debug/7.jpg" onclick="captcha(this.id)" alt="">
          <img id="cap8-8" width="110px" height="110px" class="captcha" src="captcha/debug/8.jpg" onclick="captcha(this.id)" alt="">
          <img id="cap9-9" width="110px" height="110px" class="captcha" src="captcha/debug/9.jpg" onclick="captcha(this.id)" alt="">
        </div>
      </div>
      <div id=modalFooter class="modal-footer d-flex justify-content-center">
        <!-- <button type="button" class="btn btn-success" data-bs-dismiss="modal">Valider</button> -->
      </div>
    </div>
  </div>
</div>
  </div>
  <script src="css-js/captcha.js?<?php echo time(); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
-->

</html>
