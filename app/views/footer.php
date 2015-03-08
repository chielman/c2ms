<div id="footer">
    <!-- contact, adverteren, over thedutchdragons.nl, privacy, algemene voorwaarden, cookies -->
    <!-- like op facebook, volg op twitter, instagram -->
    <!-- copyright -->
</div>

<script src="<?php echo BASE_URL; ?>js/framework.js"></script>
<script src="<?php echo BASE_URL; ?>js/editor.js"></script>
<script src="<?php echo BASE_URL; ?>js/menu.js"></script>
<script src="<?php echo BASE_URL; ?>js/attendance.js"></script>
<script src="<?php echo BASE_URL; ?>js/userprogress.js"></script>
<script>
    $.editor.setStore('<?php echo BASE_URL . CURRENT_URL; ?>/update');
    $.editor.use('title', 'article h1', 'single-line');
    $.editor.use('content', 'article div[itemprop="articleBody"]', 'html');
    $.editor.use('media', 'article img', 'media');
</script>
