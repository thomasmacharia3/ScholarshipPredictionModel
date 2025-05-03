<?php require_once('./inc/header.php'); ?>

<!-- Full-page Background -->
<div id="scholarship-form" class="flex items-center justify-center w-full px-8 py-10 border-t border-gray-200 md:py-16 lg:py-24 xl:py-40 xl:px-0">
  <div class="max-w-6xl mx-auto">
    <div class="flex-col items-center">
      <div class="flex flex-col items-center justify-center w-full h-full max-w-2xl pr-8 mx-auto text-center">
        <h2 class="text-4xl font-extrabold leading-10 tracking-tight text-gray-900 sm:text-5xl sm:leading-none md:text-6xl lg:text-5xl xl:text-6xl">Scholarship Details Form</h2>
        <p class="my-6 text-xl font-medium text-gray-500">Fill out the details below to analyze scholarship application.</p>
      </div>

      <div class="w-full xl:w-full xl:pr-8 justify-center items-center">
    
    <form id="scholarshipForm" class="space-y-6">

      <!-- Personal Details -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first-name">First Name</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="first-name" type="text" placeholder="Jane" required>
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="last-name">Last Name</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last-name" type="text" placeholder="Doe" required>
            </div>
          </div>

      <!-- Gender -->
      <div>
      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="gender">Gender</label>
      <select id="gender" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>

      <!-- Education Qualification -->
      <div>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="education-qualification">Education Qualification</label>
        <select id="education-qualification" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
          <option value="Undergraduate">Undergraduate</option>
          <option value="Postgraduate">Postgraduate</option>
          <option value="Doctrate">Doctorate</option>
        </select>
      </div>

      <!-- Disability & Sports -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="disability">Disability</label>
          <select id="disability" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select>
        </div>
        <div>
          <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="sports">Sports</label>
          <select id="sports" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="No">No</option>
            <option value="Yes">Yes</option>
          </select>
        </div>
      </div>

      <!-- Annual Percentage -->
      <div>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="annual-percentage">Annual Percentage</label>
        <select id="annual-percentage" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
          <option value="60-70">60-70</option>
          <option value="70-80">70-80</option>
          <option value="80-90">80-90</option>
          <option value="90-100">90-100</option>
        </select>
      </div>

      <!-- Income -->
      <div>
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="income">Income</label>
        <select id="income" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
          <option value="Upto 1.5L">Below 200K</option>
          <option value="1.5L to 3L">200K-500K</option>
          <option value="3L to 6L">500K-1M</option>
          <option value="Above 6L">Above 1M</option>
        </select>
      </div>

      <!-- Submit Button -->
      <button type="button" onclick="submitForm()" class="w-full py-3 bg-indigo-600 text-white rounded mt-4">Start Analysis</button>

      <!-- Result Display -->
      <div id="result" class="mt-6 text-center text-xl font-bold"></div>
    </form>
  </div>
</div>

<script>
function submitForm() {
    let portNumber = 5000;
    let formData = {
        'Gender': document.getElementById("gender").value,
        'Education_Qualification': document.getElementById("education-qualification").value,
        'Disability': document.getElementById("disability").value,
        'Sports': document.getElementById("sports").value,
        'Annual-Percentage': document.getElementById("annual-percentage").value,
        'Income': document.getElementById("income").value
    };

    console.log("Form Data: ", formData);  // Log the form data being sent

    fetch(`http://127.0.0.1:${portNumber}/predict`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        let resultDiv = document.getElementById("result");

        // Displaying the result based on the 'Outcome' value from the model
        resultDiv.innerHTML = `${data.predicted_class === 1 ? "Student is Eligible for Scholarship" : "Student is Not Eligible for Scholarship "}`;
        resultDiv.className = `mt-6 text-center text-xl font-bold ${
            data.predicted_class === 1 ? "mt-6 text-center text-xl font-bold text-green-700 bg-green-100 border border-green-500 px-4 py-3 rounded" : "mt-6 text-center text-xl font-bold text-blue-700 bg-blue-100 border border-blue-500 px-4 py-3 rounded"
        }`;
    })
    .catch(error => {
        console.error("Error:", error);
        document.getElementById("result").innerHTML = "An error occurred. Please try again.";
        document.getElementById("result").className = "mt-6 text-center text-xl font-bold text-yellow-400 border border-yellow-500";
    });
}
</script>

<?php require_once('./inc/footer.php'); ?>

