Mime-version: 1.0
From: <?php echo $from; ?>
Return-Path: <?php echo $returnPath; ?>
Cc: <?php echo $cc; ?>
Bcc: <?php echo $bcc; ?>
Reply-To: <?php echo $replyTo; ?>
Sensitivity: <?php echo $sensitivity; ?>
X-Mailer: C2MS (PHP/<?php echo phpversion(); ?>
<?php if($attachment): ?>
    Content-Type: multipart/mixed; boundary=<?php echo $boundary; ?>

--<?php echo $boundary; ?>
<?php endif; ?>
content-type: multipart/alternative; boundary=<?php echo $seperator; ?>

--<?php echo $seperator; ?>
Content-Type: text/plain; charset="utf-8"
Content-Transfer-Encoding: quoted-printable
Content-Disposition: inline

<?php echo $text; ?>

--<?php echo $seperator; ?>
Content-Type: text/html; charset="utf-8"
Content-Disposition: inline

<?php echo $html; ?>

--<?php echo $seperator; ?>--
<?php if($attachment): ?>
--<?php echo $boundary; ?>
<?php foreach($attachments as $attachment): ?>
Content-Type: <?php echo $mimeType; ?>; name="<?php echo $filename; ?>"
Content-Disposition: attachment; filename"<?php echo $filename;?>"; size="<?php echo $size; ?>;"
Content-Transfer-Encoding: base64

<?php echo $attachment; ?>
--<?php echo $seperator; ?>--
<?php endforeach; ?>
<?php endif;