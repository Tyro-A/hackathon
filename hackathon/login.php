<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: index.php'); // Redirect to login page if not logged in
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Login/Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <style>
    .hidden {
      display: none;
    }
  </style>
</head>

<body class="bg-gray-200">

  <!-- Header -->
  <header class="bg-gray-800 text-white py-4">
    <div class="container mx-auto flex justify-between items-center px-4">
      <div class="text-2xl font-bold"><a href="index.php">University of Kerbala</a></div>
      <div class="flex items-center space-x-4">
        <a href="index.php" class="text-white hover:text-gray-400">
          <i class="fas fa-home text-xl"></i>
        </a>
        <a href="login.php" class="text-white hover:text-gray-400">
          <i class="fas fa-user text-xl"></i>
        </a>
      </div>
    </div>
  </header>

  <!-- Button to switch between forms -->
  <div class="flex justify-center mt-4 space-x-4">
    <button onclick="toggleForm('login')"
      class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 transition">Login</button>
    <button onclick="toggleForm('register')"
      class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 transition">Register</button>
  </div>

  <!-- Login Form -->
  <div id="loginForm" class="max-w-md mx-auto mt-8 p-6 bg-white rounded shadow-md hidden">
    <h2 class="text-2xl font-semibold mb-4">Login</h2>
    <form onsubmit="handleLoginSubmit(event)">
      <label for="loginUsername" class="block text-sm font-medium">Email:</label>
      <input type="email" id="loginUsername" name="loginUsername" class="block w-full px-4 py-2 mb-4 border" required>


      <label for="loginPassword" class="block text-sm font-medium">Password:</label>
      <input type="password" id="loginPassword" name="loginPassword" class="block w-full px-4 py-2 mb-4 border"
        required>
      <p id="EpasswordError" class="text-red-500 text-sm hidden mb-4">The password or Email is not crrect</p>

      <button type="submit"
        class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Login</button>
    </form>
  </div>

  <!-- Register Form -->
  <div id="registerForm" class="max-w-md mx-auto mt-8 p-6 bg-white rounded shadow-md hidden">
    <h2 class="text-2xl font-semibold mb-4">Register</h2>
    <form onsubmit="handleRegisterSubmit(event)">
      <label for="registerName" class="block text-sm font-medium">Name:</label>
      <input type="text" id="registerName" name="registerName" class="block w-full px-4 py-2 mb-4 border" required>

      <label for="registerEmail" class="block text-sm font-medium">Email:</label>
      <input type="email" id="registerEmail" name="registerEmail" class="block w-full px-4 py-2 mb-4 border" required>

      <label for="registerPhone" class="block text-sm font-medium">Phone Number:</label>
      <input type="tel" id="registerPhone" name="registerPhone" class="block w-full px-4 py-2 mb-4 border" required>

      <label for="registerCollege" class="block text-sm font-medium">College:</label>
      <input type="text" id="registerCollege" name="registerCollege" class="block w-full px-4 py-2 mb-4 border"
        required>

      <label for="registerDepartment" class="block text-sm font-medium">Department:</label>
      <input type="text" id="registerDepartment" name="registerDepartment" class="block w-full px-4 py-2 mb-4 border"
        required>

      <label for="isGraduated" class="block text-sm font-medium">Are you a graduate?</label>
      <select id="isGraduated" name="isGraduated" class="block w-full px-4 py-2 mb-4 border" required>
        <option value="yes">Yes</option>
        <option value="no">No</option>
      </select>

      <label for="graduationYear" class="block text-sm font-medium">Graduation Year:</label>
      <input type="number" id="graduationYear" name="graduationYear" class="block w-full px-4 py-2 mb-4 border"
        min="1950" max="2026">

      <label for="registerPassword" class="block text-sm font-medium">Password:</label>
      <input type="password" id="registerPassword" name="registerPassword" class="block w-full px-4 py-2 mb-2 border"
        required>

      <button type="submit"
        class="w-full py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Register</button>
    </form>
  </div>

  <script>
    function toggleForm(formType) {
      const loginForm = document.getElementById('loginForm');
      const registerForm = document.getElementById('registerForm');

      if (formType === 'login') {
        loginForm.classList.remove('hidden');
        registerForm.classList.add('hidden');
      } else {
        loginForm.classList.add('hidden');
        registerForm.classList.remove('hidden');
      }
    }

    // Set default form as login
    window.onload = function () {
      toggleForm('login');
    }
    // Handle Login Form Submission
    function handleLoginSubmit(event) {
      event.preventDefault();
      const logErrorText = document.getElementById('EpasswordError');
      const loginData = {
        username: document.getElementById('loginUsername').value,
        password: document.getElementById('loginPassword').value,
      };

      fetch('submit-login.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action: 'login', data: loginData }),
      })
        .then(response => response.json())
        .then(result => {
          if (result.success) {
            window.location.href = result.redirectUrl; // Redirect based on the server response
          } else {
            alert('Login failed.');
          }
        })
        .catch(logErrorText.classList.remove('hidden'));
    }

    // Handle Register Form Submission
    function handleRegisterSubmit(event) {
      event.preventDefault();

      if (true) {
        const registerData = {
          name: document.getElementById('registerName').value,
          email: document.getElementById('registerEmail').value,
          phone: document.getElementById('registerPhone').value,
          college: document.getElementById('registerCollege').value,
          department: document.getElementById('registerDepartment').value,
          isGraduated: document.getElementById('isGraduated').value,
          graduationYear: document.getElementById('graduationYear').value || null,
          password: document.getElementById('registerPassword').value,
        };

        fetch('submit-login.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({ action: 'register', data: registerData }),
        })
          .then(response => response.json())
          .then(result => {
            if (result.success) {
              alert('Registration successful! Redirecting...');
              window.location.href = 'login.php';
            } else {
              alert(result.message || 'Registration failed.');
            }
          })
          .catch(error => console.error('Error:', error));
      }
    }
  </script>


</body>

</html>