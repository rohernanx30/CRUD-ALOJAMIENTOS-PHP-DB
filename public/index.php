<?php
$active = 'index';
require_once '../includes/header.php';

// Obtener alojamientos
$stmt = $pdo->query("SELECT * FROM accommodations");
$alojamientos = $stmt->fetchAll();
?>

<style>
    button{
        font-size: 16px;   
        font-weight: bold;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-align: center;
    }
    
    h1{
        font-size: 30px;   
        font-weight: bold;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-align: center;
    }
    
    .content {
        margin-top: 40px; 
        padding: 20px;
    }  

    .add-button {
        display: block;
        width: 80%;
        margin: 15px auto 0 auto;
        padding: 8px 15px;
        background-color: #4CAF50;
        color: white;
        text-align: center;
        border-radius: 5px;
        font-weight: bold;
        text-decoration: none;
        cursor: pointer;
    }

    .add-button:hover {
        background-color: #45a049;
    }

    .toast {
        visibility: hidden;
        max-width: 300px;
        background: rgba(0, 0, 0, 0.7);
        color: #fff;
        text-align: center;
        border-radius: 10px;
        padding: 15px 20px;
        position: fixed;
        z-index: 10000;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font-weight: bold;
        font-size: 18px;
        opacity: 0;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: opacity 0.5s, top 0.5s;
    }

    .toast.show {
        visibility: visible;
        opacity: 1;
        top: 45%;
    }

    .toast i {
        font-size: 24px;
        color: #4CAF50; 
    }
</style>

<div class="content">
    <h1>Lista de Alojamientos</h1>
    <div class="accommodations">
        <?php foreach($alojamientos as $a): ?>
            <div class="accommodation-card">
                <img src="<?php echo $a['image_url']; ?>" alt="">
                <h3><?php echo $a['title']; ?></h3>
                <p><?php echo $a['description']; ?></p>
                <p>Precio: $<?php echo $a['price']; ?></p>

                <?php if(is_logged_in() && !is_admin()): ?>
                    <form action="favorite.php" method="post">
                        <input type="hidden" name="accommodation_id" value="<?php echo $a['id']; ?>">
                        <input type="hidden" name="action" value="add">
                        <button type="submit" class="add-button">★ Agregar a mi cuenta</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Toast -->
<div id="toast" class="toast">
    <i id="toast-icon" class="fas fa-check-circle"></i>
    <span id="toast-message"></span>
</div>


<script>
window.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const toast = document.getElementById('toast');
    const toastMessage = document.getElementById('toast-message');
    const toastIcon = document.getElementById('toast-icon');

    if(urlParams.get('success') === '1'){
        toastMessage.textContent = "Alojamiento agregado exitosamente";
        toastIcon.className = 'fas fa-check-circle';
        toastIcon.style.color = '#4CAF50'; 
        toast.classList.add('show');
    } 
    else if(urlParams.get('already') === '1'){
        toastMessage.textContent = "Ya tienes este alojamiento agregado";
        toastIcon.className = 'fas fa-exclamation-circle';
        toastIcon.style.color = '#FFC107'; 
        toast.classList.add('show');
    }

    // Ocultar toast automáticamente
    if(toast.classList.contains('show')) {
        setTimeout(() => { toast.classList.remove('show'); }, 3000);
    }
});
</script>

<?php require_once '../includes/footer.php'; ?>
