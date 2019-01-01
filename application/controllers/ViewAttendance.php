<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ViewAttendance extends CI_Controller {

	public function __construct() {
	parent::__construct();

	}
	public function index($data)
	{
		$headdata = array('domain_name' => "Attendance System");
		$this->load->view('header',$headdata);
		$this->load->view('viewAttendancePanel',$data);
		$this->load->view('footer');
	}

	public function generateTable()
	{

		$data = array(
		'ClassId' => $this->input->post('classdetail'),
		'SubjectId' => $this->input->post('subjectdetail'),	
		'Batch' => $this->input->post('batch'),
		'limit' => $this->input->post('limit'),
		'FacultyId' => $this->session->userdata('userid')
		);
		$this->session->set_userdata('batch',$data['Batch']);
		$session="";

		$scheduleId = $this->Save_attendance_model->scheduleId($data); 
		$scheduleId = $scheduleId[0]->id;
		if(is_int($scheduleId))
			$this->session->set_userdata('scheduleId',$scheduleId);
		$dates = $this->View_attendance_model->scheduleTable($data);

		foreach ($dates as $date) {
			$lecture_no = $date->last_lecture_no;
			for($i=1;$i<=$lecture_no;$i++){    
					$l='l'.$i;  
           		    $dl=$date->$l;
          		    $sdate[$l]=$dl;
          		}
                asort($sdate);
                $session = substr($dl,0,4);

                $relative = $this->input->post('relative');
                if(($relative==1))	{   
             		$date_val=$_POST['date1'];
              		$date_val = array_search($date_val, array_keys($sdate));
              		$start=$date_val;
              	}
      			else{
      			$start=0;
      			}

      			if($data['limit'] > 0 && $data['limit'] <= $lecture_no){ 
          			$lecture_no = $limit+$start;
             	}

             	$total_present = array(); 
				foreach ($sdate as $key => $value) {
					$count = $this->View_attendance_model->studentCount($key,$scheduleId);
					foreach ($count as $pno) {
						 array_push($total_present, $pno->presentNo);
					}
				}
				//print_r($total_present);
		}

		$col = ""; 	$str_count = 0;	$datestring = "";

		foreach ($sdate as $key => $value) {
			 if ($str_count >= $start && $str_count<=$lecture_no){
			 	$col.="attendance_table.".$key.",";
			 	$dl=substr($value,8,2)."-".substr($value,5,2);
			 	//print_r($total_present);	print_r($key);var_dump();
          		$datestring.='<td>'.$dl.'<br><b>('.$total_present[$str_count].')</b><div class="radio"><input type="radio" id="date" name="date1" value='.$key.'></div></td>';
			 }
			 $str_count++; 
		}
		$str_count++; 

 		$col = substr($col,0,strlen($col)-1);
 		$studentList = $this->View_attendance_model->studentList($data,$col);
		$list="";
		foreach ($studentList as  $student) {
			foreach ($sdate as $key => $value) {
				if(	$student->$key == 1	)
                	{ $student->$key = 'P'; }
            	elseif( $student->$key == 0 )
                	{ $student->$key ='A' ; }
			}

			if( $student->present_no == null ){
				$n=1;
                $m=0;
			}
			else $m=$lecture_no;

			if($this->input->post('relative')==1)
			{	$divider=$lecture_no-$start+1;	}
            else
            {  	$divider=$lecture_no;	}

        	$num="";$count=0;$str_count=0;

        	foreach($sdate as $key => $value) {                             
			     if ($str_count >= $start && $str_count<=$lecture_no){
			 		$num.='<td id="status">'.$student->$key.'</td>';
			        if($student->$key=="P")
			            $count++;
			        }
			      $str_count++;  
			    } $str_count++;
			
			$student->present_no = $count;
			$count = 0;
          	$list.='<tr>
          	<td>'.$student->roll_no.'</td>
          	<td>'.$student->name.'</td>'.$num
          	.' <td>'.$student->present_no.'</td>
            <td>'.(int)($student->present_no*100/$divider).'%</td>
        	</tr>';

			}

        	$data=array('session' => $session,
        				'date' => $datestring,
        				'list' => $list,
        				'schedule' => $scheduleId,
        				'divider' => $divider,
        				'batch' => $data['Batch'],
        				'class'	=> $data['ClassId'],
        				'subject' => $data['SubjectId']
        	 ); 
        	$this->index($data);
	}

}
