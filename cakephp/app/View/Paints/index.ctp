<html>
	<head>
		<?php echo $this->Html->charset();
			echo $this->Html->meta('icon');
			echo $this->Html->css('cake.paintlayout.css');
			echo $this->Html->Script('https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js');
			echo $this->Html->Script('jquery.color');
			echo $this->Html->Script('color_change');
			echo $this->Html->Script('action.js'); ?>
	</head>
	<body>
		<div id="top">
			<div id="header">
				<img src="<?php  echo $this->Html->webroot.IMAGES_URL.'title.jpg' ?>" />

			</div>
			<div id="main">
				<div id="listTop" class="listPosition"><ul>
					<?php echo $this->Paginator->first('First', array('tag' => 'li'));
					echo $this->Paginator->numbers(array('separator' => false,'modulus' => 10, 'tag' => 'li'));
					echo $this->Paginator->last('Last', array('tag' => 'li')); ?>
				</ul></div>
		
				<table id="tdLoop">
					<?php 
						$loop = (array_chunk($paints, 4));
						foreach ($loop as $row): ?>
					<tr>
						<?php foreach ($row as $paint): ?>
						<td>
							<img src="<?php  echo $this->Html->webroot.IMAGES_URL.$paint['Paint']['illustname']; ?>" id="image<?php echo $paint['Paint']['id']; ?>" class="image<?php echo $paint['Paint']['groupId']; ?>" />
							<div id="<?php echo $paint['Paint']['id']; ?>" class="goodForm">
								<div class="floatButton">
									<form accept-charset="utf-8" method="post"><div style="display:none;"><input type="hidden" /></div><button type="submit" id="button<?php echo $paint['Paint']['id']; ?>">Good</button></form>
								</div>
								<div id="text<?php echo $paint['Paint']['id']; ?>" class="floatText">
									<?php echo $paint['Paint']['good']; ?>
								</div>
							</div>
						</td>
						<?php endforeach; ?>
					</tr>
					<?php endforeach; ?>
				</table>

				<div id="listBottom" class="listPosition"><ul>
					<?php echo $this->Paginator->first('First', array('tag' => 'li'));
					echo $this->Paginator->numbers(array('separator' => false,'modulus' => 10, 'tag' => 'li'));
					echo $this->Paginator->last('Last', array('tag' => 'li')); ?>
				</ul></div>
			</div>
			<div id="footer">&copy;&nbsp;2015&nbsp;team&nbsp;TAKAHARU</div>
		</div>
		<div id="comment">
			<div id="commentForm">Please&nbsp;comment&nbsp;!&nbsp;(&nbsplimit&nbsp;15&nbsp)
				<form accept-charset="utf-8" method="post">
					<input type="text" maxlength="15" id="inputComment" />
					<button type="submit" id="commentButton">Submit</button>
				</form>
			</div>
		</div>
		<div id="display">
			<div id="list">
				<div id="listTitle">Comment&nbsp;List</div>
				<ul id="mainList">
					<li></li>
				</ul>
			</div>
		</div>
		<div id="imageDisplay">
			<div id="list">
				<div id="listTitle">Original</div>
				<div id="originalImage">
				</div>
				<div id="listTitle">Similar</div>
				<div id="imageList"></div>
			</div>
		</div>
	</body>
</html>