<div class="BuildingSubmenu">
    <div class="SubmenuAddress">
        <div class="SubmenuTitle">
            <a class="SubmenuTitleLink" href="#">Tìm theo Quận</a>
        </div>
        <div class="SubmenuGrid SubmenuGrid-Three">
        <?php foreach ($quans as $quan) : ?>
            <a class="SubmenuLink" href="<?php echo submenuQuanLink('ha-noi', $quan->slug); ?>">
                Cho thuê văn phòng <?php echo esc_html($quan->name); ?>
            </a>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="SubmenuRank">
        <div class="SubmenuTitle">
            <div class="SubmenuTitleLink">Hạng</div>
        </div>
        <div class="SubmenuGrid">
            <?php foreach ($hangs as $hang): ?>
                <a href="<?php echo hangLink($taxonomy, $hang->slug); ?>" class="SubmenuLink"><?php echo esc_html($hang->name); ?></a>
            <?php endforeach; ?>
        </div>
    </div>
</div>