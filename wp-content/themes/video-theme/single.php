<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <article class="single-post">
        <div class="post-content">
            <header class="post-header">
                <h1><?php the_title(); ?></h1>
            </header>
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('large'); ?>
                </div>
            <?php endif; ?>
            
            <div class="post-description">
                <?php the_content(); ?>
            </div>
        </div>
    </article>
<?php endwhile; ?>

<?php get_footer(); ?>
