<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
	$conn = mysqli_connect('localhost', 'root', '', 'assesment');

	if(!$conn) {
		echo "<script>alert('Unstable Connection')</script>";
	}

	if(isset($_POST['client_registration'])) {

		$data = $_POST['Clients'];
		$interest = $data['client_client_interest'];
		$equipmentList = $data['equipment_list'];
		$rentingFile = $data['renting_file'];
		$fileTempName = $_FILES['Clients']['tmp_name']['renting_file'];
		$fileName = $_FILES['Clients']['name']['renting_file'];

		$pickupDate = $data['client_pickup_date'];
		$pickupWindow = $data['client_pickup_window'];
		$returnDate = $data['client_return_date'];
		$returnWindow = $data['client_return_window'];
		$firstName = $data['client_first_name'];
		$middleName = $data['client_middle_name'];
		$lastName = $data['client_last_name'];
		$countryCode = $data['client_country_code'];
		$phoneNumber = $data['client_tel_number'];
		$email = $data['client_email'];
		$address1 = $data['client_address_1'];
		$address2 = $data['client_address_2'];
		$city = $data['client_city'];
		$state = $data['client_state'];
		$zip = $data['client_zip'];
		$country = $data['client_country'];
		$citizenship = $data['client_citizenship'];
		$clientType = $data['client_client_type'];
		$companyName = $data['client_company_name'];
		$role = $data['client_role'];
		$website = $data['client_website'];
		$facebook = $data['client_facebook'];
		$instagram = $data['client_instagram'];
		$vimeo = $data['client_vimeo'];
		$imdb = $data['client_imdb'];

		$emergencyFirstName = $data['emergency_first_name'];
		$emergencyMiddleName = $data['emergency_middle_name'];
		$emergencyLastName = $data['emergency_last_name'];
		$emergencyEmail = $data['emergency_email'];
		$emergencyPhoneNumber = $data['emergency_phone_number'];
		$emergencyCountryCode = $data['client_emergency_country_code'];
		$contactRelation = $data['client_contact_relation'];
		$findUs = $data['client_find_us'];

		$registration = mysqli_query($conn, "INSERT INTO `client_registration`(`client_interest`, `equipment_list`, `equipment_file`, `pickup_date`, `pickup_window`, `return_date`, `return_window`, `first_name`, `middle_name`, `last_name`, `country_code`, `phone_number`, `email`, `address_1`, `address_2`, `city`, `state`, `zip`, `country`, `citizenship`, `client_type`, `company_name`, `role`,`personal_website`, `facebook`, `instagram`, `vimeo`, `imdb`, `created_at`) VALUES ('$interest', '$equipmentList', '$fileName', '$pickupDate', '$pickupWindow', '$returnDate', '$returnWindow', '$firstName', '$middleName', '$lastName', '$countryCode', '$phoneNumber', '$email', '$address1', '$address2', '$city', '$state', '$zip', '$country', '$citizenship', '$clientType', '$companyName', '$role', '$website', '$facebook', '$instagram', '$vimeo', '$imdb', NOW())");

		if($registration) {
			$clientId = mysqli_insert_id($conn);
			mkdir('./uploads/equipmentList/' . $clientId);
			$fileDestination = ('./uploads/equipmentList/' . $clientId . '/' . $fileName);

			move_uploaded_file($fileTempName, $fileDestination);

			$emergency = mysqli_query($conn, "INSERT INTO `client_emergency_contact`(`client_id`, `first_name`, `middle_name`, `last_name`, `email`, `country_code`, `phone_number`, `relation`, `find_us`, `created_at`) VALUES ('$clientId', '$emergencyFirstName', '$emergencyMiddleName', '$emergencyLastName', '$emergencyEmail', '$emergencyCountryCode',  '$emergencyPhoneNumber', '$contactRelation', '$findUs', NOW())");
			if($emergency) {
				echo "<script>
					Swal.fire(
							  'Good job!',
							  'Your Query Saved!',
							  'success'
							).then(function() {
							    window.location = 'client.php';
							});
				</script>";
			} else {
				echo "<script>
					Swal.fire(
							  'Something Wrong!',
							  'Your Query Saved!',
							  'error'
							).then(function() {
							    window.location = 'client.php';
							});
				</script>";
			}
		}
	}

?>