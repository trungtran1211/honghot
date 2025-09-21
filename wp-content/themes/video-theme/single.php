<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <?php
    // Check if this post has sensitive content
    $has_sensitive_content = get_post_meta(get_the_ID(), '_sensitive_content', true);
    ?>
    
    <article class="single-post">
        <div class="post-content">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
            </header>
            
            <div class="post-description">
                <?php the_content(); ?>
            </div>
        </div>
    </article>
    
    <?php if ($has_sensitive_content): ?>
    <script>
        // Pass sensitive content status to JavaScript
        window.hasSensitiveContent = true;
        window.postId = <?php echo get_the_ID(); ?>;
        console.log('🔒 Post marked as having sensitive content');
    </script>
    <?php else: ?>
    <script>
        window.hasSensitiveContent = false;
        window.postId = <?php echo get_the_ID(); ?>;
    </script>
    <?php endif; ?>
    
<?php endwhile; ?>

<?php get_footer(); ?>
