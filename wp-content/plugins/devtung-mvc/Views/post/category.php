<div class="Product-Category">
         <h1 class="Category-Title"><?php echo esc_html($data['category']['name']); ?></h1>
         <p class="Category-Title__Text"><?php echo esc_html($data['category']['description']); ?></p>
        <div class="grid grid--three">
            
            <?php foreach ($data['posts'] as $post): ?>
                <a class="ProductCard" href="<?php echo esc_url($post['link']); ?>">
                    <img class="ProductCard-Image" src="<?php echo esc_url($post['thumbnail']); ?>">
                    <div class="ProductCard-Tilte">
                    <h3 class="ProductCard-Content"><?= esc_html($post['title']) ?></h3>
                    <p class="ProductCard-Text"><?php echo esc_html($post['excerpt']); ?></p>
                    </div>
                </a> 
            <?php endforeach; ?>

        </div>
    
</div>