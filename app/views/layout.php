<html>
    <head>
        <?php include(APP_PATH . '/views/head.php'); ?>
    </head>
    <body itemscope itemtype="http://schema.org/WebPage">
        <?php include(APP_PATH . '/views/header.php'); ?>
        <?php include(APP_PATH . '/views/menu.php'); ?>
        <?php include(APP_PATH . '/views/breadcrumb.php'); ?>
        
        <div style="margin:0 auto; max-width: 640px;">
        <?php echo $content; ?>
        </div>
        
        <?php include(APP_PATH . '/views/footer.php'); ?>
    </body>
</html>