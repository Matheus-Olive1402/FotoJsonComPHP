<?php

/*
a aplicação do codigo abaixo serve para salvar o arquivo, recebe em POST do html, se existi um arquivo (no caso chamado de $arquivousuarios) o array $usuparios vai tem um index com arquivo posto (file_get) se não existir o aruivo o aray vai reseber o POST e transforma em json pra envia pra um dos index
*/

$arquivosusuarios = 'usuarios.json';
if (count($_POST)){
    $usuario = $_POST;
    $usuarios = [];
    if (file_exists($arquivosusuarios)){
        $usuarios = json_decode(file_get_contents($arquivosusuarios), true);
    }
    $usuarios[]= $usuario;    
    file_put_contents($arquivosusuarios, json_encode($usuarios));
    
    }
    $usuarios = [];
    if(file_exists($arquivosusuarios)){
        $usuarios = json_decode(file_get_contents($arquivosusuarios), true);
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
                <li class='active'><a href="usuarios.php">usuarios</a></li>
                <li><a href="fotologe.php">Fotos</a></li>
              </ul>
            </div>
        </nav>
    <main>
        <div class="container">
            <div class="row" style="margin-top: 50px;">
                <div class="col s8 offset-s2">
                    <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title">Cadastre um novo usuário</span>
                        </div>
<?php
    if (count($usuarios)){
        echo '<ul class="collection">';
        foreach($usuarios as $u){
        echo'<li class="collection-item avatar">';
        echo'<i class="material-icons circle">account-circle</i>';
        echo'<span class="title">'.$u['nome'].'</span>';
        echo'<p>'. $u['email'].'<br></p>';
        echo'<a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>';
        echo'</li>';
        }
            echo '</ul>';
    }
    else{
?>
<div class="row">
    <div class="col s10 bffset-s1">
      <div class="card blue darken-2">
          <span class="white-text">
          <p>Não existe usuário</p>
        <p>Precisa cadastrar</p>
          </span>
      </div>
    </div>
  </div>

<?php
        
    }
    
                      

?>
                        <div class="card-action">
                            <form class="container"  method="post">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input placeholder="Nome ou apelido" id="nome" name="nome" type="text" class="validate">
                                        <label for="nome">Nome</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input placeholder="email@dominio" id="email" name="email" type="text" class="validate">
                                        <label for="nome">Email</label>
                                    </div>
                                    <div class="col s12 right-align">
                                        <button class="btn waves-effect waves-light" type="submit">cadastrar
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>    
                                </div>
                            </form>
                        </div> 
                    </div>
                </div>
            </div>
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
        