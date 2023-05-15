<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Ajaxdataload_model' => 'ajaxload'));
	$model = $this->admin_model;

		if(!$model->is_logged_in())
		{
			redirect('admin_login');
		}
	}

/******MANAGE BILLING / INVOICES WITH STATUS*****/
    function invoice($param1 = '', $param2 = '', $param3 = '')
    {
        

        if ($param1 == 'create') {
            $data['trainer_list_id']         = $this->input->post('trainer_list_id');
            $data['student_batch_id']         = $this->input->post('student_batch_id');
            $data['title']              = html_escape($this->input->post('title'));
            $data['amount']             = html_escape($this->input->post('amount'));
            $data['amount_paid']        = html_escape($this->input->post('amount_paid'));
            $data['due']                = $data['amount'] - $data['amount_paid'];
            $data['status']             = html_escape($this->input->post('status'));
            $data['creation_timestamp'] = strtotime($this->input->post('date'));
            

            $this->db->insert('invoice', $data);
            $invoice_id = $this->db->insert_id();

            $data2['invoice_id']        =   $invoice_id;
            $data2['trainer_list_id']        =   $this->input->post('trainer_list_id');
			$data['title']              = html_escape($this->input->post('title'));
            $data2['amount']            =   html_escape($this->input->post('amount_paid'));
            $data2['timestamp']         =   strtotime($this->input->post('date'));
            $this->db->insert('payment' , $data2);

            $this->session->set_flashdata('flash_message' , 'data_added_successfully');
            redirect(site_url('admin/teacher_payment'), 'refresh');
        }

        

        if ($param1 == 'do_update') {
            $data['trainer_list_id']         = $this->input->post('trainer_list_id');
            $data['student_batch_id']         = $this->input->post('student_batch_id');
            $data['title']              = html_escape($this->input->post('title'));
            $data['amount']             = html_escape($this->input->post('amount'));
            $data['status']             = $this->input->post('status');
            $data['creation_timestamp'] = strtotime($this->input->post('date'));

            $this->db->where('invoice_id', $param2);
            $this->db->update('invoice', $data);
            $this->session->set_flashdata('flash_message' , 'data_updated');
            redirect(site_url('admin/income'), 'refresh');
        } else if ($param1 == 'edit') {
            $page_data['edit_data'] = $this->db->get_where('invoice', array(
                'invoice_id' => $param2
            ))->result_array();
        }
        if ($param1 == 'take_payment') {
            $data['invoice_id']   =   $this->input->post('invoice_id');
            $data['trainer_list_id']   =   $this->input->post('trainer_list_id');
            $data['title']        =   html_escape($this->input->post('title'));
            $data['amount']       =   html_escape($this->input->post('amount'));
            $data['timestamp']    =   strtotime($this->input->post('timestamp'));
            $this->db->insert('payment' , $data);

            $status['status']   =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->update('invoice' , array('status' => $status['status']));

            $data2['amount_paid']   =   html_escape($this->input->post('amount'));
            $data2['status']        =   $this->input->post('status');
            $this->db->where('invoice_id' , $param2);
            $this->db->set('amount_paid', 'amount_paid + ' . $data2['amount_paid'], FALSE);
            $this->db->set('due', 'due - ' . $data2['amount_paid'], FALSE);
            $this->db->update('invoice');

            $this->session->set_flashdata('flash_message' , 'payment_successfull');
            redirect(site_url('admin/income'), 'refresh');
        }

        if ($param1 == 'delete') {
            $this->db->where('invoice_id', $param2);
            $this->db->delete('invoice');
            $this->session->set_flashdata('flash_message' , 'data_deleted');
            redirect(site_url('admin/income'), 'refresh');
        }
        //$page_data['page_name']  = 'invoice';
        //$page_data['page_title'] = get_phrase('manage_invoice/payment');
        $this->db->order_by('creation_timestamp', 'desc');
        $page_data['invoices'] = $this->db->get('invoice')->result_array();
        $this->load->view('invoice', $page_data);
    }
	
	
	
	function income($param1 = 'invoices', $param2 = '', $param3 = '') {
       

        $page_data['page_name'] = 'invoices';
        $this->load->view('admin/index', $page_data);
    }

    function get_invoices() {
        

        $columns = array(
            0 => 'invoice_id',
            1 => 'trainer_list',
            2 => 'title',
            3 => 'total',
            4 => 'paid',
            5 => 'status',
            6 => 'date',
            7 => 'options',
            8 => 'invoice_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_invoices_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {
            $invoices = $this->ajaxload->all_invoices($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $invoices =  $this->ajaxload->invoice_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->invoice_search_count($search);
        }

        $data = array();
        if(!empty($invoices)) {
            foreach ($invoices as $row) {

                if ($row->due == 0) {
                    $status = '<button class="btn btn-success btn-xs">'.'paid'.'</button>';
                    $payment_option = '';
                } else {
                    $status = '<button class="btn btn-danger btn-xs">'.'unpaid'.'</button>';
                    $payment_option = '<li><a href="#" onclick="invoice_pay_modal('.$row->invoice_id.')"><i class="entypo-bookmarks"></i>&nbsp;'.'Take payment'.'</a></li><li class="divider"></li>';
                }


                $options = '<div class="btn-group"><button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span></button><ul class="dropdown-menu dropdown-default pull-right" role="menu">'.$payment_option.'<li><a href="#" onclick="invoice_view_modal('.$row->invoice_id.')"><i class="entypo-credit-card"></i>&nbsp;'.'View invoice'.'</a></li><li class="divider"></li><li><a href="#" onclick="invoice_edit_modal('.$row->invoice_id.')"><i class="entypo-pencil"></i>&nbsp;'.'edit'.'</a></li><li class="divider"></li><li><a href="#" onclick="invoice_delete_confirm('.$row->invoice_id.')"><i class="entypo-trash"></i>&nbsp;'.'Delete'.'</a></li></ul></div>';

                $nestedData['invoice_id'] = $row->invoice_id; 
                $nestedData['trainer_list'] = $this->ajaxload->get_type_name_by_id('trainer_list',$row->trainer_list_id);
                $nestedData['title'] = $row->title;
                $nestedData['total'] = $row->amount;
                $nestedData['paid'] = $row->amount_paid;
                $nestedData['status'] = $status;
                $nestedData['date'] = date('d M,Y', $row->creation_timestamp);
                $nestedData['options'] = $options;

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function get_payments() {
        
        $columns = array(
            0 => 'payment_id',
            1 => 'title',
            2 => 'amount',
            3 => 'date',
            4 => 'options',
            5 => 'payment_id'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir   = $this->input->post('order')[0]['dir'];

        $totalData = $this->ajaxload->all_payments_count();
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value'])) {
            $payments = $this->ajaxload->all_payments($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $payments =  $this->ajaxload->payment_search($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->ajaxload->payment_search_count($search);
        }

        $data = array();
        if(!empty($payments)) {
            foreach ($payments as $row) {

                


                $options = '<a href="#" onclick="invoice_view_modal('.$row->invoice_id.')"><i class="entypo-credit-card"></i>&nbsp;'.'view_invoice'.'</a>';

                $nestedData['payment_id'] = $row->payment_id;
                $nestedData['title'] = $row->title;
                $nestedData['amount'] = $row->amount;
                $nestedData['date'] = date('d M,Y', $row->timestamp);
                $nestedData['options'] = $options;

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    function teacher_payment($param1 = '' , $param2 = '' , $param3 = '') {

      
        
        $page_data['page_title'] = 'Teacher payment';
        $this->load->view('admin/teacher_payment', $page_data);
    }
	
    }