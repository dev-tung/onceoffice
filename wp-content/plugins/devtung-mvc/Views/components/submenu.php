  <!-- Desktop Version -->
  <div class="DtSubmenu">
    <!-- ===================== -->
    <!-- KHU VỰC: QUẬN / PHƯỜNG -->
    <!-- ===================== -->
    <div class="DtSubmenu-Address">
      <div class="DtSubmenu-Title">
        <a class="DtSubmenuTitle-Link DtSubmenu-Text1 DtSubmenuTitle-LinkSeparate DtToggleButton DtToggleButton-Active" data-target="District" href="javascript:void(0)">Tìm theo Quận</a>
        <a class="DtSubmenuTitle-Link DtSubmenu-Text1 DtToggleButton DtSubmenu-MarginLeft2" data-target="Ward" href="javascript:void(0)">Tìm theo Phường và Đường</a>
      </div>

      <!-- ToggleContent: Quận -->
      <div class="DtToggleContent DtToggleContent-District DtToggleContent-Active">
        <div class="DtSubmenuGrid DtSubmenuGrid-Two DtSubmenu-Scroll">
          <?php foreach ($data['districts'] as $district): ?>
            <a class="DtSubmenuLink DtSubmenu-Text2" href="<?= htmlspecialchars($district['link']) ?>">
              Cho thuê văn phòng <?= htmlspecialchars($district['name']) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- ToggleContent: Phường -->
      <div class="DtToggleContent DtToggleContent-Ward">
        <div class="DtToggleLayout">
          <!-- Cột trái: menu quận -->
          <div class="DtToggleMenu DtSubmenu-Scroll">
            <?php foreach ($data['districts'] as $i => $district): ?>
              <div class="DtToggleMenu-Item DtSubmenu-Text2 <?= $i === 0 ? 'DtToggleMenu-Active' : '' ?>" 
                  data-target="DtWardDistrict-<?= $district['id'] ?>">
                <?= htmlspecialchars(str_replace('Quận', '', $district['name'])) ?>
              </div>
            <?php endforeach; ?>
          </div>

          <!-- Cột phải: nội dung -->
          <div class="DtToggleContent-Right DtSubmenu-Scroll">
            <?php foreach ($data['districts'] as $i => $district): ?>
              <div class="DtToggleContent-Item <?= $i === 0 ? 'DtToggleContent-ItemActive' : '' ?>" 
                  id="DtWardDistrict-<?= $district['id'] ?>">
                
                <!-- Danh sách phường -->
                <div class="DtToggleContent-Ward">
                  <h5 class="DtToggleContentList-Title DtSubmenu-Text2 DtSubmenu-TextB">Danh sách phường</h5>
                  <div class="DtToggleContent-List DtToggleContentList-Ward">
                    <?php if (!empty($district['wards'])): ?>
                      <?php foreach ($district['wards'] as $ward): ?>
                        <a class="DtToggleContent-Link DtSubmenu-Text2" href="<?= htmlspecialchars($ward['link']) ?>">
                          <?= htmlspecialchars($ward['name']) ?>
                        </a>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                </div>

                <!-- Danh sách đường -->
                <div class="DtToggleContent-Road">
                  <h5 class="DtToggleContentList-Title DtSubmenu-Text2 DtSubmenu-TextB">Các tuyến đường nổi bật</h5>
                  <div class="DtToggleContent-List DtToggleContentList-Road">
                    <?php if (!empty($district['roads'])): ?>
                      <?php foreach ($district['roads'] as $road): ?>
                        <a class="DtToggleContent-Link DtSubmenu-Text2" href="<?= htmlspecialchars($road['link']) ?>">
                          <?= htmlspecialchars($road['name']) ?>
                        </a>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </div>
                </div>

              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- ===================== -->
    <!-- TÒA NHÀ NỔI BẬT -->
    <!-- ===================== -->
    <div class="DtSubmenu-Highlight">
      <div class="DtSubmenu-Title">
        <div class="DtSubmenuTitle-Link DtSubmenu-Text1">Tòa nhà nổi bật</div>
      </div>
      <div class="DtSubmenuGrid DtSubmenu-Scroll DtSubmenu-PaddingTop1">
        <?php if (!empty($buildings)): ?>
            <?php foreach ($buildings as $building): ?>
            <a class="DtSubmenuLink DtSubmenu-Text2" href="<?= htmlspecialchars($building['link']) ?>">
                <?= htmlspecialchars($building['name']) ?>
            </a>
            <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>

    <!-- ===================== -->
    <!-- HẠNG -->
    <!-- ===================== -->
    <div class="DtSubmenu-Rank">
      <div class="DtSubmenu-Title">
        <div class="DtSubmenuTitle-Link DtSubmenu-Text1">Tìm theo loại</div>
      </div>
      <div class="DtSubmenuGrid DtSubmenu-Scroll DtSubmenu-PaddingTop1">
        <?php if (!empty($ranks)): ?>
            <?php foreach ($ranks as $rank): ?>
            <a class="DtSubmenuLink DtSubmenu-Text2" href="<?= htmlspecialchars($rank['link']) ?>">
                <?= htmlspecialchars($rank['name']) ?>
            </a>
            <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <!-- End Desktop Version -->

  <!-- Mobile Version -->
  <div class="DtmSubmenu">
    <!-- ===================== -->
    <!-- KHU VỰC: QUẬN / PHƯỜNG -->
    <!-- ===================== -->
    <div class="DtmSubmenu-Address">
      <div class="DtmSubmenu-Title">
        <a class="DtmSubmenuTitle-Link DtmSubmenu-Text1 DtmSubmenuTitle-LinkSeparate DtmToggleButton DtmToggleButton-Active" data-target="District" href="javascript:void(0)">Tìm theo Quận</a>
        <a class="DtmSubmenuTitle-Link DtmSubmenu-Text1 DtmToggleButton" data-target="Ward" href="javascript:void(0)">Tìm theo Phường và Đường</a>
      </div>

      <!-- ToggleContent: Quận -->
      <div class="DtmToggleContent DtmToggleContent-District DtmToggleContent-Active">
        <div class="DtmSubmenuGrid DtmSubmenuGrid-Three">
          <?php foreach ($data['districts'] as $district): ?>
            <a class="DtmSubmenuLink DtmSubmenu-Text2" href="<?= htmlspecialchars($district['link']) ?>">
              Cho thuê văn phòng <?= htmlspecialchars($district['name']) ?>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- ToggleContent: Phường -->
      <div class="DtmToggleContent DtmToggleContent-Ward">
        <div class="DtmAccordion">
            <?php foreach ($data['districts'] as $district): ?>
            <div class="DtmAccordion-Item">
                <div class="DtmAccordion-Header DtmSubmenu-Text2" data-target="DtmWardDistrict-<?= $district['id'] ?>">
                <?= htmlspecialchars($district['name']) ?>
                </div>

                <div class="DtmAccordion-Body" id="DtmWardDistrict-<?= $district['id'] ?>">
                    <!-- Danh sách phường -->
                    <?php if (!empty($district['wards'])): ?>
                        <div class="DtmToggleContent-Ward">
                            <h5 class="DtmToggleContentList-Title DtmSubmenu-Text3">Danh sách phường</h5>
                            <div class="DtmToggleContent-List DtmToggleContentList-Ward">
                                <?php foreach ($district['wards'] as $ward): ?>
                                <a class="DtmToggleContent-Link DtmSubmenu-Text4" href="<?= htmlspecialchars($ward['link']) ?>">
                                    <?= htmlspecialchars($ward['name']) ?>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Danh sách đường -->
                    <?php if (!empty($district['roads'])): ?>
                        <div class="DtmToggleContent-Road">
                            <h5 class="DtmToggleContentList-Title DtmSubmenu-Text3">Các tuyến đường nổi bật</h5>
                            <div class="DtmToggleContent-List DtmToggleContentList-Road">
                                <?php foreach ($district['roads'] as $road): ?>
                                <a class="DtmToggleContent-Link DtmSubmenu-Text4" href="<?= htmlspecialchars($road['link']) ?>">
                                    <?= htmlspecialchars($road['name']) ?>
                                </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
            <?php endforeach; ?>
        </div>
      </div>

    </div>

    <!-- ===================== -->
    <!-- TÒA NHÀ NỔI BẬT -->
    <!-- ===================== -->
    <div class="DtmSubmenu-Highlight">
      <div class="DtmSubmenu-Title">
        <div class="DtmSubmenuTitle-Link DtmSubmenu-Text1">Tòa nhà nổi bật</div>
      </div>
      <div class="DtmSubmenuGrid">
          <?php if (!empty($buildings)): ?>
            <?php foreach ($buildings as $building): ?>
              <a class="DtmSubmenuLink DtmSubmenu-Text2" href="<?= htmlspecialchars($building['link']) ?>">
                  <?= htmlspecialchars($building['name']) ?>
              </a>
            <?php endforeach; ?>
          <?php endif; ?>
      </div>
    </div>

    <!-- ===================== -->
    <!-- HẠNG -->
    <!-- ===================== -->
    <div class="DtmSubmenu-Rank">
      <div class="DtmSubmenu-Title">
        <div class="DtmSubmenuTitle-Link DtmSubmenu-Text1">Tìm theo loại</div>
      </div>
      <div class="DtmSubmenuGrid">
          <?php if (!empty($ranks)): ?>
            <?php foreach ($ranks as $rank): ?>
              <a class="DtmSubmenuLink DtmSubmenu-Text2" href="<?= htmlspecialchars($rank['link']) ?>">
                  <?= htmlspecialchars($rank['name']) ?>
              </a>
            <?php endforeach; ?>
          <?php endif; ?>
      </div>
    </div>
  </div>