
<h3>Examples</h3>
<ul>
	<li>
		<?php
			echo $this->Html->link('Login', array(
					'controller' => 'secure',
					'action' => 'index',
					'students' => true
				)
			)
		?>
	</li>
	<li>
		<?php
			echo $this->Html->link('Experiences', array(
					'controller' => 'experiences',
					'action' => 'index',
					'students' => true
				)
			)
		?>
	</li>
</ul>
