document.addEventListener('click', function(e) {
  const menu = document.getElementById('DtmToggleMenu');
  if (!menu) return;

  // Mở menu khi click vào phần tử có class .open-fullmenu-mobile
  const extraOpen = e.target.closest('.open-fullmenu-mobile');
  if (extraOpen) {
    menu.classList.add('DtmToggleMenu-Active');
  }

  // Đóng menu khi click nút đóng SVG
  const closeBtn = e.target.closest('#DtmCloseMenuBtn');
  if (closeBtn) {
    menu.classList.remove('DtmToggleMenu-Active');
  }

  // Đóng menu khi click ra ngoài menu
  if (menu.classList.contains('DtmToggleMenu-Active')) {
    if (!e.target.closest('#DtmToggleMenu') && !e.target.closest('.open-fullmenu-mobile')) {
      menu.classList.remove('DtmToggleMenu-Active');
    }
  }

  // Đóng menu khi click link trong menu
  if (e.target.closest('#DtmToggleMenu .has-icon')) {
    menu.classList.remove('DtmToggleMenu-Active');
  }
});
