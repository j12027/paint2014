<div class="tests form">
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('illustname');
		echo $this->Form->input('groupId');
		echo $this->Form->input('groupType');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('ˆê——'), array('action' => 'index')); ?></li>
	</ul>
</div>