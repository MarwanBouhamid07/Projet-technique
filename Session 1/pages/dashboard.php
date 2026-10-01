<?php

require_once '../conf/db.php';

$sql = 'SELECT workouts.*, users.first_name, muscle_groups.name AS muscle_name
        FROM workouts 
        INNER JOIN users ON workouts.id_coach = users.id 
        INNER JOIN muscle_groups ON workouts.id_group = muscle_groups.id_group
        ORDER BY workouts.created_at DESC';
        
$stmt = $conn->prepare($sql);
$stmt->execute();

$results = $stmt->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body>
    <aside>
        <h1>Fitcouch</h1>
        <a href="dashboard.php">Dashboard</a>
        <a href="add_workout.php">Add a Workout</a>
    </aside>

    <main>
        <header>Welcome back</header>

        <table>
            <thead>
                <tr>
                    <th>Workout</th>
                    <th>Description</th>
                    <th>level</th>
                    <th>duretion</th>
                    <th>Target muscel</th>
                    <th>date</th>
                </tr>
            </thead>
<tbody>
        <?php foreach ($results as $workout): ?>
            <tr>
                <td><?= htmlspecialchars($workout['title']) ?></td>
                <td><?= htmlspecialchars($workout['description']) ?></td>
                <td><?= htmlspecialchars($workout['difficulty_level']) ?></td>
                <td><?= htmlspecialchars($workout['duration_min']) ?> min</td>
                <td><?= htmlspecialchars($workout['muscle_name']) ?></td>
                <td><?= htmlspecialchars($workout['created_at']) ?></td>
            </tr>
        <?php endforeach; ?>
</tbody>
        </table>
    </main>
</body>
</html>