<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 17-02-16
 * Time: 03:02 PM
 */
class StudentroomsController extends AppController
{
    public $helpers = array('Html', 'Form');

    public $use = array('Student','Room');


    public function index()
    {
        $this->set('student_room', $this->Studentroom->find('all'));
        $t = new Student();

        $this->cal_total_rrs();
        $this->cal_total_ars();

        $student_list=$t->find('all');
        $this->set('list',$student_list);
        //SELECT courses.* FROM courses WHERE id NOT IN(SELECT course_id FROM techcourses)
        $this->set('data',$this->setlist());


        if ($this->request->is(array('post', 'put'))) {
            $this->log('Some data in post');
            $this->add();
        }

        $this->set('most_free_room',$this->get_free_room_id(25));
    }


    public function setlist()
    {
        $t = new Course();
        $x=$t->query('SELECT rooms.* FROM rooms WHERE (id NOT IN(SELECT room_id FROM studentrooms)) ');

        $result = Set::combine($x, '{n}.rooms.id', '{n}.rooms.room_name');

        return($result);

    }

    public function add() {
        $this->log("add is called");



        if ($this->request->is('post')) {

            $this->Studentroom->create();
          //   $this->Studentroom->is_hard= 1;
          //  print_r($this->request->data);
            if ($this->Studentroom->save($this->request->data)) {
                $this->Flash->success(__('Your Data has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }

    }

    public function insert_in_studentroom($student_id,$room_id)
    {

        $this->Studentroom->create();
        if ($this->Studentroom->save(array('student_id' => $student_id, 'room_id' => $room_id, 'is_hard' => 0)))
        {
            $this->log('Update Studentroom - student_id='.$student_id.', room_id= '.$room_id);
            //debug($this->Techcourse->find('all'));
            // return $this->redirect(array('action' => 'index'));
        } else {
            $this->log('Error in Update Studentroom - student_id=\'.$student_id.\', room_id= \'.$room_id');

        }

    }



    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Studentroom->delete($id)) {
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

    public function delete_all() {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Studentroom->deleteAll(['is_hard' => 0])) {
            $this->Flash->success(
                __('deleted successful')
            );
        } else {
            $this->Flash->error(
                __(' could not be deleted.')
            );
        }

        return $this->redirect(array('action' => 'index'));
    }


    /*   public function view($id) {

           if (!$id) {
               throw new NotFoundException(__('Invalid post'));
           }

           $techcourse = $this->Studentroom->findById($id);
           if (!$techcourse) {
               throw new NotFoundException(__('Invalid post'));
           }
           $this->set('techurses', $techcourse);
       }
   /*
       public function add() {
           $this->log("add is called");



           if ($this->request->is('post')) {

               $this->Techcourse->create();
               // $this->Techcourse->teacher_id= $id;
               if ($this->Techcourse->save($this->request->data)) {
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

           if ($this->Techcourse->delete($id)) {
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

       public function delete_all() {
           if ($this->request->is('get')) {
               throw new MethodNotAllowedException();
           }

           if ($this->Techcourse->deleteAll(['hard' => 0])) {
               $this->Flash->success(
                   __('deleted successful')
               );
           } else {
               $this->Flash->error(
                   __(' could not be deleted.')
               );
           }

           return $this->redirect(array('action' => 'index'));
       }
   */

    //required room slots
    public function cal_total_rrs()
    {

        $c = new Course();

        $q=   $c->find('all',array('conditions'=>array('type ='=>'c'),'fields'=>array('SUM(Course.frequency*Course.parts) as req_wh')));

        $this->set('rrs',$q[0][0]['req_wh']);
        // return $c;
    }

    //available room slots
    public function cal_total_ars()
    {
        $c = new Room();

        $q=   $c->find('all',array('conditions'=>array('type ='=>'c'),'fields'=>array('SUM(Room.slots_week) as ava_wh')));

        $this->set('a_room_slots',$q[0][0]['ava_wh']);
        // return $c;
    }


    public function get_free_room_id($t)
    {
        //return null if no room is free


        $this->set('tmp'.$t,$t);
        $q=$this->Studentroom->query('SELECT teachers.id,teachers.load, sum(courses.frequency), (1-IFNULL(sum(courses.frequency),0)/teachers.load) as freeness
                                      FROM teachers left join techcourses on teachers.id=techcourses.teacher_id left join courses on courses.id=techcourses.course_id
                                      group by teachers.id order by freeness desc , RAND() Limit 1');
        // $this->set('free',$q[0]['teachers']);
        // unset($c);
        return $q[0]['teachers']['id'];
    }


}

?>