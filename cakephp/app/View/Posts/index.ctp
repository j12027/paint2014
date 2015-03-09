<h1>データ一覧</h1>

<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
		<th>id</th>
		<th>title</th>
		<th>body</th>
		<th>created</th>
		<th>modified</th>
			
	</tr>
	</thead>
	<?php foreach ($posts as $post): ?>
  		<tr>
    			<td><?php echo $post['Post']['id']; ?></td>
    			<td><?php echo $post['Post']['title']; ?></td>
    			<td><?php echo $post['Post']['body']; ?></td>
			<td><?php echo $post['Post']['created']; ?></td>
			<td><?php echo $post['Post']['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array(), __('Are you sure you want to delete # %s?', $post['Post']['id'])); ?>
			</td>
  		</tr>
	<?php endforeach; ?>
</table>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('新規投稿'), array('action' => 'add')); ?></li>
	</ul>
</div>