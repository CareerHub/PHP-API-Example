
<h1>Welcome</h1>
<ul>
	<li>
		<?php
			echo $this->Html->link('Public', array(
				'controller' => 'home',
				'action' => 'index',
				'public' => true
			)
		)
	?>
	</li>
	<li>
		<?php
			echo $this->Html->link('Students', array(
				'controller' => 'home',
				'action' => 'index',
				'students' => true
			)
		)
	?>
	</li>
	<li>
		<?php
			echo $this->Html->link('Trusted', array(
				'controller' => 'home',
				'action' => 'index',
				'trusted' => true
			)
		)
	?>
	</li>
</ul>
