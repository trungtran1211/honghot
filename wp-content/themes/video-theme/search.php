<?php get_header(); ?>

<div class="search-results">
    <?php if (have_posts()) : ?>
        <h1 class="search-title" style="text-align: center; margin-bottom: 2rem; color: #333;">
            Kết quả tìm kiếm cho: "<?php echo get_search_query(); ?>"
        </h1>
        
        <div class="post-grid">
            <?php while (have_posts()) : the_post(); ?>
                <div class="post-card">
                    <div class="post-thumbnail">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('video-thumbnail'); ?>
                                <div class="play-button">▶</div>
                            </a>
                        <?php else : 
                            $video_poster = get_post_meta(get_the_ID(), '_video_poster', true);
                            if ($video_poster) : ?>
                                <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo esc_url($video_poster); ?>" alt="<?php the_title(); ?>" style="width:100%;height:200px;object-fit:cover;">
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
                        <?php endif; ?>
                    </div>
                    
                    <div class="post-info">
                    <h3 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>                        <div class="post-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        
        <?php
        // Pagination
        the_posts_pagination(array(
            'mid_size'  => 2,
            'prev_text' => '‹ Trước',
            'next_text' => 'Tiếp ›',
        ));
        ?>
        
    <?php else : ?>
        <div class="no-results" style="text-align: center; padding: 3rem;">
            <h1>Không tìm thấy kết quả</h1>
            <p>Không tìm thấy video nào phù hợp với từ khóa "<strong><?php echo get_search_query(); ?></strong>"</p>
            <p>Hãy thử tìm kiếm với từ khóa khác.</p>
            
            <div style="margin-top: 2rem;">
                <?php get_search_form(); ?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
