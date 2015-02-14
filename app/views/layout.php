<html>
    <head>
        <?php include(APP_PATH . '/views/head.php'); ?>
    </head>
    <body itemscope itemtype="http://schema.org/WebPage">
        <?php include(APP_PATH . '/views/header.php'); ?>
        <?php include(APP_PATH . '/views/menu.php'); ?>
        
        <div id="content"><?php echo $content; ?></div>
        
        <?php include(APP_PATH . '/views/footer.php'); ?>
    </body>
</html>