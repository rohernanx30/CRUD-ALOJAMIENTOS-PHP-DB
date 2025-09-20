<?php
$active = 'account';
require_once '../includes/header.php';
if(!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT a.* FROM accommodations a
                       JOIN user_accommodations ua ON a.id = ua.accommodation_id
                       WHERE ua.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$my_accommodations = $stmt->fetchAll();
?>

<style>
button{
    font-size: 16px;   
    font-weight: bold;
    font-family: Georgia, 'Times New Roman', Times, serif;
    cursor: pointer;
}

h1,h2{   
    font-weight: bold;
    font-family: Georgia, 'Times New Roman', Times, serif;
    text-align: center;
}

.content {
    margin-top: 45px; /* Para que el header no tape el contenido */
    padding: 20px;
}

.accommodation-card {
    background-color: #fefefe;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 1400px;
    margin: 10px auto;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    min-height: 60px;  
    border-left: 3px solid #4CAF50; 
    border-right: 3px solid #4CAF50; 
}

.accommodation-info {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.accommodation-info h3 {
    margin: 0 0 5px 0;
    font-size: 20px;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Ícono  junto al título */
.accommodation-info h3::before {
    content: "\f005"; 
    font-family: "Font Awesome 6 Free";
    font-weight: 900;
    color: #FFD700;;
    font-size: 14px;
}

.accommodation-info p {
    margin: 0;
    font-size: 14px;
    color: #555;
}

.accommodation-card button {
    padding: 8px 16px;
    border: none;
    border-radius: 5px;
    background-color: #f44336;
    color: white;
    font-weight: bold;
    width: auto;
    margin: auto 0;           
}

.accommodation-card button:hover {
    background-color: #d32f2f;
}

.toast-remove {
    display: none;
    position: fixed;
    top: 20%;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(244, 67, 54, 0.9); 
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


/* Responsive para pantallas pequeñas */
@media (max-width: 600px) {
    .accommodation-card {
        flex-direction: column;
        align-items: flex-start;
        min-height: auto;
        border-left: 3px solid #4CAF50;
        border-right: 3px solid #4CAF50;
    }

    .accommodation-card button {
        margin-top: 10px;
        width: 100%;
    }
}
</style>

<div class="content">
<h1>Mi cuenta</h1>    
    <h2>Alojamientos Seleccionados</h2>
    <?php if(count($my_accommodations) === 0): ?>
        <p style="text-align:center;">No has agregado ningún alojamiento aún.</p>
    <?php endif; ?>
    <?php foreach($my_accommodations as $a): ?>
        <div class="accommodation-card">
            <div class="accommodation-info">
                <h3><?php echo $a['title']; ?></h3>
                <p><?php echo $a['description']; ?></p>
            </div>
            <form action="favorite.php" method="post">
                <input type="hidden" name="accommodation_id" value="<?php echo $a['id']; ?>">
                <input type="hidden" name="action" value="remove">
                <button type="submit">Eliminar</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>

<?php if(isset($_GET['removed']) && $_GET['removed'] == 1): ?>
<div class="toast toast-remove" id="removeToast">
    <i class="fas fa-trash"></i> Alojamiento eliminado
</div>
<script>
    const removeToast = document.getElementById('removeToast');
    removeToast.style.display = 'block';
    setTimeout(() => {
        removeToast.style.opacity = '0';
    }, 2500);
    setTimeout(() => {
        removeToast.style.display = 'none';
    }, 2500);
</script>
<?php endif; ?>


<?php require_once '../includes/footer.php'; ?>
