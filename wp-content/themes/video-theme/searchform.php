<div class="search-form-wrapper">
    <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="modern-search-form">
        <div class="search-input-wrapper">
            <svg class="search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <input type="search" 
                   class="search-input"
                   placeholder="Tìm kiếm video, bài viết..." 
                   value="<?php echo get_search_query(); ?>" 
                   name="s" 
                   autocomplete="off" />
            <div class="search-suggestions" id="search-suggestions"></div>
        </div>
        <button type="submit" class="search-button" aria-label="Tìm kiếm">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
        </button>
    </form>
</div>
