    <div class="shop-container">
      <section class="SectionBuilding">
        <div class="SectionBuildingHeader">
          <h3 class="SectionBuildingTitle">Cho thuê văn phòng Hà Nội</h3>
          <p>Nhận được ngay báo giá, thông tin chi tiết của hàng ngàn toà nhà văn phòng lớn nhỏ. Với dịch vụ tư vấn của Wonderland, bạn sẽ không lo bỏ lỡ những văn phòng đẹp, phù hợp nhất với mức giá tốt nhất. Ngoài ra, thông tin tư vấn chuyên sâu của chúng tôi sẽ mang lại cho bạn cái nhìn toàn cảnh, chi tiết, công bằng mà không dễ có được sau một vài lần ghé thăm toà nhà hoặc được chia sẻ từ phía bên cho thuê.</p>
        </div>

        <div class="row">
          <div class="col SectionBuildingTagList">
            <?php foreach ($data['districts'] as $district) : ?>
              <a class="SectionBuildingTag"
                href="<?= htmlspecialchars($district['link']) ?>">
                <?php echo esc_html($district['name']); ?>
              </a>
            <?php endforeach; ?>
          </div>
        </div>


        <?php foreach ($data['districts'] as $district) : ?>
          <?php if (!empty($district['products'])) : ?>
            <div class="BuildingQuanHeader">
              <h4 class="BuildingQuanTitle">
                Cho thuê văn phòng quận <?php echo esc_html($district['name']); ?>
              </h4>
              <a class="BuildingQuanLink" href="#">Xem thêm</a>
            </div>

            <div class="row list-building">
              <?php foreach ($district['products'] as $product) : ?>
                <div class="col large-3 small-12 pb-0">
                  <div class="building-item">
                    <div class="thumb">
                      <a href="<?php echo esc_url($product['link']); ?>" title="<?php echo esc_attr($product['name']); ?>">
                        <img 
                          src="<?php echo esc_url($product['thumbnail']); ?>" 
                          alt="<?php echo esc_attr($product['name']); ?>" 
                          class="img-responsive thumb-blog"
                        />
                      </a>
                    </div>

                    <div class="content BuildingItemContent">
                      <h3>
                        <a 
                          class="BuildingItemName"
                          href="<?php echo esc_url($product['link']); ?>"
                          title="<?php echo esc_attr($product['name']); ?>">
                          <?php echo esc_html($product['name']); ?>
                        </a>
                      </h3>

                      <?php if (!empty($product['price'])) : ?>
                        <span class="BuildingItemLocation">
                          Giá: <?php echo $product['price']; ?>
                        </span>
                      <?php endif; ?>

                      <div class="meta">
                        <span class="btn-care quan_tam js-btn-care BuildingItemCare" 
                              type="button" 
                              data-id="<?php echo esc_attr($product['id']); ?>">
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