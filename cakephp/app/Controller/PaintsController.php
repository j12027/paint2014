<?php
App::uses('AppController', 'Controller');

class PaintsController extends AppController {

	public $uses = array('Paint', 'Comment');
	public $components = array('Session');
	public $paginate = array('Paint' => array('page' => 1, 'limit' => 16, 'order' => array('id' => 'desc')));

	public function index() {
		$this->autoLayout = false;
		$paints = $this->Paint->find('all');
		$comments = $this->Comment->find('all', array('fields' => array('comments'), 'order' => array('commentsId' => 'desc')));
		$this->set('paints', $this->paginate());
		$this->set('comments',$comments);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Paint->create();
			if ($this->Paint->save($this->request->data)) {
				$this->Session->setFlash(__('Save'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

	public function good(){
		$this->autoRender = FALSE;
		$result = false;
		if($this->request->is('ajax')) {
			$id = $this->data['id'];

			if(!is_null($id)){
				//$result = $this->Paint->setGood($target, $id);

				//データの更新処理
				if($this->Paint->updateAll(array('good' => 'good + 1'), array('id' => $id))){
					$result = true;	//保存成功
				}
				else{
					$result = false;	//保存失敗
				}
				//$this->redirect($this->referer());
			}
		}
		return $result;
	}

	public function addComment(){
		$this->autoRender = FALSE;
		$result = true;
		if($this->request->is('ajax')) {
			$id = $this->data['id'];
			$comment = $this->data['comments'];

			if(!is_null($id)){
				$this->Comment->create();
				if ($this->Comment->save(array('paintsId' => $id, 'comments' => $comment), false, array('paintsId', 'comments'))) {
					$result = true;
				}
			}
		}
		return $result;
	}

	public function selectImageComment(){
		$this->autoRender = FALSE;
		if($this->request->is('ajax')) {
			$paintsId = $this->data['id'];
			$comment = $this->Comment->find('noModelName', array('fields' => array('comments'), 'conditions' => array('paintsId' => $paintsId)));
		}

		return json_encode($comment);
	}

	public function selectImage(){
		$this->autoRender = FALSE;
		if($this->request->is('ajax')) {
			$paintsId = $this->data['id'];
			//$illustname = $this->Paint->find('noModelName', array('fields' => array('illustname'), 'conditions' => array('and' => array('groupId' => $paintsId, 'groupType' => 1))));
			//$illustname = $this->Paint->find('noModelName', array('fields' => array('illustname'), 'conditions' => array('and' => array('groupId' => $paintsId, array('or' => array('groupType' => 0, 'groupType' => 1))))));
			$illustname = $this->Paint->find('noModelName', array('fields' => array('illustname'), 'conditions' => array('groupId' => $paintsId)));
		}

		return json_encode($illustname);
	}
}
?>