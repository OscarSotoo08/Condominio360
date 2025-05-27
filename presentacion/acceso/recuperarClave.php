<?php 
require_once "logica/Mail.php";

$error = "";
$respuesta = false;
$correo = "";

function almacenarCodigo(Administrador | Propietario $persona){
    $codigo = rand(100000, 999999);
    $expira = date("Y-m-d H:i:s", strtotime("+15 minutes")); // 15 min
    $persona -> setCodigo($codigo);
    $persona -> setFechaExp($expira);
    $persona -> guardarCodigo();
    $mensaje = "El código de verificación es: $codigo";
    echo $persona->getCorreo();
    echo $mensaje;
    $mail = new Mail($persona->getCorreo(), "Recuperar contraseña", $mensaje);
    // return $mail->enviar();
    return true;
  }

function redirigir($id, $tipo){
  $_SESSION["id"] = $id;
  $_SESSION["tipo"] = $tipo;
  header("Location: ?pid=".base64_encode("presentacion/acceso/cambiarClave.php"));
}

if(isset($_POST["recuperar"])){
  # 1. Captura de datos
  $correo = $_POST["correo"];

  $persona = new Administrador(correo: $correo);
$persona->verificarCorreo();

if($persona->getId() != ""){
  $respuesta = almacenarCodigo($persona);
  } else {
    $persona = new Propietario(correo: $correo);
    $persona->verificarCorreo();
    if($persona->getId() != ""){
      $respuesta = almacenarCodigo($persona);
    } else {
      $error = "El correo ingresado no existe.";
    }
}

}


if(isset($_POST["verificar"])){
  $codigo = md5(trim($_POST["codigo"]));
  $persona = new Administrador(codigoRecuperacion: $codigo);
  if(($id = $persona -> verificarCodigo()) != null){
    redirigir($id, "administrador");
  } else{
    $persona = new Propietario(codigoRecuperacion: $codigo);
    if(($id = $persona -> verificarCodigo()) != null){
      redirigir($id, "propietario");
    } else{
      $respuesta = false;
      $error = "El código ingresado no es válido.";
    }
  }
}

?>

<body class="bg-info d-flex justify-content-center align-items-center min-vh-100">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <div class="text-center">
          <a href="?" target="_blank" rel="noopener noreferrer">
            <img src="img/logo.png" class="rounded-circle w-25 mb-5" alt="...">
          </a>
        </div>
        

<?php if($respuesta): ?>
<!-- Modal para ingresar el codigo de verificacion-->
<div class="modal modal-dialog modal-dialog-centered" id="verificar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h1 class="modal-title fs-5 " id="staticBackdropLabel">Ingresa tu código</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="?pid=<?php echo base64_encode("presentacion/acceso/recuperarClave.php")?>" method="post">
          <div class="mb-3">
            <input type="text" class="form-control form-control-lg" id="codigo" name="codigo" required placeholder="Código de verificación">
          </div>
          <div class="d-grid">
            <button type="submit" name="verificar" class="btn btn-primary btn-lg">Verificar código</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

        <!-- Mensajes de error y respuesta -->
        <?php if($error != "") echo "<div class='alert alert-danger text-center' role='alert'>$error</div>"; ?>
        <div class="card border-0 shadow-lg rounded-4">
          <div class="card-body p-4">
            <div class="text-center mb-4">
              <h4 class="fw-semibold">Recuperar Contraseña</h4>
              <p class="text-muted mb-0">Te enviaremos un código para restablecerla</p>
              <p class="text-muted mb-0">El código expirará en 15 minutos</p>
            </div>
            <form action="?pid=<?php echo base64_encode("presentacion/acceso/recuperarClave.php")?>" method="post">
              <div class="mb-3">
                <input type="email" class="form-control form-control-lg" id="correo" name="correo" required placeholder="Correo electrónico">
              </div>
              <div class="d-grid">
                <button type="submit" name="recuperar" class="btn btn-primary btn-lg">Enviar instrucciones</button>
              </div>
            </form>
            <div class="text-center mt-3">
              <a href="?" class="text-decoration-none link-primary">Volver al inicio de sesión</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  




<script>
  <?php if($respuesta): ?>
    const modal = new bootstrap.Modal(document.getElementById('verificar'));
    modal.show();
  <?php endif; ?>
</script>  


</body>