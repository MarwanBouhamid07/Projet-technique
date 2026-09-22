<?php


require "../conf/db.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title         = trim($_POST['title']);
    $description   = trim($_POST['description']);
    $duration_min  = $_POST['duration_min'];
    $level         = $_POST['level'];
    $muscle_name   = $_POST['muscel'];
    $id_coach      = 1;

    if (empty($title) || empty($description) || empty($duration_min)) {
        die("Merci de remplir tous les champs obligatoires.");
    }

    $stmt = $conn->prepare("SELECT id_group FROM muscle_groups WHERE name = ?");
    $stmt->execute([$muscle_name]);
    $group = $stmt->fetch(PDO::FETCH_ASSOC);


    $id_group = $group['id_group'];

    $sql = "INSERT INTO workouts 
                (title, description, duration_min, difficulty_level, id_coach, id_group) 
            VALUES 
                (:title, :description, :duration_min, :difficulty_level, :id_coach, :id_group)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':title'            => $title,
        ':description'      => $description,
        ':duration_min'     => $duration_min,
        ':difficulty_level' => $level,
        ':id_coach'         => $id_coach,
        ':id_group'         => $id_group,
    ]);


} 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add article</title>
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body>
    <aside>
        <h1>Fitcouch</h1>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_workout.php">Add Workouts</a>
    </aside>
    <main>
        <header>New Workout</header>
        <form action="add_workout.php" method="POST" >
            <label>Title</label>
            <input type="text" name="title" id="title">
            <label>Description</label>
            <input type="text" name="description" id="description">
            <label>duration(min)</label>
            <input type="number" name="duration_min" id="duration_min">
            <label>Defficulty level</label>
            <select name="level" id="level">
                <option value="beginner">beginner</option>
                <option value="intermediate">intermediate</option>
                <option value="advanced">advanced</option>
            </select>
            <label >Target muscel</label>
            <select name="muscel" id="muscel">
                <option value="chest">chest</option>
                <option value="legs">legs</option>
                <option value="back">back</option>
                <option value="core">core</option>
            </select>
            <button type="submit">Save workout</button>
        </form>
    </main>
</body>
</html>