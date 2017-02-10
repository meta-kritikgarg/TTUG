<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 08-02-16
 * Time: 07:58 PM
 */
class TeachersController extends AppController {

    public $helpers = array('Html', 'Form');

    public function index()
    {
       // $this->count_total_load();
        $this->set('teachers', $this->Teacher->find('all'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $teacher = $this->Teacher->findById($id);
        if (!$teacher) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('teacher', $teacher);
    }


    public function add() {
        if ($this->request->is('post')) {
            $this->Teacher->create();
            if ($this->Teacher->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add teacher.'));
        }
    }


    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $teacher = $this->Teacher->findById($id);
        if (!$teacher) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Teacher->id = $id;
            if ($this->Teacher->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $teacher;
        }
    }


    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Teacher->delete($id)) {
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

    public function count_total_load(){

        $sum = $this->Teacher->find('all', array(
                'conditions' => array('Teacher.type' => 'gf'),
                'fields' => array('sum(Teacher.load) as total_sum')
            )
        );
        $this->set('sum', $sum);


    }

}

?>