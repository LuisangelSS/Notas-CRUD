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
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
        }
        form {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background: #218838;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            background: white;
            margin: 10px 0;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
        }
        a {
            color: red;
            text-decoration: none;
            font-weight: bold;
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
                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $nota['id']; ?>">
                    <input type="text" name="titulo" value="<?php echo $nota['titulo']; ?>" required>
                    <textarea name="contenido" required><?php echo $nota['contenido']; ?></textarea>
                </form>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>