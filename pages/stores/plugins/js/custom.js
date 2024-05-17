
    document.addEventListener('DOMContentLoaded', function () {
      const toggleSwitch = document.getElementById('customSwitch1');
      const theme_label = document.getElementById('theme_label');
      const body = document.body;

      // Function to apply the theme
      function applyTheme(theme) {
        if (theme === 'dark') {
          body.classList.add('dark-mode');
          body.classList.remove('light-mode');
          theme_label.style.color = 'white';
          toggleSwitch.checked = true;
        } else {
          body.classList.add('light-mode');
          body.classList.remove('dark-mode');
          theme_label.style.color = 'black';
          toggleSwitch.checked = false;
        }
      }

      // Check session storage for theme preference
      const currentTheme = sessionStorage.getItem('theme') || 'light';
      applyTheme(currentTheme);

      // Listen for toggle switch changes
      toggleSwitch.addEventListener('change', function () {
        const selectedTheme = toggleSwitch.checked ? 'dark' : 'light';
        applyTheme(selectedTheme);
        sessionStorage.setItem('theme', selectedTheme);
      });
    });
