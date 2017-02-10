<?php

/**
 * Created by PhpStorm.
 * User: KRITIK GARG
 * Date: 07-04-16
 * Time: 12:22 PM
 */

// Day - Time(Period) - Duration
class DTD_manager
{
    public function get_dt_array_duration_1()
    {
        $data= $this->generate_main_array_duration(1);
        return $data;

    }
    public function get_dt_array_duration_2()
    {
        $data= $this->generate_main_array_duration(2);
        return $data;

    }
    public function get_dt_array_duration_3()
    {
        $data= $this->generate_main_array_duration(3);
        return $data;

    }

    //Get dt array from Day
    public function get_dt_array_by_day($day)
    {
        $data=array();
        $period1=array('03','04','05','06');
        $period2=array('08','09','10');
        switch($day)
        {
	    //For saturday -- Before lunch only
            case 6:
            {
                foreach($period1 as $per)
                {
                    // echo $day.$per."<br>";
                    $data[]=$day.$per;
                }

            }
                break;
	    //Days else sat
            default:
            {
                foreach($period1 as $per)
                {
                    // echo $day.$per."<br>";
                    $data[]=$day.$per;

                }
                foreach($period2 as $per)
                {
                    // echo $day.$per."<br>";
                    $data[]=$day.$per;

                }

            }
                break;


        }


        return $data;
    }

	//Generate array of possible periods
    public function generate_main_array_duration($duration)
    {
        $duration--;
        $days= array('1','2','3','4','5','6');

        $period1=array('03','04','05','06');
        $period2=array('08','09','10');

		//remove last period according to duration
        for($x=$duration;$x>0;$x--)
        {
            array_pop($period1);
            array_pop($period2);
        }

        $data=array();
        foreach($days as $day){
            switch($day)
            {
                case 6:
                {
                    foreach($period1 as $per)
                    {
                       // echo $day.$per."<br>";
                        $data[]=$day.$per;
                    }

                }
                    break;
                default:
                {
                    foreach($period1 as $per)
                    {
                       // echo $day.$per."<br>";
                        $data[]=$day.$per;

                    }
                    foreach($period2 as $per)
                    {
                       // echo $day.$per."<br>";
                        $data[]=$day.$per;

                    }

                }
                    break;


            }


        }
        //var_export($data);
        return $data;

    }


    public function get_dt_from_dtd($datas)
    {
        $result= array();
        foreach($datas as $data )
        {
            $x=intval($data);
           // var_export($data);
            $end=str_split($x,3);
            //var_export($end);
            switch($end[1])
            {
                case '1':
                    $result[]=$end[0];
                    break;
                case '2';
                    $result[]=$end[0];
                    $result[]=$end[0]+1;
                    break;
                case '3';
                    $result[]=$end[0];
                    $result[]=$end[0]+1;
                    $result[]=$end[0]+2;

            }
        }
      //  var_export($result);


        return $result;
    }

    public function get_d_from_dtd($data)
    {
        $result=array();
        foreach($data as $element)
        {
            $result[]=intval($element/1000);

        }
        //var_export($result);

        return array_unique($result);

    }

    public function get_dtd_from_dt($dt,$duration)
    {
        //var_export( $dt);
        $result= $dt.$duration;
       // var_export($result);

        return $result;
    }



}
