
<?php echo $this->Form->create(false); ?>

<?php 
echo $this->Form->input(
    'title',
    array('label' => 'Title: ')
);

 echo $this->Form->input(
	    'organisation',
	    array('label' => 'Organisation: ')
		);

echo $this->Form->input(
	    'description',
	    array('label' => 'Description: ')
		);

echo $this->Form->input(
	    'start',
	    array('label' => 'Start Date: ')
		);

echo $this->Form->input(
	    'end',
	    array('label' => 'End Date: ')
		);

echo $this->Form->input(
	    'contactName',
	    array('label' => 'Contact Name: ')
		);

echo $this->Form->input(
	    'contactEmail',
	    array('label' => 'Contact Email: ')
		);

echo $this->Form->input(
	    'contactPhone',
	    array('label' => 'Contact Phone: ')
		);
?>
<div>
    <button type="submit">Save</button>
</div>
<?php echo $this->Form->end(); ?>