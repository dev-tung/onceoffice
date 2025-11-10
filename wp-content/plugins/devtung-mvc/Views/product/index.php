
<div class="row category-page-row border-top">
  <div class="col large-12">

    <!-- Form search -->
    <form id="custom-search-form" role="search" method="get" class="wl-search-form" action="#">
      <div class="row">
        <!-- Ô tìm kiếm -->
        <div class="col large-4 small-12">
          <div class="search-input-wrapper">
            <div class="input-with-icon">
              <span class="search-icon">
                <svg width="28" height="29" viewBox="0 0 28 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M24.0002 24.5002L17.6562 18.1562" stroke="#222531" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="square"></path>
                  <path d="M12 20.5C16.4183 20.5 20 16.9183 20 12.5C20 8.08172 16.4183 4.5 12 4.5C7.58172 4.5 4 8.08172 4 12.5C4 16.9183 7.58172 20.5 12 20.5Z" stroke="#222531" stroke-width="1.25" stroke-miterlimit="10" stroke-linecap="square"></path>
                </svg>
              </span>
              <input type="search" id="search-field" class="form-control" name="s" placeholder="Tìm theo tên tòa nhà, tên đường..." value="<?php echo esc_attr($formData['searchTerm']); ?>">
            </div>
            <input type="hidden" name="post_type" value="product">
          </div>
        </div>

        <!-- Dropdown Khu vực -->
        <div class="col large-2 small-12">
          <div class="custom-dropdown-wrapper">
            <div class="dropdown-label">Khu vực</div>
            <div class="custom-dropdown" id="quan-dropdown">
              <div class="dropdown-display" id="quan-display">
                <span class="selected-count">(<?php echo count($formData['selectedDistricts']); ?>) đã chọn</span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu" id="quan-menu" style="display:none;">
                <div class="selected-items" id="selected-quan-items"></div>

                <!-- Ô tìm kiếm -->
                <div class="dropdown-search">
                  <input type="text" id="quan-search" placeholder="Tìm quận hoặc phường...">
                </div>

                <div class="dropdown-options">
                  <?php foreach ($formData['districts'] as $district): ?>
                    <?php $isChecked = in_array($district['slug'], $formData['selectedDistricts'], true); ?>
                    <div class="dropdown-option district" data-value="<?php echo esc_attr($district['slug']); ?>">
                      <input type="checkbox" id="quan_<?php echo esc_attr($district['slug']); ?>" value="<?php echo esc_attr($district['slug']); ?>" <?php checked($isChecked); ?>>
                      <label for="quan_<?php echo esc_attr($district['slug']); ?>"><?php echo esc_html($district['name']); ?></label>
                    </div>

                    <?php if (!empty($district['wards'])): ?>
                      <?php foreach ($district['wards'] as $ward): ?>
                        <?php $isWardChecked = in_array($ward['slug'], $formData['selectedDistricts'], true); ?>
                        <div class="dropdown-option ward" data-parent="<?php echo esc_attr($district['slug']); ?>" data-value="<?php echo esc_attr($ward['slug']); ?>">
                          <input type="checkbox" id="ward_<?php echo esc_attr($ward['slug']); ?>" value="<?php echo esc_attr($ward['slug']); ?>" <?php checked($isWardChecked); ?>>
                          <label for="ward_<?php echo esc_attr($ward['slug']); ?>"><?php echo esc_html($ward['name']); ?></label>
                        </div>
                      <?php endforeach; ?>
                    <?php endif; ?>

                  <?php endforeach; ?>
                </div>

                <input type="hidden" id="current-quan-input" name="filter_location" value="<?php echo esc_attr(implode(',', $formData['selectedDistricts'])); ?>">
              </div>
            </div>
          </div>
        </div>

        <!-- Dropdown Giá -->
        <div class="col large-2 small-12">
          <div class="price-dropdown-wrapper">
            <div class="dropdown-label">Giá</div>
            <div class="custom-dropdown" id="price-dropdown">
              <div class="dropdown-display" id="price-display">
                <span class="price-range-text">$<?php echo $formData['minPrice']; ?> - $<?php echo $formData['maxPrice']; ?></span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu price-dropdown-menu" id="price-menu">
                <div class="price-controls">

                  <!-- Thanh slider 2 đầu -->
                  <div class="range-slider">
                    <input type="range" id="range-min" min="0" max="100" value="<?php echo $formData['minPrice']; ?>" step="1">
                    <input type="range" id="range-max" min="0" max="100" value="<?php echo $formData['maxPrice']; ?>" step="1">
                    <div class="slider-track"></div>
                  </div>

                  <!-- Nhập số thủ công -->
                  <div class="price-inputs-row">
                    <div class="price-input-group">
                      <label>Từ</label>
                      <input type="number" id="price-min-input" class="price-input" min="0" max="100" value="<?php echo $formData['minPrice']; ?>">
                    </div>
                    <div class="price-input-group">
                      <label>Đến</label>
                      <input type="number" id="price-max-input" class="price-input" min="0" max="100" value="<?php echo $formData['maxPrice']; ?>">
                    </div>
                  </div>

                  <div class="price-buttons">
                    <button type="button" class="btn-price-reset">Đặt lại</button>
                    <button type="button" class="btn-price-apply">Áp dụng</button>
                  </div>
                </div>

                <!-- Hidden inputs để submit form -->
                <input type="hidden" id="min_price" name="min_price" value="<?php echo $formData['minPrice']; ?>">
                <input type="hidden" id="max_price" name="max_price" value="<?php echo $formData['maxPrice']; ?>">
              </div>
            </div>
          </div>
        </div>

        <!-- Dropdown Hạng -->
        <div class="col large-2 small-12">
          <div class="custom-dropdown-wrapper">
            <div class="dropdown-label">Hạng</div>
            <div class="custom-dropdown" id="hang-dropdown">
              <div class="dropdown-display" id="hang-display">
                <span class="selected-hang">(<?php echo count($formData['selectedRanks']); ?>) đã chọn</span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu" id="hang-menu" style="display:none;">
                <div class="selected-items" id="selected-hang-items"></div>
                <div class="dropdown-options">
                  <?php foreach ($formData['ranks'] as $rank): ?>
                    <?php $isChecked = in_array($rank['slug'], $formData['selectedRanks'], true); ?>
                    <div class="dropdown-option" data-value="<?php echo esc_attr($rank['slug']); ?>">
                      <input type="checkbox"
                            id="hang_<?php echo esc_attr($rank['slug']); ?>"
                            value="<?php echo esc_attr($rank['slug']); ?>"
                            <?php checked($isChecked); ?>>
                      <label for="hang_<?php echo esc_attr($rank['slug']); ?>">
                        <?php echo esc_html($rank['name']); ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                </div>
                <input type="hidden" id="current-hang-input" name="filter_rank" value="<?php echo esc_attr(implode(',', $formData['selectedRanks'])); ?>">
              </div>
            </div>
          </div>
        </div>

        <!-- Nút tìm kiếm -->
        <div class="col large-2 small-12">
          <div class="search-button-wrapper">
            <button type="submit" class="btn btn-search">Tìm kiếm</button>
          </div>
        </div>
      </div>
    </form>
    <!-- End Form search -->

    <!-- SectionBuilding -->
    <div class="shop-container">
      <section class="SectionBuilding">

        <!-- Header giới thiệu -->
        <div class="SectionBuildingHeader">
          <h3 class="SectionBuildingTitle">Cho thuê văn phòng Hà Nội</h3>
          <p>Nhận được ngay báo giá, thông tin chi tiết của hàng ngàn toà nhà văn phòng lớn nhỏ. Với dịch vụ tư vấn của Wonderland, bạn sẽ không lo bỏ lỡ những văn phòng đẹp, phù hợp nhất với mức giá tốt nhất. Ngoài ra, thông tin tư vấn chuyên sâu của chúng tôi sẽ mang lại cho bạn cái nhìn toàn cảnh, chi tiết, công bằng mà không dễ có được sau một vài lần ghé thăm toà nhà hoặc được chia sẻ từ phía bên cho thuê.</p>
        </div>

        <!-- Danh sách districts dưới dạng tag -->
        <div class="row">
          <div class="col SectionBuildingTagList">
              <?php foreach ($tagData as $district): ?>
                  <a class="SectionBuildingTag" href="<?= htmlspecialchars($district['link']) ?>">
                      <?= htmlspecialchars($district['name']) ?>
                  </a>
              <?php endforeach; ?>
          </div>
        </div>

        <!-- Lặp từng district, hiển thị sản phẩm nếu có -->
        <?php foreach ($districtData as $district): ?>
          <?php if (!empty($district['products'])): ?>
            <div class="BuildingQuanHeader">
              <h4 class="BuildingQuanTitle">
                Cho thuê văn phòng quận <?= esc_html($district['name']); ?>
              </h4>
              <a class="BuildingQuanLink" href="<?= esc_url($district['link']); ?>">Xem thêm</a>
            </div>

            <div class="row list-building">
              <?php foreach ($district['products'] as $product): ?>
                <div class="col large-3 small-12 pb-0">
                  <div class="building-item">

                    <!-- Hình ảnh sản phẩm -->
                    <div class="thumb">
                      <a href="<?= esc_url($product['link']); ?>" title="<?= esc_attr($product['name']); ?>">
                        <img 
                          src="<?= esc_url($product['thumbnail']); ?>" 
                          alt="<?= esc_attr($product['name']); ?>" 
                          class="img-responsive thumb-blog"
                        />
                      </a>
                    </div>

                    <div class="content BuildingItemContent">
                        <h3>
                            <a class="BuildingItemName" href="<?= esc_url($product['link']); ?>" title="<?= esc_attr($product['name']); ?>">
                                <?= esc_html($product['name']); ?>
                            </a>
                        </h3>
                        <span class="BuildingItemLocation"><?php echo $product['_vi_tri']; ?></span>
                        <div class="meta">
                            <span class="price"><?php echo $product['_gia_hien_thi']; ?></span>
                            <span class="btn-care quan_tam js-btn-care BuildingItemCare" type="button" data-id="<?php echo $product['ID']; ?>">
                                <span>
                                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                </span> 
                                Quan tâm 
                            </span>
                        </div>
                    </div>


                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </section>
    </div>

    <!-- End SectionBuilding -->

  </div>
</div>
<?php echo do_shortcode('[block id="tiet-kiem-95"]'); ?>