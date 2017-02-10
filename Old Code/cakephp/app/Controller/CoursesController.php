<?php
class CoursesController extends AppController{
    public $helpers = array('Html', 'Form');
    public $use = array('e_lab');


    public function index() {
        $this->set('courses', $this->Course->findAllByType(array('l','c')));
        $this->cal_total_rwh();

        $this->elaborate_labs();
    }


    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $course = $this->Course->findById($id);
        if (!$course) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('course', $course);
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Course->create();
            if ($this->Course->save($this->request->data)) {
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

        $course = $this->Course->findById($id);
        if (!$course) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Course->id = $id;
            if ($this->Course->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $course;
        }
    }


    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Course->delete($id)) {
            $this->Course->deleteAll(array('Course.course_id' => $id));

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


    //rwh = Required working hours
    public function cal_total_rwh()
    {
        $c=   $this->Course->find('all',array('fields'=>array('SUM(Course.frequency*Course.parts*Course.time_units) as req_wh')));
       // $this->set('rwh',$c);
        return $c;
    }

    public function delete_all_elaborate_lab()
    {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Course->deleteAll(array('Course.type' => 'el'))) {


            $this->Flash->success(
                __('All el labs has been deleted.')
            );
        } else {
            $this->Flash->error(
                __(' could not be deleted.')
            );
        }

        return $this->redirect(array('action' => 'index'));

    }

    public function elaborate_labs()
    {
        $data= $this->get_un_elaborate_labs();
        $en=0;

        foreach($data as $item)
        {

           // echo "result";
            $batches=($this->get_name_of_batches($item['courses']['parts'],$item['students']['batch_count'],$item['courses']['batch']));

            //echo "<br><br>";

            foreach($batches as $batch)
            {
                $this->add_data($item['courses']['id'],$batch,$item['courses']['time_units'],$item['courses']['frequency'],$en);

                $en++;
            }
        }


    }

    public function get_un_elaborate_labs()
    {
        $this->loadModel('Elab');

        $elab= new Elab();

        $result= $this->Course->query('SELECT * FROM courses LEFT JOIN students
                ON courses.batch=students.code where courses.type= \'l\'');
        $this->set('lab data',$result);

        //$this->set('lab data',$elaborated_labs);

             /* SELECT * FROM courses LEFT JOIN students
                ON courses.batch=students.code where courses.type='l'*/

        $result_data=array();
        foreach($result as $lab)
        {

            $elaborated_labs=$elab->findAllByCourseId($lab['courses']['id']);
            $this->set('el',$elaborated_labs);

            if(sizeof($elaborated_labs)==$lab['courses']['parts'])
            {

            }
            else
            {
                $result_data[]=$lab;

            }

        }

        $this->set('return data',$result_data);

        return $result_data;
    }

    public function get_name_of_batches($required_pats,$ava_parts,$code)
    {
        $ava_batch_array=array();
        for($i=1;$i<=$ava_parts;$i++)
        {
            $ava_batch_array[]= $code.$i;

        }



        print_r($ava_batch_array);
        $no_of_elements_each_batch=$ava_parts/$required_pats;

        $result=array();
        echo "No of element each=".$no_of_elements_each_batch;
        switch($no_of_elements_each_batch)
        {
            case 1:
                $result= $ava_batch_array;
                break;
            case 2:


                for($x=0;$x<=$required_pats;$x=$x+$no_of_elements_each_batch)
                {

                    $tmp= $ava_batch_array[$x].'+'.$ava_batch_array[$x+1];
                    $result[]=$tmp;

                }
            break;

        }

        return $result;


    }


    public function add_data($course_id,$batch,$time,$frequency,$log)
    {

        $this->Course->create();
        if ($this->Course->save(array('el_batch' => $batch,'frequency'=>$frequency,'type' => 'el','course_id' => $course_id ,'time_units'=>$time)))
        {
            $this->log('data saved '.$log);
            //debug($this->Techcourse->find('all'));
            // return $this->redirect(array('action' => 'index'));
           // print_r(array('course_id' => $course_id , 'teacher_id' => $teacher_id, 'room_id' => $room_id, 'dtd' => $dtd));
           // echo "data saved"."<br>";
        } else {
            $this->log('Error');

        }

    }

    public function set_student_id()
    {

        $dat=$this->Course->query('UPDATE `courses` LEFT JOIN students
                ON courses.batch=students.code SET `student_id`= students.id');

    }



}


?>