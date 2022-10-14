
$(document).ready(function() {
	var button, data, response;

	$("#processBtn").click(function() {
		
		button = $("#processBtn");
		response = $("#response");
		
		var data = {
				  fundwallet: "fundwallet",
				  amount: $("#amount").val(),
				  txID: $("#txID").val()
				  
				};
		
		$.ajax({
			
			url: "../process.php",
			type: "post",
			data: data,			
			beforeSend: function(){
				button.html("Processing <i class='fa fa-spinner fa-spin'></i>");
				button.prop('disabled', true);
			},
			success: function(result) {
				
				if($.trim(result) == "sent") {
					response.html("<div class='alert alert-success'><div class='alert-message' style='font-size: 22px'>Your transaction is in progress, your wallet will be credited soon</div></div>");
					button.html("<i class='fa fa-credit-card'></i> Process Payment");
					button.prop('disabled', true);
					setTimeout(function() {
						window.location = "fundwallet";
					}, 7000);
				} else if($.trim(result) == "greater") {
					response.html("<div class='alert alert-danger'><div class='alert-message' style='font-size: 22px'><b>Error : </b> Insufficient wallet balance</div></div>");
					button.html("<i class='fa fa-credit-card'></i> Process Payment");
					button.prop('disabled', false);
				} else if($.trim(result) == "connection_problem") {
					response.html("<div class='alert alert-danger'><div class='alert-message' style='font-size: 22px'><b>Error : </b> We are unable to process your request at the moment, please try again later</div></div>");
					button.html("<i class='fa fa-credit-card'></i> Process Payment");
					button.prop('disabled', false);
				} else if($.trim(result) == "invalid") {
					response.html("<div class='alert alert-danger'><div class='alert-message' style='font-size: 22px'><b>Error : </b> We couldn't process your transaction due to an invalid merchant address or wallet address provided</div></div>");
					button.html("<i class='fa fa-credit-card'></i> Process Payment");
					button.prop('disabled', false);
				} else {
					response.html("<div class='alert alert-danger'><div class='alert-message' style='font-size: 22px'>"+result+"</div></div>").addClass("alert alert-danger");
					button.html("<i class='fa fa-credit-card'></i> Process Payment");
					button.prop('disabled', false);
				}
				
			}
			
		});
		
	});
	
	//Save settings...
	$("#updtSettings").click(function(e) {
		e.preventDefault();
		
		if($("#defPlan").val().length == 0 || $("#refComm").val().length == 0 || $("#btcWallet").val().length == 0 || $("#paypalAddr").val().length == 0 || $("#tronWallet").val().length == 0 || $("#ethAddr").val().length == 0  || $("#creation_point").val().length == 0  || $("#review_point").val().length == 0  || $("#wdrDays").val().length == 0 ) {
			swal.fire({
				icon: 'error',
				title: "Missing field",
				text: "Please fill all field",
				confirmButtonText: 'OK'
			});
		} else {
			$("#updtSettings").html('<i class="fa fa-spinner fa-spin"></i> Processing').prop("disabled", true);
			$.ajax({
				type: "POST",
				data: $("#adminSettingsInfo").serialize(), //There is array in the input field
				url: "../process.php",
				success: function (response) {
					console.log(response);
					
					$("#updtSettings").html('<i class="icon-pencil"></i> Modify Settings').prop("disabled", false);
					
					if($.trim(response) == "success") {
						swal.fire({
							icon: 'success',
							title: "Settings Updated",
							text: "Your settings has been modified successfully",
							confirmButtonText: 'OK'
						}).then((isRedirect) => {
							
							if(isRedirect.isConfirmed) {
								window.location = "general_settings"
							}
							
						});
					} else if($.trim(response) == "error") {
						swal.fire({
							icon: 'error',
							title: "Error Updating",
							text: "Something went wrong, please try again",
							confirmButtonText: 'OK'
						});
					} else {
						swal.fire({
							icon: 'error',
							title: "Error Updating",
							html: response,
							confirmButtonText: 'OK'
						});
					}
					
				}
			});

		}
		
	});
	
	//Fetch account details 4 withdrawal...
	$("#payMethod").on("change", function() {
		var amount = $.trim($("#amount").val());
		if($.trim($(this).val()) == "") {
			swal.fire({
				icon: 'error',
				title: "Method Required!",
				html: "Please select a payment method",
				confirmButtonText: 'OK'
			});
			$("#response").html("");
		} else if(amount == "") {
			swal.fire({
				icon: 'error',
				title: "Amount Required!",
				html: "Please enter amount you want to withdraw",
				confirmButtonText: 'OK'
			});
			$("option:selected").prop("selected", false);
		} else if($.trim($(this).val()) == "bank" && amount == "") {
			swal.fire({
				icon: 'error',
				title: "Amount Required!",
				html: "Please enter amount you want to withdraw",
				confirmButtonText: 'OK'
			});
			$("option:selected").prop("selected", false);
		} else {
			
			data = {
				payType: "payType",
				type: $.trim($(this).val()),
				amount: amount
			}
			
			$.ajax({
				url: "../process.php",
				type: "POST",
				data: data,
				success: function(result) {
					
					if($.trim(result) == "login_needed") {
						swal.fire({
							icon: 'error',
							title: "Unauthorized Access",
							text: "Your session has expired. Kindly login to continue",
							confirmButtonText: 'OK'
						}).then((isRedirect) => {
							
							if(isRedirect.isConfirmed) {
								window.location = "makeWithdrawal"
							}
							
						});
					} else {
						$("#response").html(result);
					}
					
				}
			});
			
		}
		
	});
	
	//Convert amount to Naira in withdrawal...
	$("#amount").bind("change keyup input",function() { 
		if($("#payMethod").val() == "bank") {
			
			data = {
				payType: "payType",
				type: "bank",
				amount: $.trim($(this).val())
			}
			
			$.ajax({
				url: "../process.php",
				type: "POST",
				data: data,
				success: function(result) {
					
					if($.trim(result) == "login_needed") {
						swal.fire({
							icon: 'error',
							title: "Unauthorized Access",
							text: "Your session has expired. Kindly login to continue",
							confirmButtonText: 'OK'
						}).then((isRedirect) => {
							
							if(isRedirect.isConfirmed) {
								window.location = "makeWithdrawal"
							}
							
						});
					} else {
						$("#response").html(result);
					}
					
				}
			});
			
		}
	});
	
	//Make a withdrawal
	$("#mkWithdraw").click(function(e) {
		e.preventDefault();
		
		if($.trim($("#amount").val()) == "" || $.trim($("#payMethod").val()) == "" || $.trim($("#accntPass").val()) == "") {
			swal.fire({
				icon: 'error',
				title: "Missing field",
				text: "Please fill all field",
				confirmButtonText: 'OK'
			});
		} else {
			
			$("#mkWithdraw").html('<i class="fa fa-spinner fa-spin"></i> Processing').prop("disabled", true);
			
			data = {
				mkWdr: "mkWdr",
				amount: $.trim($("#amount").val()),
				payMethod: $.trim($("#payMethod").val()),
				pwd: $.trim($("#accntPass").val()),
			}
			
			$.ajax({
				url: "../process.php",
				type: "POST",
				data: data,
				success: function(result) {
					
					// console.log(result);
					
					$("#mkWithdraw").html('<i class="fa fa-exchange"></i> Submit Request').prop("disabled", false);
					
					if($.trim(result) == "success") {
						swal.fire({
							icon: 'success',
							title: "Success",
							text: "Withdrawal was successful, You will be credited soon",
							confirmButtonText: "OK"
						}).then((isRedirect) => {
							
							if(isRedirect.isConfirmed) {
								window.location = "makeWithdrawal"
							}
							
						});
					} else if($.trim(result) == "error_pass") {
						swal.fire({
							icon: 'error',
							title: "Incorrect Password",
							text: "The password provided is incorrect",
							confirmButtonText: 'OK'
						});
					} else if($.trim(result) == "invalid_amount") {
						swal.fire({
							icon: 'error',
							title: "Invalid Amount ",
							text: "You've entered an invalid amount",
							confirmButtonText: 'OK'
						});
					} else if($.trim(result) == "min_withdrawal_not_met") {
						swal.fire({
							icon: 'error',
							title: "Withdrawal Issue",
							text: "Minimum withdrawal not met",
							confirmButtonText: 'OK'
						});
					} else if($.trim(result) == "max_withdrawal_exceed") {
						swal.fire({
							icon: 'error',
							title: "Withdrawal Issue",
							text: "Maximum withdrawal exceeded",
							confirmButtonText: 'OK'
						});
					} else if($.trim(result) == "insufficient_blc") {
						swal.fire({
							icon: 'error',
							title: "Insufficient Balance",
							text: "Your wallet balance is not sufficient to process your request",
							confirmButtonText: 'OK'
						});
					} else if($.trim(result) == "login_needed") {
						swal.fire({
							icon: 'error',
							title: "Unauthorized Access",
							text: "Your session has expired. Kindly login to continue",
							confirmButtonText: 'OK'
						}).then((isRedirect) => {
							
							if(isRedirect.isConfirmed) {
								window.location = "makeWithdrawal"
							}
							
						});
					} else if($.trim(result) == "error") {
						swal.fire({
							icon: 'error',
							title: "Withdrawal Error",
							text: "Something went wrong, please try again",
							confirmButtonText: 'OK'
						});
					} else {
						swal.fire({
							icon: 'error',
							title: "Withdrawal Error",
							html: result,
							confirmButtonText: 'OK'
						});
					}
				}
			});
			
		}
		
	});
	
	//Send OTP...
	$("#sendOtp").click(function() {
		
		data = {
			sendOtp: "sendOtp"
		}
		
		$.ajax({
			url: "../process.php",
			type: "POST",
			data: data,
			beforeSend: function() {
				$("#sendOtp").html("Sending <i class='fa fa-spinner fa-spin'></i>").prop("disabled", true);
			},
			success: function(result) {
				
				$("#sendOtp").html("request otp code").prop("disabled", false);
				
				if($.trim(result) == "login_needed") {
					swal.fire({
						icon: 'error',
						title: "Unauthorized Access",
						text: "Your session has expired. Kindly login to continue",
						confirmButtonText: 'OK'
					}).then((isRedirect) => {
						
						if(isRedirect.isConfirmed) {
							window.location = "profile"
						}
						
					});
				} else if($.trim(result) == "sent") {
					swal.fire({
						icon: 'success',
						title: "OTP Generated",
						text: "An OTP Code has been generated for your request and sent successfully. Kindly check your email inbox or spam folder",
						confirmButtonText: 'OK'
					});
				} else if($.trim(result) == "error") {
					swal.fire({
						icon: 'error',
						title: "Error Ocurred",
						text: "We're currently experiencing dificulties in sending email at the moment, please try again",
						confirmButtonText: 'OK'
					});
				} else {
					swal.fire({
						icon: 'error',
						title: "Error Ocurred",
						html: result,
						confirmButtonText: 'OK'
					})
					console.log(result);
				}
				
			}
		});
	});
	
	//Show password on login
	$("#showPass").click(function() {
		
		var x = document.getElementById("password");
		
		if($.trim(x.value) == "") { } else {
			if (x.type == "password") {
				x.type = "text";
				$("#showPass").html("HIDE");
			} else {
				x.type = "password";
				$("#showPass").html('<i class="fa fa-eye fa-2x"></i>');
			}
		}
	});
});