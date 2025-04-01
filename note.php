<?php
// config.php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'notesbd';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// Crear nota
if (isset($_POST['crear'])) {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $conn->query("INSERT INTO notas (titulo, contenido) VALUES ('$titulo', '$contenido')");
}
// Actualizar nota
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $conn->query("UPDATE notas SET titulo='$titulo', contenido='$contenido' WHERE id=$id");
}
// Eliminar nota
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM notas WHERE id=$id");
}
// Obtener todas las notas
$notas = $conn->query("SELECT * FROM notas");
?>

<!DOCTYPE html>
<html>
<head>
    <title>CRUD Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #e3f2fd;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #1565c0;
        }
        form {
            background: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #90caf9;
            border-radius: 5px;
        }
        button {
            background: #1976d2;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #1565c0;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: #ffffff;
            margin: 10px 0;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        a {
            color: #d32f2f;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            color: #b71c1c;
        }
    </style>
</head>
<body>
    <h1>Mis notas</h1>
    <form method="POST">
        <input type="text" name="titulo" placeholder="Título" required>
        <textarea name="contenido" placeholder="Contenido" required></textarea>
        <button type="submit" name="crear">Agregar</button>
    </form>
    <ul>
        <?php while ($nota = $notas->fetch_assoc()): ?>
            <li>
                <strong><?php echo $nota['titulo']; ?></strong>
                <p><?php echo $nota['contenido']; ?></p>
                <a href="?eliminar=<?php echo $nota['id']; ?>">Eliminar</a>
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $nota['id']; ?>">
                    <input type="text" name="titulo" value="<?php echo $nota['titulo']; ?>" required>
                    <textarea name="contenido" required><?php echo $nota['contenido']; ?></textarea>
                    <button type="submit" name="actualizar">Actualizar</button>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>