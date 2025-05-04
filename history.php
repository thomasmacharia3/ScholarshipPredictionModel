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

    <!-- Flexbox for side by side layout -->
    <div class="flex justify-between gap-8 bg-gray-100 p-5">

        <!-- Chart Section (left) -->
        <div class="flex-1">
            <div class="relative flex flex-col rounded-xl bg-white bg-clip-border text-gray-900 shadow-md mb-8 py-20">
                <div class="relative mx-4 mt-4 flex flex-col gap-4 overflow-hidden rounded-none bg-transparent bg-clip-border text-gray-700 shadow-none md:flex-row md:items-center">
                    <div class="w-max rounded-lg bg-gray-900 p-5 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"></path>
                        </svg>
                    </div>
                    <div>
                        <h6 class="block font-sans text-base font-semibold leading-relaxed tracking-normal text-gray-900 antialiased">
                            Scholarship Status Chart
                        </h6>
                        <p class="block max-w-sm font-sans text-sm font-normal leading-normal text-gray-700 antialiased">
                            Visualize the number of scholarships awarded and denied.
                        </p>
                    </div>
                </div>
                <div class="pt-6 px-2 pb-0">
                    <div id="status-chart"></div>
                </div>
            </div>
        </div>

        <!-- Table Section (right) -->
        <div class="flex-1 overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full border-collapse w-full">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-4 text-left">ID</th>
                        <th class="p-4 text-left">Name</th>
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
                               <td class='p-4'>" . $row['first_name'] . ' ' . $row['last_name'] . "</td>



                                <td class='p-4'>{$row['gender']}</td>
                                <td class='p-4 text-center'>
                                    <span class='px-3 py-1 rounded-full text-white text-sm " . 
                                    ($row['award_status'] == 'Awarded' ? 'bg-green-500' : 'bg-red-500') .
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

</div>

<?php require_once('./inc/footer.php') ?>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
// Chart for Scholarship Award Status
const chartData = {
  series: [
    {
      name: "Awarded",
      data: [<?php echo $conn->query("SELECT COUNT(*) FROM scholarships WHERE award_status = 'Awarded'")->fetch_row()[0]; ?>],
    },
    {
      name: "Denied",
      data: [<?php echo $conn->query("SELECT COUNT(*) FROM scholarships WHERE award_status = 'Denied'")->fetch_row()[0]; ?>],
    },
  ],
  chart: {
    type: "bar",
    height: 280,
    toolbar: {
      show: false,
    },
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "45%",
    },
  },
  xaxis: {
    categories: ["Scholarship Status"],
  },
  yaxis: {
    title: {
      text: "Number of Applications",
    },
  },
  fill: {
    opacity: 0.8,
  },
  colors: ["#4CAF50", "#F44336"],
  tooltip: {
    theme: "dark",
  },
};

const statusChart = new ApexCharts(document.querySelector("#status-chart"), chartData);
statusChart.render();
</script>
