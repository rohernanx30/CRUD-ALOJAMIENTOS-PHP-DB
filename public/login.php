<?php
$active = 'login';
require_once '../includes/config.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if($user && password_verify($password,$user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        
    if(is_admin()) {
        header('Location: admin.php'); // admin va directo al panel
    } else {
        header('Location: account.php'); // usuario común va a su cuenta
    }
        exit;
    } else {
        $error = true;
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
        background-color: #4CAF50; 
    }
    
    label{
        font-size: 16px;
        font-family: Georgia, 'Times New Roman', Times, serif; 
        font-weight: bold;
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

    .content {
    margin-top: 40px; /* Para que el header no tape el contenido */
    padding: 20px;
    }
    .toast-error {
    display: none;
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);
    background-color: #ec1b1b9d; 
    color: white;
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
</style> 

<div class="content">
<h2 style="text-align: center;">Inicio de Sesión</h2>

    <form method="post">
    <label for="nombre">Usuario: </label><br>     
    <input type="text" name="username" placeholder="Ingrese su usuario" value="" required><br>
    <label for="nombre">Contraseña: </label><br>     
    <input type="password" name="password" placeholder="Ingrese su contraseña" value="" required><br>
    <button type="submit">Iniciar Sesión</button>

    <p class="login-redirect">
    ¿No tienes cuenta?
    <a href="register.php">Regístrate aquí</a>
    </p>
</form>
</div>

<?php if(!empty($error)): ?>
<div class="toast-error" id="loginToast">
    <i class="fas fa-exclamation-circle"></i> Usuario o contraseña incorrectos
</div>
<script>
    const loginToast = document.getElementById('loginToast');
    loginToast.style.display = 'flex';
    setTimeout(() => {
        loginToast.style.opacity = '0';
    }, 2500);
    setTimeout(() => {
        loginToast.style.display = 'none';
    }, 3050);
</script>
<?php endif; ?>

<?php require_once '../includes/footer.php'; ?>
