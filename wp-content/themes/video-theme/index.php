<?php get_header(); ?>

<div class="post-grid">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="post-card">
                <div class="post-thumbnail">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('video-thumbnail'); ?>
                        </a>
                    <?php else : ?>
                        <a href="<?php the_permalink(); ?>">
                            <div style="width:100%;height:200px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;color:#999;">
                                <span>No Image</span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="post-info">
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="no-posts" style="grid-column: 1/-1; text-align: center; padding: 3rem;">
            <h2>Không tìm thấy bài viết nào</h2>
            <p>Hiện tại chưa có bài viết nào được đăng tải.</p>
        </div>
    <?php endif; ?>
</div>

<?php
// Pagination
the_posts_pagination(array(
    'mid_size'  => 2,
    'prev_text' => '‹ Trước',
    'next_text' => 'Tiếp ›',
));
?>

<?php get_footer(); ?>
