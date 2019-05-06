<?php 
$curl = curl_init();
		$postF = array (
			'consignments' => array (
		    array (
		      'customer_code' => DTDC_CUSTOMER_CODE,
		      'reference_number' => 'D42688401',
		      'service_type_id' => DTDC_SERVICE_TPYE,
		      'load_type' => 'DOCUMENT',
		      'description' => $product->name,
		      'dimension_unit' => '',
		      'length' => '',
		      'width' => '',
		      'height' => '',
		      'weight_unit' => 'kg',
		      'weight' => '0.25',
		      'declared_value' => '',
		      'cod_amount' => '0',
		      'num_pieces' => '1',
		      'customer_reference_number' => 'XF878723',
		      'origin_details' => array (
		      	'name' => DTDC_NAME,
		        'phone' => DTDC_PHONE,
		        'alternate_phone' => DTDC_PHONE_2,
		        'address_line_1' => DTDC_ADDS,
		        'address_line_2' => DTDC_ADDS_2,
		        'pincode' => DTDC_PINCODE,
		        'city' => DTDC_CITY,
		        'state' => DTDC_STATE,
		      ),
		      'destination_details' => array (
		        'name' => $param['order']['delivery_name'],
		        'phone' => $param['order']['delivery_tel'],
		        'alternate_phone' => $param['order']['delivery_tel'],
		        'address_line_1' => $param['order']['delivery_address'],
		        'address_line_2' => '',
		        'pincode' => $param['order']['delivery_zip'],
		        'city' => $param['order']['delivery_city'],
		        'state' => $param['order']['delivery_state'],
		      ),
		    ),
		  ),
		);
		$postF = json_encode($postF);
		curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://demodashboard.shipsy.in:3001/api/customer/integration/consignment/softdata',
			CURLOPT_RETURNTRANSFER => TRUE,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $postF,
			CURLOPT_HTTPHEADER => array(
				'Authorization:	Basic aGltZ3VwOg==',
				'Postman-Token:	c096d7ba-830d-440a-9de4-10425e62e52f',
				'api-key:	35d3a8385a151e0d70eb2d4bb0dc65',
				'cache-control:	no-cache',
				'customerId:	GL112',
				'Content-Type: application/json',
				'organisation-id:	1'
			)
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if($err){
			pre($err);
		}else{
			$res = json_decode($response);
			$ref_num = $res->data[0]->reference_number;
			$this->db->update('tbl_orders',array(
				'c_tracking_id'	=>	$ref_num,
				'c_type'				=>	'dtdc'
			),array(
				'o_id'	=>	$param['last_id']
			));
			$this->send_mail($param['order'],$ref_num);
			return $ref_num;
		}
?>
