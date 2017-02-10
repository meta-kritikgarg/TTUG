<?php

class TechcoursesController extends AppController {

    public $helpers = array('Html', 'Form');

    public $use = array('Teacher','Course');


    public function index()
    {
        // $this->count_total_load();
        //$teacherlist=$t->find('all');
        //$this->set('list',$teacherlist);


        $this->set('techcourses', $this->Techcourse->find('all'));
        $t = new Teacher();



        $this->cal_total_rwh();
        $this->cal_total_awh();
        $this->get_all_subject_list();

        $teacherlist=$t->find('all');
        $this->set('list',$teacherlist);
        //SELECT courses.* FROM courses WHERE id NOT IN(SELECT course_id FROM techcourses)
        $this->set('data',$this->setlist());


        if ($this->request->is(array('post', 'put'))) {
            $this->log('Some data in post');
            $this->add();
        }
    }

    public function view($id) {

        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $techcourse = $this->Techcourse->findById($id);
        if (!$techcourse) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('techcourses', $techcourse);
    }

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

    public function setlist()
    {
        $t = new Course();

      /*  SELECT a.id,b.subject, a.el_batch as batch FROM courses a LEFT JOIN courses b
ON a.course_id= b.id WHERE (a.id NOT IN(SELECT course_id FROM techcourses)) AND a.type='el'

union

SELECT courses.id,courses.subject, courses.batch FROM courses WHERE (id NOT IN(SELECT course_id FROM techcourses)) AND courses.type="c"
        */
        //$x=$t->query('SELECT courses.* FROM courses WHERE (id NOT IN(SELECT course_id FROM techcourses)) AND courses.type="c" ');
        $x=$t->query('SELECT a.id,  concat(b.subject, \' \', a.el_batch)  as subject FROM courses a LEFT JOIN courses b
ON a.course_id= b.id WHERE (a.id NOT IN(SELECT course_id FROM techcourses)) AND a.type=\'el\'

union

SELECT courses.id,courses.subject FROM courses WHERE (id NOT IN(SELECT course_id FROM techcourses)) AND courses.type=\'c\'
');

        $this->set('check',$x);
        $result = Set::combine($x, '{n}.0.id', '{n}.0.subject');

        return($result);

    }

    public function set_lab_list()
    {
        $t = new Course();
       /* SELECT a.id,a.el_batch as batch_name ,b.* FROM courses a LEFT JOIN courses b
                ON a.course_id= b.id where a.type= 'el'
        */

        $x=$t->query('SELECT courses.* FROM courses WHERE (id NOT IN(SELECT course_id FROM techcourses)) AND courses.type="el" ');



        $result = Set::combine($x, '{n}.courses.id', '{n}.courses.subject');

        return($result);


    }

    public function get_subject_list()
    {
        $x=$this->Techcourse->query('SELECT courses.* FROM courses WHERE (id NOT IN(SELECT course_id FROM techcourses))AND courses.type="c"');

        //$result = Set::combine($x, '{n}.courses.id', '{n}.courses.subject');

        return($x);

    }

    public function get_all_subject_list()
    {
        $t = new Course();
        //$x=$this->Techcourse->query('SELECT courses.* FROM courses WHERE (id NOT IN(SELECT course_id FROM techcourses))AND courses.type="c"');


        $this->set('courses', $t->findAllByType(array('l','c')));
        //$result = Set::combine($x, '{n}.courses.id', '{n}.courses.subject');

        //return($x);

    }

    public function get_unassigned_subject()
    {
        $x=$this->Techcourse->query('SELECT courses.* FROM courses WHERE id NOT IN(SELECT course_id FROM techcourses)');

        $result = Set::combine($x, '{n}.courses.id', '{n}.courses.subject');

        $this->set('data',$result);

    }

    public function cal_total_rwh()
    {
        $c = new Course();

        $q=   $c->find('all',array('fields'=>array('SUM(Course.frequency*Course.parts*Course.time_units) as req_wh')));

        $this->set('rwh',$q[0][0]['req_wh']);
       // return $c;
    }

    public function cal_total_awh()
    {
        $c = new Teacher();

        $q=   $c->find('all',array('fields'=>array('SUM(Teacher.load) as ava_wh')));

        $this->set('awh',$q[0][0]['ava_wh']);
        // return $c;
    }

    public function assign_teacher_rnd()
    {
        //create table tmp_for  teacher with there load
        //select
        //find most free teacher
        //assign him a subject
        //stop when there in no pending subject


        $subjects = $this->get_subject_list();
        foreach ($subjects as $subject) {

            $q=$this->Techcourse->query('SELECT teachers.id,teachers.load, sum(courses.frequency), (1-IFNULL(sum(courses.frequency),0)/teachers.load) as freeness , courses.frequency*'.$subject['courses']['id'].'
                                      FROM teachers left join techcourses on teachers.id=techcourses.teacher_id left join courses on courses.id=techcourses.course_id
                                      group by teachers.id order by freeness desc , RAND() Limit 1');
            // $this->set('free',$q[0]['teachers']);
            // unset($c);
            $r= $q[0]['teachers']['id'];
          //  $this->log($subject['courses']['id'] . '=c   t=' . $this->get_mostfree_teacher_id($subject['courses']['id']));

            //$this->Techcourse->save(array('teacher_id' => $this->get_mostfree_teacher_id(), 'course_id' => $subject['courses']['id'],'hard'=>0));

            // $q=$this->Techcourse->query('INSERT INTO `techcourses`( `teacher_id`, `course_id`, `hard`) VALUES ('.$v.','.$subject['courses']['id'].',0)');

            $this->Techcourse->create();
            if ($this->Techcourse->save(array('teacher_id' => $r, 'course_id' => $subject['courses']['id'], 'hard' => 0)))
            {
                $this->log('Your Data has been saved');
                //debug($this->Techcourse->find('all'));
                // return $this->redirect(array('action' => 'index'));
            } else {
                $this->log('Error');

            }

            unset($v);
            unset($r);

            //debug($q);
            // }

        }
        return $this->redirect(array('action' => 'index'));
    }

    public function assign_teacher_rnd_for_course_id($course_id,$log)
    {
        $q=$this->Techcourse->query('SELECT teachers.id,teachers.load, sum(courses.frequency*IFNULL(courses.parts,1)*courses.time_units), (1-IFNULL(sum(courses.frequency*IFNULL(courses.parts,1)*courses.time_units),0)/teachers.load) as freeness , courses.frequency*'.$course_id.' ,'.$log.'
                                      FROM teachers left join techcourses on teachers.id=techcourses.teacher_id left join courses on courses.id=techcourses.course_id
                                      group by teachers.id order by freeness desc , RAND() Limit 1');
        // $this->set('free',$q[0]['teachers']);
        // unset($c);
        $r= $q[0]['teachers']['id'];
        echo " assign_teacher_rnd_for_course_id=".$course_id;
        $this->Techcourse->create();
        if ($this->Techcourse->save(array('teacher_id' => $r, 'course_id' => $course_id, 'hard' => 0)))
        {
            $this->log('Update Techcourse - teacher_id='.$r.', course_id= '.$course_id);
            //debug($this->Techcourse->find('all'));
            // return $this->redirect(array('action' => 'index'));
        } else {
            $this->log('Error in Update Techcourse - teacher_id=\'.$r.\', course_id= \'.$course_id');

        }
    }

    public function get_mostfree_teacher_id($t)
    {

        $this->set('tmp'.$t,$t);
        $q=$this->Techcourse->query('SELECT teachers.id,teachers.load, sum(courses.frequency*IFNULL(courses.parts,1)*courses.time_units), (1-IFNULL(sum(courses.frequency*IFNULL(courses.parts,1)*courses.time_units),0)/teachers.load) as freeness
                                      FROM teachers left join techcourses on teachers.id=techcourses.teacher_id left join courses on courses.id=techcourses.course_id
                                      group by teachers.id order by freeness desc , RAND() Limit 1');
       // $this->set('free',$q[0]['teachers']);
       // unset($c);
        return $q[0]['teachers']['id'];
     }






}
?>