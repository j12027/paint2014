<?php
App::uses('AppModel', 'Model');
 
class Paint extends AppModel {

	public function setGood($good, $id){
		//$result = $this->query('UPDATE paints SET good = :good + 1 WHERE id = :id', array('good' => $good, 'id' => $id));

		$result = false;
		$setGood = $good + 1;
		$sql = "UPDATE paints SET good = '".$setGood."' WHERE id = '".$id."'";
		$this->query($sql);
		$res = $this->getAffectedRows();
		if($res >= 1){
			$result = true;
		}

		return $result;
	}
}