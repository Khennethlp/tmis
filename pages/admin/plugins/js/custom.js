document.addEventListener("DOMContentLoaded", function () {
  const body = document.body;
  const sidebar = document.getElementById("sidebar");
  const navbar = document.getElementById("navbar");

  // Function to detect system theme
  function detectSystemTheme() {
    const systemTheme = window.matchMedia("(prefers-color-scheme: dark)")
      .matches
      ? "dark"
      : "light";
    console.log("Detected system theme:", systemTheme);
    return systemTheme;
  }

  // Function to apply the theme
  function applyTheme(theme) {
    if (theme === "dark") {
      body.classList.add("dark-mode");
      body.classList.remove("light-mode");

      sidebar.classList.add("sidebar-dark-primary");
      sidebar.classList.remove("sidebar-light-primary");

      navbar.classList.add("navbar-dark");
      navbar.classList.remove("navbar-light");
    } else {
      body.classList.remove("dark-mode");
      body.classList.add("light-mode");

      sidebar.classList.remove("sidebar-dark-primary");
      sidebar.classList.add("sidebar-light-primary");

      navbar.classList.remove("navbar-dark");
      navbar.classList.add("navbar-light");
    }
  }

  // Automatically apply the system theme and update on change
  function applySystemTheme() {
    const systemTheme = detectSystemTheme();
    applyTheme(systemTheme);
  }

  // Event listener for system theme changes
  window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", function (e) {
      console.log("System theme changed to:", e.matches ? "dark" : "light");
      applySystemTheme();
    });

  // Apply the initial system theme
  applySystemTheme();
});

//copy text to clipboard
const copy_pcname = () => {
  var pc_name = document.getElementById("pc_name").innerText;
  navigator.clipboard.writeText(pc_name);
  // alert("Copied the text: " + pc_name);
  var icon = document.querySelector(".pcn-icon");
  icon.classList.remove("fa-copy");
  icon.classList.add("fa-check");
  setTimeout(() => {
    icon.classList.remove("fa-check");
    icon.classList.add("fa-copy");
  }, 2000);
};

const copy_pcip = () => {
  var pc_ip = document.getElementById("pc_ip").innerText;
  navigator.clipboard.writeText(pc_ip);
  // alert("Copied the text: " + pc_ip);
  var icon = document.querySelector(".pcip-icon");
  icon.classList.remove("fa-copy");
  icon.classList.add("fa-check");
  setTimeout(() => {
    icon.classList.remove("fa-check");
    icon.classList.add("fa-copy");
  }, 2000);
};

document.addEventListener("DOMContentLoaded", function () {
  const date_to = document.getElementById("date_to");
  const date_from = document.getElementById("date_from");
  const show_date = document.getElementById("show_date");
  const searchbtn = document.getElementById("search");
  const inv_search = document.getElementById("inv_search");
  const inv_searchbtn = document.getElementById("searchReqBtn");

  date_from.style.display = "none";
  date_to.style.display = "none";
  searchbtn.style.display = "none";

  let isDateVisible = false;
  const toggleDates = () => {
    isDateVisible = !isDateVisible; // Toggle the visibility state

    date_from.style.display = isDateVisible ? "block" : "none";
    date_to.style.display = isDateVisible ? "block" : "none"; 
    searchbtn.style.display = isDateVisible ? 'block' : 'none';
    
    inv_search.style.display = isDateVisible ? 'none' : 'block';
    inv_searchbtn.style.display = isDateVisible ? 'none' : 'block';
  };

  show_date.addEventListener('click', toggleDates);
});

// apply theme via switch toggle
// document.addEventListener('DOMContentLoaded', function () {
//   const toggleSwitch = document.getElementById('customSwitch1');
//   const theme_label = document.getElementById('theme_label');
//   // const btnTxtColor = document.querySelectorAll('.theme-text');
//   const body = document.body;

//   // Function to apply the theme
//   function applyTheme(theme) {
//     if (theme === 'dark') {
//       body.classList.add('dark-mode');
//       body.classList.remove('light-mode');
//       theme_label.innerHTML = 'Light ';
//       theme_label.style.color = 'white';
//       // btnTxtColor.forEach(button => button.style.color = 'white');
//       toggleSwitch.checked = true;
//     } else {
//       body.classList.add('light-mode');
//       body.classList.remove('dark-mode');
//       theme_label.innerHTML = 'Dark ';
//       theme_label.style.color = 'black';
//       // btnTxtColor.forEach(button => button.style.color = 'black');
//       toggleSwitch.checked = false;
//     }
//   }

//   // Check session storage for theme preference
//   const currentTheme = sessionStorage.getItem('theme') || 'light';
//   applyTheme(currentTheme);

//   // Listen for toggle switch changes
//   toggleSwitch.addEventListener('change', function () {
//     const selectedTheme = toggleSwitch.checked ? 'dark' : 'light';
//     applyTheme(selectedTheme);
//     sessionStorage.setItem('theme', selectedTheme);
//   });
// });
