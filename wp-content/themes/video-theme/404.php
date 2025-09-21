<?php get_header(); ?>

<div class="error-404" style="text-align: center; padding: 4rem 2rem; background: white; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.1);">
    <div style="font-size: 8rem; color: #667eea; margin-bottom: 1rem;">404</div>
    <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: #333;">Trang không tồn tại</h1>
    <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">Rất tiếc, trang bạn đang tìm kiếm không tồn tại hoặc đã được di chuyển.</p>
    
    <div style="margin-bottom: 3rem;">
        <?php get_search_form(); ?>
    </div>
    
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="<?php echo esc_url(home_url('/')); ?>" 
           style="display: inline-block; padding: 12px 24px; background: #667eea; color: white; text-decoration: none; border-radius: 25px; transition: background-color 0.3s ease;">
            🏠 Về Trang Chủ
        </a>
        <a href="<?php echo esc_url(home_url('/posts')); ?>" 
           style="display: inline-block; padding: 12px 24px; background: #764ba2; color: white; text-decoration: none; border-radius: 25px; transition: background-color 0.3s ease;">
            � Xem Tất Cả Bài Viết
        </a>
    </div>
</div>

<?php
// Show some recent posts
$recent_videos = get_posts(array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'post_status' => 'publish'
));

if ($recent_videos) : ?>
    <section style="margin-top: 3rem;">
        <h2 style="text-align: center; margin-bottom: 2rem; color: #333;">Bài Viết Mới Nhất</h2>
        <div class="post-grid">
            <?php foreach ($recent_videos as $post) : setup_postdata($post); ?>
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
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer(); ?>
