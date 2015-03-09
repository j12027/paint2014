<html>
<?php echo $this->Html->script('http://maps.google.com/maps/api/js?sensor=true', false); ?>
<body>
<h1>Address</h1>
<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
		<th>id</th>
		<th>name</th>
		<th>zipcode</th>
		<th>address</th>
		<th>latitude</th>
		<th>longitude</th>
		<th>elevation</th>
		<th>created</th>
		<th>modified</th>
			
	</tr>
	</thead>
	<?php foreach ($addresses as $address): ?>
  		<tr>
    			<td><?php echo $address['Address']['id']; ?></td>
    			<td><?php echo $address['Address']['name']; ?></td>
			<td><?php echo $address['Address']['zipcode']; ?></td>
			<td><?php echo $address['Address']['address']; ?></td>
    			<td><?php echo $address['Address']['latitude']; ?></td>
			<td><?php echo $address['Address']['longitude']; ?></td>
			<td><?php echo $address['Address']['elevation']; ?></td>
			<td><?php echo $address['Address']['created']; ?></td>
			<td><?php echo $address['Address']['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $address['Address']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $address['Address']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $address['Address']['id']), array(), __('Are you sure you want to delete # %s?', $address['Address']['id'])); ?>
			</td>
  		</tr>
	<?php endforeach; ?>
</table>

<?php $i=1; ?>
<?php foreach ($addresses as $address): ?>
<?php
	$image = $this->Html->webroot.IMAGES_URL .$address['Address']['illust'];
	if($i == 1){
		$latitude = $address['Address']['latitude'];
		$longitude = $address['Address']['longitude'];
		$address = $address['Address']['address'];
		$i++;

	//�}�b�v�̃I�v�V�����w��
	$map_options = array(
	'id' => 'map1', //�n�}�\����������ID��
	'zoom' => 14,            //�n�}�\���̃Y�[�����x��
	'type' => 'ROAD',       //'HYBRID',     //�n�}�\���̃^�C�v
	//'custom' => null,       //�n�}�R���g���[���Ȃǂ̃I�v�V����
	'localize' => true,     //�n�}�\���̎���GPS�Ō��ݒn���g�����ǂ���
	'latitude' => $latitude,   //�n�}�\���̎��̈ܓx(localize��true�̏ꍇ�͌��ݒn���D�悳��܂�)
	'longitude' => $longitude,   //�n�}�\���̎��̌o�x(localize��true�̏ꍇ�͌��ݒn���D�悳��܂�)
	'marker' => true,         //�}�[�J�[�̎g�p
	'markerIcon' => 'http://google-maps-icons.googlecode.com/files/home.png',     		//�}�[�J�[�̃A�C�R��
	'markerShadow' => 'http://google-maps-icons.googlecode.com/files/shadow.png',  	//�}�[�J�[�A�C�R���̉e
	'infoWindow' => true,           //�}�[�J�[���N���b�N�����Ƃ��̃E�C���h�E�\��
	'windowText' => '<img src="'.$image.'" width="'.'100'.'" height="'.'100'.'" align="'.'left'.'" />'
	);
	}
?>
<?php endforeach; ?>

<div id="map">
  <?php echo $this->GoogleMap->map($map_options); ?>
</div>

<?php $i=1; ?>
<?php foreach ($addresses as $address): ?>
<?php
        if($i>1){
		$marker_options = array(
			'showWindow' => true,
			'windowText' =>'<img src="'.$image.'" width="'.'100'.'" height="'.'100'.'" align="'.'left'.'"/>'.$address['Address']['name']." ".$address['Address']['address'],
			'markerTitle' => 'Title',
			'markerIcon' => 'http://labs.google.com/ridefinder/images/mm_20_purple.png',
			'markerShadow' => 'http://labs.google.com/ridefinder/images/mm_20_purpleshadow.png', );

			echo  $this->GoogleMap->addMarker('map1', $i, array('latitude' => $address['Address']['latitude'], 'longitude' =>$address['Address']['longitude'] ),$marker_options);
	}
$i++; ?>
<?php endforeach; ?>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add'), array('action' => 'add')); ?></li>
	</ul>
</div>
</body>
</html>