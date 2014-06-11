

<h3>Raw</h3>
<pre><?php echo $result->response ?></pre>
<p>
</p>
<h3>Decoded</h3>
<table>
    <tr>
        <th>Key</th>
        <th>Value</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach (json_decode($result->response) as $key => $value): ?>
    <tr>
        <td><?php echo $key ?></td>
        <td><?php echo $value ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($result); ?>
</table>
