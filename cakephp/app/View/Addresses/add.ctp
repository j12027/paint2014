<div class="tests form">
<?php echo $this->Form->create('Address'); ?>
	<fieldset>
		<legend><?php echo __('V‹K“Še'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('illust');
		echo $this->Form->input('zipcode');
		echo $this->Form->input('address');
		//echo $this->Form->input('latitude');
		//echo $this->Form->input('longitude');
		//echo $this->Form->input('elevation');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List'), array('action' => 'index')); ?></li>
	</ul>
</div>
