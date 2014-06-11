
<h1><?php echo $result['title']; ?></h1>
<h2><?php echo $result['organisation']; ?></h2>

<p><?php echo $result['description']; ?></p>

<p>
	<?php echo $this->Html->link('edit', array(
				'controller' => 'experiences', 
				'action' => 'edit', 
				$result['id'], 
				'?' => array('studentId' => $this->request->query['studentId'] )
			)
		) 
	?>
</p>