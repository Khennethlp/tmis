
document.addEventListener('DOMContentLoaded', function () {
  const theme_label = document.getElementById('theme_label');
  const toggleSwitch = document.getElementById('customSwitch1');

  function applyTheme(theme) {
    if (theme === 'dark') {
      document.body.classList.add('dark-mode');
      document.body.classList.remove('light-mode');
      theme_label.innerHTML = 'Light ';
      theme_label.style.color = 'white';
      toggleSwitch.checked = true;
    } else {
      document.body.classList.add('light-mode');
      document.body.classList.remove('dark-mode');
      theme_label.innerHTML = 'Dark ';
      theme_label.style.color = 'black';
      toggleSwitch.checked = false;
    }
  }

  const currentTheme = sessionStorage.getItem('theme') || 'light';
  applyTheme(currentTheme);

  toggleSwitch.addEventListener('change', function () {
    const selectedTheme = toggleSwitch.checked ? 'dark' : 'light';
    applyTheme(selectedTheme);
    sessionStorage.setItem('theme', selectedTheme);
  });
});