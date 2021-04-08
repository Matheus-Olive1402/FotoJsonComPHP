<?php
//pra caregar usuários

$arquivosusuarios = 'usuarios.json';
$arquivospostagens = 'postagens.json';
$erro_extensao_invalida = false;
    $usuarios = [];
    if(file_exists($arquivosusuarios)){
        $usuarios = json_decode(file_get_contents($arquivosusuarios), true);
    }
    
    $postagens = [];
    if(file_exists($arquivospostagens)){
        $postagens = json_decode(file_get_contents($arquivospostagens), true);
    }

if(isset($_FILES['foto']) && count($_POST)){
    $nome = $_FILES['foto']['name'];
    $tma = $_FILES['foto']['size'];
    $tipo = $_FILES['foto']['type'];
    $tmp = $_FILES['foto']['tmp_name'];
    $path = 'fotos/'. $nome;
    
    $extensoes = ["jpg","jpeg","png"]; //extensão que qeuro buscar
    $ext = explode('.',$nome);
    $extensao = strtolower(end($ext)); //separar o ponto no caso a ultima
    $erro_extensao_invalida = ! in_array($extensao, $extensoes); //se extansao não tiver em extensoes vai ser true (por causa do !)
    
        if(!$erro_extensao_invalida && $tma > 0){
            move_uploaded_file($tmp, $path);
        
            if (isset($_POST['usuario_id']) && ($_POST['usuario_id'])<count($usuarios)){
                $usuarios = $usuarios[$_POST['usuario_id']]['nome'];
            }
            else{
                $usuarios = 'usuarios desconehcido';
            }
        $titulo = $_POST['titulo'];
        $mensagem = $_POST['mensagem'];
        $foto = $path;
        $novopost = ['usuario'=>$usuarios, 'titulo'=>$titulo, 'mensagem'=>$mensagem, 'foto'=>$foto];
        $postagens[] = $novopost;
        file_put_contents($arquivospostagens, json_encode($postagens));
        }
    
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
                <li class='active'><a href="novapostagem.php">Nova postagem</a></li>
                <li><a href="usuarios.php">usuarios</a></li>
                <li ><a href="fotologe.php">Fotos</a></li>
              </ul>
            </div>
        </nav>
    <main>
        <div class="container">
            <div class="row">
                <div class="col s10 offset-s1">
                    <div class="card grey lighten-5">
                        <div class="card-content">
                            <span class="card-title">Postar uma foto</span>
                            <br>
                            <form class="container" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <select name="usuario_id">
<?php
      if (count($usuarios)){
          echo '<option value="" disabled selected>Quem é você?</option>';
          foreach($usuarios as $id=>$u){
              echo '<option value="'. $id .'">'. $u['nome']. '</option>';
          }
      }else{
          echo '<option value="" disabled selected>Cadastre um novo usuario</option>';
      }                                      
?>
                                                </select>
                                        <label>Usuario</label>
                                    </div>  
                                    <div class="file-field input-field col s6">
                                        <div class="btn cyan accent-4 col s2">
                                            <span><i class="material-icons center">add_a_photo</i></span>
                                            <input type="file" name="foto">
                                        </div>
                                    
                                        <div class="file-path-wrapper col s10">
                                            <input class="file-path validate" type="text">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label for="titulo">Titulo do post</label>
                                            <input type="text" id="titulo" name="titulo">
                                        </div>     
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12"></div>
                                            <label for="mensagem">Sua mensagem</label>
                                            <textarea id="mensagem" name="mensagem" class="materialize-textarea"></textarea>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col s12 right-align ">
                                            <button class="btn waves-effect waves-light" type="submit">submit<i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>                                
                            </form>
                        </div>
                    </div>
                </div>
<?php
  if ($erro_extensao_invalida){
?>
                <div class="row" style="margin-top: 50px;">
                    <div class="col s10 offset-s1">
                        <div class="card-panel red lighten-4">
                            <span class="grey-text text-darken-3">
                            Erro: o arquivo não é uma imagem
                            </span>
                        </div>
                    </div>
                </div>
<?php
  }              
?>
            </div>
        </div>
      </main>
     <footer class="page-footer #ef5350 red lighten-1blue-text text-darken-2">
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
        <!-- framework local -->
      <script type="text/javascript" src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
        <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
       <script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
        });
        </script> 
    </body>
  </html>
        