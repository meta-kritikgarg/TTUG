<?php
/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 15-04-16
 * Time: 01:12 PM
 */
class CourseroomsController extends AppController
{

    public $helpers = array('Html', 'Form');

    public $use = array('Course','Room');


    public function index()
    {
        $this->loadModel('Course');
        $cour= new Course();
        $x=$cour->findAllByType('l');
        $this->set('courses', $x);



        $course_room=$this->Courseroom->find('all');
        $this->set('course_rooms', $course_room);

        $this->set('data',$this->set_room_list());

        //$this->delete_by_course_id(5);
       // $this->assign_room_to_labs_rnd();
        //$this->cal_total_rrs();
        //$this->cal_total_ars();

     //   $elab= new Elab();

       // $course_lab_list=$this->Courseroom->findAllByType('l');
        //$this->set('list',$course_lab_list);
        //SELECT courses.* FROM courses WHERE id NOT IN(SELECT course_id FROM techcourses)
       // $this->set('data',$this->setlist());


        if ($this->request->is(array('post', 'put'))) {
            $this->log('Some data in post');
            $this->add();
        }

        //$this->set('most_free_room',$this->get_free_room_id(25));
    }



    public function add() {
        $this->log("add is called");



        if ($this->request->is('post')) {



              //$this->set('postdat',$this->request->data);
            $courses=$this->get_real_add($this->request->data);

            $room_id=$this->request->data['Courseroom']['room_id'];

            //$x=0;
            foreach($courses as $course)
            {
                $this->Courseroom->create();

                //$this->set('sdf'.$x,$course);
                $this->Courseroom->course_id=$course['Course']['id'];
                $this->Courseroom->save(array('course_id' => $course['Course']['id'],'room_id'=>$room_id,'is_hard'=>1));

                //$x++;
            }

                $this->Flash->success(__('Your Data has been saved.'));
                return $this->redirect(array('action' => 'index'));

        }

    }

    public function get_real_add($data)
    {
        $this->loadModel('Course');
        $cour= new Course();
        $x=$cour->findAllByCourseId($data['Courseroom']['course_id']);
        if(sizeof($x)==0)
        {
            $x=$cour->findAllById($data['Courseroom']['course_id']);
        }
        //$this->set('update-list', $x);
        return $x;


    }


    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Courseroom->delete($id)) {
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

        if ($this->Courseroom->deleteAll(['is_hard' => 0])) {
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


    public function delete_by_course_id($id)
    {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }


        $this->loadModel('Course');
        $cour= new Course();
        $courses_labs = $cour->findAllByCourseId($id);

        $this->set('datatodelete',$courses_labs);

        foreach($courses_labs as $courses_lab) {
            $x=$this->Courseroom->findByCourseId($courses_lab['Course']['id']);
            if(sizeof($x)>0) {
                if ($this->Courseroom->delete($x['Courseroom']['id'])) {
                   // $this->set('datatodelete' . $courses_lab['Course']['id'], $courses_labs);
                } else {
                    $this->set('datanotdelete' . $courses_lab['Course']['id'], $courses_labs);
                }
            }

        }


       /* if ($this->Courseroom->delete($courses_labs)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }*/

        return $this->redirect(array('action' => 'index'));
    }

    public function insert_in_courseroom($course_id,$room_id)
    {

        $this->Courseroom->create();
        if ($this->Studentroom->save(array('course_id' => $course_id, 'room_id' => $room_id, 'is_hard' => 0)))
        {
            $this->log('Update Studentroom - $course_id='.$course_id.', room_id= '.$room_id);
            //debug($this->Techcourse->find('all'));
            // return $this->redirect(array('action' => 'index'));
        } else {
            $this->log('Error in Update Studentroom - student_id=\'.$course_id.\', room_id= \'.$room_id');

        }

    }

    public function set_room_list()
    {
        $t = new Room();
        $x=$t->findAllByType('l');
// ='l'
        $result = Set::combine($x, '{n}.Room.id', '{n}.Room.room_name');

        return($result);
    }



    public function assign_room_to_labs_rnd()
    {

        $this->loadModel('Course');
        $cour= new Course();
        $courses_labs = $cour->findAllByType('l');

        $this->set('lab-dat',$courses_labs);
        $log_1=0;
        foreach($courses_labs as $courses_lab)
        {
            $this->set('lab-dat'.$log_1,$courses_lab);

            $room_id = $this->get_free_room_id($log_1);
            foreach($courses_lab['Batches'] as $batch )
            {
                $this->Courseroom->create();

                $this->Courseroom->course_id=$batch['id'];
                $this->Courseroom->save(array('course_id' => $batch['id'],'room_id'=>$room_id,'is_hard'=>0));

            }

            //$room_id = $this->get_free_room_id($log_1);



            $log_1++;

        }
        return $this->redirect(array('action' => 'index'));


    }

    public function assign_room_to_labs_by_course_id($course_id,$log_1)
    {



            $room_id = $this->get_free_room_id($log_1);
            $this->Courseroom->create();
            $this->Courseroom->course_id=$course_id;
            $this->Courseroom->save(array('course_id' => $course_id,'room_id'=>$room_id,'is_hard'=>0));


    }

            //$room_id = $this->get_free_room_id($log_1);








    public function get_free_room_id($t)
    {
        //return null if no room is free


        $this->set('tmp'.$t,$t);
        $q=$this->Courseroom->query('SELECT rooms.id,rooms.room_name,'.$t.' ,sum(ifnull(courses.time_units,0)*ifnull(courses.frequency,0)) as freeness
FROM rooms left join courserooms on rooms.id=courserooms.room_id left join courses on courses.id=courserooms.course_id
WHERE rooms.type=\'l\'
group by rooms.id
order by freeness, RAND()
limit 1');

        /*SELECT rooms.id,rooms.room_name, sum(ifnull(courses.time_units,0)*ifnull(courses.frequency,0)) as freeness
FROM rooms left join courserooms on rooms.id=courserooms.room_id left join courses on courses.id=courserooms.course_id
WHERE rooms.type='l'
group by rooms.id
order by freeness, RAND()
limit 1*/
        // $this->set('free',$q);
        // unset($c);
        return $q[0]['rooms']['id'];
    }


}



?>