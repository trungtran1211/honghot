<?php get_header(); ?>

<div class="archive-header" style="text-align: center; margin-bottom: 3rem; padding: 2rem; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
    <?php if (is_category()) : ?>
        <h1>Danh mục: <?php single_cat_title(); ?></h1>
        <?php if (category_description()) : ?>
            <div class="archive-description"><?php echo category_description(); ?></div>
        <?php endif; ?>
    <?php elseif (is_tag()) : ?>
        <h1>Thẻ: <?php single_tag_title(); ?></h1>
        <?php if (tag_description()) : ?>
            <div class="archive-description"><?php echo tag_description(); ?></div>
        <?php endif; ?>
    <?php elseif (is_author()) : ?>
        <h1>Tác giả: <?php echo get_the_author(); ?></h1>
    <?php elseif (is_date()) : ?>
        <h1>
            <?php if (is_year()) : ?>
                Năm: <?php echo get_the_date('Y'); ?>
            <?php elseif (is_month()) : ?>
                Tháng: <?php echo get_the_date('F Y'); ?>
            <?php elseif (is_day()) : ?>
                Ngày: <?php echo get_the_date(); ?>
            <?php endif; ?>
        </h1>
    <?php elseif (is_post_type_archive('video')) : ?>
        <h1>Tất cả Video</h1>
        <p>Khám phá bộ sưu tập video của chúng tôi</p>
    <?php else : ?>
        <h1><?php the_archive_title(); ?></h1>
        <?php if (get_the_archive_description()) : ?>
            <div class="archive-description"><?php echo get_the_archive_description(); ?></div>
        <?php endif; ?>
    <?php endif; ?>
</div>

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
            <p>Hiện tại chưa có bài viết nào trong danh mục này.</p>
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
