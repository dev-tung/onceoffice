  <!-- Mobile Version -->
  <!-- <button id="DtmToggleMenuBtn">Toggle Menu</button> -->
  <div class="DtmToggleMenu" id="DtmToggleMenu">
    <div class="DtmSubmenu">
    <button id="DtmCloseMenuBtn">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
        <line x1="18" y1="6" x2="6" y2="18" stroke="black" stroke-width="2"/>
        <line x1="6" y1="6" x2="18" y2="18" stroke="black" stroke-width="2"/>
      </svg>
    </button>
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
  </div>