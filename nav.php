<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!-- start nav -->
 <nav class="bg-red-800">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button id="mobile-btn" type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
            <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
            <svg class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <a href="https://aminetriki.com.tn/"><img class="h-8 w-auto" src="assets/3.png" alt="Amine triki"></a>
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <a href="index.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white" aria-current="page">home</a>
              <a href="contact.php" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">contact</a>
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <!-- Profile dropdown -->
          <div class="relative ml-3">
            <div>
              <button type="button" class="relative flex rounded-full bg-red-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="absolute -inset-1.5"></span>
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full" src="./assets/user.png" alt="user">
              </button>
            </div>

            <div id="menu-list-hidden" class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <!-- Active: "bg-gray-100", Not Active: "" -->
              <?php if(isset($_SESSION['user_id'])): ?>
              <a href="./profile.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
              <a href="logout.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
              <?php else: ?>
              <a href="./signIn.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">sign in</a>
              <a href="./signUp.php" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">sign up</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="index.php" class="block rounded-md  px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white" aria-current="page">home</a>
        <a href="contact.php" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">contact</a>
      </div>
    </div>
  </nav>
  <!-- end nav -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('menu-list-hidden');
    // Toggle menu on click
    userMenuButton.addEventListener('click', function() {
        userMenu.classList.toggle('hidden');
    });
    // Show menu on hover
    userMenuButton.addEventListener('mouseover', function() {
        userMenu.classList.remove('hidden');
    });
    // Hide menu when hover out
    userMenuButton.addEventListener('mouseout', function(event) {
        if (!userMenu.contains(event.relatedTarget)) {
            userMenu.classList.add('hidden');
        }
    });
    // Close the menu if clicked outside
    document.addEventListener('click', function(event) {
        if (!userMenuButton.contains(event.target) && !userMenu.contains(event.target)) {
            userMenu.classList.add('hidden');
        }
    });
});

//mobile

const mobileMenuButton = document.getElementById('mobile-btn');
const mobileMenu = document.getElementById('mobile-menu');

// Toggle the mobile menu when the button is clicked
mobileMenuButton.addEventListener('click', function() {
    mobileMenu.classList.toggle('hidden');
});


</script>