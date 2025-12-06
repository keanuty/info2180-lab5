<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = $_GET['country'] ?? '';
$findCities = isset($_GET['lookup']) ? $_GET['lookup'] == 'cities' : false;

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if(!$findCities)
    $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
else
    $stmt = $conn->query("SELECT c.name, c.district, c.population
                        FROM cities AS c
                        JOIN countries AS co ON co.code = c.country_code
                        WHERE co.name = '$country'");

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php if ($findCities): ?>

    <table>
        <thead>

            <tr>
                <th>Name</th>
                <th>District</th>
                <th>Population</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($results as $row): ?>
            
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['district'] ?></td>
                    <td><?= $row['population'] ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

<?php else: ?>

    <table>
        <thead>

            <tr>
                <th>Name</th>
                <th>Continent</th>
                <th>Independence</th>
                <th>Head of State</th>
            </tr>

        </thead>

        <tbody>

            <?php foreach ($results as $row): ?>
            
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['continent'] ?></td>
                    <td><?= $row['independence_year'] ?></td>
                    <td><?= $row['head_of_state'] ?></td>
                </tr>

            <?php endforeach; ?>

        </tbody>
    </table>

<?php endif ?>