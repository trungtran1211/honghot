<?php
/**
 * Template for displaying video post type archives
 */

get_header(); ?>

<div class="archive-header" style="text-align: center; margin-bottom: 3rem; padding: 2rem; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
    <h1>📹 Tất Cả Video</h1>
    <p>Khám phá bộ sưu tập video đa dạng của chúng tôi</p>
    
    <!-- Filter options -->
    <div class="video-filters" style="margin-top: 2rem;">
        <a href="<?php echo get_post_type_archive_link('video'); ?>" 
           class="filter-btn <?php echo !isset($_GET['orderby']) ? 'active' : ''; ?>"
           style="display: inline-block; padding: 8px 16px; margin: 0 5px; background: #667eea; color: white; text-decoration: none; border-radius: 20px; font-size: 0.9rem;">
            Mới nhất
        </a>
        <a href="<?php echo add_query_arg('orderby', 'popular', get_post_type_archive_link('video')); ?>" 
           class="filter-btn <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'popular') ? 'active' : ''; ?>"
           style="display: inline-block; padding: 8px 16px; margin: 0 5px; background: #764ba2; color: white; text-decoration: none; border-radius: 20px; font-size: 0.9rem;">
            Phổ biến
        </a>
        <a href="<?php echo add_query_arg('orderby', 'title', get_post_type_archive_link('video')); ?>" 
           class="filter-btn <?php echo (isset($_GET['orderby']) && $_GET['orderby'] == 'title') ? 'active' : ''; ?>"
           style="display: inline-block; padding: 8px 16px; margin: 0 5px; background: #f39c12; color: white; text-decoration: none; border-radius: 20px; font-size: 0.9rem;">
            A-Z
        </a>
    </div>
</div>

<div class="video-grid">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="video-card">
                <div class="video-thumbnail">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('video-thumbnail'); ?>
                            <div class="play-button">▶</div>
                        </a>
                    <?php else : ?>
                        <a href="<?php the_permalink(); ?>">
                            <div style="width:100%;height:200px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;color:#999;">
                                <div class="play-button">▶</div>
                                <span>No Thumbnail</span>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>
                
                <div class="video-info">
                    <h3 class="video-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    
                    <div class="video-meta">
                        <span class="video-date"><?php echo get_the_date(); ?></span>
                        <?php 
                        $duration = get_post_meta(get_the_ID(), '_video_duration', true);
                        if ($duration) : ?>
                            <span class="video-duration"> • <?php echo $duration; ?> phút</span>
                        <?php endif; ?>
                        <span class="video-views"> • <?php echo get_post_meta(get_the_ID(), 'views', true) ?: '0'; ?> lượt xem</span>
                    </div>
                    
                    <div class="video-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <div class="no-videos" style="grid-column: 1/-1; text-align: center; padding: 3rem;">
            <h2>Chưa có video nào</h2>
            <p>Hiện tại chưa có video nào được đăng tải. Hãy quay lại sau nhé!</p>
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
