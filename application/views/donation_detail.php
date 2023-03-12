<!doctype html>
<html lang="en">
	<?php $this->load->view('template/head'); ?>
	<body>
		<header class="header_box hh300">
			<?php $this->load->view('template/menu'); ?>
			<div class="jumbotron jh200"></div>
		</header>
		<div class="container dd_container">
			<div class="row">
				<div class="col-md-7" id="dd_images">
					<?php if (count($data["images"]) > 1): ?>
						<div id="custCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false" align="center">
							<div class="carousel-inner dd_highlight_img">
								<?php for ($i = 0; $i < count($data['images']); $i++): ?>
									<div class="carousel-item<?= $i == 0 ? " active" : ""; ?>">
										<img src="<?= base_url('assets/lazyload.gif'); ?>" data-src="<?= "{$_ENV['API_BASE']}/{$data['images'][$i]['file_location']}"; ?>" alt="Image <?= $data['title']; ?>">
									</div>
								<?php endfor; ?>
							</div>
							<ol class="carousel-indicators list-inline">
								<?php for ($i = 0; $i < count($data['images']); $i++): ?>
									<li class="list-inline-item<?= $i == 0 ? " active" : ""; ?>">
										<a id="carousel-selector-<?= $i; ?>" class="selected" data-slide-to="<?= $i; ?>" data-target="#custCarousel">
											<img src="<?= base_url('assets/lazyload.gif'); ?>" data-src="<?= "{$_ENV['API_BASE']}/{$data['images'][$i]['file_location']}"; ?>" class="box_list_highlight"  alt="Image <?= $data['title']; ?>">
										</a>
									</li>
								<?php endfor; ?>
							</ol>
						</div>
						<hr>
					<?php else: ?>
						<div class="dd_highlight_img mb-4">
							<img src="<?= base_url('assets/lazyload.gif'); ?>" data-src="<?= count($data["images"]) == 0 ? base_url('assets/img/default_image_small.png') : "{$_ENV['API_BASE']}/{$data['images'][0]['file_location']}"; ?>" class="highlight_img" alt="Image <?= $data['title']; ?>">
						</div>
					<?php endif; ?>
					<div class="dd_description_donasi">
						<h2 class="dd_title_description"><?= $data['title']; ?></h2>
						<p class="dd_sub_title_description"><?= $data['short_description']; ?></p>
						<div class="progress mb10">
							<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="<?= $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentage; ?>%"></div>
						</div>
						<div class="progres_box_donasi">
							<p class="txt_progres_percent"><?= $percentage; ?>%</p>
							<p class="txt_progres_nominal">Rp <?= nomor($data["goal_amount"]); ?></p>
						</div>
						<p class="description_donasi"><?= nl2br($data['description']); ?></p>
						<hr>
						<h2 class="dd_title_description">Transaction Activity</h2>
						<div id="wrapper-activity"></div>
						<div id="wrapper-load-more" class="row_show_all_donasi" style="margin-top: 20px; margin-bottom: 0; display: none;">
							<button id="btn-load-more" class="btn_see_all_donasi">
								load more
							</button>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="box_donation">
						<?php if ($data['status'] == 'finished'): ?>
							<h2>Campaign Finished</h2>
							<hr>
							<p>
								This donation campaign is over, thanks to all who have contributed to this donation campaign.
							</p>
							<hr>
							<p>
								Collected funds: Rp <?= number_format($data['current_amount'], 0, ",", "."); ?>
								<br>
								The number of people who donated: <?= $data['donor_count']; ?>
							</p>
							<hr>
							<p class="mb-0">
								<b>Thank You All !!!</b>
							</p>
						<?php else: ?>
							<form id="form-donate">
								<div class="form-group mb20">
									<label class="lbl_form_donation mb0 pb20"><b>Form Donation</b></label>
									<textarea id="donate-comment" class="form-control dd_textarea" id="exampleFormControlTextarea1" rows="4" placeholder="Write your words, can be for encouragement or positive words" style="padding-bottom: 32px;"></textarea>
								</div>
								<div class="form-group mb20">
									<label for="donate-amount">Enter the amount you want to donate:</label>
									<input id="donate-amount" class="form-control" autocomplete="off">
								</div>
								<button id="btn-donate" type="submit" class="dl_btn_search clr_btn_donate">DONATE NOW</button>
							</form>
						<?php endif; ?>
					</div>
					<div class="box_donation mt-4" id="card-exclusive-campaign-information" style="display: none;">
						<h5><b>Exclusive Campaign Information</b></h5>
						<hr>
						<p>
							This campaign is an exclusive campaign, you can get a prize at the end of the campaign, the winner will be randomized by the system, the conditions for participating in order to get a prize are that you only need to donate any amount to this campaign.
						</p>
						<p>
							<b>Reward:</b><br>
							<span id="reward"></span>
						</p>
						<p class="mb-0">
							<b>Winner:</b><br>
							<span id="winner"></span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('template/footer'); ?>
		<?php $this->load->view('template/script'); ?>
		<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= $_ENV['MIDTRANS_CLIENT_KEY']; ?>"></script>
		<script src="<?= base_url('assets/inputmask/dist/jquery.inputmask.js'); ?>"></script>
		<script>
			$("#donate-amount").inputmask({
				alias: 'numeric',
				groupSeparator: '.',
				autoGroup: true,
				digits: 0,
				digitsOptional: false,
				prefix: 'Rp ',
				autoUnmask: true
			}).attr('autocomplete', 'off');

			let offset = 0;

			<?php if ($this->session->has_userdata('id')): ?>
				let eMoney = 0;

				$.ajax({
					url: `<?= $_ENV['API_URL']; ?>/users/data`,
					type: 'GET',
					beforeSend: function(xhr) {
						xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
					},
					success: function(response) {
						if (response.success) {
							eMoney = response?.data?.e_money;
						} else {
							Swal.fire({
								icon: 'error',
								text: response.error
							});
						}
					},
					error: function(xhr, error, code) {
						Swal.fire({
							icon: 'error',
							text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
						});
					},
					complete: function() {}
				});

				$('#form-donate').submit(function(e){
					e.preventDefault();

					if ($('#donate-amount').val() == "") {
						Swal.fire({
							icon: 'warning',
							text: "Donation amount can not be empty!"
						});
						return
					}

					var amountMidtrans = $('#donate-amount').val();
					var	amounts = amountMidtrans.replace(".", "");

					if (eMoney >= parseInt(amounts)) {
						Swal.fire({
							title: 'Want to Use e-Money?',
							text: `You have e-money worth ${formatRupiah(eMoney)}, want to use it?`,
							icon: 'info',
							showCancelButton: true,
							confirmButtonText: 'Yes',
							cancelButtonText: 'No'
						}).then((result) => {
							if (result.isConfirmed) {
								Swal.fire({
									title: 'Transaction on Process',
									text: `Please wait, your transaction is being processed...`,
									icon: 'info',
									showConfirmButton: false,
									showCancelButton: false
								});
								eMoneyTransaction();
							} else {
								snapTransaction();
							}
						});
					} else {
						snapTransaction();
					}

					function eMoneyTransaction() {
						var amountMidtrans = $('#donate-amount').val();
						var	amounts = amountMidtrans.replace(".", "");

						$.ajax({
							url: "<?= $_ENV['API_URL']; ?>/transactions/emoney",
							method: 'POST',
							cache: false,
							data: JSON.stringify({
								"campaign_id": <?= $data['id']; ?>,
								"user_id": <?= $this->session->userdata('id'); ?>,
								"amount": parseInt(amounts),
								"comment": $('#donate-comment').val()
							}),
							contentType: "application/json",
							dataType: 'json',
							beforeSend: function(xhr) {
								xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
								$('#btn-donate').html('PROCESSING...');
								$('#btn-donate').prop('disabled', true);
								$('#btn-donate').fadeOut(500);
							},
							success: function(response) {
								if (response.success) {
									Swal.fire({
										icon: 'success',
										title: 'Success',
										text: response.message,
										showConfirmButton: false,
										showCancelButton: false
									});
									setTimeout(() => {
										location.reload();
									}, 2500);
								} else {
									Swal.fire({
										icon: 'error',
										text: response.error
									});
								}
							},
							error: function(xhr, error, code) {
								Swal.fire({
									icon: 'error',
									text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
								});
							},
							complete: function() {
								$('#btn-donate').removeAttr("disabled").fadeIn(500);
								$('#btn-donate').prop('disabled', false);
								$('#btn-donate').html('DONATE NOW');
							}
						});
					}

					function snapTransaction() {
						var amountMidtrans = $('#donate-amount').val();
						var	amounts = amountMidtrans.replace(".", "");

						$.ajax({
							url: "<?= $_ENV['API_URL']; ?>/transactions",
							method: 'POST',
							cache: false,
							data: JSON.stringify({
								"campaign_id": <?= $data['id']; ?>,
								"user_id": <?= $this->session->userdata('id'); ?>,
								"amount": parseInt(amounts),
								"comment": $('#donate-comment').val()
							}),
							contentType: "application/json",
							dataType: 'json',
							beforeSend: function(xhr) {
								xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
								$('#btn-donate').html('PROCESSING...');
								$('#btn-donate').prop('disabled', true);
							},
							success: function(response) {
								$('#btn-donate').fadeOut(500);
								snap.pay(response.data.payment_token, {
									skipOrderSummary: true,
									onSuccess: function(result) {
										$('#form-donate').trigger('reset');
										Swal.fire({
											icon: 'success',
											text: result?.status_message || "transaction successfully",
											showConfirmButton: false,
											timer: 3000
										});
										setTimeout(() => {
											location.reload();
										}, 2500);
									},
									onPending: function(result) {
										$('#form-donate').trigger('reset');
										Swal.fire({
											icon: 'info',
											text: result?.status_message || "transaction pending"
										});
									},
									onError: function(result) {
										$('#form-donate').trigger('reset');
										Swal.fire({
											icon: 'error',
											text: result?.status_message[0] || "transaction error"
										});
									},
									onClose: function() {
										$('#form-donate').trigger('reset');
										Swal.fire({
											icon: 'warning',
											text: "The payment snap popup closed, the payment transaction is canceled..."
										});
									}
								});
							},
							error: function(xhr, error, code) {
								Swal.fire({
									icon: 'error',
									text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
								});
							},
							complete: function() {
								$('#btn-donate').removeAttr("disabled").fadeIn(500);
								$('#btn-donate').prop('disabled', false);
								$('#btn-donate').html('DONATE NOW');
							}
						});
					}
				});
			<?php else: ?>
				$('#form-donate').submit(function(e){
					var amountMidtrans = $('#donate-amount').val();
					var	amounts = amountMidtrans.replace(".", "");
					e.preventDefault();
					if ($('#donate-amount').val() == "") {
						Swal.fire({
							icon: 'warning',
							text: "Donation amount can not be empty!"
						});
						return
					}
					$.ajax({
						url: "<?= $_ENV['API_URL']; ?>/transactions/anonymous",
						method: 'POST',
						cache: false,
						data: JSON.stringify({
							"campaign_id": <?= $data['id']; ?>,
							"amount": parseInt(amounts),
							"comment": $('#donate-comment').val()
						}),
						contentType: "application/json",
						dataType: 'json',
						beforeSend: function(xhr) {
							$('#btn-donate').html('PROCESSING...');
							$('#btn-donate').prop('disabled', true);
						},
						success: function(response) {
							$('#btn-donate').fadeOut(500);
							snap.pay(response.data.payment_token, {
								skipOrderSummary: true,
								onSuccess: function(result) {
									$('#form-donate').trigger('reset');
									Swal.fire({
										icon: 'success',
										text: result?.status_message || "transaction successfully",
										showConfirmButton: false,
										timer: 3000
									});
									setTimeout(() => {
										location.reload();
									}, 2500);
								},
								onPending: function(result) {
									$('#form-donate').trigger('reset');
									Swal.fire({
										icon: 'info',
										text: result?.status_message || "transaction pending"
									});
								},
								onError: function(result) {
									$('#form-donate').trigger('reset');
									Swal.fire({
										icon: 'error',
										text: result?.status_message[0] || "transaction error"
									});
								},
								onClose: function() {
									$('#form-donate').trigger('reset');
									Swal.fire({
										icon: 'warning',
										text: "The payment snap popup closed, the payment transaction is canceled..."
									});
								}
							});
						},
						error: function(xhr, error, code) {
							Swal.fire({
								icon: 'error',
								text: xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
							});
						},
						complete: function() {
							$('#btn-donate').removeAttr("disabled").fadeIn(500);
							$('#btn-donate').prop('disabled', false);
							$('#btn-donate').html('DONATE NOW');
						}
					});
				});
			<?php endif; ?>

			$.ajax({
				url: "<?= $_ENV['API_URL']; ?>/transactions/campaigns/<?= $data['id']; ?>?status=paid&limit=5&order_by=id&order_type=DESC",
				type: 'GET',
				success: function(response) {
					if (response.success) {
						let data = response.data;
						if (data.length == 0) {
							$('#wrapper-activity').html("No transaction yet for this campaign donation.");
							return
						}

						if (data.length >= 5) {
							$('#wrapper-load-more').show();
						}

						for (let i = 0; i < data.length; i++) {
							let words = '.';
							if (data[i].comment.length > 0) {
								words = ` and sent the words: ${data[i].comment}${data[i].comment[data[i].comment.length] == "." ? "" : "."}`;
							}
							$('#wrapper-activity').append(`<div class="card${i == 0 ? "" : " mt-3"}">
								<div class="card-body">
									<p class="card-text">
										<span class="text-capitalize font-weight-bold">${data[i].user_name}</span> donated ${formatRupiah(data[i].amount)}${words} Thank you so much <span class="text-capitalize font-weight-bold">${data[i].user_name}</span>!
									</p>
								</div>
							</div>`);
						}

						offset += 5;
					}
				},
				error: function(xhr, error, code) {
					console.log(xhr, error, code);
				}
			});

			$('#btn-load-more').click(function(){
				$('#btn-load-more').html('<i class="fa fa-spinner fa-pulse"></i> FETCHING DATA ...').addClass('disabled').attr('disabled', 'disabled').css("cursor", "wait");
				$.ajax({
					url: `<?= $_ENV['API_URL']; ?>/transactions/campaigns/<?= $data['id']; ?>?status=paid&limit=5&offset=${offset}&order_by=id&order_type=DESC`,
					type: 'GET',
					success: function(response) {
						if (response.success) {
							let data = response.data;

							if (data.length == 0 && offset == 0) {
								$('#wrapper-activity').html("No transaction yet for this campaign donation.");
								return
							}

							if (data.length >= 5) {
								$('#wrapper-load-more').show();
								$('#btn-load-more').removeAttr('disabled').removeClass('disabled').html("LOAD MORE").css("cursor", "pointer");
							} else {
								$('#wrapper-load-more').hide();
							}

							for (let i = 0; i < data.length; i++) {
								let words = '.';
								if (data[i].comment.length > 0) {
									words = ` and sent the words: ${data[i].comment}${data[i].comment[data[i].comment.length] == "." ? "" : "."}`;
								}
								$('#wrapper-activity').append(`<div class="card${i == 0 ? "" : " mt-3"}">
									<div class="card-body">
										<p class="card-text">
											<span class="text-capitalize font-weight-bold">${data[i].user_name}</span> donated ${formatRupiah(data[i].amount)}${words} Thank you so much <span class="text-capitalize font-weight-bold">${data[i].user_name}</span>!
										</p>
									</div>
								</div>`);
							}

							offset += 5;
						}
					},
					error: function(xhr, error, code) {
						console.log(xhr, error, code);
					}
				});
			});

			$(function(){
				$.ajax({
					url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/campaign/<?= $this->uri->segment(2); ?>`,
					type: 'GET',
					beforeSend: function(xhr) {
						xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
					},
					success: function(response) {
						if (response.success) {
							$('#card-exclusive-campaign-information').show();

							let winner = response.data.winner_user_id;

							if (response.data.is_reward_money) {
								$("#reward").html(formatRupiah(response.data.reward));
							} else {
								$("#reward").html(response.data.reward);
							}

							if (winner > 0) {
								$.ajax({
									url: `<?= $_ENV['API_URL']; ?>/users/name/${response.data.winner_user_id}`,
									type: 'GET',
									success: function(response) {
										if (response.success) {
											$('#winner').html(response.data.name);
										} else {
											console.log(response.error);
										}
									},
									error: function(xhr, error, code) {
										console.log(xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`);
									},
									complete: function() {}
								});
							} else {
								$('#winner').html("Will be shown after the campaign is finished.");
							}
						} else {
							console.log(response.error);
						}
					},
					error: function(xhr, error, code) {
						console.log(xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`);
					},
					complete: function() {}
				});
			});
		</script>
	</body>
</html>
