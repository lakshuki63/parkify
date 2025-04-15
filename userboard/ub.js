// === Updated ub.js to support enhanced sidebar and animations ===

function openPanel(section) {
  const panel = document.getElementById('slidePanel');
  const overlay = document.getElementById('overlay');
  const content = document.getElementById('panelContent');

  let html = '';
  switch (section) {
    case 'personal':
      html = `
        <h2>Personal Info</h2>
        <p>Name: John Doe</p>
        <p>Email: john@example.com</p>`;
      break;
    case 'history':
      html = `
        <h2>History</h2>
        <ul>
          <li>Logged in: Today</li>
          <li>Updated profile: Yesterday</li>
        </ul>`;
      break;
    case 'settings':
      html = `
        <h2>Settings</h2>
        <p>Dark mode: Off</p>
        <p>Notifications: On</p>`;
      break;
  }

  content.innerHTML = html;
  panel.classList.add('open');
  overlay.classList.add('show');
}

function closePanel() {
  const panel = document.getElementById('slidePanel');
  const overlay = document.getElementById('overlay');

  panel.classList.remove('open');
  overlay.classList.remove('show');
}

// Animate subtext on load
window.addEventListener('DOMContentLoaded', () => {
  const subtext = document.querySelector('.brand-subtext');
  if (subtext) {
    subtext.style.opacity = '1';
    subtext.style.transform = 'translateY(0)';
  }
});
