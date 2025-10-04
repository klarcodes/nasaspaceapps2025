  function toggleSubmenu(element) {
    const submenu = element.nextElementSibling;
    if (!submenu) return;
    submenu.classList.toggle('show');
    element.classList.toggle('expanded');
    element.classList.toggle('collapsed');
  }
