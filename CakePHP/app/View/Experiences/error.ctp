
<h3>Error</h3>
<h4>Request</h4>
<p>
    <?php echo var_dump($data) ?>
</p>

<h4>Response</h4>
<p>Error Code: <?php echo $result->info->http_code ?></p>
<p><?php echo $result->response ?></p>
