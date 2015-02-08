<script src="<?php echo BASE_URL; ?>js/framework.js"></script>
<script src="<?php echo BASE_URL; ?>js/editor.js"></script>
<script src="<?php echo BASE_URL; ?>js/menu.js"></script>
<script>
    $.editor.setStore('<?php echo BASE_URL . CURRENT_URL; ?>/update');
    $.editor.use('title', 'article h1', 'single-line');
    $.editor.use('content', 'article div[itemprop="articleBody"]', 'html');
    $.editor.use('media', 'article img', 'media');
</script>
