<?php
$active = 'admin';
require_once '../includes/header.php';
if(!is_admin()) {
    echo "<p>No tienes permiso para ver esta página</p>";
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $img = $_POST['image_url'];

    $stmt = $pdo->prepare("INSERT INTO accommodations (title, description, price, image_url) VALUES (?,?,?,?)");
    $stmt->execute([$title,$desc,$price,$img]);
     echo '<div class="toast-success" id="adminToast">
            <i class="fas fa-check-circle"></i> Alojamiento agregado correctamente
          </div>';
    echo '<script>
            const adminToast = document.getElementById("adminToast");
            adminToast.style.display = "flex";
            setTimeout(() => { adminToast.style.opacity = "0"; }, 2500);
            setTimeout(() => { adminToast.style.display = "none"; }, 3050);
          </script>';
}
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
    margin-top: 30px; /* Para que el header no tape el contenido */
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
    .toast-success {
        display: none;
        position: fixed;
        top: 20%;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(76, 175, 80, 0.9);
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
    <h2 style="text-align: center;">Agregar Alojamiento a la base de datos</h2>
    <form method="post">
        <label for="titulo">Título </label><br>
        <input type="text" name="title" placeholder="Ingrese el nombre del alojamiento" required><br>
        <label for="Descripcion">Descripción: </label><br>
        <input name="description" placeholder="Ingrese una descripción"></textarea><br>
       <label for="number">Precio: </label><br>
        <input type="number" step="0.01" name="price" placeholder="Ingrese el precio" required><br>
        <label for="nombre">Enlace de imagen: </label><br>
        <input type="text" name="image_url" placeholder="Ingrese el URL de la imagen"><br>
        <button type="submit">Agregar</button>
    </form>
</div>

<?php require_once '../includes/footer.php'; ?>
