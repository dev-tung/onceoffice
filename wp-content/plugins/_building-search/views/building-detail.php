<div class="row content-row">
  <div class="col large-12 pb-15">
    <aside>
      <h1>
        <?php echo get_the_title( get_the_ID() ); ?>
      </h1>
      <p>
        <?php echo get_post_meta( get_the_ID(), '_vi_tri', true ); ?>
      </p>
    </aside>
  </div>
</div>
<?php if( !empty($slideImages) ) : ?>

<div id="BuildingGalleryDesktop">
  <div class="row">
    <div class="col large-12">
      <div class="BuildingGallery">
        <?php if( !empty($slideImages[0]) ) : ?>
        <div class="BuildingGallery-Featured">
          <a href="<?php echo $slideImages[0]; ?>" class="BuildingGallery-Item" data-fancybox="gallery">
            <img class="BuildingGallery-ItemIMG" src="<?php echo $slideImages[0]; ?>" alt="Featured" />
          </a>
        </div>
        <?php endif; ?>
        <div class="BuildingGallery-Side">
          <?php if( !empty($slideImages[1]) ) : ?>
          <a href="<?php echo $slideImages[1]; ?>" class="BuildingGallery-Item" data-fancybox="gallery">
            <img class="BuildingGallery-ItemIMG" src="<?php echo $slideImages[1]; ?>" alt="Featured" />
          </a>
          <?php endif; ?>
          <?php if( !empty($slideImages[2]) ) : ?>
          <a href="<?php echo $slideImages[2]; ?>" class="BuildingGallery-Item" data-fancybox="gallery">
            <img class="BuildingGallery-ItemIMG" src="<?php echo $slideImages[2]; ?>" alt="Featured" />
          </a>
          <?php endif; ?>
          <?php if( !empty($slideImages[3]) ) : ?>
          <a href="<?php echo $slideImages[3]; ?>" class="BuildingGallery-Item" data-fancybox="gallery">
            <img class="BuildingGallery-ItemIMG" src="<?php echo $slideImages[3]; ?>" alt="Featured" />
          </a>
          <?php endif; ?>
          <?php if( !empty($slideImages[4]) ) : ?>
          <a href="<?php echo $slideImages[4]; ?>" class="BuildingGallery-Item" data-fancybox="gallery">
            <img class="BuildingGallery-ItemIMG" src="<?php echo $slideImages[4]; ?>" alt="Featured" />
          </a>
          <?php endif; ?>
        </div>
        <a href="<?php echo $slideImages[0]; ?>" class="BuildingGallery-More" data-fancybox="gallery">Xem thêm</a>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div id="BuildingGalleryMobile">
    <div class="swiper BuildingGallery">
      <div class="swiper-wrapper">
        <?php foreach ($slideImages as $img) : ?>
        <?php if( !empty($img) ) : ?>
        <div class="swiper-slide">
          <a href="<?php echo $img; ?>" class="BuildingGallery-Item" data-fancybox="gallery">
            <img class="BuildingGallery-ItemIMG" src="<?php echo $img; ?>" alt="Slide" />
          </a>
        </div>
        <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>


<?php endif; ?>


