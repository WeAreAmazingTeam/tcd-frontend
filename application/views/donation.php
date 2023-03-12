<!doctype html>
<html lang="en">
	<?php $this->load->view('template/head'); ?>
  	<body>
		<header class="header_box dl_header">
			<?php $this->load->view('template/menu'); ?>
			<div class="jumbotron jhabout" style="padding-top: 150px;">
				<p class="all_judul_header">List of Donations</p>
			</div>
			<div class="container dl_box_search" style="padding: 25px;">
				<form id="form-filter">
					<div class="row">
						<div class="col-md-4">
							<p class="dl_txt_header">Search</p>
							<input type="text" class="form-control dl_input_txt_header" id="filter-search">
						</div>
						<div class="col-md-4">
							<p class="dl_txt_header">Category</p>
							<select class="form-control dl_input_txt_header" id="filter-category_id">
								<option value=""></option>
							</select>
						</div>
						<div class="col-md-4">
							<p class="dl_txt_header">Sort By</p>
							<select class="form-control dl_input_txt_header" id="filter-sort_by">
								<option value=""></option>
								<option value="oldest">Oldest Campaigns</option>
								<option value="newest">Newest Campaigns</option>
								<option value="smallest_income">Smallest Collection Amount</option>
								<option value="biggest_income">Biggest Collection Amount</option>
							</select>
						</div>
					</div>
					<button id="btn-search" class="dl_btn_search" type="submit" style="margin-top: 25px;">search</button>
				</form>
			</div>
		</header>
		<div class="container mt290" style="min-height: 80vh;">
			<div class="list_donasi">
				<div class="row display-flex" id="wrapper-list_donation"></div>
				<div id="wrapper-load-more" class="row_show_all_donasi" style="margin-top: 10px; display: none;">
					<button id="btn-load-more" class="btn_see_all_donasi">
						load more
					</button>
				</div>
			</div>
		</div>
		<?php $this->load->view('template/footer'); ?>
	    <?php $this->load->view('template/script'); ?>
		<script>
			let gSearch = "";
			let gCategory = "";
			let gLimit = "9";
			let gOffset = "0";
			let gSortBy = "";
			let gOrderBy = "id";
			let gOrderType = "DESC";
			let gIsProcessing = false;

			$('#form-filter').submit(function(e){
				e.preventDefault();

				$('#btn-search').html('<i class="fa fa-spinner fa-pulse"></i> SEARCHING ...').addClass('disabled').attr('disabled', 'disabled').css("cursor", "wait");

				// reduce repeat request
				if (gSearch == $('#filter-search').val() && gSortBy == $('#filter-sort_by').val() && gCategory == $('#filter-category_id').val()) {
					setTimeout(() => {
						$('#btn-search').removeAttr('disabled').removeClass('disabled').html("SEARCH").css("cursor", "pointer");
					}, 100);
					return;
				}

				// reset
				gSearch = "";
				gCategory = "";
				gLimit = "9";
				gOffset = "0";
				gSortBy = "";
				gOrderBy = "id";
				gOrderType = "DESC";

				gSearch = $('#filter-search').val();
				gSortBy = $('#filter-sort_by').val();
				gCategory = $('#filter-category_id').val();

				if (gSortBy != "") {
					switch (gSortBy) {
						case "newest":
							gOrderBy = "id";
							gOrderType = "DESC";
							break;
						case "oldest":
							gOrderBy = "id";
							gOrderType = "ASC";
							break;
						case "biggest_income":
							gOrderBy = "current_amount";
							gOrderType = "DESC";
							break;
						case "smallest_income":
							gOrderBy = "current_amount";
							gOrderType = "ASC";
							break;
						default:
							break;
					}
				}

				$('#wrapper-load-more').hide();
				newRequest(gSearch, gCategory, gLimit, gOffset, gOrderBy, gOrderType);
			});

			function newRequest(search = "", category = "", limit = "9", offset = "0", orderBy = "id", orderType = "DESC") {
				if (gIsProcessing) {
					return
				}

				gIsProcessing = true;
				gSearch = search;
				gCategory = category;
				gLimit = limit;
				gOffset = offset;
				gOrderBy = orderBy;
				gOrderType = orderType;

				let query = "?";

				if (search != "") {
					query += `search=${search}`;
				}

				if (category != "") {
					query += (query == "?" ? "" : "&") + `category=${category}`;
				}

				query += (query == "?" ? "" : "&") + `limit=${limit}&offset=${offset}&order_by=${orderBy}&order_type=${orderType}`;

				query += '&status=active';

				if (offset == 0) {
					$('#wrapper-list_donation').html('');
					$('#wrapper-list_donation').html(`<div class="col-12"><h1 class="text-center"><i class="fa fa-spinner fa-pulse"></i></h1></div>`);
				}

				$.ajax({
					url: `<?= $_ENV['API_URL']; ?>/campaigns${query}`,
					type: 'GET',
					success: function(response) {
						if (response.success) {
							let data = response.data;

							if (offset == 0) {
								$('#wrapper-list_donation').html('');

								if (data.length == 0) {
									$('#wrapper-list_donation').html(`<div class="col-12"><h2 class="text-center">NO RESULT FOUND</h2></div>`);
								}
							}

							if (data.length >= limit) {
								$('#wrapper-load-more').show();
								$('#btn-load-more').removeAttr('disabled').removeClass('disabled').html("LOAD MORE").css("cursor", "pointer");
							} else {
								$('#wrapper-load-more').hide();
							}

							for (let i = 0; i < data.length; i++) {
								let img = '';
								let tooltip = '';
								let exclusive = '';
								let percentage = 0;
								let description = '';

								if (data[i].images.length > 0) {
									img = `<img class="card-img-top card_img_donasi" style="height: 250px; object-fit: cover;" src="<?= base_url('assets/lazyload.gif'); ?>" data-src="<?= $_ENV['API_BASE']; ?>/${data[i].images[0].file_location}" alt="Image ${data[i].short_description}">`;
								} else {
									img = `<img class="card-img-top card_img_donasi" style="height: 250px; object-fit: cover;" src="<?= base_url('assets/lazyload.gif'); ?>" data-src="<?= base_url('assets/img/default_image.png'); ?>" alt="Image ${data[i].short_description}">`;
								}

								if (data[i].is_exclusive) {
									exclusive = `<hr><div style="font-size: 17px; margin-top: -7.5px !important;" class="mt-0 mb-2">
										<span class="badge badge-dark" style="display: block;">EXCLUSIVE CAMPAIGN</span>
									</div>`;
								}

								percentage = Math.round((data[i].current_amount / data[i].goal_amount) * 100);
								percentage = percentage > 100 ? "100" : percentage;

								description = data[i].description.length > 150 ? `${data[i].description.substring(0, 150)}...` : data[i].description;

								if (data[i].short_description.length > 30) {
									tooltip = ` data-toggle="tooltip" data-placement="top" title="${data[i].short_description}"`;
								}

								$('#wrapper-list_donation').append(`<div class="col-md-6 col-lg-4">
									<div class="card col_list_donasi" style="height: 100%;">
										${img}
										<div class="card-body pad0">
											<p class="txt_judul_donasi" style="cursor: help;"${tooltip}>${data[i].short_description}</p>
											<p class="txt_sub_judul_donasi">${description}</p>
											${exclusive}
										</div>
										<div class="card-footer" style="background-color: transparent; margin: 0; padding: 0; padding-top: 10px;">
											<div class="progress mb10">
												<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: ${percentage}%"></div>
											</div>
											<div class="progres_box_donasi">
												<p class="txt_progres_percent">${percentage}%</p>
												<p class="txt_progres_nominal">${formatRupiah(data[i].goal_amount)}</p>
											</div>
											<hr style="margin-top: -5px;">
											<a href="<?= site_url('donate'); ?>/${data[i].id}">
												<button class="btn_submit_donasi">
													donate
												</button>
											</a>
										</div>
									</div>
								</div>`);
							}

							lazyLoading();
							renderTooltip();
						}
					},
					error: function(xhr, error, code) {
						let errorMsg = xhr?.responseJSON?.error || `${error}, ${(code == "" ? "internal server error or API is down!" : code)}`
						$('#wrapper-list_donation').html(`<div class="col-12"><h3 class="text-center">${errorMsg}</h3></div>`);
						console.log(xhr, error, code);
					},
					complete: function() {
						gIsProcessing = false;
						if (gOffset == 0) {
							$('#btn-search').removeAttr('disabled').removeClass('disabled').html("SEARCH").css("cursor", "pointer");
						}
					}
				});
			}

			$(function(){
				newRequest();

				$.ajax({
					url: "<?= $_ENV['API_URL']; ?>/campaigns/categories",
					type: 'GET',
					success: function(response) {
						if (response.success) {
							let data = response.data;
							for (let i = 0; i < data.length; i++) {
								$("#filter-category_id").append(`<option value="${data[i].id}">${data[i].category}</option>`);
							}
						}
					},
					error: function(xhr, error, code) {
						console.log(xhr, error, code);
					}
				});
			});

			$('#btn-load-more').click(function(){
				$('#btn-load-more').html('<i class="fa fa-spinner fa-pulse"></i> FETCHING DATA ...').addClass('disabled').attr('disabled', 'disabled').css("cursor", "wait");
				newRequest(gSearch, gCategory, gLimit, parseInt(gOffset)+9, gOrderBy, gOrderType);
			});
		</script>
	</body>
</html>