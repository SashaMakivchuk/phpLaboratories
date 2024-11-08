<?php
// Load projects from JSON file
function loadProjects($filename = 'projects.json') {
    if (file_exists($filename)) {
        $data = file_get_contents($filename);
        return json_decode($data, true);
    }
    return [];
}

// Save projects to JSON file
function saveProjects($projects, $filename = 'projects.json') {
    file_put_contents($filename, json_encode($projects, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Display projects in a table
function displayProjects($projects) {
    echo "<table border='1'>";
    echo "<tr><th>Код</th><th>Автор</th><th>Кошторис (грн)</th><th>Оцінки</th><th>Дії</th></tr>";
    foreach ($projects as $index => $project) {
        $ratings = implode(", ", $project['ratings']);
        echo "<tr>
                <td>{$project['code']}</td>
                <td>{$project['author']}</td>
                <td>{$project['budget']}</td>
                <td>{$ratings}</td>
                <td>
                    <a href='Table.php?edit=$index'>Редагувати</a>
                </td>
              </tr>";
    }
    echo "</table>";
}

// Filter projects based on budget and ratings sum
function filterProjects($projects, $maxBudget, $minScore) {
    return array_filter($projects, function($project) use ($maxBudget, $minScore) {
        return $project['budget'] <= $maxBudget && array_sum($project['ratings']) >= $minScore;
    });
}

// Get filtered projects based on URL parameters
$projects = loadProjects();
$maxBudget = isset($_GET['max_budget']) ? (int)$_GET['max_budget'] : 15000;
$minScore = isset($_GET['min_score']) ? (int)$_GET['min_score'] : 15;
$filteredProjects = filterProjects($projects, $maxBudget, $minScore);

// Handle add new project form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $newProject = [
        'code' => $_POST['code'],
        'author' => $_POST['author'],
        'budget' => max(0, (int)$_POST['budget']),
        'ratings' => [
            max(1, min(10, (int)$_POST['rating1'])),
            max(1, min(10, (int)$_POST['rating2'])),
            max(1, min(10, (int)$_POST['rating3']))
        ]
    ];
    $projects[] = $newProject;
    saveProjects($projects);
    header("Location: Table.php"); // Refresh to prevent form resubmission
}

// Handle edit project form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $index = (int)$_POST['index'];
    if (isset($projects[$index])) {
        $projects[$index] = [
            'code' => $_POST['code'],
            'author' => $_POST['author'],
            'budget' => max(0, (int)$_POST['budget']),
            'ratings' => [
                max(1, min(10, (int)$_POST['rating1'])),
                max(1, min(10, (int)$_POST['rating2'])),
                max(1, min(10, (int)$_POST['rating3']))
            ]
        ];
        saveProjects($projects);
        header("Location: Table.php"); // Refresh to prevent form resubmission
    }
}

// Display filtered projects
echo "<h2>Проекти з кошторисом ≤ {$maxBudget} грн і загальною оцінкою ≥ {$minScore}</h2>";
displayProjects($filteredProjects);

// Filter form
?>
<h3>Фільтрувати проекти</h3>
<form method="get" action="Table.php">
    Максимальний кошторис (грн): <input type="number" name="max_budget" value="<?php echo $maxBudget; ?>"><br>
    Мінімальна сума оцінок: <input type="number" name="min_score" value="<?php echo $minScore; ?>"><br>
    <input type="submit" value="Фільтрувати">
</form>

<h3>Додати новий проект</h3>
<form method="post" action="Table.php">
    <input type="hidden" name="add" value="1">
    Код: <input type="text" name="code" required><br>
    Автор: <input type="text" name="author" required><br>
    Кошторис (грн): <input type="number" name="budget" min="0" required><br>
    Оцінка 1: <input type="number" name="rating1" min="1" max="10" required><br>
    Оцінка 2: <input type="number" name="rating2" min="1" max="10" required><br>
    Оцінка 3: <input type="number" name="rating3" min="1" max="10" required><br>
    <input type="submit" value="Додати проект">
</form>

<?php
// Edit form (if editing a project)
if (isset($_GET['edit'])) {
    $index = (int)$_GET['edit'];
    if (isset($projects[$index])) {
        $project = $projects[$index];
        ?>
        <h3>Редагувати проект</h3>
        <form method="post" action="Table.php">
            <input type="hidden" name="edit" value="1">
            <input type="hidden" name="index" value="<?php echo $index; ?>">
            Код: <input type="text" name="code" value="<?php echo $project['code']; ?>" required><br>
            Автор: <input type="text" name="author" value="<?php echo $project['author']; ?>" required><br>
            Кошторис (грн): <input type="number" name="budget" value="<?php echo $project['budget']; ?>" min="0" required><br>
            Оцінка 1: <input type="number" name="rating1" value="<?php echo $project['ratings'][0]; ?>" min="1" max="10" required><br>
            Оцінка 2: <input type="number" name="rating2" value="<?php echo $project['ratings'][1]; ?>" min="1" max="10" required><br>
            Оцінка 3: <input type="number" name="rating3" value="<?php echo $project['ratings'][2]; ?>" min="1" max="10" required><br>
            <input type="submit" value="Зберегти зміни">
        </form>
        <?php
    }
}
?>
