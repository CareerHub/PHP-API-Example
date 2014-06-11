
<h3>Experiences</h3>


<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Start</th>
    </tr>

    <!-- Here is where we loop through our $posts array, printing out post info -->

    <?php foreach ($result as $experience): ?>
    <tr>
        <td><?php echo $experience['id']; ?></td>
        <td>
            <?php echo $this->Html->link($experience['title'], array('controller' => 'experiences', 'action' => 'detail', $experience['id'])); ?>
        </td>
        <td><?php echo $experience['start']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>