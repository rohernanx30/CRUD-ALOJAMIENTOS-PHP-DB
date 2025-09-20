<?php
require_once 'config.php';
$active = isset($active) ? $active : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aloja+</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        :root{
            --green-1: #4CAF50;
            --green-2: #2E8B57;
            --accent: #000000ff;
        }
        html, body{ 
            margin:0; padding:0; 
            font-family: Georgia, 'Times New Roman', Times, serif; 
            background:#f8f8f8; color:#333; 
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(90deg, var(--green-1), var(--green-2));
            color: white;
            padding: 12px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.12);
            z-index: 1000;
        }

        .brand {
            display:flex;
            align-items:center;
            gap:10px;
        }
        .brand a {
            color: white;
            text-decoration: none;
            font-size: 20px;
            font-weight: 700;
            margin-left: 30px
        }

        nav {
            display:flex;
            align-items:center;
            gap: 12px;
            margin-right: 60px; 
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 6px 10px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap:8px;
            transition: background 0.18s, color 0.18s, transform 0.12s;
            font-size: 18px;
        }

        nav a i { font-size: 18px; }

        nav a:hover {
            background: rgba(255,255,255,0.08);
            transform: translateY(-2px);
        }

        /* estado activo claro y visible */
        nav a.active {
            color: var(--accent);
            background: rgba(255,235,59,0.12);
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            border-bottom: 3px solid var(--accent);
        }

        /* espacio para que el contenido no quede bajo el header fijo */
        .content {
            margin-top: 72px; 
            padding: 20px;
            min-height: calc(100vh - 72px - 80px); 
        }

        @media (max-width:600px){
            .brand a { font-size: 18px; }
            nav a { font-size: 16px; padding:6px; }
            nav a i { font-size:16px; }
        }
        .accommodations { 
            display: flex; 
            flex-wrap: wrap; 
            justify-content: center; 
            gap: 20px; padding: 20px; 
        } 
            
        .accommodation-card { 
            background-color: white; 
            border-radius: 10px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1); 
            width: 300px; 
            padding: 15px; 
            text-align: center; 
        } 
        
        .accommodation-card img { 
            width: 100%; 
            height: 150px; 
            object-fit: cover; 
            border-radius: 10px; 
        } 
        
        .accommodation-card button { 
            background-color: #4CAF50; 
            color: white; 
            border: none; 
            padding: 8px 15px; 
            margin-top: 15px; 
            border-radius: 5px; 
            cursor: pointer; 
            display: block; 
            width: 80%; 
            margin-left: auto; 
            margin-right: auto; 
        } 
        
        .accommodation-card button:hover { 
            background-color: #45a049; 
        }
    </style>
</head>
<body>
<<header>
    <div class="brand">
        <a href="index.php">Aloja Plus</a>
    </div>
    <nav aria-label="Principal">
        <!-- Inicio -->
        <a href="index.php" class="<?php echo ($active === 'index') ? 'active' : ''; ?>" title="Inicio">
            <i class="fas fa-house"></i>
        </a>

        <?php if (is_logged_in()): ?>
            
            <?php if (!is_admin()): ?>
                <!-- Usuario común: Mi Cuenta -->
                <a href="account.php" class="<?php echo ($active === 'account') ? 'active' : ''; ?>" title="Mi Cuenta">
                    <i class="fas fa-user"></i>
                </a>
            <?php else: ?>
                <!-- Administrador: Panel Admin -->
                <a href="admin.php" class="<?php echo ($active === 'admin') ? 'active' : ''; ?>" title="Panel Admin">
                    <i class="fas fa-plus"></i>
                </a>
            <?php endif; ?>

            <!-- Logout -->
            <a href="logout.php" title="Cerrar sesión">
                <i class="fas fa-right-from-bracket"></i>
            </a>

        <?php else: ?>
            <!-- No logueado: Iniciar sesión -->
            <a href="login.php" class="<?php echo ($active === 'login') ? 'active' : ''; ?>" title="Iniciar sesión">
                <i class="fas fa-door-open"></i>
            </a>

            <!-- Registro -->
            <a href="register.php" class="<?php echo ($active === 'register') ? 'active' : ''; ?>" title="Registro">
                <i class="fas fa-user-plus"></i>
            </a>

        <?php endif; ?>
    </nav>
</header>
