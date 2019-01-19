<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ViewAttendance extends CI_Controller {

	public function __construct() {
	parent::__construct();

	}
	public function index()
	{
		
	}

	public function generateTable()
	{
		if($this->session->userdata('userid')) {
			$data = array(
			'ClassId' => $this->input->post('classdetail'),
			'SubjectId' => $this->input->post('subjectdetail'),	
			'Batch' => $this->input->post('batch'),
			'limit' => isset($_POST['limit'])?$this->input->post('limit'):-1,
			'FacultyId' => $this->session->userdata('userid')
			);
			$this->session->set_userdata('batch',$data['Batch']);
			$session="";

			$scheduleId = $this->Attendance_panel_model->scheduleId($data);// print_r($scheduleId);
			$scheduleId = $scheduleId[0]->id;
			$this->session->set_userdata('scheduleId',$scheduleId);
			$dates = $this->View_attendance_model->scheduleTable($data);// print_r($dates[0]);

			$lecture_no = $dates[0]->last_lecture_no;
			if($lecture_no > 0) {
				for($i=1;$i<=$lecture_no;$i++){    
						$l='l'.$i; 
	          		    $sdate[$l]=$dates[0]->$l;
	          		}
	                asort($sdate);
	                $session = substr($dates[0]->last_lecture_date,0,4);

	                if(isset($_POST['relative']) && isset($_POST['dateEdit']) && $_POST['relative']==1)	{   
	             		$date_val=$_POST['dateEdit'];
	              		$date_val = array_search($date_val, array_keys($sdate));
	              		$start=$date_val;
	              	}
	      			else{
	      			$start=0;
	      			}

	      			if($data['limit'] > 0 && $data['limit'] <= $lecture_no){ 
	          			$lecture_no = $data['limit']+$start-1;
	             	}

	             	$total_present = array(); 
					foreach ($sdate as $key => $value) {
						$count = $this->View_attendance_model->studentCount($key,$scheduleId);// print_r($count);
						foreach ($count as $pno) {
							 array_push($total_present, $pno->presentNo);
						}
					}
					//print_r($total_present);

				$col = ""; 	$str_count = 0;	$datestring = "";

				foreach ($sdate as $key => $value) {
					 if ($str_count >= $start && $str_count<=$lecture_no){
					 	$col.="attendance_table.".$key.",";
					 	$dl=substr($value,8,2)."-".substr($value,5,2);
					 	//print_r($total_present);	print_r($key);var_dump();
		          		$datestring.='<td>'.$dl.'<br><b>('.$total_present[$str_count].')
		          		</b><div class="radio"><input type="radio" id="date" name="dateEdit" value='.$key.'></div></td>';
					 }
					 $str_count++; 
				}
				$str_count++; 

		 		$col = substr($col,0,strlen($col)-1);
		 		$studentList = $this->View_attendance_model->studentList($data,$col);// print_r($studentList);
				$list="";
				foreach ($studentList as  $student) {
					foreach ($sdate as $key => $value) {
						if(isset($student->$key) && $student->$key == 1	)
		                	{ $student->$key = 'P'; }
		            	elseif(isset($student->$key) && $student->$key == 0 )
		                	{ $student->$key ='A' ; }
					}

					/*if( $student->present_no == null )
		                $m=0;
					
					else $m=$lecture_no;*/

					if(isset($_POST['relative']) && isset($_POST['dateEdit']) && $_POST['relative']==1)
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
		          	$list.='<tr>
		          	<td>'.$student->roll_no.'</td>
		          	<td>'.$student->name.'</td>'.$num
		          	.' <td>'.$student->present_no.'</td>
		            <td>'.(int)($student->present_no*100/$divider).'%</td>
		        	</tr>';

					}

				$class = $this->View_attendance_model->getClass($data['ClassId']);
				$cls = (array)$class[0];
				$course=$cls['course'];
				$branch=$cls['branch'];
				$yr=$cls['year'];
				$section=$cls['section'];
				$nm = $course.'-'.$branch.'-'.$yr.'-Year-'.$section;
		        $data=array('session' => $session,
			        		'date' => $datestring,
		        			'list' => $list,
			        		'schedule' => $scheduleId,
			       			'divider' => $divider,
			       			'batch' => $data['Batch'],
			   				'class'	=> $data['ClassId'],
		     				'subject' => $data['SubjectId'],
		     				'excel_title' => $nm
			       	 );
			    $table =  $this->load->view('view_table',$data,true);
		        if(isset($_POST['relative']) && $_POST['relative']==1) {
		        	$arr = array('div' => $divider,
		        				'table' => $table);
		        	echo json_encode($arr); 
		        }
		        else{
		        	$page = array('table' => $table);
			        $headdata = array('domain_name' => "Attendance System");
					$this->load->view('header',$headdata);
					$this->load->view('viewAttendancePanel',$page);
				}
			} else {
				$page = array('list' => '');
		        $headdata = array('domain_name' => "Attendance System");
				$this->load->view('header',$headdata);
				$this->load->view('viewAttendancePanel',$page);
			}
		} else
			$this->load->view('index');
		$this->load->view('footer');
	}

	public function generate_report() {
		$schedule = $this->View_attendance_model->getSchedule($this->input->post('schedule_id'));
		$class = $this->View_attendance_model->getClass($schedule[0]->class_id);
		$name = $this->View_attendance_model->getFaculty($schedule[0]->class_id,$schedule[0]->subject_id);
		$subject = $this->View_attendance_model->getSubject($schedule[0]->subject_id);

		$sch = (array)$schedule[0];
		asort($sch);
		$i=1;
		$cols = '';
		foreach($sch as $key=>$value) {
			if($value == null || $key == 'id' || $key == 'class_id' || $key == 'subject_id' || $key == 'batch' || $key == 'last_lecture_no' || $key == 'last_lecture_date') 
				continue;
			$sh['l'.$i] = $value;
			$cols .= $key." as 'l".$i."',";
			$i++;
		}
		$attendance = $this->View_attendance_model->getAttendance($schedule[0]->id,$schedule[0]->class_id,$cols);

		$data = array('schedule' => $sch,
					'class' => (array)$class[0],
					'name' => (array)$name[0],
					'subject' => (array)$subject[0],
					'attendance' => $attendance,
					'sh' => $sh);
		$this->load->helper('generate_pdf');
		$pdf = new PDF;
		$output = $pdf->getPdf($data);

		$cls = $data['class'];
		$course=$cls['course'];
		$branch=$cls['branch'];
		$yr=$cls['year'];
		$section=$cls['section'];
		$nm = $course.$branch.$yr.'-Year'.$section.'.pdf';
		$loc = '/var/www/html/attendance.mvc/reports/'.$nm;
		$file = fopen($loc, 'w');
		fwrite($file, $output);
		fclose($file);

		echo $nm;
	}

	public function delete_report() {
		$name = '/var/www/html/attendance.mvc/reports/'.$this->input->post('name');
		unlink($name);
	}

}
