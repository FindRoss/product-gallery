<?php 

function render_dynamic_ailb_product_gallery_block($attributes) {
  $post_ids = isset($attributes['products']) ? array_map('intval', $attributes['products']) : [];

  if (empty($post_ids)) return '';

  // Fetch posts efficiently
  $posts = get_posts([
    'post_type'      => 'item',
    'post__in'       => $post_ids,
    'orderby'        => 'post__in',
    'posts_per_page' => count($post_ids),
    'no_found_rows'  => true,
  ]);

  ob_start(); ?>

  <div class="wp-block-create-block-product-gallery">
    <div class="product-gallery">
      <div class="product-gallery__content">
        <?php foreach ($posts as $post) : 
          $title = esc_html(get_the_title($post->ID));
          $excerpt = esc_html(get_the_excerpt($post->ID));
          $image = get_the_post_thumbnail_url($post->ID, 'medium');
          $acf_field = get_field('links', $post->ID); // Replace with actual ACF field name
        ?>
          <div class="product-item">
            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" />
            <h2 class="title"><?php echo $title; ?></h2>
            <a href="#">Buy on Amazon</a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <?php return ob_get_clean();
}; 