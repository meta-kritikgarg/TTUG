<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 10-02-16
 * Time: 11:20 PM
 */
class StudentsController extends AppController{
    public $helpers = array('Html', 'Form');

    public function index() {
        $this->set('students', $this->Student->find('all'));
    }


    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $student = $this->Student->findById($id);
        if (!$student) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('student', $student);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Student->create();
            if ($this->Student->save($this->request->data)) {
                $this->Flash->success(__('Your Data has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }


    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $student = $this->Student->findById($id);
        if (!$student) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Student->id = $id;
            if ($this->Student->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $student;
        }
    }


    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Student->delete($id)) {
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