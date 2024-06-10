
document.addEventListener("DOMContentLoaded", function () {
  const body = document.body;

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
    } else {
      body.classList.remove("dark-mode"); 
      body.classList.add("light-mode");
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

// copy text to clipboard
const copy_pcname = () => {
  var pc_name = document.getElementById('pc_name').innerText;
  navigator.clipboard.writeText(pc_name);
  // alert("Copied the text: " + pc_name);
  var icon = document.querySelector('.pcn-icon');
  icon.classList.remove('fa-copy');
  icon.classList.add('fa-check');
  setTimeout(() => {
    icon.classList.remove('fa-check');
    icon.classList.add('fa-copy');
  }, 2000);
}

const copy_pcip = () => {
  var pc_ip = document.getElementById('pc_ip').innerText;
  navigator.clipboard.writeText(pc_ip);
  // alert("Copied the text: " + pc_ip);
  var icon = document.querySelector('.pcip-icon');
  icon.classList.remove('fa-copy');
  icon.classList.add('fa-check');
  setTimeout(() => {
    icon.classList.remove('fa-check');
    icon.classList.add('fa-copy');
  }, 2000);
}