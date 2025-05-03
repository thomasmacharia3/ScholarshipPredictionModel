<?php require_once('../inc/header.php'); ?>

<!-- Start Registration Form -->
<div id="registration-form" class="flex items-center justify-center w-full px-8 py-10 border-t border-gray-200 md:py-16 lg:py-24 xl:py-40 xl:px-0">
  <div class="max-w-6xl mx-auto">
    <div class="flex-col items-center">
      <div class="flex flex-col items-center justify-center w-full h-full max-w-2xl pr-8 mx-auto text-center">
        <p class="my-5 text-base font-medium tracking-tight text-indigo-500 uppercase">User Registration</p>
        <h2 class="text-4xl font-extrabold leading-10 tracking-tight text-gray-900 sm:text-5xl sm:leading-none md:text-6xl lg:text-5xl xl:text-6xl">Create Your Account</h2>
        <p class="my-6 text-xl font-medium text-gray-500">Fill out the form below to create an account.</p>
      </div>

      <div class="w-full xl:w-full xl:pr-8 justify-center items-center">
        <form id="registrationForm" class="w-full max-w-lg" method="POST" action="../user/auth.php">
          <!-- First Name -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first-name">First Name</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="first-name" type="text" name="first-name" placeholder="John" required>
            </div>
            <div class="w-full md:w-1/2 px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="last-name">Last Name</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="last-name" type="text" name="last-name" placeholder="Doe" required>
            </div>
          </div>

          <!-- Email -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="register-email">Email</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="register-email" type="email" name="register-email" placeholder="Email" required>
            </div>
          </div>

          <!-- Password -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="register-password">Password</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="register-password" type="password" name="register-password" placeholder="Password" required>
            </div>
          </div>

          <!-- Confirm Password -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="confirm-password">Confirm Password</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="confirm-password" type="password" name="confirm-password" placeholder="Confirm Password" required>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <button type="submit" name="register" class="w-full py-3 bg-indigo-600 text-white rounded mt-4">Register</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once('../inc/footer.php'); ?>
