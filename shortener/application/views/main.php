<?php echo validation_errors(); ?>
<h1 style="text-align: center">Short url from here</h1>
<form method="post" style="margin: 0 auto;width:12%"  action="<?php echo site_url('a/shortener'); ?>">
    <input type="radio" name="type" value="1" />shortener script
    <br />
    <input type="radio" name="type" value="2" />google shortener api
    <br />
    <input type="text" name="url" />
    <input type="submit" value="show">
</form>
