<?php
class Managebids_model extends CI_Model
{

	var $id   = '';


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->load->database();
	}

	function getallrecords()
	{
		$this->db->select('bids.*,products.id as prdid,products.name as prdname,products.category_id,products.description,products.product_type_id,companies.company_name,currencies.symbol,incoterm.name as incoterm');
		$this->db->join('company_products', 'bids.product_id = company_products.id');
		$this->db->join('products', 'company_products.product_id = products.id');
		$this->db->join('currencies', 'bids.currency_id = currencies.id');
		$this->db->join('companies', 'bids.company_id = companies.id');
		$this->db->join('incoterm', 'bids.incoterm_id = incoterm.id');
		$this->db->where('bids.is_deleted', 0);
		$this->db->where('bids.is_active', 1);
		$this->db->order_by("bids.id", "desc");
		$query = $this->db->get('bids');
		if ($query->num_rows() != 0) {
			return $query->result_array();
		} else
			return 0;
	}
	function getstatusrecords()
	{
		$this->db->select('bids.*,products.id as prdid,products.name as prdname,products.category_id,products.description,products.product_type_id,companies.company_name,currencies.symbol,incoterm.name as incoterm');
		$this->db->join('company_products', 'bids.product_id = company_products.id');
		$this->db->join('products', 'company_products.product_id = products.id');
		$this->db->join('currencies', 'bids.currency_id = currencies.id');
		$this->db->join('companies', 'bids.company_id = companies.id');
		$this->db->join('incoterm', 'bids.incoterm_id = incoterm.id');
		$this->db->where('bids.is_deleted', 0);
		$this->db->where('bids.is_active', 1);
		if ($_POST['productid']) {
			$this->db->where('bids.product_id', $_POST['productid']);
		}
		if ($_POST['locationid']) {
			$this->db->where('bids.location_id', $_POST['locationid']);
		}
		if ($_POST['incotermid']) {
			$this->db->where('bids.incoterm_id', $_POST['incotermid']);
		}
		if ($_POST['statusid']) {
			$this->db->where('bids.bid_status_id', $_POST['statusid']);
		}
		if ($_POST['marketid']) {
			$mkt = $_POST['marketid'];
			$cnd = "`bids.market_id` IN ($mkt)";
			$this->db->where($cnd);
		}
		$this->db->order_by("bids.id", "asc");
		$query = $this->db->get('bids');
		if ($query->num_rows() != 0) {
			return $query->result_array();
		} else
			return 0;
	}
	function getallmrkt()
	{
		$this->db->select('id,name');
		$this->db->where('is_deleted', 0);
		$this->db->where('is_active', 1);
		$query = $this->db->get('markets');
		//echo $this->db->last_query();
		if ($query->num_rows() != 0) {
			return $query->result_array();
		} else
			return 0;
	}
	function negotiaterec()
	{
		$id = $this->uri->segment(3);
		$this->db->select('DISTINCT(seller_id)');
		$this->db->where('bid_id', $id);
		$query = $this->db->get('negotiations');
		if ($query->num_rows() != 0) {
			return $query->result_array();
		} else
			return 0;
	}
	function getbidrecord()
	{
		$id = $this->uri->segment(3);
		$this->db->select('bids.*,products.id as prdid,products.name as prdname,products.category_id,products.description,products.product_type_id,currencies.name as currname,currencies.symbol,packing.name as packname,locations.name as locname,incoterm.name as incoterm, c.`company_name`, u.`first_name`, u.`last_name`');
		$this->db->join('company_products', 'bids.product_id = company_products.id');
		$this->db->join('products', 'company_products.product_id = products.id');
		$this->db->join('currencies', 'bids.currency_id = currencies.id');
		$this->db->join('packing', 'bids.type_of_packing = packing.id');
		$this->db->join('locations', 'bids.location_id = locations.id');
		$this->db->join('incoterm', 'bids.incoterm_id = incoterm.id');
		$this->db->join('users as u', 'bids.created_by = u.id');
		$this->db->join('companies c', 'u.company_id = c.id');
		$this->db->where('bids.id', $id);
		$query = $this->db->get('bids');
		if ($query->num_rows() != 0) {
			return $query->result_array();
		} else
			return 0;
	}
	function edit($rec, $id)
	{
		$rec['modified_on']    = date('Y-m-d H:i:s A');
		$rec['modified_by']    = $this->session->userdata['user_id'];

		//print_r($rec);exit;
		return $this->db->update('markets', $rec, array('id' => $id));
	}
	function getapprovedmsg($ngtid, $comment)
	{
		$this->db->select('buyer_id,seller_id,created_by');
		$this->db->where('id', $ngtid);
		$query1 = $this->db->get('negotiations');
		$row = $query1->result_array();
		$byr_id = $row[0]['buyer_id'];
		$slr_id = $row[0]['seller_id'];
		$owner = $row[0]['created_by'];

		$data_update = array('is_msg_verified' => 1, 'Admin_comment' => $comment);
		$this->db->where('id', $ngtid);
		$this->db->update('negotiations', $data_update);

		if ($byr_id == $owner) {
			//email to seller to approved ngt.

			$this->db->select('first_name,email_address');
			$this->db->where('id', $slr_id);
			$query2 = $this->db->get('users');
			$row1 = $query2->result_array();
			$slr_nm = $row1[0]['first_name'];
			$slr_email = $row1[0]['email_address'];

			$to = $slr_email;
			$from = $this->Settings_model->getselected_by_label('admin_from_email');
			$fromname = $this->Settings_model->getselected_by_label('admin_from_name');
			$email_template = $this->Email_templates_model->gettemplatebyname('bid_negotiation_approved_by_admin');
			$email_subject = $email_template[0]['subject'];
			$email_body = $email_template[0]['body'];
			$email_body = str_replace('#username#', $slr_nm, $email_body);
			$this->email->set_mailtype("html");
			$this->email->from($from, $fromname);
			$this->email->to($to);
			$this->email->cc($from);
			$this->email->subject($email_subject);
			$this->email->message($email_body);
			if ($email_template[0]['attachment']) {
				$attachment = $email_template[0]['attachment'];
				$attach_path = base_url() . $attachment;
				$this->email->attach($attach_path);
			} else {
				$attachment = "";
			}
			$this->email->send();
			$emaildata = array(
				'sender_id' => '1',
				'reciever_id' => $slr_id,
				'email_subject' => trim($email_subject),
				'email_body' => trim($email_body),
				'email_attachment' => trim($attachment),
				//'admin_notification'=>'1',
				'user_notification' => '1',
				'is_deleted' => '0',
				'reading_status' => '0',
				'date_time' => date('Y-m-d H:i:s A')
			);

			$this->db->insert('email_sent', $emaildata);
		}

		if ($slr_id == $owner) {
			//email to buyer to approved ngt.

			$this->db->select('first_name,email_address');
			$this->db->where('id', $byr_id);
			$query2 = $this->db->get('users');
			$row1 = $query2->result_array();
			$byr_nm = $row1[0]['first_name'];
			$byr_email = $row1[0]['email_address'];

			$to = $byr_email;
			$from = $this->Settings_model->getselected_by_label('admin_from_email');
			$fromname = $this->Settings_model->getselected_by_label('admin_from_name');
			$email_template = $this->Email_templates_model->gettemplatebyname('bid_negotiation_approved_by_admin');
			$email_subject = $email_template[0]['subject'];
			$email_body = $email_template[0]['body'];
			$email_body = str_replace('#username#', $byr_nm, $email_body);
			$this->email->set_mailtype("html");
			$this->email->from($from, $fromname);
			$this->email->to($to);
			$this->email->cc($from);
			$this->email->subject($email_subject);
			$this->email->message($email_body);
			if ($email_template[0]['attachment']) {
				$attachment = $email_template[0]['attachment'];
				$attach_path = base_url() . $attachment;
				$this->email->attach($attach_path);
			} else {
				$attachment = "";
			}
			$this->email->send();
			$emaildata = array(
				'sender_id' => '1',
				'reciever_id' => $byr_id,
				'email_subject' => trim($email_subject),
				'email_body' => trim($email_body),
				'email_attachment' => trim($attachment),
				//'admin_notification'=>'1',
				'user_notification' => '1',
				'is_deleted' => '0',
				'reading_status' => '0',
				'date_time' => date('Y-m-d H:i:s A')
			);

			$this->db->insert('email_sent', $emaildata);
		}

		return true;
	}
	/*function approvebidmsgAdmin($ngtid, $comment, $hiddenSellerId, $hiddenBuyerId) 
	{
		print_r($hiddenSellerId); die;
		$this->db->select('*');
		$this->db->where('id',$ngtid);
	    $query1 = $this->db->get('negotiations');
		$row = $query1->result_array();
		$slr_id = $row[0]['seller_id'];
		$byr_id = $row[0]['buyer_id'];
		$alt_Seller_email_arr = [];
		if ($row[0]['alt_email1']) {
			$alt_Seller_email_arr[] = $row[0]['alt_email1'];
		}
		if ($row[0]['alt_email2']) {
			$alt_Seller_email_arr[] = $row[0]['alt_email2'];
		}
		if ($row[0]['alt_email3']) {
			$alt_Seller_email_arr[] = $row[0]['alt_email3'];
		}
		if ($row[0]['alt_email4']) {
			$alt_Seller_email_arr[] =$row[0]['alt_email4'];
		}
		if ($row[0]['alt_email5']) {
			$alt_Seller_email_arr[] = $row[0]['alt_email5'];
		}

		$allAltSeller = implode(',', $alt_Seller_email_arr);
		
		$this->db->select('*');
		$this->db->where('id',$slr_id);
	    $query2 = $this->db->get('users');
		$row1 = $query2->result_array();
		$slr_nm = $row1[0]['first_name'];
		$slr_email = $row1[0]['email_address'];		
		
		$data_update = array('is_msg_verified'=>1,'Admin_comment'=>$comment );
        $this->db->where('id', $ngtid);
		//$this->db->update('negotiations', $data_update); 
		
		
		//email to buyer when negotiontion approved by admin
		if($hiddenBuyerId > 0){
			$this->db->select('*');
			$this->db->where('id',$hiddenBuyerId);
			$query2 = $this->db->get('users');
			$row1 = $query2->result_array();
			$byr_nm = $row1[0]['first_name'];
			$byr_email = $row1[0]['email_address'];	

			$alt_email_arr = [];
		if ($row1[0]['alt_email1']) {
			$alt_email_arr[] = $row1[0]['alt_email1'];
		}
		if ($row1[0]['alt_email2']) {
			$alt_email_arr[] = $row1[0]['alt_email2'];
		}
		if ($row1[0]['alt_email3']) {
			$alt_email_arr[] = $row1[0]['alt_email3'];
		}
		if ($row1[0]['alt_email4']) {
			$alt_email_arr[] =$row1[0]['alt_email4'];
		}
		if ($row1[0]['alt_email5']) {
			$alt_email_arr[] = $row1[0]['alt_email5'];
		}

		$allAlt = implode(',', $alt_email_arr);

				$to = $byr_email;
				$from=$this->Settings_model->getselected_by_label('admin_from_email');
				$fromname =$this->Settings_model->getselected_by_label('admin_from_name');
				//$email_template = $this->Email_templates_model->gettemplatebyname('offer_negotiation_approved_by_admin');
				$email_subject = 'You have a Negotiation on Your Bid';
				$email_body = sprintf('<p>Dear %s,</p>

				<p>&nbsp;</p>
				<p>Your Counter party has negotiated on your bid.</p>
				<p>Please review Negotiations placed by Seller.</p>
				
				<p>&nbsp;</p>
				
				<p>Regards,</p>
				
				<p>TRADERSpower PTE LTD</p>
				
				<p><img alt="" src="http://tradersbiomass.com/wp-content/uploads/2017/10/TB-Logo-for-mails.png" style="height:48px; width:177px" /></p>
				', $byr_nm );				
				$this->email->set_mailtype("html");
				$this->email->from($from, $fromname);
				$this->email->to($to); 
				$this->email->cc($allAlt);
				$this->email->bcc($from, $fromname);
				$this->email->subject($email_subject);
				$this->email->message($email_body);
					
				$this->email->send();
				
				$emaildata = array(
                'sender_id'=> '1',
                'reciever_id'=> $hiddenBuyerId,
                'email_subject'=> trim($email_subject),
                'email_body'=> trim($email_body),
                'email_attachment'=> '',
				'admin_notification'=>'1',
                'is_deleted'=> '0',
                'reading_status'=> '0',
                'date_time'=>date('Y-m-d H:i:s A')
                );
				
				$this->db->insert('email_sent', $emaildata);

				//email to seller for approval of negotiation 
				$to=$slr_email;
				$from=$this->Settings_model->getselected_by_label('admin_from_email');
				$fromname =$this->Settings_model->getselected_by_label('admin_from_name');
				
				$email_subject = 'Negotiation is approved!';
				$email_body = sprintf('<p>Dear %s,</p>

				<p>&nbsp;</p>
				<p>Your negotiation is approved by admin</p>
				<p>Enjoy Trading.</p>
				
				<p>&nbsp;</p>
				
				<p>Regards,</p>
				
				<p>TRADERSpower PTE LTD</p>
				
				<p><img alt="" src="http://tradersbiomass.com/wp-content/uploads/2017/10/TB-Logo-for-mails.png" style="height:48px; width:177px" /></p>
				', $slr_nm );			
				$this->email->set_mailtype("html");
				$this->email->from($from, $fromname);
				$this->email->to($to); 
				$this->email->cc($allAltSeller);
				$this->email->bcc($from, $fromname);
				$this->email->subject($email_subject);
				$this->email->message($email_body);
				
				$this->email->send();
				
				$emaildata = array(
                'sender_id'=> '1',
                'reciever_id'=> $slr_id,
                'email_subject'=> trim($email_subject),
                'email_body'=> trim($email_body),
                'email_attachment'=> '',
				'admin_notification'=>'1',
                'is_deleted'=> '0',
                'reading_status'=> '0',
                'date_time'=>date('Y-m-d H:i:s A')
                );
				
				$this->db->insert('email_sent', $emaildata);
		}
		else {
			
			$this->db->select('*');
			$this->db->where('id',$hiddenSellerId);
			$query21 = $this->db->get('users');
			$row12 = $query21->result_array();
			$slr_nm = $row12[0]['first_name'];
			$slr_email = $row12[0]['email_address'];	

			$alt_email_arr2 = [];
			if ($row12[0]['alt_email1']) {
				$alt_email_arr2[] = $row12[0]['alt_email1'];
			}
			if ($row12[0]['alt_email2']) {
				$alt_email_arr2[] = $row12[0]['alt_email2'];
			}
			if ($row12[0]['alt_email3']) {
				$alt_email_arr2[] = $row12[0]['alt_email3'];
			}
			if ($row12[0]['alt_email4']) {
				$alt_email_arr2[] =$row12[0]['alt_email4'];
			}
			if ($row12[0]['alt_email5']) {
				$alt_email_arr2[] = $row12[0]['alt_email5'];
			}

		$allAlt = implode(',', $alt_email_arr2);

				$to = $byr_email;
				$from=$this->Settings_model->getselected_by_label('admin_from_email');
				$fromname =$this->Settings_model->getselected_by_label('admin_from_name');
				//$email_template = $this->Email_templates_model->gettemplatebyname('offer_negotiation_approved_by_admin');
				$email_subject = 'You have a Negotiation on Your Bid';
				$email_body = sprintf('<p>Dear %s,</p>

				<p>&nbsp;</p>
				<p>Buyer has posted Negotiation.</p>
				<p>Please review Negotiations placed by Buyer.</p>
				
				<p>&nbsp;</p>
				
				<p>Regards,</p>
				
				<p>TRADERSpower PTE LTD</p>
				
				<p><img alt="" src="http://tradersbiomass.com/wp-content/uploads/2017/10/TB-Logo-for-mails.png" style="height:48px; width:177px" /></p>
				', $slr_nm );				
				$this->email->set_mailtype("html");
				$this->email->from($from, $fromname);
				$this->email->to($to); 
				$this->email->cc($allAlt);
				$this->email->bcc($from, $fromname);
				$this->email->subject($email_subject);
				$this->email->message($email_body);
					
				$this->email->send();
				
				$emaildata = array(
                'sender_id'=> '1',
                'reciever_id'=> $hiddenSellerId,
                'email_subject'=> trim($email_subject),
                'email_body'=> trim($email_body),
                'email_attachment'=> '',
				'admin_notification'=>'1',
                'is_deleted'=> '0',
                'reading_status'=> '0',
                'date_time'=>date('Y-m-d H:i:s A')
                );
				
				$this->db->insert('email_sent', $emaildata);

				$to=$slr_email;
				$from=$this->Settings_model->getselected_by_label('admin_from_email');
				$fromname =$this->Settings_model->getselected_by_label('admin_from_name');
				
				$email_subject = 'Negotiation is approved!';
				$email_body = sprintf('<p>Dear %s,</p>

				<p>&nbsp;</p>
				<p>Your negotiation is approved by admin</p>
				<p>Enjoy Trading.</p>
				
				<p>&nbsp;</p>
				
				<p>Regards,</p>
				
				<p>TRADERSpower PTE LTD</p>
				
				<p><img alt="" src="http://tradersbiomass.com/wp-content/uploads/2017/10/TB-Logo-for-mails.png" style="height:48px; width:177px" /></p>
				', $byr_nm );			
				$this->email->set_mailtype("html");
				$this->email->from($from, $fromname);
				$this->email->to($to); 
				$this->email->cc($allAltSeller);
				$this->email->bcc($from, $fromname);
				$this->email->subject($email_subject);
				$this->email->message($email_body);
				
				$this->email->send();
				
				$emaildata = array(
                'sender_id'=> '1',
                'reciever_id'=> $byr_id,
                'email_subject'=> trim($email_subject),
                'email_body'=> trim($email_body),
                'email_attachment'=> '',
				'admin_notification'=>'1',
                'is_deleted'=> '0',
                'reading_status'=> '0',
                'date_time'=>date('Y-m-d H:i:s A')
                );
				
				$this->db->insert('email_sent', $emaildata);

		}



				$to=$slr_email;
				$from=$this->Settings_model->getselected_by_label('admin_from_email');
				$fromname =$this->Settings_model->getselected_by_label('admin_from_name');
				$email_template = $this->Email_templates_model->gettemplatebyname('offer_negotiation_approved_by_admin');
				$email_subject = $email_template[0]['subject'];
				$email_body = $email_template[0]['body'];
				$email_body = str_replace('#username#',$slr_nm,$email_body);				
				$this->email->set_mailtype("html");
				$this->email->from($from, $fromname);
				$this->email->to($to); 
				$this->email->cc($allAlt);
				$this->email->bcc($from, $fromname);
				$this->email->subject($email_subject);
				$this->email->message($email_body);
					if($email_template[0]['attachment'])
					{
						$attachment = $email_template[0]['attachment'];
						$attach_path = base_url().$attachment;
						$this->email->attach($attach_path);
					}
					else
					{
						$attachment="";
					}
				$this->email->send();
				
				$emaildata = array(
                'sender_id'=> '1',
                'reciever_id'=> $slr_id,
                'email_subject'=> trim($email_subject),
                'email_body'=> trim($email_body),
                'email_attachment'=> trim($attachment),
				'admin_notification'=>'1',
                'is_deleted'=> '0',
                'reading_status'=> '0',
                'date_time'=>date('Y-m-d H:i:s A')
                );
				
				$this->db->insert('email_sent', $emaildata); 
				
        return true;	
	
	} */ 
	function getrejectdmsg($ngtid, $comment)
	{

		$data_update = array('is_reject' => 1, 'Admin_comment' => $comment);
		$this->db->where('id', $ngtid);
		$this->db->update('negotiations', $data_update);


		$this->db->select('created_by');
		$this->db->where('id', $ngtid);
		$query1 = $this->db->get('negotiations');
		$row = $query1->result_array();
		$owner_id = $row[0]['created_by'];

		$this->db->select('*');
		$this->db->where('id', $owner_id);
		$query2 = $this->db->get('users');
		$row1 = $query2->result_array();
		$slr_nm = $row1[0]['first_name'];
		$slr_email = $row1[0]['email_address'];

		/*email to dealowner when negotiontion is rejected by admin*/
		$alt_email_arr = [];
		if ($row1[0]['alt_email1']) {
			$alt_email_arr[] = $row1[0]['alt_email1'];
		}
		if ($row1[0]['alt_email2']) {
			$alt_email_arr[] = $row1[0]['alt_email2'];
		}
		if ($row1[0]['alt_email3']) {
			$alt_email_arr[] = $row1[0]['alt_email3'];
		}
		if ($row1[0]['alt_email4']) {
			$alt_email_arr[] =$row1[0]['alt_email4'];
		}
		if ($row1[0]['alt_email5']) {
			$alt_email_arr[] = $row1[0]['alt_email5'];
		}

		$allAlt = implode(',', $alt_email_arr);
		$to = $slr_email;
		$to_name = $slr_email;
		$from = $this->Settings_model->getselected_by_label('admin_from_email');
		$fromname = $this->Settings_model->getselected_by_label('admin_from_name');
		$email_template = $this->Email_templates_model->gettemplatebyname('negotiation_rejected_by_admin');
		$email_subject = $email_template[0]['subject'];
		$email_body = $email_template[0]['body'];
		$email_body = str_replace('#username#', $slr_nm, $email_body);
		$this->email->set_mailtype("html");
		$this->email->from($from, $fromname);
		$this->email->to($to, $to_name);
		$this->email->cc($allAlt); //We raise mail in cc
		$this->email->bcc($from, $fromname);
		$this->email->subject($email_subject);
		$this->email->message($email_body);
		if ($email_template[0]['attachment']) {
			$attachment = $email_template[0]['attachment'];
			$attach_path = base_url() . $attachment;
			$this->email->attach($attach_path);
		} else {
			$attachment = "";
		}
		$this->email->send();

		$emaildata = array(
			'sender_id' => '1',
			'reciever_id' => $owner_id,
			'email_subject' => trim($email_subject),
			'email_body' => trim($email_body),
			'email_attachment' => trim($attachment),
			'admin_notification' => '1',
			'is_deleted' => '0',
			'reading_status' => '0',
			'date_time' => date('Y-m-d H:i:s A')
		);
		$this->db->insert('email_sent', $emaildata);

		return true;
	}
	function getdeclinedmsg($ngtid, $decline_buyer_cmt)
	{

		$data_update = array('is_reject' => 1, 'Admin_comment' => $comment);
		$this->db->where('id', $ngtid);
		$this->db->update('negotiations', $data_update);


		$this->db->select('created_by');
		$this->db->where('id', $ngtid);
		$query1 = $this->db->get('negotiations');
		$row = $query1->result_array();
		$owner_id = $row[0]['created_by'];

		$this->db->select('*');
		$this->db->where('id', $owner_id);
		$query2 = $this->db->get('users');
		$row1 = $query2->result_array();
		$slr_nm = $row1[0]['first_name'];
		$slr_email = $row1[0]['email_address'];

		/*email to dealowner when negotiontion is rejected by admin*/
		$alt_email_arr = [];
		if ($row1[0]['alt_email1']) {
			$alt_email_arr[] = $row1[0]['alt_email1'];
		}
		if ($row1[0]['alt_email2']) {
			$alt_email_arr[] = $row1[0]['alt_email2'];
		}
		if ($row1[0]['alt_email3']) {
			$alt_email_arr[] = $row1[0]['alt_email3'];
		}
		if ($row1[0]['alt_email4']) {
			$alt_email_arr[] =$row1[0]['alt_email4'];
		}
		if ($row1[0]['alt_email5']) {
			$alt_email_arr[] = $row1[0]['alt_email5'];
		}

		$allAlt = implode(',', $alt_email_arr);
		$to = $slr_email;
		$to_name = $slr_email;
		$from = $this->Settings_model->getselected_by_label('admin_from_email');
		$fromname = $this->Settings_model->getselected_by_label('admin_from_name');
		$email_template = $this->Email_templates_model->gettemplatebyname('negotiation_rejected_by_admin');
		$email_subject = $email_template[0]['subject'];
		$email_body = $email_template[0]['body'];
		$email_body = str_replace('#username#', $slr_nm, $email_body);
		$this->email->set_mailtype("html");
		$this->email->from($from, $fromname);
		$this->email->to($to, $to_name);
		$this->email->cc($allAlt); //We raise mail in cc
		$this->email->bcc($from, $fromname);
		$this->email->subject($email_subject);
		$this->email->message($email_body);
		if ($email_template[0]['attachment']) {
			$attachment = $email_template[0]['attachment'];
			$attach_path = base_url() . $attachment;
			$this->email->attach($attach_path);
		} else {
			$attachment = "";
		}
		$this->email->send();

		$emaildata = array(
			'sender_id' => '1',
			'reciever_id' => $owner_id,
			'email_subject' => trim($email_subject),
			'email_body' => trim($email_body),
			'email_attachment' => trim($attachment),
			'admin_notification' => '1',
			'is_deleted' => '0',
			'reading_status' => '0',
			'date_time' => date('Y-m-d H:i:s A')
		);
		$this->db->insert('email_sent', $emaildata);

		return true;
	}
	function getconfirmdeal($ngtid, $bidid, $comment)
	{
		$userdata = $this->session->userdata;
		$uid = $userdata['user_id'];

		$data_update = array('is_admin_confirm' => 1, 'is_msg_verified' => 1, 'Admin_comment' => $comment);
		$this->db->where('id', $ngtid);
		$this->db->update('negotiations', $data_update);

		$this->db->select('buyer_id');
		$this->db->where('id', $ngtid);
		$query1 = $this->db->get('negotiations');
		$row = $query1->result_array();
		$buyer_id = $row[0]['buyer_id'];

		$this->db->select('first_name,email_address');
		$this->db->where('id', $buyer_id);
		$query2 = $this->db->get('users');
		$row1 = $query2->result_array();
		$buyer_name = $row1[0]['first_name'];
		$buyer_email = $row1[0]['email_address'];

		$to = $buyer_email;
		$from = $this->Settings_model->getselected_by_label('admin_from_email');
		$email_template = $this->Email_templates_model->gettemplatebyname('bid_confirm_approved_by_admin');
		$fromname = $this->Settings_model->getselected_by_label('admin_from_name');
		$email_subject = $email_template[0]['subject'];
		$email_body = $email_template[0]['body'];
		$email_body = str_replace('#username#', $buyer_name, $email_body);
		$this->email->set_mailtype("html");
		$this->email->from($from, $fromname);
		$this->email->to($to, $to_name);
		$this->email->subject($email_subject);
		$this->email->message($email_body);
		if ($email_template[0]['attachment']) {
			$attachment = $email_template[0]['attachment'];
			$attach_path = base_url() . $attachment;
			$this->email->attach($attach_path);
		} else {
			$attachment = "";
		}
		$this->email->send();

		$emaildata = array(
			'sender_id' => $buyer_id,
			'reciever_id' => '1',
			'email_subject' => trim($email_subject),
			'email_body' => trim($email_body),
			'email_attachment' => trim($attachment),
			'admin_notification' => '1',
			'is_deleted' => '0',
			'reading_status' => '0',
			'date_time' => date('Y-m-d H:i:s A')
		);

		$this->db->insert('email_sent', $emaildata);


		return true;
	}

	function getreadmsg($ngtid, $buyerid, $sellerid)
	{
		$dataupdate = array('is_read_by_admin' => 1);
		$this->db->where('bid_id', $ngtid);
		$this->db->where('buyer_id', $buyerid);
		$this->db->where('seller_id', $sellerid);
		$this->db->update('negotiations', $dataupdate);
		//echo $this->db->last_query();				
	}
	function delete($id)
	{
		$data_update = array('is_deleted' => 1, 'is_active' => 0);
		$this->db->where('id', $id);
		$this->db->update('bids', $data_update);
		return true;
	}
	function getallproducts()
	{

		$this->db->select('DISTINCT(products.id)');
		$this->db->join('products', 'products.id = company_products.product_id');
		$this->db->where('company_products.is_approved', 1);
		$this->db->where('company_products.is_deleted', 0);
		$this->db->where('company_products.is_active', 1);
		$query = $this->db->get('company_products');
		$Rec = $query->result_array();
		return $Rec;
	}
	function getlocations()
	{
		$this->db->select('locations.id,locations.location,locations.name');
		//$this->db->join('locations','locations.id = company_locations.location_id');
		$this->db->where('is_deleted', 0);
		$this->db->where('is_active', 1);
		$query = $this->db->get('locations');
		if ($query->num_rows() != 0) {
			return $query->result_array();
		} else
			return 0;
	}
}
