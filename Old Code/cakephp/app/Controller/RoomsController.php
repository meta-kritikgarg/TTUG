<?php
class RoomsController extends AppController{
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('rooms', $this->Room->find('all'));
    }


    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $room = $this->Room->findById($id);
        if (!$room) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('room', $room);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Room->create();
            if ($this->Room->save($this->request->data)) {
                $this->Flash->success(__('Your Data has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your data.'));
        }
    }


    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $room = $this->Room->findById($id);
        if (!$room) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Room->id = $id;
            if ($this->Room->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $room;
        }
    }


    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Room->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }

}


?>