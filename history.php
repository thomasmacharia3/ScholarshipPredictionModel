<?php
require_once('./config/database.php');

$database = new Database();
$conn = $database->connect();

// Check if connection was successful
if (!$conn) {
    die("Database connection failed.");
}
// Fetch Scholarship Applications
$sql = "SELECT * FROM scholarships";
$result = $conn->query($sql);
?>

 <?php require_once('./inc/header.php') ?>


<div class="container min-h-screen mx-auto mt-10 p-5">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Scholarship Applications</h2>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full border-collapse w-full">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">First Name</th>
                        <th class="p-4 text-left">Last Name</th>
                        <th class="p-4 text-left">Gender</th>
                        <th class="p-4 text-left">Award Status</th>
                        <th class="p-4 text-left">Timestamp</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-50">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b hover:bg-gray-100'>
                                <td class='p-4'>{$row['id']}</td>
                                <td class='p-4'>{$row['first_name']}</td>
                                <td class='p-4'>{$row['last_name']}</td>
                                <td class='p-4'>{$row['gender']}</td>
                                <td class='p-4 text-center'>
                                    <span class='px-3 py-1 rounded-full text-white text-sm " . 
                                    ($row['award_status'] == 'Awarded' ? 'bg-green-500' : ($row['award_status'] == 'Pending' ? 'bg-yellow-500' : 'bg-red-500')) .
                                    "'>{$row['award_status']}</span>
                                </td>
                                <td class='p-4'>{$row['created_at']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11' class='p-4 text-center text-gray-500'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>




<?php require_once('./inc/footer.php') ?>
