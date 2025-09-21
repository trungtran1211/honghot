    </main>

    <footer class="site-footer">
        <div class="footer-main">
            <div class="container">
                <div class="footer-grid">
                    <div class="footer-section about-section">
                        <h3 class="footer-title">
                            <span class="footer-icon">🎬</span>
                            <?php bloginfo('name'); ?>
                        </h3>
                        <p class="footer-description">
                            <?php 
                            $description = get_bloginfo('description');
                            echo $description ? $description : 'Nền tảng chia sẻ video và nội dung giải trí hàng đầu. Khám phá thế giới video đa dạng và thú vị.';
                            ?>
                        </p>
                        <div class="footer-social">
                            <a href="#" class="social-link facebook" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-link youtube" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="#" class="social-link tiktok" title="TikTok">
                                <i class="fab fa-tiktok"></i>
                            </a>
                            <a href="#" class="social-link instagram" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    
                    <div class="footer-section links-section">
                        <h4 class="footer-subtitle">Danh mục</h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>">🏠 Trang chủ</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/video')); ?>">🎥 Video</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/tin-tuc')); ?>">📰 Tin tức</a></li>
                            <li><a href="<?php echo esc_url(home_url('/category/giai-tri')); ?>">🎭 Giải trí</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section support-section">
                        <h4 class="footer-subtitle">Hỗ trợ</h4>
                        <ul class="footer-links">
                            <li><a href="<?php echo esc_url(home_url('/lien-he')); ?>">📧 Liên hệ</a></li>
                            <li><a href="<?php echo esc_url(home_url('/chinh-sach')); ?>">📋 Chính sách</a></li>
                            <li><a href="<?php echo esc_url(home_url('/dieu-khoan')); ?>">📜 Điều khoản</a></li>
                            <li><a href="<?php echo esc_url(home_url('/faq')); ?>">❓ FAQ</a></li>
                        </ul>
                    </div>
                    
                    <div class="footer-section newsletter-section">
                        <h4 class="footer-subtitle">Theo dõi cập nhật</h4>
                        <p class="newsletter-text">Đăng ký để nhận thông báo về video và nội dung mới nhất</p>
                        <form class="newsletter-form" action="#" method="post">
                            <div class="newsletter-input-wrapper">
                                <input type="email" class="newsletter-input" placeholder="Email của bạn..." required>
                                <button type="submit" class="newsletter-button">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                        
                        <div class="footer-stats">
                            <div class="stat-item">
                                <span class="stat-number"><?php echo wp_count_posts()->publish; ?></span>
                                <span class="stat-label">Bài viết</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number"><?php echo get_comments(array('count' => true)); ?></span>
                                <span class="stat-label">Bình luận</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <p>&copy; <?php echo date('Y'); ?> <strong><?php bloginfo('name'); ?></strong>. Tất cả quyền được bảo lưu.</p>
                    </div>
                    <div class="footer-credits">
                        <p>Được thiết kế với ❤️ tại Việt Nam | <a href="#top" class="back-to-top">⬆️ Lên đầu trang</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
