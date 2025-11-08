<?php if( !empty($buildingsQuan) ): ?>
  <div class="row category-page-row border-top">
    <div class="col large-12">
    <form id="custom-search-form" role="search" method="get" class="wl-search-form" action="<?php echo get_term_link( get_queried_object_id() ); ?>">
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
              <input type="search" id="search-field" class="form-control" name="s" placeholder="Tìm theo tên tòa nhà, tên đường..." value="<?php echo get_search_query(); ?>">
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
                <span class="selected-count">(<?php echo count($selectedQuans); ?>) đã chọn</span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu" id="quan-menu" style="display:none;">
                <div class="selected-items" id="selected-quan-items"></div>

                <div class="dropdown-options">
                  <?php foreach ($quans as $quan) : ?>
                    <?php $isChecked = in_array($quan->slug, $selectedQuans, true); ?>
                    <div class="dropdown-option" data-value="<?php echo esc_html($quan->slug); ?>">
                      <input type="checkbox"
                            id="quan_<?php echo esc_html($quan->slug); ?>"
                            value="<?php echo esc_html($quan->slug); ?>"
                            <?php checked($isChecked); ?>>
                      <label for="quan_<?php echo esc_html($quan->slug); ?>">
                        <?php echo esc_html($quan->name); ?>
                      </label>
                    </div>
                  <?php endforeach; ?>

                  <!-- Hidden input: name động -->
                  <input type="hidden"
                        id="current-quan-input"
                        name="<?php echo esc_attr($filterQuanKey); ?>"
                        value="<?php echo esc_attr(implode(',', $selectedQuans)); ?>">
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
                <span class="price-range-text">$0 - $100</span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu price-dropdown-menu" id="price-menu">
                <div class="price-controls">

                  <!-- Thanh slider 2 đầu -->
                  <div class="range-slider">
                    <input type="range" id="range-min" min="0" max="100" value="<?php echo isset( $_GET['min_price'] ) ? $_GET['min_price'] : '0'; ?>" step="0">
                    <input type="range" id="range-max" min="0" max="100" value="<?php echo isset( $_GET['max_price'] ) ? $_GET['max_price'] : '100'; ?>" step="0">
                    <div class="slider-track"></div>
                  </div>

                  <!-- Nhập số thủ công -->
                  <div class="price-inputs-row">
                    <div class="price-input-group">
                      <label>Từ</label>
                      <input type="number" id="price-min-input" class="price-input" min="0" max="100" value="<?php echo isset( $_GET['min_price'] ) ? $_GET['min_price'] : '0'; ?>">
                    </div>
                    <div class="price-input-group">
                      <label>Đến</label>
                      <input type="number" id="price-max-input" class="price-input" min="0" max="100" value="<?php echo isset( $_GET['max_price'] ) ? $_GET['max_price'] : '100'; ?>">
                    </div>
                  </div>

                  <div class="price-buttons">
                    <button type="button" class="btn-price-reset">Đặt lại</button>
                    <button type="button" class="btn-price-apply">Áp dụng</button>
                  </div>
                </div>

                <input type="hidden" id="min_price" name="min_price" value="<?php echo isset( $_GET['min_price'] ) ? $_GET['min_price'] : '0'; ?>">
                <input type="hidden" id="max_price" name="max_price" value="<?php echo isset( $_GET['max_price'] ) ? $_GET['max_price'] : '100'; ?>">
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
                <span class="selected-hang">
                  (<?php echo count($selectedHangs); ?>) đã chọn
                </span>
                <i class="fa fa-chevron-down dropdown-arrow"></i>
              </div>
              <div class="dropdown-menu" id="hang-menu" style="display:none;">
                <!-- NƠI SẼ HIỆN TAG -->
                <div class="selected-items" id="selected-hang-items"></div>

                <div class="dropdown-options">
                  <?php foreach ($hangs as $hang): ?>
                    <?php $isChecked = in_array($hang->slug, $selectedHangs, true); ?>
                    <div class="dropdown-option" data-value="<?php echo esc_html($hang->slug); ?>">
                      <input type="checkbox"
                            id="hang_<?php echo esc_html($hang->slug); ?>"
                            value="<?php echo esc_html($hang->slug); ?>"
                            <?php checked($isChecked); ?>>
                      <label for="hang_<?php echo esc_html($hang->slug); ?>">
                        <?php echo esc_html($hang->name); ?>
                      </label>
                    </div>
                  <?php endforeach; ?>

                  <!-- Hidden input để submit -->
                  <input type="hidden"
                        id="current-hang-input"
                        name="filter_hang"
                        value="<?php echo esc_attr(implode(',', $selectedHangs)); ?>">
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
          <div class="SectionBuildingHeader">
            <h3 class="SectionBuildingTitle">Cho thuê <?php echo $page->name; ?></h3>
            <p>Nhận được ngay báo giá, thông tin chi tiết của hàng ngàn toà nhà văn phòng lớn nhỏ. Với dịch vụ tư vấn của Wonderland, bạn sẽ không lo bỏ lỡ những văn phòng đẹp, phù hợp nhất với mức giá tốt nhất. Ngoài ra, thông tin tư vấn chuyên sâu của chúng tôi sẽ mang lại cho bạn cái nhìn toàn cảnh, chi tiết, công bằng mà không dễ có được sau một vài lần ghé thăm toà nhà hoặc được chia sẻ từ phía bên cho thuê.</p>
          </div>

          <div class="row">
            <div class="col SectionBuildingTagList">
              <?php foreach ($quans as $quan) : ?>
                <a class="SectionBuildingTag"
                  href="<?php echo quanLink($taxonomy, $quan->slug); ?>">
                  <?php echo esc_html($quan->name); ?>
                </a>
              <?php endforeach; ?>
            </div>
          </div>


          <?php foreach($buildingsQuan as $item) : ?>
            <?php if (!empty($item['buildings'])) : ?>
              <div class="BuildingQuanHeader">
                <h4 class="BuildingQuanTitle">Cho thuê văn phòng quận <?php echo esc_html($item['quan']->name); ?></h4>
                <a class="BuildingQuanLink" href="<?php echo quanLink($taxonomy, $item['quan']->slug); ?>" > Xem thêm</a>
              </div>
              <div class="row list-building">
                <?php foreach ($item['buildings'] as $building) : ?>
                    <div class="col large-3 small-12 pb-0">
                        <div class="building-item">
                            <div class="thumb">
                                <a href="<?php echo get_permalink($building->ID); ?>" title="<?php echo get_the_title($building->ID); ?>">
                                    <?php echo get_the_post_thumbnail($building->ID, 'medium', ['class' => 'img-responsive thumb-blog', 'alt' => get_the_title($building->ID)]); ?>
                                </a>
                            </div>
                            <div class="content BuildingItemContent">
                                <h3>
                                    <a class="BuildingItemName" href="<?php echo get_permalink($building->ID); ?>" title="<?php echo get_the_title($building->ID); ?>"><?php echo get_the_title($building->ID); ?></a>
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
              </div> <!-- End list-building -->
            <?php endif; ?>
          <?php endforeach; ?>
        </section>
      </div>
      <!-- shop container -->
    </div>
  </div>
<?php endif; ?>

<?php echo do_shortcode('[block id="tiet-kiem-95"]'); ?>