document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".dropdown-submenu > .dropdown-toggle").forEach((item) => {
    item.addEventListener("click", (event) => {
      event.preventDefault();
      event.stopPropagation();

      const submenu = item.nextElementSibling;

      document
        .querySelectorAll(".dropdown-submenu > .dropdown-menu.show")
        .forEach((menu) => {
          if (menu !== submenu) {
            menu.classList.remove("show");
          }
        });

      submenu.classList.toggle("show");
    });
  });
});