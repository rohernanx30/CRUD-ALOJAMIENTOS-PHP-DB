<?php
$active = 'register';
require_once '../includes/config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $existing_user = $stmt->fetch();

    if($existing_user) {
        // Usuario ya existe
        $error = "El usuario ya existe, ingrese otro.";
    } else {
        // Crear usuario nuevo
        $stmt = $pdo->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
        $stmt->execute([$username,$email,$password]);
        $success = "Usuario registrado con éxito, Redirigiendo ...";
    }
}

require_once '../includes/header.php';
?>

<style> 
    form { 
        display: flex; 
        flex-direction: column; 
        max-width: 600px;
        width: 90%;
        margin: 20px auto;
        font-family: Georgia, 'Times New Roman', Times, serif; 
    } 
    form input, form textarea { 
        padding: 10px; 
        margin-bottom: 10px; 
        border-radius: 5px; 
        border: 1px solid #ccc;
        font-family: Georgia, 'Times New Roman', Times, serif;  
    } 
    form button { 
        padding: 10px; 
        font-size: 18px;
        font-family: Georgia, 'Times New Roman', Times, serif; 
        border: none; 
        border-radius: 5px; 
        background-color: #4CAF50; 
        color: white; cursor: pointer; 
    } 
    form button:hover {
         background-color: #45a049; 
    }   
    .login-redirect {
        text-align: center; 
        margin-top: 25px; 
        font-size: 16px; 
    }
    
    .login-redirect a {
        color: #4CAF50; 
        font-weight: bold; 
        text-decoration: none; 
    
    }

    .login-redirect a:hover { 
        text-decoration: underline; 
    }

    label{ 
        font-size: 16px; 
        font-family: Georgia, 'Times New Roman', Times, serif; 
        font-weight: bold; 
    }

    .content { 
        margin-top: 40px; 
        padding: 20px; 
    }   

    .toast-error, .toast-success {
        display: none;
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px 25px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        z-index: 2000;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .toast-error { 
        background-color: #ec1b1b9d; 
        color: white; 
    }

    .toast-success { 
        background-color: rgba(76, 175, 80, 0.9); 
        color: white; }
</style>

<div class="content">
    <h2 style="text-align: center;">Registro</h2>
    <form method="post">
        <label for="nombre">Usuario: </label><br>    
        <input type="text" name="username" placeholder="Ingrese su usuario" required><br>
        <label for="Correo electronico">Correo electrónico:</label><br>    
        <input type="email" name="email" placeholder="Ingrese su correo" required><br>
        <label for="Contraseña">Contraseña: </label><br>    
        <input type="password" name="password" placeholder="Ingrese su contraseña" required><br>
        <button type="submit">Registrar</button>

        <p class="login-redirect">
            ¿Ya tienes cuenta?
            <a href="login.php">Inicia sesión aquí</a>
        </p>
    </form>
</div>

<?php if(!empty($error)): ?>
<div class="toast-error" id="registerErrorToast">
    <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
</div>
<script>
    const errorToast = document.getElementById('registerErrorToast');
    if(errorToast){
        errorToast.style.display = 'flex';
        errorToast.style.opacity = '1';
        setTimeout(() => { errorToast.style.transition = 'opacity 0.5s'; errorToast.style.opacity = '0'; }, 2500);
        setTimeout(() => { errorToast.style.display = 'none'; }, 3000);
    }
</script>
<?php endif; ?>

<?php if(!empty($success)): ?>
<div class="toast-success" id="registerSuccessToast">
    <i class="fas fa-check-circle"></i> <?php echo $success; ?>
</div>
<script>
    const successToast = document.getElementById('registerSuccessToast');
    if(successToast){
        successToast.style.display = 'flex';
        successToast.style.opacity = '1';
        setTimeout(() => { successToast.style.transition = 'opacity 0.5s'; successToast.style.opacity = '0'; }, 2500);
        setTimeout(() => { window.location.href = 'login.php'; }, 3000);
    }
</script>
<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>
