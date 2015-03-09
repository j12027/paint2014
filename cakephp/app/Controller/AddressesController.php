<?php
App::uses('AppController', 'Controller');

class AddressesController extends AppController {

	public $uses = array('Address');
	public $layout = "j12027";

	function index(){
		$addresses = $this->Address->find('all');
		$this->set('addresses',$addresses);
	}

	public function add() {
		if ($this->request->is('post')) {
			$parametar = "?sensor=false&region=jp&address=".urlencode(mb_convert_encoding($this->request->data['Address']['address'], 'UTF8', 'auto'));
			$datas = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json'.$parametar);

			// JSONデータをPHPの値に変換する
			$geo = json_decode($datas);
			$results = $geo->results[0];
			$geometry = $results->geometry;
			$location = $geometry->location;
 			$lat = $location->lat; // 緯度を取得
			$lng = $location->lng; // 経度を取得
			
			//標高を取得
			$datas = file_get_contents("http://maps.googleapis.com/maps/api/elevation/json?sensor=false&locations=$lat,$lng");
			$elevations = json_decode($datas);
			$elevation = $elevations->results[0]->elevation;

			$this->request->data['Address']['latitude'] = $lat;
			$this->request->data['Address']['longitude'] = $lng;
			$this->request->data['Address']['elevation'] = $elevation; 

			$this->Address->create();
			if ($this->Address->save($this->request->data)) {
				return $this->redirect(array('action' => 'index'));
			} 		
		}
	}

	public function view($id = null) {
		$options = array('conditions' => array('Address.' .    $this->Address->primaryKey => $id));
		$this->set('address', $this->Address->find('first', $options));
	}

	public function delete($id = null) {
		$this->Address->id = $id;
		$this->request->allowMethod('post', 'delete');
		$this->Address->delete();
		return $this->redirect(array('action' => 'index'));
	}

	public function edit($id = null) {
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Address->save($this->request->data)) {
				return $this->redirect(array('action' => 'index'));
			} 
		} else {
			$options = array('conditions' => array('Address.' . $this->Address->primaryKey => $id));
			$this->request->data = $this->Address->find('first', $options);
		}
	}
}
?>
