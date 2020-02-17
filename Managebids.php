<?php
class Managebids extends CI_Controller{	

	 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
		$this->load->helper(array('form', 'url','language'));
		$this->load->library(array('form_validation','session','encrypt','upload','email'));
		$this->load->model('Email_templates_model');
		$model=$this->load->model('Managebids_model');
		$this->load->model('System_messages_model');
		$this->load->model('Settings_model');
		$userdata=$this->session->userdata;	
		if($userdata['user_role']!='superadmin')  { redirect('Login/Logout');  }	
		if($this->session->userdata('user_id')=='') { redirect('Login/Logout');  }
		
    }
		
	function index(){ 
			$data['active_tab'] ='Managebids';
			$data['sub_tab'] ='Managebids';
			$data['form_title'] ='Manage Bids';
			
			if($_POST)
			{
				$formdata['records']=$this->Managebids_model->getstatusrecords();	
			}
			else
			{
			$formdata['records']=$this->Managebids_model->getallrecords();
			}
			$this->load->model('Asks_model');
			$formdata['Incoterm']=$this->Asks_model->getIncoterm();	
			$formdata['status']=$this->Asks_model->getstatus();
			$formdata['markets']=$this->Managebids_model->getallmrkt();	
			$formdata['products']=$this->Managebids_model->getallproducts();
			$formdata['location']=$this->Managebids_model->getlocations();			
			$this->load->view('header',$data);
			$this->load->view('Bidsmanage_list_view',$formdata);
			$this->load->view('footer');
	}
	
	function details()
	{
			$data['active_tab'] ='Managebids';
			$data['sub_tab'] ='Managebids';
			$data['form_title'] ='Bids Details';
			$formdata['bidrecord']=$this->Managebids_model->getbidrecord();
			$formdata['ngtrecord']=$this->Managebids_model->negotiaterec();
			$this->load->view('header',$data);
			$this->load->view('Managebid_detail_view',$formdata);
			$this->load->view('footer');
	}
	function approvebidmsg()
	{		
		//print_r($_REQUEST);
		$ngtid = $_REQUEST['ngtid'];
		$comment =$_REQUEST['comment'];
		$this->Managebids_model->getapprovedmsg($ngtid,$comment);
	}
	/* function approvebidmsgAdmin()
	{		
		//print_r($_REQUEST);
		$ngtid = $_REQUEST['ngtid'];
		$comment =$_REQUEST['comment'];
		$hiddenSellerId = $_REQUEST['hiddenSellerId'];
		$hiddenBuyerId =$_REQUEST['hiddenBuyerId'];
		$this->Managebids_model->approvebidmsgAdmin($ngtid,$comment, $hiddenSellerId, $hiddenBuyerId);
	} */
	function rejectmsg()
	{		
		//print_r($_REQUEST);
		$ngtid = $_REQUEST['ngtid'];
		$comment =$_REQUEST['comment'];
		$this->Managebids_model->getrejectdmsg($ngtid,$comment);
	}
	function declinemsg()
	{		
		//print_r($_REQUEST);
		$ngtid = $_REQUEST['ngtid'];
		$decline_buyer_cmt =$_REQUEST['decline_buyer_cmt'];
		$this->Managebids_model->getdeclinedmsg($ngtid,$decline_buyer_cmt);
	}
	function confirmdeal()
	{
		//print_r($_REQUEST);
		$ngtid = $_REQUEST['ngtid'];
		$bidid = $_REQUEST['bidid'];
		$comment =$_REQUEST['comment'];
		$this->Managebids_model->getconfirmdeal($ngtid,$bidid,$comment);		
	}
	function msgreadbyadmin()
	{
		$ngtid = $_REQUEST['ngtid'];
		$buyerid = $_REQUEST['buyerid'];
		$sellerid = $_REQUEST['sellerid'];
		$this->Managebids_model->getreadmsg($ngtid,$buyerid,$sellerid);
	}
	function delete($id){
				  $this->Managebids_model->delete($id);
				 $get_message=$this->System_messages_model->get_system_message('Bid_delete_success');	              
				  $message = array('message' => $get_message->message,'class' => 'alert alert-success');
				  $this->session->set_flashdata('item',$message );
					redirect('Managebids');
			}
	
}

