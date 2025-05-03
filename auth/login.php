<?php require_once('../inc/header.php'); ?>

<!-- Start Login Form -->
<div id="login-form" class="flex items-center justify-center w-full px-8 py-10 border-t border-gray-200 md:py-16 lg:py-24 xl:py-40 xl:px-0">
  <div class="max-w-6xl mx-auto">
    <div class="flex-col items-center">
      <div class="flex flex-col items-center justify-center w-full h-full max-w-2xl pr-8 mx-auto text-center">
        <p class="my-5 text-base font-medium tracking-tight text-indigo-500 uppercase">User Login</p>
        <h2 class="text-4xl font-extrabold leading-10 tracking-tight text-gray-900 sm:text-5xl sm:leading-none md:text-6xl lg:text-5xl xl:text-6xl">Login to Your Account</h2>
        <p class="my-6 text-xl font-medium text-gray-500">Enter your credentials to log in.</p>
      </div>

      <div class="w-full xl:w-full xl:pr-8 justify-center items-center">
        <form id="loginForm" class="w-full max-w-lg" method="POST" action="../user/auth.php">
          <!-- Email -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="login-email">Email</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="login-email" type="email" name="login-email" placeholder="Email" required>
            </div>
          </div>

          <!-- Password -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="login-password">Password</label>
              <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="login-password" type="password" name="login-password" placeholder="Password" required>
            </div>
          </div>

          <!-- Submit Button -->
          <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
              <button type="submit" name="login" class="w-full py-3 bg-indigo-600 text-white rounded mt-4">Login</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php require_once('../inc/footer.php'); ?>
