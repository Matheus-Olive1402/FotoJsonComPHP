<?php
$arquivospostagens = 'postagens.json';
$postagens = [];
    if(file_exists($arquivospostagens)){
        $postagens = json_decode(file_get_contents($arquivospostagens), true);
    }
?>

<!DOCTYPE html>
  <html>
    <head>
      <!--Import Google Icon Font-->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="./node_modules/materialize-css/dist/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        
        <style>
            body: {
                display: flex;
                min-height: 100vh;
                flex-direction: column;
            }
            main: {
                flex: 1 0 auto;
            }
        </style> <!-- style pra alinhar o corpo como um todo-->
    </head>

    <body>
        <nav class="#ef5350 red lighten-1">
            <div class="nav-wrapper">
              <a style="margin-left: 3%" href="#" class="brand-logo">Sistema de postagem</a>
              <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="novapostagem.php">Nova postagem</a></li>
                <li><a href="usuarios.php">usuarios</a></li>
                <li class='active'><a href="fotologe.php">Fotos</a></li>
              </ul>
            </div>
        </nav>
    <main>
    <div class='container' style="margin-top:50px;">
<?php
  if(count($postagens)){
      foreach($postagens as $i=>$p){
          if ($i % 2 == 0)
            echo '<div class="row">';
            echo '    <div class="col s4 offset-s1">';
            echo '       <div class="card grey lighten-5 z-depth-5">';
            echo '           <div class="card-image">';
            echo '                <img src="'. $p['foto'].'">';
            echo '               <span class="card-title">'. $p['titulo'] .'</span>';
            echo '           </div>';
            echo '           <div class="card-content">';
            echo '               <span class="card-title">'. $p['mensagem'] .'</span>';
            echo '               <br>';
            echo '           </div>';
            echo '         </div>';
            echo '    </div>'; 
          
          
        if ($i % 2 == 1)
            echo '</div>';
      }
  }else{
?>
        <div class="row">
            <div class="col s10 offset-s1">
                <div class="card-panel cyan lighten-5 z-depth-5">
                    <span class="grey-text text-darken-3">
                    Você ainda não possie nenhuma postagem
                    </span>
                </div>
            </div>
        </div>
<?php
  }   
?>
    </div>    
    </main>
     <footer class="page-footer #ef5350 red lighten-1 blue-text text-darken-2">
          <div class="container">
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2021 Copyright fotologo
            <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
          </div>
        </footer>
      <!--JavaScript at end of body for optimized loading-->
      <script type="text/javascript" src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
                <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    </body>
  </html>
        