<div class="row">
  <div class="col large-9">
    <div class="row">

      <div class="product-info summary entry-summary col col-fit <?php flatsome_product_summary_classes();?>">
        <?php
          // Hàm render 2 cột có icon riêng 1 bên
          function render_building_tab($title, $fields) {
              echo '<div class="box-item tab-item thong_so edit">';
              echo '<div class="tab-title BuildingTabTitle"><strong>' . esc_html($title) . '</strong></div>';
              echo '<div class="tab-content">';
              
              // Chia fields làm 2 phần (2 cột)
              $half = ceil(count($fields) / 2);
              $columns = array_chunk($fields, $half);

              foreach ($columns as $col) {
                  echo '<ul>';
                  foreach ($col as $field) {
                      $value = get_post_meta(get_the_ID(), $field['key'], true);
                      echo '<li class="BuildingItem">';
                        echo '<div class="BuildingItem-Icon"><i class="' . esc_attr($field['icon']) . '"></i></div>';
                          echo '<div class="BuildingItem-Content">';
                            echo '<h4 class="BuildingItem-Title">' . esc_html($field['label']) . '</h4>';
                            echo '<span class="BuildingTabContent">' . esc_html($value) . '</span>';
                        echo '</div>';
                      echo '</li>';
                  }
                  echo '</ul>';
              }

              echo '</div></div>';
          }

          // Tab 1: Thông số toà nhà
          render_building_tab('Thông số toà nhà', [
              ['label' => 'Vị trí', 'key' => '_vi_tri', 'icon' => 'fa-solid fa-location-dot'],
              ['label' => 'Chiều cao tầng', 'key' => '_chieu_cao_tang', 'icon' => 'fa-solid fa-building'],
              ['label' => 'Chiều cao trần', 'key' => '_chieu_cao_tran', 'icon' => 'fa-solid fa-arrows-up-down'],
              ['label' => 'Diện tích sàn', 'key' => '_dien_tich_san', 'icon' => 'fa-solid fa-maximize'],
              ['label' => 'Đỗ xe', 'key' => '_do_xe', 'icon' => 'fa-solid fa-square-parking'],
              ['label' => 'Thang máy', 'key' => '_thang_may', 'icon' => 'fa-solid fa-elevator'],
              ['label' => 'Điều hòa', 'key' => '_dieu_hoa', 'icon' => 'fa-solid fa-wind'],
              ['label' => 'Điện dự phòng', 'key' => '_dien_du_phong', 'icon' => 'fa-solid fa-bolt'],
              ['label' => 'Giờ làm việc', 'key' => '_gio_lam_viec', 'icon' => 'fa-solid fa-clock'],
              ['label' => 'Hướng tòa nhà', 'key' => '_huong_toa_nha', 'icon' => 'fa-solid fa-compass'],
          ]);

          // Tab 2: Chi tiết giá thuê và diện tích
          render_building_tab('Chi tiết giá thuê và diện tích', [
              ['label' => 'Giá thuê gộp (Giá thuê + Phí dịch vụ)', 'key' => '_gia_thue_gop', 'icon' => 'fa-solid fa-money-bill-wave'],
              ['label' => 'Giá thuê', 'key' => '_gia_thue', 'icon' => 'fa-solid fa-money-bill'],
              ['label' => 'Phí dịch vụ', 'key' => '_phi_dich_vu', 'icon' => 'fa-solid fa-receipt'],
              ['label' => 'Diện tích cho thuê tiêu chuẩn', 'key' => '_dien_tich_cho_thue_tieu_chuan', 'icon' => 'fa-solid fa-vector-square'],
              ['label' => 'Tiền điện điều hòa', 'key' => '_tien_dien_dieu_hoa', 'icon' => 'fa-solid fa-fan'],
              ['label' => 'Đỗ xe máy', 'key' => '_do_xe_may', 'icon' => 'fa-solid fa-motorcycle'],
              ['label' => 'Đỗ ô tô', 'key' => '_do_o_to', 'icon' => 'fa-solid fa-car'],
              ['label' => 'Tiền điện trong văn phòng', 'key' => '_tien_dien_trong_van_phong', 'icon' => 'fa-solid fa-plug'],
          ]);

        ?>

        <?php do_action( 'woocommerce_single_product_summary' ); ?>
      </div>

      <div class="col product-footer">

        <?php 

          add_filter( 'woocommerce_product_tabs', function( $tabs ) {
              if ( isset( $tabs['description'] ) ) {
                  $tabs['description']['title'] = 'THÔNG TIN CHO THUÊ'; // chữ thay thế
              }
              return $tabs;
          }, 98 );
          do_action( 'woocommerce_after_single_product_summary' ); 
        
        ?>
      </div>

    </div>
  </div>
  <div class="col large-3 pl-0">
    <aside id="block_widget-5" class="widget block_widget BuildingWidgetTuvan">
      <h2>
        <?php echo get_post_meta( get_the_ID(), '_gia_hien_thi', true ); ?>
      </h2>
      <h2>Tư vấn thuê văn phòng</h2>
      <a href="tel:0966681616" target="_self" class="button primary lowercase btn-phone">
        <span>Gọi 0966.68.1616</span>
      </a>
      <a class="button primary lowercase btn-trang">
        <span>Gửi yêu cầu thuê</span>
      </a>
      <div class="wpcf7 js" id="wpcf7-f601-p1899-o1" lang="vi" dir="ltr">
        <div class="screen-reader-response">
          <p role="status" aria-live="polite" aria-atomic="true"></p>
          <ul></ul>
        </div>
        <form action="/toa-nha-hang-b/doji-tower/#wpcf7-f601-p1899-o1" method="post" class="wpcf7-form init"
          aria-label="Form liên hệ" novalidate="novalidate" data-status="init">
          <div style="display: none;">
            <input type="hidden" name="_wpcf7" value="601">
            <input type="hidden" name="_wpcf7_version" value="5.7.7">
            <input type="hidden" name="_wpcf7_locale" value="vi">
            <input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f601-p1899-o1">
            <input type="hidden" name="_wpcf7_container_post" value="1899">
            <input type="hidden" name="_wpcf7_posted_data_hash" value="">
          </div>
          <div class="section csncngbg">
            <div class="background_close_csncngbg">
            </div>
            <div class="body_csncngbg">
              <div class="close_csncngbg">
                <p><button type="button" class="close"><i class="fa fa-times"></i></button>
                </p>
              </div>
              <div class="body_content_csncngbg">
                <div class="header_csncngbg">
                  <h4 class="modal-title">Chia sẻ nhu cầu - Nhận ngay báo giá
                  </h4>
                </div>
                <div class="row align-center">
                  <div class="col large-12 small-12 non_padding_bottom">
                    <h4>Nhu cầu thuê
                    </h4>
                    <div>
                      <p>
                        <span class="wpcf7-form-control-wrap" data-name="nhucauthue"><textarea cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" aria-required="true" aria-invalid="false" placeholder="Chi tiết văn phòng bạn đang tìm: Khu vực, Giá thuê, dịch vụ đi kèm..." name="nhucauthue"></textarea></span>
                      </p>
                    </div>
                  </div>
                  <div class="col large-12 small-12 non_padding_bottom">
                    <h4>Thông tin liên hệ
                    </h4>
                  </div>
                  <div class="col large-12 small-12">
                    <div class="row align-center">
                      <div class="col large-6 small-12 non_padding_bottom">
                        <p><label>Tên công ty</label>
                        </p>
                        <div>
                          <p>
                            <span class="wpcf7-form-control-wrap" data-name="tencongty"><input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="tencongty"></span>
                          </p>
                        </div>
                      </div>
                      <div class="col large-6 small-12 non_padding_bottom">
                        <p><label>Tên của bạn</label>
                        </p>
                        <div>
                          <p>
                            <span class="wpcf7-form-control-wrap" data-name="tencuaban"><input size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="tencuaban"></span>
                          </p>
                        </div>
                      </div>
                      <div class="col large-6 small-12 non_padding_bottom">
                        <p><label>Điện thoại</label>
                        </p>
                        <div>
                          <p>
                            <span class="wpcf7-form-control-wrap" data-name="dienthoai"><input size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" value="" type="tel" name="dienthoai"></span>
                          </p>
                        </div>
                      </div>
                      <div class="col large-6 small-12 non_padding_bottom">
                        <p><label>Email</label>
                        </p>
                        <div>
                          <p>
                            <span class="wpcf7-form-control-wrap" data-name="email"><input size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" value="" type="email" name="email"></span>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="footer_csncngbg">
                  <div class="col-inner">
                    <p>
                      <input class="wpcf7-form-control has-spinner wpcf7-submit" type="submit" value="Gửi thông tin"><span class="wpcf7-spinner"></span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="wpcf7-response-output" aria-hidden="true"></div>
        </form>
      </div>
    </aside>
  </div>
</div>

<?php echo do_shortcode('[block id="tiet-kiem-95"]'); ?>