
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicon icon -->

    <title>404</title>

    <!-- common css -->
    @vite('resources/css/error.css')


    <!-- HTML5 shim and Respond.js IE9 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.js"></script>
    <script src="assets/js/respond.js"></script>
    <![endif]-->

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/favicon.png">

</head>

<body>
<!-- end about -->
<section class="wrapper">

   <div class="container">

      <div id="scene" class="scene" data-hover-only="false">


         <div class="circle" data-depth="1.2"></div>

         <div class="one" data-depth="0.9">
            <div class="content">
               <span class="piece"></span>
               <span class="piece"></span>
               <span class="piece"></span>
            </div>
         </div>

         <div class="two" data-depth="0.60">
            <div class="content">
               <span class="piece"></span>
               <span class="piece"></span>
               <span class="piece"></span>
            </div>
         </div>

         <div class="three" data-depth="0.40">
            <div class="content">
               <span class="piece"></span>
               <span class="piece"></span>
               <span class="piece"></span>
            </div>
         </div>

         <p class="p404" data-depth="0.50">404</p>
         <p class="p404" data-depth="0.10">404</p>

      </div>

      <div class="text">
         <article>
            <p>Это пиздец!!! Тут нихуя нету! На главную живо!</p>
            <a href=""><button>Yare Yare Daze</button></a>
         </article>
      </div>

   </div>
</section>
<script> 
        // Parallax Code
    var scene = document.getElementById('scene');
    var parallax = new Parallax(scene);
</script>	
</body>
</html>