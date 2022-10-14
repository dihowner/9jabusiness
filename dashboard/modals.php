

    <!-- log out modal-->
<div class="row">
    <div class="col-lg-6">	                                 
	    <div id="logout" class="modal modal-adminpro-general default-popup-PrimaryModal fade" style="margin-top: 15%" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header header-color-modal bg-color-1">
                            <h4 class="modal-title">Sign Out ( <?php echo ucfirst($action->loggedusername($userid));?> )</h4>
                            <div class="modal-close-area modal-close-df">
                                <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                            </div>
                        </div>
                        <div class="modal-body">
										
                            <div class="row">
                                <div class="col-lg-12">
                                   Thanks for using our service. We promise to serve you better.
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <a data-dismiss="modal" href="#">Cancel</a>
                            <a href="logoff" class="btn btn-rounded btn-primary"><i class="fa fa-sign-out"></i>Log Out</a>
                        </div>
					</form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--withdraw  Modal-->
<div class="login-form-area adminpro-pd mg-b-15">
    <div class="container-fluid">
		<div class="row">
            <div class="col-lg-6">	                                 
			    <div id="withdraw" class="modal modal-adminpro-general default-popup-PrimaryModal fade" style="margin-top: 5%" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header header-color-modal bg-color-1">
                                <h4 class="modal-title">
									<?php if($action->withdrawSettings()->allowWithdrawal !== "yes" || !in_array($todaysDay , explode(",", $wdrDays))) { ?>
										<b>Withdrawal Unavailable</b>
									<?php } else { ?>
										<b>Withdraw From Wallet</b>
									<?php } ?>
								</h4>
                                <div class="modal-close-area modal-close-df">
                                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                </div>
                            </div>
                            <div class="modal-body">
										
					        <div class="row">
        						<?php if($action->withdrawSettings()->allowWithdrawal !== "yes") { ?>
        							<div class="col-lg-12" align="center">
        								<img src="img/lock.png" style="width: 250px; height: 250px;">
        								<p style="font-size: 22px">Dear Esteemed Client, Withdrawals are not currently available</p>
        							</div>
        						<?php } else if(!in_array($todaysDay , explode(",", $wdrDays))) { ?>
        							<div class="col-lg-12" align="center">
        								<img src="img/lock.png" style="width: 250px; height: 250px;">
        								<p style="font-size: 22px">Dear Esteemed Client, Withdrawals is currently closed for today. Kindly check back on <b><?php echo $action->getDay($wdrDays);?></b> <br></p>
        							</div>
        						<?php } else { ?>
        							<div class="col-lg-12">
        								<div class="sparkline12-list shadow-reset mg-t-30">
        									<div class="sparkline12-graph">
        										<div class="basic-login-form-ad">
        											<div class="all-form-element-inner">
        												
        												<div class="row">
        													<div class="col-lg-12">
        														<div id="withdraw_result"></div>
        													</div>
        												</div>
        												
        												<form method="post" id="withdrawInfo">
        												<div class="form-group-inner">
        														<div class="row">
        															
        															<div class="col-lg-12">
        																<label class="text-left" style="font-size: 18px;"><b>Select Currency Type</b></label>
        																<div class="form-select-list">
        																	<select class="form-control custom-select-value" name="coinType" id="coinType">
        																		<option value="">Select Currency Type</option>
        																		
        																<?php
        																$userWallet = $action->userWallet($userid);
        																$btcWallet = $userWallet["btc"];
        																$ltcWallet = $userWallet["ltc"];
        																$ethWallet = $userWallet["eth"];
        																$ngnWallet = $userWallet["ngn"];
        															   
        																if($btcWallet < 1) {
        																	$valBtc = "disabled";
        																} if($ltcWallet < 1) {
        																	$valLtc = "disabled";
        																} if($ethWallet < 1) {
        																	$valEth = "disabled";
        																} if($ngnWallet < 1) {
        																	$valNgn = "disabled";
        																}  ?>
        
        																		<option value="btcWallet" <?php echo $valBtc;?>>Bitcoin (<?php echo number_format($btcWallet, 2); ?> BTC)</option>
        																		<option value="ethWallet" <?php echo $valEth;?>>Ethereum (<?php echo number_format($ethWallet, 2); ?> ETH)</option>
        																		<option value="ltcWallet" <?php echo $valLtc;?>>Litecoin (<?php echo number_format($ltcWallet, 2); ?> LTC)</option>
        																		<option value="ngnWallet" <?php echo $valNgn;?>>Nigerian Currency (<?php echo number_format($ngnWallet, 2); ?> NGN)</option>
        																	   
        																	</select>
        																</div>
        															</div>
        															
        														</div>
        													</div>
        												
        													<div class="form-group-inner" style="margin-top: 10px">
        														<div class="row">
        															<div class="col-lg-12">
        																<label class="text-left" style="font-size: 18px;"><b>Amount to be withdrawn</b></label>
        																<input placeholder="Enter Amount" class="form-control" type="number" min="1" id="withdraw_amnt" name="withdraw_amnt"/>
        															</div>
        														</div>
        														
        														<div id="walletAddr"></div>
        													
        													</div>
        												  
        												 
        											</div>
        											   
        										</div>
        									</div>
        								</div>
        							</div>
        						<?php } ?>
						
                            </div>
                        </div>
										
                        <div class="modal-footer">
                            <a data-dismiss="modal" href="#">Cancel</a>
							<?php if($action->withdrawSettings()->allowWithdrawal == "yes") { ?>
								<button href="#" type="submit" class="btn btn-primary" id="withdrawbtn" name="withdrawbtn" onclick="return aconfirmSend();">
									<b>Withdraw</b>
								</button>
							<?php } ?>
                                </div>
        					</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>