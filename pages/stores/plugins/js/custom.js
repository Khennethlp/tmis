
document.addEventListener("DOMContentLoaded", function () {
  const body = document.body;
  // const sidebar = document.getElementById("sidebar");
  // const navbar = document.getElementById("navbar");

  // Function to detect system theme
  function detectSystemTheme() {
    const systemTheme = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
    console.log("Detected system theme:", systemTheme);
    return systemTheme;
  }

  // Function to apply the theme
  function applyTheme(theme) {
    if (theme === "dark") {
      body.classList.add("dark-mode");
      body.classList.remove("light-mode");

      // sidebar.classList.add("sidebar-dark-primary");
      // sidebar.classList.remove("sidebar-light-primary");

      // navbar.classList.add("navbar-dark");
      // navbar.classList.remove("navbar-light");
    } else {
      body.classList.remove("dark-mode"); 
      body.classList.add("light-mode");

      // sidebar.classList.remove("sidebar-dark-primary");
      // sidebar.classList.add("sidebar-light-primary");

      // navbar.classList.remove("navbar-dark");
      // navbar.classList.add("navbar-light");
    }
  }

  // Automatically apply the system theme and update on change
  function applySystemTheme() {
    const systemTheme = detectSystemTheme();
    applyTheme(systemTheme);
  }

  // Event listener for system theme changes
  window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", function (e) {
      console.log("System theme changed to:", e.matches ? "dark" : "light");
      applySystemTheme();
    });

  // Apply the initial system theme
  applySystemTheme();
});

// document.addEventListener('DOMContentLoaded', function () {
//   const theme_label = document.getElementById('theme_label');
//   const toggleSwitch = document.getElementById('customSwitch1');

//   function applyTheme(theme) {
//     if (theme === 'dark') {
//       document.body.classList.add('dark-mode');
//       document.body.classList.remove('light-mode');
//       theme_label.innerHTML = 'Light ';
//       theme_label.style.color = 'white';
//       toggleSwitch.checked = true;
//     } else {
//       document.body.classList.add('light-mode');
//       document.body.classList.remove('dark-mode');
//       theme_label.innerHTML = 'Dark ';
//       theme_label.style.color = 'black';
//       toggleSwitch.checked = false;
//     }
//   }

//   const currentTheme = sessionStorage.getItem('theme') || 'light';
//   applyTheme(currentTheme);

//   toggleSwitch.addEventListener('change', function () {
//     const selectedTheme = toggleSwitch.checked ? 'dark' : 'light';
//     applyTheme(selectedTheme);
//     sessionStorage.setItem('theme', selectedTheme);
//   });
// });