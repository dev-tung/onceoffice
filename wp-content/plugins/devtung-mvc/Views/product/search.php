<div class="row category-page-row border-top">
  <div class="col large-12">
    <form id="custom-search-form" role="search" method="get" class="wl-search-form" action="">
      <div class="row">
        <!-- Ô tìm kiếm -->
        <div class="col large-4 small-12">
          <div class="search-input-wrapper">
            <div class="input-with-icon">
              <span class="search-icon">
                <!-- SVG icon -->
              </span>
              <input type="search" id="search-field" class="form-control" name="s" placeholder="Tìm theo tên tòa nhà, tên đường..." value="<?php echo esc_attr($filters['s'] ?? ''); ?>">
            </div>
            <input type="hidden" name="post_type" value="product">
          </div>
        </div>

        <!-- Dropdown Quận -->
        <div class="col large-2 small-12">
          <div class="custom-dropdown-wrapper">
            <div class="dropdown-label">Quận</div>
            <div class="custom-dropdown" id="quan-dropdown">
              <div class="dropdown-display" id="quan-display">
                <span class="selected-count">(<?php echo count($filters['districts'] ?? []); ?>) đã chọn</span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu" id="quan-menu" style="display:none;">
                <div class="selected-items" id="selected-quan-items"></div>
                <div class="dropdown-options">
                  <?php foreach ($districts as $quan) : ?>
                    <?php $isChecked = in_array($quan->slug, $filters['districts'] ?? [], true); ?>
                    <div class="dropdown-option" data-value="<?php echo esc_attr($quan->slug); ?>">
                      <input type="checkbox"
                             id="quan_<?php echo esc_attr($quan->slug); ?>"
                             value="<?php echo esc_attr($quan->slug); ?>"
                             <?php checked($isChecked); ?>>
                      <label for="quan_<?php echo esc_attr($quan->slug); ?>">
                        <?php echo esc_html($quan->name); ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                  <input type="hidden" id="current-quan-input" name="filter_location" value="<?php echo esc_attr(implode(',', $filters['districts'] ?? [])); ?>">
                </div>
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
                <span class="price-range-text">$<?php echo esc_attr($filters['price']['min'] ?? 0); ?> - $<?php echo esc_attr($filters['price']['max'] ?? 100); ?></span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu price-dropdown-menu" id="price-menu">
                <div class="price-controls">
                  <!-- Thanh slider 2 đầu -->
                  <div class="range-slider">
                    <input type="range" id="range-min" min="0" max="100" value="<?php echo esc_attr($filters['price']['min'] ?? 0); ?>" step="0">
                    <input type="range" id="range-max" min="0" max="100" value="<?php echo esc_attr($filters['price']['max'] ?? 100); ?>" step="0">
                    <div class="slider-track"></div>
                  </div>
                  <!-- Nhập số thủ công -->
                  <div class="price-inputs-row">
                    <div class="price-input-group">
                      <label>Từ</label>
                      <input type="number" id="price-min-input" class="price-input" min="0" max="100" value="<?php echo esc_attr($filters['price']['min'] ?? 0); ?>">
                    </div>
                    <div class="price-input-group">
                      <label>Đến</label>
                      <input type="number" id="price-max-input" class="price-input" min="0" max="100" value="<?php echo esc_attr($filters['price']['max'] ?? 100); ?>">
                    </div>
                  </div>
                  <div class="price-buttons">
                    <button type="button" class="btn-price-reset">Đặt lại</button>
                    <button type="button" class="btn-price-apply">Áp dụng</button>
                  </div>
                </div>
                <input type="hidden" id="min_price" name="min_price" value="<?php echo esc_attr($filters['price']['min'] ?? 0); ?>">
                <input type="hidden" id="max_price" name="max_price" value="<?php echo esc_attr($filters['price']['max'] ?? 100); ?>">
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
                <span class="selected-hang">(<?php echo count($filters['ranks'] ?? []); ?>) đã chọn</span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu" id="hang-menu" style="display:none;">
                <div class="selected-items" id="selected-hang-items"></div>
                <div class="dropdown-options">
                  <?php foreach ($ranks as $hang): ?>
                    <?php $isChecked = in_array($hang->slug, $filters['ranks'] ?? [], true); ?>
                    <div class="dropdown-option" data-value="<?php echo esc_attr($hang->slug); ?>">
                      <input type="checkbox"
                             id="hang_<?php echo esc_attr($hang->slug); ?>"
                             value="<?php echo esc_attr($hang->slug); ?>"
                             <?php checked($isChecked); ?>>
                      <label for="hang_<?php echo esc_attr($hang->slug); ?>">
                        <?php echo esc_html($hang->name); ?>
                      </label>
                    </div>
                  <?php endforeach; ?>
                  <input type="hidden" id="current-hang-input" name="filter_hang" value="<?php echo esc_attr(implode(',', $filters['ranks'] ?? [])); ?>">
                </div>
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

    <div class="shop-container">
      <section class="SectionBuilding">
        <h3 class="SectionBuildingTitle">Có <?php echo count($buildings); ?> tòa nhà phù hợp với nhu cầu của bạn</h3>
        <div class="row list-building">
          <?php foreach ($buildings as $building) : ?>
            <div class="col large-3 small-12 pb-0">
              <div class="building-item">
                <div class="thumb">
                  <a href="<?php echo get_permalink($building->ID); ?>" title="<?php echo get_the_title($building->ID); ?>">
                    <?php echo get_the_post_thumbnail($building->ID, 'medium', ['class' => 'img-responsive thumb-blog', 'alt' => get_the_title($building->ID)]); ?>
                  </a>
                </div>
                <div class="content BuildingItemContent">
                  <h3>
                    <a class="BuildingItemName" href="<?php echo get_permalink($building->ID); ?>" title="<?php echo get_the_title($building->ID); ?>">
                      <?php echo get_the_title($building->ID); ?>
                    </a>
                  </h3>
                  <span class="BuildingItemLocation"><?php echo get_post_meta($building->ID, '_vi_tri', true); ?></span>
                  <div class="meta">
                    <span class="price"><?php echo get_post_meta($building->ID, '_gia_hien_thi', true); ?></span>
                    <span class="btn-care quan_tam js-btn-care BuildingItemCare" type="button" data-id="<?php echo $building->ID; ?>">
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
      </section>
    </div>
  </div>
</div>
