<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>TEST</title>

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    </head>
    <body>

        <h1 style="text-align: center">the url that shorten </h1>
        <table border="1" style="margin: 0 auto">
            <tr>
                <td>short url</td>
                <td>full url</td>
                <td>Hits</td>
            </tr>    


            <?php foreach ($fullurl as $url): ?>
                <tr> 
                    <td>
                        <a href="<?php echo $url->full_url; ?>" onclick="update_hits(<?php echo $url->id; ?>)">
                            <?php
                            if ($url->type == 1) {
                                echo base_url() . $url->short_url;
                            } else {
                                echo $url->short_url;
                            }
                            ?></a>
                        <br />
                    </td>
                    <td><?php echo $url->full_url; ?></td>
                    <td><?php echo $url->hits; ?></td>
                </tr>
            <?php endforeach; ?>

        </table>


        <script type="text/javascript">
            function update_hits(id) {
                $.post("/index.php/a/update_hits", {uid: id})
                
            }


        </script>

    </body>
</html>