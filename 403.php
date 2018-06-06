<!DOCTYPE html>
<html lang="en">
<head>
  <title>Page not found</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style/index-style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="particles/particles.js"></script><!--SRC FOR PARTICLES -->
  <script src="script/loader.js"></script><!--SRC FOR PARTICLES -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        #redirect {
            width: 200%;
            height:100%;
            left:-50%;
            top:25%;
        }
        .page-header{
            width:25%;
            height:25%;
            background-color: rgba(45, 45, 45, 0.2);
            border-radius: 25px;
        }
        p {
            font-family: 'Quicksand', sans-serif;
            text-align:center;
        }
        
        @media only screen and (max-width: 800px){
        .page-header{
            margin-top:100px;
        }
        #redirect {
            width: 200%;
            height:150%;
            left:-50%;
            top:0%;
            
        }
        }
    </style>
</head>

<body id="particles-js">
<div class="container">
    <div class="page-header">
        <div class="page-header-description">
            <p>I see you are lost, or you are looking for something not for you, so I will help you get back to the main page</p>
        </div>
        <div class="page-header-buttons">
            <button type="button" id="redirect" class="btn btn-success btn-header" data-toggle="modal" onclick="document.location.href='idex.php">
                Powrót na strone główną
            </button>
        </div>
    </div>
</div>

<script>
/* particlesJS.load(@dom-id, @path-json, @callback (optional); */
particlesJS.load('particles-js', 'particles/error-particlesjs.json', function() {
  console.log('callback - particles.js config loaded');
});

  
</script>
<script> /*Skrypt powrotu na strone główną*/
var btn = document.getElementById('redirect');
    btn.addEventListener('click', function() {
      document.location.href = 'index.php';
    });
</script>

</body>
</html>