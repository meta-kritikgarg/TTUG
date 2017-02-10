<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 18-02-16
 * Time: 09:47 PM
 */

//To creating instances of Techcoursescontroller
App::import('Controller', 'Techcourses');
App::import('Controller', 'Studentrooms');
App::import('Controller', 'Courserooms');

App::import('Vendor','Myclasses/DTD_manager');




class GeneratesController extends AppController
{


    public $helpers = array('Html', 'Form');

   // public $use = array('Course');
    public $uses = array('Techcourse','Generate','Studentroom','Student');

    public function index() {
        $this->loadModel('Course');

        $x= new Course();
        $this->set('courses', $x->findAllBytype('c'));
        $log_count=0;


        //CakeLog::write('debug', 'Something did not work');

//        print_r( $this->get_unassigned_subject($log_count));


        $dt_ins1= new DTD_manager();

        $array_du1=$dt_ins1->get_dt_array_duration_1();
        $array_du2=$dt_ins1->get_dt_array_duration_2();
        $array_du3=$dt_ins1->get_dt_array_duration_3();

        CakeLog::write('debug', 'possible values of duration 1 generated');


        //Loop starts from here

        $en=0;
   /*     while($course_id = $this->get_unassigned_subject($en++)) {

            //-->course id
            //$course_id = $this->get_unassigned_subject($en);

            CakeLog::write('debug', 'get unassigned course loop:'.$en);





            //$this->set('course id', $course_id);


            //-->Get Techcourse -- contains -- batch - used to identify student
            $techcourse_ins = ($this->get_techcourse_by_course_id($course_id,$en));
            $teacher_id = $techcourse_ins['Techcourse']['teacher_id'];
            $this->set('teacher id', $teacher_id);

            //echo $techcourse_ins['Course']['batch'];
            // print_r($this->get_student_id_by_course_batch($techcourse_ins['Course']['batch'],$log_count));


            //Get Student_id with the help of batch
            $student_data = $this->get_student_id_by_course_batch($techcourse_ins['Course']['batch'], $log_count);
            // $this->set('teacher id',$student_data);

            //  $this->set_studentroom_by_student_id(4);


            //Get Studentroom  with student id -- find , if not found than generate
            $room_id = $this->get_studentroom_by_student_id($student_data['Student']['id'],$en);
            //echo "Studentroom_id=" .$this->get_studentroom_by_student_id($student_data['Student']['id']);

            $this->set('room id', $room_id);


            if ($room_id > 0) {
                $final_exclude_dt = array();

                //--> make array dt of course, teacher and room
                $dtd_of_all = $this->get_dtd_by_course_teacher_room($course_id, $teacher_id, $room_id,$en);
                echo $en."<br> DTD of all= ";
                var_export($dtd_of_all);

                $final_exclude_dt = $dt_ins1->get_dt_from_dtd($dtd_of_all);
                //      var_export($final_exclude_dt);


                //--> make array dt of course for exclude
                $dtd_of_course = $this->get_dtd_by_course_id($course_id,$en);
                echo $en."<br> DTD of course= ";
                var_export($dtd_of_course);

                $alloted_days = $dt_ins1->get_d_from_dtd($dtd_of_course);

                echo $en."<br> Alloted days= ";

                var_export($alloted_days);
                foreach ($alloted_days as $alloted_day) {
                    $final_exclude_dt = array_merge($final_exclude_dt, $dt_ins1->get_dt_array_by_day($alloted_day));
                    echo $alloted_day."<br>";
                }


                $final_exclude_dt = array_unique($final_exclude_dt);


                $this->set('exclude array', $final_exclude_dt);

                $final_dt_array = array_diff($array_du1, $final_exclude_dt);

                echo $en."<br> Array init= ";
                var_export($array_du1);

                echo $en."<br> Array for exclude = ";
                var_export($final_exclude_dt);

                echo $en."<br>Final Array = ";
                var_export($final_dt_array);

                $this->set('final dt array', $final_dt_array);

                $random=array_rand($final_dt_array, 1);
                echo "Random index=".$random."<br>";
                $dt = $final_dt_array[$random];




                $this->set('dt', $dt);

                $dtd = $dt_ins1->get_dtd_from_dt($dt, 1);
                $this->set('dtd', $dtd);
                $this->add_data($course_id, $teacher_id, $room_id, $dtd);


            } else {

                echo $en."<br>";
                echo "Room id not available, Assigning Null<br>";

                $this->add_data($course_id, $teacher_id, -1, -1);

            }

            //Prepare final array after exclude


            //$this->cal_total_rwh();
        }


*/
        for($xq=0;$xq<20;$xq++)
        //while($course_id = $this->get_unassigned_labs($en++))
        {

            $course_id = $this->get_unassigned_labs($en++);
            CakeLog::write('debug', 'get unassigned labs loop:'.$en);
            echo "<br><br>start: Course id=";
            var_export($course_id);



            $room_id2=($this->get_courseroom_by_course_id($course_id,$en));
            echo "Room id=";
            var_export($room_id2);

            $techcourse_ins = ($this->get_techcourse_by_course_id($course_id,$en));

            //var_export($techcourse_ins);
            $teacher_id = $techcourse_ins['Techcourse']['teacher_id'];
            echo "Teacher id=";
            var_export($teacher_id);

            echo "<br>";

            //find all DTD by student, room, Teacher
            $final_exclude_dt = array();

            //--> make array dt of course, teacher and room
            $dtd_of_all = $this->get_dtd_by_course_teacher_room($course_id, $teacher_id, $room_id2,$en);
            echo $en."<br> DTD of all= ";
            var_export($dtd_of_all);



            $time_units= $this->get_time_units_by_course_id($course_id,$en);
           // $this->set('$tmp'.$en,$tmp);




        }
    }


