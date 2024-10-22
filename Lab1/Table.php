<?php
include 'projects.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $newProject = [
        'code' => $_POST['code'],
        'author' => $_POST['author'],
        'budget' => intval($_POST['budget']),
        'ratings' => [
            intval($_POST['rating1']),
            intval($_POST['rating2']),
            intval($_POST['rating3'])
        ]
    ];

    $projects[] = $newProject;

    header("Location: Table.php");
    exit;
}

function filterProjects($projects, $maxBudget, $minTotalRatings) {
$filteredProjects = [];
foreach ($projects as $project) {
$totalRatings = array_sum($project['ratings']);
if ($project['budget'] <= $maxBudget && $totalRatings >= $minTotalRatings) {
$filteredProjects[] = $project;
}
}
return $filteredProjects;
}

$maxBudget = isset($_GET['max_budget']) ? intval($_GET['max_budget']) : 20000;
$minTotalRatings = isset($_GET['min_ratings']) ? intval($_GET['min_ratings']) : 10;
$filteredProjects = filterProjects($projects, $maxBudget, $minTotalRatings);

function findProjectByCode($projects, $code) {
foreach ($projects as $project) {
if ($project['code'] === $code) {
return $project;
}
}
return null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    foreach ($projects as &$project) {
        if ($project['code'] === $_POST['code']) {
            $project['author'] = $_POST['author'];
            $project['budget'] = intval($_POST['budget']);
            $project['ratings'] = [
                intval($_POST['rating1']),
                intval($_POST['rating2']),
                intval($_POST['rating3'])
            ];
        }
    }

header("Location: Table.php");
exit;
}

$editProject = isset($_GET['code']) ? findProjectByCode($projects, $_GET['code']) : null;

?>

<h2>Projects</h2>
<table border='1'>
    <thead>
    <tr>
        <th>Code</th>
        <th>Author</th>
        <th>Budget</th>
        <th>Ratings</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($filteredProjects as $project): ?>
        <tr>
            <td><?= htmlspecialchars($project['code']) ?></td>
            <td><?= htmlspecialchars($project['author']) ?></td>
            <td><?= htmlspecialchars($project['budget']) ?></td>
            <td><?= implode(', ', array_map('htmlspecialchars', $project['ratings'])) ?></td>
            <td>
                <form method="get">
                    <input type="hidden" name="code" value="<?= htmlspecialchars($project['code']) ?>">
                    <button type="submit">Edit</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<form method="post">
    <label for="code">Code</label>
    <input type="text" name="code" required><br><br>

    <label for="author">Author</label>
    <input type="text" name="author" required><br><br>

    <label for="budget">Budget</label>
    <input type="number" name="budget" required><br><br>

    <label for="rating1">Rating 1</label>
    <input type="number" name="rating1" min="1" max="10" required><br><br>

    <label for="rating2">Rating 2</label>
    <input type="number" name="rating2" min="1" max="10" required><br><br>

    <label for="rating3">Rating 3</label>
    <input type="number" name="rating3" min="1" max="10" required><br><br>

    <input type="submit" name="add" value="Add">
</form>

<h2>Filter Projects</h2>
<form method="get">
    <label for="max_budget">Max Budget</label>
    <input type="number" name="max_budget" value="<?= $maxBudget ?>"><br><br>

    <label for="min_ratings">Min Rating Sum</label>
    <input type="number" name="min_ratings" value="<?= $minTotalRatings ?>"><br><br>

    <input type="submit" value="Filter">
    <button type="button" onclick="window.location.href='Table.php'">Cancel Filter</button>
</form>
</form>

<?php if ($editProject): ?>

    <h2>Edit Project</h2>
    <form method="post">
        <input type="hidden" name="code" value="<?= $editProject['code']; ?>">

        <label for="author">Author</label>
        <input type="text" name="author" value="<?= htmlspecialchars($editProject['author']); ?>" required><br><br>

        <label for="budget">Budget</label>
        <input type="number" name="budget" value="<?= htmlspecialchars($editProject['budget']); ?>" required><br><br>

        <label for="rating1">Rating 1</label>
        <input type="number" name="rating1" value="<?= $editProject['ratings'][0]; ?>" min="1" max="10" required><br><br>

        <label for="rating2">Rating 2</label>
        <input type="number" name="rating2" value="<?= $editProject['ratings'][1]; ?>" min="1" max="10" required><br><br>

        <label for="rating3">Rating 3</label>
        <input type="number" name="rating3" value="<?= $editProject['ratings'][2]; ?>" min="1" max="10" required><br><br>

        <input type="submit" name="update" value="Update">
    </form>
<?php endif; ?>

