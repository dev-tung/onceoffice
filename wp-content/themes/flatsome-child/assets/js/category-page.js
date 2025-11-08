jQuery(document).ready(function ($) {

    function setupDropdown(dropdownId, displayId, menuId, selectedContainerId, hiddenInputId){
        const $display = $(displayId);
        const $menu = $(menuId);
        const $selectedContainer = $(selectedContainerId);
        const $hiddenInput = $(hiddenInputId);

        // Mở/đóng dropdown khi click display
        $display.click(function(e){
            e.stopPropagation(); // Ngăn event nổi bọt
            $menu.toggle();
        });

        // Click bên trong dropdown không đóng
        $menu.click(function(e){
            e.stopPropagation();
        });

        // Click bên ngoài dropdown thì đóng
        $(document).click(function(){
            $menu.hide();
        });

        // Cập nhật tag, số lượng và hidden input
        function updateTags(){
            $selectedContainer.empty();
            const checked = $menu.find('input[type=checkbox]:checked');
            let selectedValues = [];

            checked.each(function(){
                const value = $(this).val();
                const label = $(this).siblings('label').text();
                selectedValues.push(value);

                const $tag = $('<span class="selected-tag" data-value="'+value+'">'+label+' <span class="remove-tag">×</span></span>');
                $tag.find('.remove-tag').click(function(e){
                    e.stopPropagation();
                    $(this).parent().remove();
                    $menu.find('input[value="'+value+'"]').prop('checked', false);
                    updateTags();
                });

                $selectedContainer.append($tag);
            });

            // Cập nhật số lượng
            $display.find('span').first().text('('+checked.length+') đã chọn');

            // Cập nhật hidden input
            $hiddenInput.val(selectedValues.join(','));
        }

        // Khi checkbox thay đổi
        $menu.find('input[type=checkbox]').change(updateTags);

        // Khởi tạo
        updateTags();
    }

    // Dropdown Quận
    setupDropdown('#quan-dropdown', '#quan-display', '#quan-menu', '#selected-quan-items', '#current-quan-input');

    // Dropdown Hạng
    setupDropdown('#hang-dropdown', '#hang-display', '#hang-menu', '#selected-hang-items', '#current-hang-input');


    /* =============================
       DROPDOWN GIÁ
    ==============================*/

    // Mở/đóng dropdown giá
        $("#price-display").on("click", function(e){
            e.stopPropagation(); // Ngăn event nổi bọt
            $("#price-menu").toggle();
        });

        // Click bên trong dropdown không đóng
        $("#price-menu").click(function(e){
            e.stopPropagation();
        });

        // Click ngoài thì đóng dropdown
        $(document).click(function(){
            $("#price-menu").hide();
        });

        // Cập nhật thanh slider
        function updateSliderTrack() {
            const min = parseInt($("#range-min").val());
            const max = parseInt($("#range-max").val());
            const minAttr = parseInt($("#range-min").attr("min"));
            const maxAttr = parseInt($("#range-min").attr("max"));

            const percent1 = ((min - minAttr) / (maxAttr - minAttr)) * 100;
            const percent2 = ((max - minAttr) / (maxAttr - minAttr)) * 100;

            $(".slider-track").css({
                left: percent1 + "%",
                right: (100 - percent2) + "%"
            });

            // Đồng bộ input số và hidden input
            $("#price-min-input").val(min);
            $("#price-max-input").val(max);
            $("#min_price").val(min);
            $("#max_price").val(max);

            // Hiển thị text
            $(".price-range-text").text(`$${min} - $${max}`);
        }

        // Sự kiện khi kéo slider
        $("#range-min, #range-max").on("input", function () {
            let min = parseInt($("#range-min").val());
            let max = parseInt($("#range-max").val());

            if (min > max) [min, max] = [max, min];

            $("#range-min").val(min);
            $("#range-max").val(max);
            updateSliderTrack();
        });

        // Sự kiện khi nhập số
        $("#price-min-input, #price-max-input").on("input", function () {
            let min = parseInt($("#price-min-input").val()) || 0;
            let max = parseInt($("#price-max-input").val()) || 0;

            if (min > max) [min, max] = [max, min];

            $("#range-min").val(min);
            $("#range-max").val(max);
            updateSliderTrack();
        });

        // Reset
        $(".btn-price-reset").on("click", function () {
            $("#range-min").val(0);
            $("#range-max").val(100);
            updateSliderTrack();
            $("#price-menu").hide();
        });

        // Apply
        $(".btn-price-apply").on("click", function () {
            updateSliderTrack();
            $("#price-menu").hide();
        });

        // Khởi tạo lần đầu
        updateSliderTrack();


});
