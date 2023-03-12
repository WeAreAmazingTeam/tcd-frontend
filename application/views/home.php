<!doctype html>
<html lang="en">
	<?php $this->load->view('template/head'); ?>
	<body>
		<header class="header_box">
			<?php $this->load->view('template/menu'); ?>
			<div class="jumbotron jumbotron_header paddingt150">
				<div class="container">
					<div class="row">
						<div class="col-md-6 maxw564 box_txt_jumbotron">
							<p class="txt_header1">Set Aside Your Money to Help Others Who Are In Need!</p>
							<p class="txt_header2">Help others who need your help, make others happy with your help, show your kindness to others, always contribute to spreading goodness in this world! Lets make a change!</p>
							<a href="#list-donation" class="btn_header">
								take me to goodness
							</a>
						</div>
						<div class="col-md-6 padl45">
							<img src="<?= base_url('assets/lazyload.gif'); ?>" data-src="<?= base_url('assets/img/home-hero.jpeg'); ?>" class="img_home_page" alt="The Cloud Donation - Hero Image">
						</div>
					</div>
				</div>
			</div>
		</header>
		<section id="list-donation">
			<div class="container">
				<div class="headline_donasi">
					<center>
						<p class="headline_judul">List of Donations</p>
						<span class="sub_headline_judul">Find a donation campaign for you today, spread kindness to them</span>
					</center>
				</div>
				<div class="list_donasi">
					<div class="row display-flex" id="wrapper-list_donation"></div>
					<div class="row_show_all_donasi mt10">
						<div id="btn-see-all" class="dn">
							<a href="<?= site_url('donations'); ?>" class="db wfull">
								<button class="btn_see_all_donasi">
									see all donation list
								</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<div class="jumbotron jumbotron_ringkasan_donasi">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="d-flex justify-content-center fs55">
							<div class="img_ringkas_donasi d-flex justify-content-center align-items-center">
								<i class="fa fa-donate fa-fw"></i>
							</div>
						</div>
						<p class="txt_judul_ringkas_donasi1" id="statistics-total_donation">-</p>
						<p class="txt_judul_ringkas_donasi2">total donation</p>
					</div>
					<div class="col-md-3">
						<div class="d-flex justify-content-center fs55">
							<div class="img_ringkas_donasi d-flex justify-content-center align-items-center">
								<i class="fa fa-check-double fa-fw"></i>
							</div>
						</div>
						<p class="txt_judul_ringkas_donasi1" id="statistics-donation_completed">-</p>
						<p class="txt_judul_ringkas_donasi2">donation completed</p>
					</div>
					<div class="col-md-3">
						<div class="d-flex justify-content-center fs55">
							<div class="img_ringkas_donasi d-flex justify-content-center align-items-center">
								<i class="fa fa-handshake fa-fw"></i>
							</div>
						</div>
						<p class="txt_judul_ringkas_donasi1" id="statistics-total_transaction">-</p>
						<p class="txt_judul_ringkas_donasi2">total transaction</p>
					</div>
					<div class="col-md-3">
						<div class="d-flex justify-content-center fs55">
							<div class="img_ringkas_donasi d-flex justify-content-center align-items-center">
								<i class="fa fa-users fa-fw"></i>
							</div>
						</div>
						<p class="txt_judul_ringkas_donasi1" id="statistics-user_registered">-</p>
						<p class="txt_judul_ringkas_donasi2">user registered</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container mt100">
			<section class="head_review tac">
				<p class="headline_judul">Heartwarming Stories</p>
				<p class="sub_headline_judul mb50">Here are some heartwarming stories of those who were helped</p>
			</section>
			<section class="slider_review mb50">
				<div id="demo" class="carousel slide" data-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<div class="box_review card-shadow">
								<div class="sub_box_review">
									<div class="box_review_left">
										<div class="box_judul_review">
											<p class="txt_judul_review">Philippina Tyche</p>

											<div class="m_judul_left_review dn">
												<svg class="m_svg_icon_user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
												<i class="fa-thin fa-user"></i>
											</div>
											<div class="m_judul_right_review dn">
												<p class="m_txt_judul_review">Philippina Tyche</p>
											</div>
										</div>
										<div class="desription_review">
											<p class="txt_description_review">
												When a natural disaster, I was left feeling helpless and alone. My home was destroyed, and I had no idea how I was going to rebuild my life. But then something incredible happened. People from all over the world came together to donate money to help me throught The Cloud Donation's Website.
											</p>
											<p class="txt_description_review mb-0">
												I will always be grateful for the support of the people who donated to me. Their kindness gave me a second chance, and I will never forget it. I am committed to paying it forward by helping others in need, just as they helped me.
											</p>
										</div>
									</div>
									<div class="box_review_right" style="background-image: url('<?= base_url('assets/img/heartwarming_stories/1.jpg'); ?>');"></div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="box_review card-shadow">
								<div class="sub_box_review">
									<div class="box_review_left">
										<div class="box_judul_review">
											<p class="txt_judul_review">Adolph Alexander</p>

											<div class="m_judul_left_review dn">
												<svg class="m_svg_icon_user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
												<i class="fa-thin fa-user"></i>
											</div>
											<div class="m_judul_right_review dn">
												<p class="m_txt_judul_review">Adolph Alexander</p>
											</div>
										</div>
										<div class="desription_review">
											<p class="txt_description_review">
												When a wildfire swept through, I was forced to evacuate my home and leave everything I had behind. I felt lost and uncertain about what the future would hold. But then something amazing happened. People from all over the world came together to donate money to help me throught The Cloud Donation's Website.
											</p>
											<p class="txt_description_review mb-0">
												I will always be grateful for the love and support of the people who donated to me. Their kindness gave me a second chance, and I will never forget it.
											</p>
										</div>
									</div>
									<div class="box_review_right" style="background-image: url('<?= base_url('assets/img/heartwarming_stories/2.jpg'); ?>');"></div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="box_review card-shadow">
								<div class="sub_box_review">
									<div class="box_review_left">
										<div class="box_judul_review">
											<p class="txt_judul_review">Iudithu Vênus</p>

											<div class="m_judul_left_review dn">
												<svg class="m_svg_icon_user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
												<i class="fa-thin fa-user"></i>
											</div>
											<div class="m_judul_right_review dn">
												<p class="m_txt_judul_review">Iudithu Vênus</p>
											</div>
										</div>
										<div class="desription_review">
											<p class="txt_description_review">
												One day, I felt that my life was completely ruined. I had a lot of difficulties in my life and felt like I couldn't cope with everything on my own. However, something incredible happened. Many people from all over the world gathered to give me help.
											</p>
											<p class="txt_description_review mb-0">
												The help provided by these people made me feel very moved. They understood that I was going through a hard time and gave me what they could to help me. They set aside the money for me through the cloud donation's website.
											</p>
										</div>
									</div>
									<div class="box_review_right" style="background-image: url('<?= base_url('assets/img/heartwarming_stories/3.jpg'); ?>');"></div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="box_review card-shadow">
								<div class="sub_box_review">
									<div class="box_review_left">
										<div class="box_judul_review">
											<p class="txt_judul_review">Elov Saverio</p>

											<div class="m_judul_left_review dn">
												<svg class="m_svg_icon_user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
												<i class="fa-thin fa-user"></i>
											</div>
											<div class="m_judul_right_review dn">
												<p class="m_txt_judul_review">Elov Saverio</p>
											</div>
										</div>
										<div class="desription_review">
											<p class="txt_description_review">
												I live in poverty and often feel starving. Don't have enough food to meet my daily needs. However, in the most difficult circumstances, many people came to provide assistance to me and people who were in the same situation through the cloud donation's website.
											</p>
											<p class="txt_description_review mb-0">
												Thanks to the help of many people, I was able to overcome hunger and see the future more optimistically. I am heartfelt grateful to everyone who has helped me and I promise to always try to help others who are in the same situation.
											</p>
										</div>
									</div>
									<div class="box_review_right" style="background-image: url('<?= base_url('assets/img/heartwarming_stories/4.jpg'); ?>');"></div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="box_review card-shadow">
								<div class="sub_box_review">
									<div class="box_review_left">
										<div class="box_judul_review">
											<p class="txt_judul_review">Jane Doe</p>

											<div class="m_judul_left_review dn">
												<svg class="m_svg_icon_user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
												<i class="fa-thin fa-user"></i>
											</div>
											<div class="m_judul_right_review dn">
												<p class="m_txt_judul_review">Jane Doe</p>
											</div>
										</div>
										<div class="desription_review">
											<p class="txt_description_review">
												I was born with physical limitations, which made me unable to do many things that others considered easy. I feel limited and sometimes feel depressed about my condition. However, many people came to help me through the cloud donation's website to overcome these physical limitations.
											</p>
											<p class="txt_description_review mb-0">
												With the help of these many people, I can pursue my dreams and live a more meaningful life.
											</p>
										</div>
									</div>
									<div class="box_review_right" style="background-image: url('<?= base_url('assets/img/heartwarming_stories/5.jpg'); ?>');"></div>
								</div>
							</div>
						</div>
						<div class="carousel-item">
							<div class="box_review card-shadow">
								<div class="sub_box_review">
									<div class="box_review_left">
										<div class="box_judul_review">
											<p class="txt_judul_review">John Doe</p>

											<div class="m_judul_left_review dn">
												<svg class="m_svg_icon_user" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.3.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>
												<i class="fa-thin fa-user"></i>
											</div>
											<div class="m_judul_right_review dn">
												<p class="m_txt_judul_review">John Doe</p>
											</div>
										</div>
										<div class="desription_review">
											<p class="txt_description_review">
												I had difficulty in coping with the medical needs I was facing. My health condition requires expensive treatment, and I feel limited in meeting this need. However, many people came to help me and provide financial support for my medical needs.
											</p>
											<p class="txt_description_review mb-0">
												The help I received made me feel helped and more optimistic in the face of difficult medical conditions. I feel moved by the kindness of the people who pay attention to my situation.
											</p>
										</div>
									</div>
									<div class="box_review_right" style="background-image: url('<?= base_url('assets/img/heartwarming_stories/6.jpg'); ?>');"></div>
								</div>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev icon_review" data-target="#demo" data-slide="prev">
						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
						 	<path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
						</svg>
					</a>
					<a class="carousel-control-next icon_review" data-target="#demo" data-slide="next">
						<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
						  	<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
						</svg>
					</a>
				</div>
			</section>
			<section class="box_faq">
				<center>
					<p class="headline_judul">Frequently Asked Questions</p>
					<p class="sub_headline_judul mb50">Find useful information for you, and find out more about us</p>
				</center>

				<div id="accordion">
					<div class="card mb5">
						<div class="card-header box_list_faq" id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
							<p class="txt_judul_faq">What currency used on the Cloud donation website?</p>
						</div>

						<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="card-body">
								The currency used is Indonesia Rupiah, we are using local symbol: <b>Rp (Rupiah)</b>.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
							<p class="txt_judul_faq">Why do you have to make a donation at The Cloud Donation?</p>
						</div>
						<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
							<div class="card-body">
								<ol style="padding-left: 20px; padding-right: 20px; margin-bottom: 0;">
									<li>You can donate without having to create an account first.</li>
									<li>You can easily donate here.</li>
									<li>You can have the opportunity to get a prize if donating in an exclusive campaign.</li>
								</ol>
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="headingThree" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
							<p class="txt_judul_faq">Can I make a donation campaign?</p>
						</div>
						<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
							<div class="card-body">
								Yes, you can make your own donation campaign.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="headingFour" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
							<p class="txt_judul_faq">How do I make my own campaign?</p>
						</div>
						<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
							<div class="card-body">
								<ol style="padding-left: 20px; padding-right: 20px; margin-bottom: 0;">
									<li>You first register at The Cloud Donation (<a href="<?= site_url('auth/register'); ?>"><?= site_url('auth/register'); ?></a>).</li>
									<li>You Login to the User Area (<a href="<?= site_url('auth/login'); ?>"><?= site_url('auth/login'); ?></a>).</li>
									<li>Select the Campaigs menu (<a href="<?= site_url('user/campaigns'); ?>"><?= site_url('user/campaigns'); ?></a>).</li>
									<li>Click the "Create New Campaign" button.</li>
									<li>Fill in the New Campaign Form.</li>
									<li>Submit and wait for confirmation from our team.</li>
								</ol>
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="headingFive" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
							<p class="txt_judul_faq">Do I have to pay if I want to make my own donation campaign?</p>
						</div>
						<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
							<div class="card-body">
								You don't need to pay if you want to make your own donation campaign at The Cloud Donation, but you will be charged an admin fee of the funds collected from the campaign that you made at the end of the campaign.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading7" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
							<p class="txt_judul_faq">After my campaign is finished where will the funds be transferred?</p>
						</div>
						<div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
							<div class="card-body">
								The funds will automatically go to your e-money balance, you can see your e-money balance on the wallet management page (<a href="<?= site_url('user/wallet'); ?>"><?= site_url('user/wallet'); ?></a>).</li>
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading8" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
							<p class="txt_judul_faq">How do I withdraw my e-money balance?</p>
						</div>
						<div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
							<div class="card-body">
								You can simply fill in the withdrawal request on the Wallet Management page (<a href="<?= site_url('user/wallet'); ?>"><?= site_url('user/wallet'); ?></a>), make sure the amount and information are appropriate and clear.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading9" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
							<p class="txt_judul_faq">How do I donate?</p>
						</div>
						<div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion">
							<div class="card-body">
								<ol style="padding-left: 20px; padding-right: 20px; margin-bottom: 0;">
									<li>
										If you do not have an account you can go directly to the list of donations page (<a href="<?= site_url('donations'); ?>"><?= site_url('donations'); ?></a>) then select the campaign you want to donate and click "donate now", after that please enter your aphorisms for the campaign then enter the amount you want to donate, after that click the "donate now" button and do the next direction of the popup that will appear.
									</li>
									<li>
										If you have an account please login first (<a href="<?= site_url('auth/login'); ?>"><?= site_url('auth/login'); ?></a>) after login you will be directed to the User Area, in your User Area please select the list of donations menu in the sidebar to go to the list of donations  (<a href="<?= site_url('donations'); ?>"><?= site_url('donations'); ?></a>) then select the campaign you want to donate and click "donate now", after that please enter your aphorisms for the campaign then enter the amount you want to donate,  After that click the "Donate Now" button and do the next direction of the popup that will appear.
									</li>
								</ol>
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading10" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
							<p class="txt_judul_faq">What is e-money?</p>
						</div>
						<div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
							<div class="card-body">
								E-Money is a balance that can be used to donate or disbursed into cash.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading11" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
							<p class="txt_judul_faq">Can I deposit to get my e-money balance?</p>
						</div>
						<div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordion">
							<div class="card-body">
								No, you cannot deposit to get e-money balance.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading12" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
							<p class="txt_judul_faq">How do I get an e-money balance?</p>
						</div>
						<div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordion">
							<div class="card-body">
								<ol style="padding-left: 20px; padding-right: 20px; margin-bottom: 0;">
									<li>
										E-Money balance will increase if you get a reward from an exclusive campaign whose reward is in the form of cash.
									</li>
									<li>
										The e-money balance will also increase if you have a campaign and the campaign is completed or reaches the target.
									</li>
								</ol>
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading12" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
							<p class="txt_judul_faq">Can I donate using the e-money balance I have?</p>
						</div>
						<div id="collapse12" class="collapse" aria-labelledby="heading12" data-parent="#accordion">
							<div class="card-body">
								Yes you can use your e-money balance to make a donation, make sure you log in first.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading13" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
							<p class="txt_judul_faq">Can I deactivate my account?</p>
						</div>
						<div id="collapse13" class="collapse" aria-labelledby="heading13" data-parent="#accordion">
							<div class="card-body">
								Yes, you can, please contact +628974842870 (text/whatsapp only).
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading14" data-toggle="collapse" data-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
							<p class="txt_judul_faq">Can I create a campaign without having to register first?</p>
						</div>
						<div id="collapse14" class="collapse" aria-labelledby="heading14" data-parent="#accordion">
							<div class="card-body">
								Yes, you can, please contact +628974842870 (text/whatsapp only).
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading15" data-toggle="collapse" data-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
							<p class="txt_judul_faq">What is an exclusive campaign?</p>
						</div>
						<div id="collapse15" class="collapse" aria-labelledby="heading15" data-parent="#accordion">
							<div class="card-body">
								Exclusive Campaign is a special campaign where after the campaign is completed or reaches the target, users who are registered and donate to the campaign will get the opportunity to get rewards.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading16" data-toggle="collapse" data-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
							<p class="txt_judul_faq">What are the Exclusive Campaign Rewards?</p>
						</div>
						<div id="collapse16" class="collapse" aria-labelledby="heading16" data-parent="#accordion">
							<div class="card-body">
								Exclusive Campaign Rewards Can Be E-Money or Goods.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading17" data-toggle="collapse" data-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
							<p class="txt_judul_faq">If I donate in the exclusive campaign but do not use the registered account, can I have the opportunity to get a reward?</p>
						</div>
						<div id="collapse17" class="collapse" aria-labelledby="heading17" data-parent="#accordion">
							<div class="card-body">
								No, only registered users can only get the opportunity to get rewards from the Exclusive Campaign.
							</div>
						</div>
					</div>
					<div class="card mb5">
						<div class="card-header box_list_faq" id="heading18" data-toggle="collapse" data-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
							<p class="txt_judul_faq">If I transact or donate can I see my transaction history?</p>
						</div>
						<div id="collapse18" class="collapse" aria-labelledby="heading18" data-parent="#accordion">
							<div class="card-body">
								Yes you can see in the User Area of the Transactions menu (<a href="<?= site_url('user/transactions'); ?>"><?= site_url('user/transactions'); ?></a>).
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php $this->load->view('template/footer'); ?>
		<?php $this->load->view('template/script'); ?>
		<script>
			$(function(){
				$.ajax({
					url: "<?= $_ENV['API_URL']; ?>/web/home/statistics",
					type: 'GET',
					success: function(response) {
						if (response.success) {
							let data = response.data;
							$('#statistics-total_donation').html(data.total_donation);
							$('#statistics-donation_completed').html(data.donation_completed);
							$('#statistics-total_transaction').html(data.total_transaction);
							$('#statistics-user_registered').html(data.user_registered);
						}
					},
					error: function(xhr, error, code) {
						console.log(xhr, error, code);
					}
				});

				$('#wrapper-list_donation').html(`<div class="col-12"><h1 class="text-center"><i class="fa fa-spinner fa-pulse"></i></h1></div>`);

				$.ajax({
					url: "<?= $_ENV['API_URL']; ?>/campaigns?status=active&limit=9&order_by=id&order_type=DESC",
					type: 'GET',
					success: function(response) {
						if (response.success) {
							let data = response.data;

							if (data.length == 0) {
								$('#wrapper-list_donation').html('<div class="col-12"><h2 class="text-center">THERE IS CURRENTLY NO ONGOING DONATION CAMPAIGN</h2></div>');
								return;
							}

							if (data.length >= 9) {
								$('#btn-see-all').show();
							}

							$('#wrapper-list_donation').html('');

							for (let i = 0; i < data.length; i++) {
								let img = '';
								let tooltip = '';
								let exclusive = '';
								let percentage = 0;
								let description = '';

								if (data[i].images.length > 0) {
									img = `<img data-src="<?= $_ENV['API_BASE']; ?>/${data[i].images[0].file_location}" class="card-img-top card_img_donasi" alt="Image ${data[i].short_description}">`;
								} else {
									img = `<img data-src="<?= base_url('assets/img/default_image.png'); ?>" class="card-img-top card_img_donasi" alt="Image ${data[i].short_description}">`;
								}

								percentage = Math.round((data[i].current_amount / data[i].goal_amount) * 100);
								percentage = percentage > 100 ? "100" : percentage;

								description = data[i].description.length > 150 ? `${data[i].description.substring(0, 150)}...` : data[i].description;

								if (data[i].short_description.length > 30) {
									tooltip = ` data-toggle="tooltip" data-placement="top" title="${data[i].short_description}"`;
								}

								if (data[i].is_exclusive) {
									exclusive = `<hr><div class="mt-0 mb-2 box_ex_campaign">
										<span class="badge badge-dark db">EXCLUSIVE CAMPAIGN</span>
									</div>`;
								}

								$('#wrapper-list_donation').append(`<div class="col-md-6 col-lg-4">
									<div class="card col_list_donasi hfull">
										${img}
										<div class="card-body pad0">
											<p class="txt_judul_donasi" style="cursor: help;"${tooltip}>${data[i].short_description}</p>
											<p class="txt_sub_judul_donasi">${description}</p>
											${exclusive}
										</div>
										<div class="card-footer box_footer">
											<div class="progress mb10">
												<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: ${percentage}%"></div>
											</div>
											<div class="progres_box_donasi">
												<p class="txt_progres_percent">${percentage}%</p>
												<p class="txt_progres_nominal">${formatRupiah(data[i].goal_amount)}</p>
											</div>
											<hr class="mtm5">
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
					}
				});
			});
		</script>
	</body>
</html>