    public function test()
    {
        echo "Testing started...";

        //Test: check availability of each course --> should be 0
        echo "check availability of each course";
        $this->set('availability',$this->check_course_availability());

        //Test: check all dtd's   dtd-room_id , d-course_id , dtd-teacher_id should unique

        $this->set('room_dtd',$this->check_room_dtd_overlap());

        $this->set('teacher_dtd',$this->check_teacher_dtd_overlap());

        $this->set('course_dtd',$this->check_course_dtd_overlap());



    }


    public function get_unassigned_subject($log)
    {
        //only for class type = 'c'
        /*
         * Query to get free subject
         * SELECT courses.*, generates.*, courses.frequency-count(generates.course_id) as availability ,
          count(generates.course_id)
          FROM courses left join generates on courses.id=generates.course_id
          where courses.type='c'
          group by courses.id
          order by availability desc, rand()
         */

        // Used in loop till availability !=0

        $q= $this->Generate->query('SELECT courses.*, generates.*, courses.frequency-count(generates.course_id) as availability ,
          count(generates.course_id) , '.$log.'
          FROM courses left join generates on courses.id=generates.course_id
          where courses.type=\'c\'
          group by courses.id
          order by availability desc, rand() limit 1');

        //$this->set('courses', $q);

        if($q[0][0]['availability']>0)

        {return $q[0]['courses']['id'];}

        else
        { return 0;}

    }

    public function get_unassigned_labs($log)
    {
        $q= $this->Generate->query('SELECT courses.*, generates.*, courses.frequency-count(generates.course_id) as availability ,
          count(generates.course_id) , '.$log.'
          FROM courses left join generates on courses.id=generates.course_id
          where courses.type=\'el\'
          group by courses.id
          order by availability desc, rand() limit 1');

        //$this->set('courses', $q);

        if($q[0][0]['availability']>0)

        {return $q[0]['courses']['id'];}

        else
        { return 0;}
    }

    //for testing
    public function check_course_availability()
    {

        $q= $this->Generate->query('SELECT courses.*, generates.*, courses.frequency-count(generates.course_id) as availability ,
          count(generates.course_id)
          FROM courses left join generates on courses.id=generates.course_id
          where courses.type=\'c\'
          group by courses.id
          order by availability desc');

        return $q;

    }

    public function check_room_dtd_overlap()
    {
        $q= $this->Generate->query('select * from generates a where ( `room_id`, `dtd` ) in
       ( select `room_id`, `dtd`
           from generates
        	where `room_id`!=-1
          group by `room_id`, `dtd`
         having count(*) > 1 ) ');

        return $q;

    }

    public function check_teacher_dtd_overlap()
    {
        $q= $this->Generate->query('select *
  from generates a
 where ( `teacher_id`, `dtd` ) in
       ( select `teacher_id`, `dtd`
           from generates
        	where dtd!=-1
          group by `teacher_id`, `dtd`
         having count(*) > 1 )');

        return $q;

    }

    public function check_course_dtd_overlap()
    {
        $q= $this->Generate->query('select *
  from generates a
 where ( `course_id`, `dtd` ) in
       ( select `course_id`, `dtd`
           from generates
        	where dtd!=-1
          group by `course_id`, `dtd`
         having count(*) > 1 )');

        return $q;

    }


    public function get_time_units_by_course_id($CourseId,$log)
    {
        if (!$CourseId) {
            throw new NotFoundException(__('Invalid CourseId'));
        }

        $course = $this->Course->findById($CourseId);
        if (!$course) {
            throw new NotFoundException(__('Invalid CourseId'));
        }
        //$this->set('course', $course);
        return $course['Course']['time_units'];



    }


    public function get_techcourse_by_course_id($course_id,$log)
    {
        $techcourse = $this->Techcourse->findByCourseId($course_id);

      //  $this->set('techcourse1',$techcourse);
        if (!isset($techcourse['Techcourse']['id'])) {
            //throw new NotFoundException(__('Invalid post'));
            echo "teacher not found assign automatacally ";
                $techcourse_ins1= new TechcoursesController();


                $techcourse_ins1->assign_teacher_rnd_for_course_id($course_id,$log);

                $techcourse = $this->Techcourse->findByCourseId($course_id);
                return $techcourse;


        }
        return $techcourse;

    }

    public function get_studentroom_by_student_id($student_id,$log)
    {
       // $data3 = $this->Studentroom->findByStudentId($student_id);

        $data3= $this->Studentroom->query('Select * From studentrooms WHERE student_id='.$student_id.' and '.$log.'='.$log);

        $this->set('data3',$data3);

        if(sizeof($data3)>0)
        {
           // echo "room data found";
           // var_export($data3);
            return $data3[0]['studentrooms']['room_id'];
        }
        else
        {
           // echo "room data not found";
            return $this->set_studentroom_by_student_id($student_id,$log);

        }





    }

    public function get_courseroom_by_course_id($course_id,$log)
    {
        $data4= $this->Generate->query('Select * From courserooms WHERE course_id='.$course_id.' and '.$log.'='.$log);

        $this->set('data4',$data4);

        echo "in function -- get_courseroom_by_course_id() with size ".sizeof($data4);

        if(sizeof($data4)>0)
        {
            // echo "room data found";
            // var_export($data3);
            return $data4[0]['courserooms']['room_id'];
        }
        else
        {
            // echo "room data not found";
            return $this->set_courrseroom_by_course_id($course_id,$log);

        }
    }


    public function set_studentroom_by_student_id($student_id,$log)
    {
        $q= $this->Generate->query('SELECT rooms.* FROM rooms WHERE (id NOT IN(SELECT room_id FROM studentrooms) AND rooms.type=\'c\' AND '.$log.'='.$log.' ) LIMIT 1');


        if(sizeof($q)>0) {
            $this->set('studentroom', $q);
            $studentroom_ins1= new StudentroomsController();

            $studentroom_ins1->insert_in_studentroom($student_id,$q[0]['rooms']['id']);
        }
        else{
            echo "Room Not available ";
            $studentroom_ins1= new StudentroomsController();

            $studentroom_ins1->insert_in_studentroom($student_id,-1);
            // Assign
        }

        $data3 = $this->Studentroom->findByStudentId($student_id);

        return $data3['Studentroom']['room_id'];
    }

    public function set_courrseroom_by_course_id($course_id,$log)
    {
        echo "Assigning room";

        $courseroom_ins1= new CourseroomsController();

        $courseroom_ins1->assign_room_to_labs_by_course_id($course_id,$log);


        $data4= $this->Generate->query('Select * From courserooms WHERE course_id='.$course_id.' and '.$log.' = '.$log);

        $this->set('check_ret_data',$data4);
        return $data4[0]['courserooms']['room_id'];
    }


    public function get_student_id_by_course_batch($course_batch,$log_count)
    {
        $student_data = $this->Student->findByCode($course_batch);

      //  $this->set('stu_dat',$student_data);

        return $student_data;


    }

    public function get_dtd_by_course_teacher_room($course_id,$teacher_id,$room_id,$log)
    {

        /*$conditions = array(
            'OR' => array(
                array('generates.course_id ' => $course_id),
                array('generates.teacher_id ' => $teacher_id),
                array('generates.room_id ' => $room_id)

            ),
        );*/



     //   $data= $this->Generate->find('all','conditions' => $conditions);


        $data=$this->Generate->query('select dtd, '.$log.' from generates where dtd!=-1 AND (course_id='.$course_id.' OR teacher_id='.$teacher_id.' OR room_id='.$room_id.') order by dtd');
        $res=array();
        for($i=0;$i<sizeof($data);$i++)
        {
            $res[]=$data[$i]['generates']['dtd'];

        }


          $this->set('dtd for exclude',$res);

        return $res;

    }


    public function get_dtd_by_course_id($course_id,$log)
    {
        $data=$this->Generate->query('select dtd from generates where course_id='.$course_id.' AND '.$log.'='.$log.' order by dtd');
        $res=array();
        for($i=0;$i<sizeof($data);$i++)
        {
            $res[]=$data[$i]['generates']['dtd'];

        }

        $this->set('dt_course_data',$data);
        return $res;
    }




   public function add_data($course_id,$teacher_id,$room_id,$dtd)
   {

       $this->Generate->create();
       if ($this->Generate->save(array('course_id' => $course_id , 'teacher_id' => $teacher_id, 'room_id' => $room_id, 'dtd' => $dtd)))
       {
           $this->log('data saved');
           //debug($this->Techcourse->find('all'));
           // return $this->redirect(array('action' => 'index'));
            print_r(array('course_id' => $course_id , 'teacher_id' => $teacher_id, 'room_id' => $room_id, 'dtd' => $dtd));
           echo "data saved"."<br>";
       } else {
           $this->log('Error');

       }

   }



}
?>