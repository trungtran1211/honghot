<?php
/**
 * Template for displaying single video posts
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article class="single-video">
        <div class="video-player">
            <?php
            $video_url = get_post_meta(get_the_ID(), '_video_url', true);
            $video_poster = get_post_meta(get_the_ID(), '_video_poster', true);
            $video_type = get_post_meta(get_the_ID(), '_video_type', true);
            
            if ($video_url) {
                echo get_video_embed($video_url, $video_type, $video_poster);
            } elseif (has_post_thumbnail()) {
                the_post_thumbnail('video-large');
            } else {
                echo '<div style="width:100%;height:500px;background:#f0f0f0;display:flex;align-items:center;justify-content:center;color:#999;font-size:1.2rem;">Video không khả dụng</div>';
            }
            ?>
        </div>
        
        <div class="video-content">
            <header class="video-header">
                <h1><?php the_title(); ?></h1>
                
                <div class="video-meta">
                    <span class="video-date">📅 Đăng ngày: <?php echo get_the_date(); ?></span>
                    <?php 
                    $duration = get_post_meta(get_the_ID(), '_video_duration', true);
                    if ($duration) : ?>
                        <span class="video-duration"> • ⏱️ Thời lượng: <?php echo $duration; ?> phút</span>
                    <?php endif; ?>
                    <span class="video-views"> • 👁️ Lượt xem: <?php echo get_post_meta(get_the_ID(), 'views', true) ?: '0'; ?></span>
                    <span class="video-author"> • 👤 <?php the_author(); ?></span>
                </div>
                
                <!-- Social sharing buttons -->
                <div class="video-share" style="margin-top: 1rem;">
                    <span style="margin-right: 1rem;">Chia sẻ:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                       target="_blank" 
                       style="display: inline-block; padding: 5px 10px; background: #3b5998; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                       target="_blank" 
                       style="display: inline-block; padding: 5px 10px; background: #1da1f2; color: white; text-decoration: none; border-radius: 5px; margin-right: 5px;">
                        Twitter
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" 
                       target="_blank" 
                       style="display: inline-block; padding: 5px 10px; background: #0077b5; color: white; text-decoration: none; border-radius: 5px;">
                        LinkedIn
                    </a>
                </div>
            </header>
            
            <div class="video-description">
                <?php the_content(); ?>
            </div>
            
            <!-- Tags -->
            <?php if (has_tag()) : ?>
                <div class="video-tags" style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #f0f0f0;">
                    <h3>Thẻ:</h3>
                    <?php the_tags('<div class="tag-list">', ' ', '</div>'); ?>
                </div>
            <?php endif; ?>
            
            <?php if (comments_open() || get_comments_number()) : ?>
                <div class="video-comments" style="margin-top: 3rem;">
                    <?php comments_template(); ?>
                </div>
            <?php endif; ?>
        </div>
    </article>
<?php endwhile; ?>

<?php
// Related videos
$related_posts = get_posts(array(
    'post_type' => 'video',
    'posts_per_page' => 4,
    'exclude' => array(get_the_ID()),
    'meta_query' => array(
        array(
            'key' => '_video_url',
            'compare' => 'EXISTS'
        )
    ),
    'orderby' => 'rand'
));

if ($related_posts) : ?>
    <section class="related-videos" style="margin-top: 3rem;">
        <h2 style="text-align: center; margin-bottom: 2rem; color: #333;">Video Liên Quan</h2>
        <div class="video-grid">
            <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
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
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer(); ?>
