document.addEventListener('DOMContentLoaded', function () {
  // Cho phép nhiều DtSubmenu hoạt động độc lập
  document.querySelectorAll('.DtSubmenu').forEach(block => {
    const buttons = block.querySelectorAll('.DtToggleButton');
    const contents = block.querySelectorAll('.DtToggleContent');

    // ====== Toggle cấp 1: Quận / Phường ======
    buttons.forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();

        // Xóa trạng thái active ở tất cả nút & nội dung trong cùng block
        buttons.forEach(b => b.classList.remove('DtToggleButton-Active'));
        contents.forEach(c => c.classList.remove('DtToggleContent-Active'));

        // Active nút được click
        button.classList.add('DtToggleButton-Active');

        // Hiện phần nội dung tương ứng
        const target = button.dataset.target;
        const activeContent = block.querySelector('.DtToggleContent-' + target);
        if (activeContent) activeContent.classList.add('DtToggleContent-Active');
      });
    });
    

    // ====== Toggle cấp 2: Quận trong phần Phường/Đường ======
    block.querySelectorAll('.DtToggleMenu').forEach(menu => {
      const items = menu.querySelectorAll('.DtToggleMenu-Item');

      items.forEach(item => {
        item.addEventListener('click', function () {
          // Xóa active ở tất cả item
          items.forEach(i => i.classList.remove('DtToggleMenu-Active'));

          // Active item hiện tại
          item.classList.add('DtToggleMenu-Active');

          // Ẩn tất cả nội dung bên phải
          const contentRight = block.querySelector('.DtToggleContent-Right');
          const contentItems = contentRight.querySelectorAll('.DtToggleContent-Item');
          contentItems.forEach(c => c.classList.remove('DtToggleContent-ItemActive'));

          // Hiện nội dung tương ứng
          const targetId = item.getAttribute('data-target');
          const targetContent = contentRight.querySelector('#' + targetId);
          if (targetContent) targetContent.classList.add('DtToggleContent-ItemActive');
        });
      });
    });
  });
});

// Mobile
document.addEventListener('DOMContentLoaded', function () {
  // Cho phép nhiều DtmSubmenu hoạt động độc lập
  document.querySelectorAll('.DtmSubmenu').forEach(block => {
    const buttons = block.querySelectorAll('.DtmToggleButton');
    const contents = block.querySelectorAll('.DtmToggleContent');

    buttons.forEach(button => {
      button.addEventListener('click', function (e) {
        e.preventDefault();

        // Xóa trạng thái active ở tất cả nút & nội dung trong cùng block
        buttons.forEach(b => b.classList.remove('DtmToggleButton-Active'));
        contents.forEach(c => c.classList.remove('DtmToggleContent-Active'));

        // Active nút được click
        button.classList.add('DtmToggleButton-Active');

        // Hiện phần nội dung tương ứng
        const target = button.dataset.target;
        const activeContent = block.querySelector('.DtmToggleContent-' + target);
        if (activeContent) activeContent.classList.add('DtmToggleContent-Active');
      });
    });

  });
});

document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.DtmAccordion-Header').forEach(header => {
    header.addEventListener('click', function () {
      const body = document.getElementById(header.dataset.target);

      // Toggle active class
      header.classList.toggle('active');
      body.classList.toggle('active');
    });
  });
});
