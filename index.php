<!DOCTYPE html>
<?php $_POST = array(); ?>
<html lang="en">
<head>
  <title>noteMe - Internetowy pojemnik na twoje myśli! </title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style/index-style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="particles/particles.js"></script><!--SRC FOR PARTICLES -->
  <script src="script/loader.js"></script><!--SRC FOR PARTICLES -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="particles-js"><!--ID FOR PARTICLES -->
  <div id="loginResult"><?php echo(''); ?></div>

<div class="container">
  <div class="loader"></div>

<!-- Button trigger modal -->

<div class="page-header">
    <div class="page-header-title">
    <img class="logo" src="assets/logo.png"></img>
    </div>
  <div class="page-header-description">
    <div class="description">
     <h3> Internetowy pojemnik na twoje myśli! </h3>
</div>
<br/>
  </div>
    <div class=page-header-buttons>
      <button type="button" class="btn btn-success btn-header" data-toggle="modal" data-target="#registerModal">
        Zarejestruj
      </button>
      <button type="button" class="btn btn-danger btn-header" style="float:right;" data-toggle="modal" data-target="#loginModal">
        Zaloguj
      </button>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title">Zarejestruj się</h3>
      </div>
      <div class="modal-body">

      <form id="registerform-form" action="" method="post">
              <div class="row">
                <div class="form-group">
                  <div class="col-lg-3 col-xs-12">
                    <label for="registerform-login" class="btn btn-default btn-sm" style="width:100%">
                      <span class="glyphicon glyphicon-user"></span> Login
                    </label>
                  </div>
                  <div class="col-lg-9 col-xs-12">
                    <input name="login" type="text" class="form-control" id="registerform-login" placeholder="Podaj Login" required></input>
                  </div>
                </div>
              </div><br/>
              <div class="row">
                <div class="form-group">
                  <div class="col-lg-3 col-xs-12">
                    <label for="mail" class="btn btn-default btn-sm" style="width:100%">
                      <span class="glyphicon glyphicon-envelope"></span> Adres e-mail
                    </label>
                  </div>
                  <div class="col-lg-9 col-xs-12">
                    <input name="mail" type="text" class="form-control" id="registerform-email" placeholder="Podaj e-mail" required></input>
                  </div>
                </div>
              </div><br/>
              <div class="row">
                <div class="form-group">
                  <div class="col-lg-3 col-xs-12">
                    <label for="pass1" class="btn btn-default btn-sm" style="width:100%">
                      <span class="glyphicon glyphicon-lock"></span> Hasło
                    </label>
                  </div>
                  <div class="col-lg-9 col-xs-12">
                    <input name="pass1" type="password" class="form-control" id="registerform-password1" placeholder="Podaj hasło" required></input>
                  </div>
                </div>
              </div><br/>
              <div class="row">
                <div class="form-group">
                  <div class="col-lg-3 col-xs-12">
                    <label for="pass2" class="btn btn-default btn-sm" style="width:100%">
                      <span class="glyphicon glyphicon-lock"></span> Powtórz hasło
                    </label>
                  </div>
                  <div class="col-lg-9 col-xs-12">
                    <input name="pass2" type="password" class="form-control" id="registerform-password2" placeholder="Powtórz hasło" required></input>
                  </div>
                </div>
              </div><br/>
      <div class="modal-footer">
      <span id="registerform-info" class="label label-danger"></span>
      <input type="button" id="registerform-submit" value="Zarejestruj się" class="btn btn-success btn-form">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
        
      </div>
</form>   
      </div>


    </div>
  </div>
</div>

 <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title">Zaloguj się</h3>
          </div>
          <div class="modal-body">
            <form id="login-form" action="" method="post">

              <div class="row">
                <div class="form-group">
                  <div class="col-lg-3 col-xs-12">
                    <label for="loginform-login" class="btn btn-default btn-sm" style="width:100%">
                      <span class="glyphicon glyphicon-user"></span> login
                    </label>
                  </div>
                  <div class="col-lg-9 col-xs-12">
                    <input name="auth-login" type="text" class="form-control" id="loginform-login" placeholder="Podaj Login"></input>
                  </div>
                </div>
              </div><br/>
              <!-- end or row1 -->
              <div class="row">
                <div class="form-group">
                  <div class="col-lg-3 col-xs-12">
                    <label for="loginform-password" class="btn btn-default btn-sm" style="width:100%">
                      <span class="	glyphicon glyphicon-lock"></span> Hasło
                    </label>
                  </div>
                  <div class="col-lg-9 col-xs-12">
                    <input name="auth-password" type="password" class="form-control" id="loginform-password" placeholder="Podaj Hasło"></input>
                  </div>
                </div>
                <br/>
                <div class="modal-footer">
                <span id="loginform-info" class="label label-danger"></span>
                  <input id="login-form-submit"  type='button' class="btn btn-success" value="zaloguj"></input>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Zamknij</button>
                </div>
              </div>
              <!-- end of row2-->
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
/* particlesJS.load(@dom-id, @path-json, @callback (optional); */
particlesJS.load('particles-js', 'particles/particlesjs-config.json', function() {
  console.log('callback - particles.js config loaded');
});

  
</script>
<script src="controllers/Index.js"></script>
</body>
</html>


