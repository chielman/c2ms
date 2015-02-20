<?php // http://themergency.com/social-network-links/ 
$url = url("$cat_slug/$slug");
?>

<div class="share">
    <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($url); ?>" rel="nofollow" target="_blank" alt="Share on Facebook"></a>

    <a class="twitter" href="https://twitter.com/share?url=<?php echo urlencode($url); ?>text=<?php echo urlencode($title); ?>&related=thedutchdragons" rel="nofollow" target="_blank" alt="Tweet"></a>

    <a class="google" href="https://plus.google.com/share?url=<?php echo urlencode($url); ?>" rel="nofollow" target="_blank" alt="Google+"></a>

    <a class="linkedin" href="http://www.linkedin.com/shareArticle?url=<?php echo urlencode($url); ?>&title=<?php echo urlencode($title); ?>" rel="nofollow" target="_blank" alt="Linkedin"></a>

    <!-- MEDIA -->
    <!--<a class="pinterest" href="http://pinterest.com/pin/create/bookmarlet/?url=<?php urlencode($url); ?>&media=<?php urlencode($media); ?>&description=<?php echo urlencode($description); ?>" rel="nofollow" target="_blank" alt="Pinterest">Pinterest</a>-->
</div>
