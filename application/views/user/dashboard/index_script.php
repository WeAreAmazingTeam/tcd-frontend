<script>
    $(function(){
        $.ajax({
            url: `<?= $_ENV['API_URL']; ?>/campaigns/exclusive/user`,
            type: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("Authorization", "Bearer <?= $this->session->userdata('token'); ?>");
            },
            success: function(response) {
                if (response.success) {
                    let data = response.data;
                    if (data.length > 0) {
                        $('#reward-notification').append("<hr>");
                        $('#reward-notification').append("<h4>Reward Notification From Exclusive Campaign:</h4>");
                        $('#reward-notification').append(`<ul class="mb-0">`);

                        for (let i = 0; i < data.length; i++) {
                            let rewardStatus = "pending or on processing";
                            let reward = "";

                            if (data[i].is_paid_off) {
                                rewardStatus = "paid off";
                            }

                            if (data[i].is_reward_money) {
                                reward = `${formatRupiah(data[i].reward)}`;
                            } else {
                                reward = data[i].reward;
                            }

                            $('#reward-notification').append(`<li>
                                Congrats! you are the chosen (winner) to get the rewards from the exclusive campaign.
                                <ul class="mb-0">
                                    <li>Link campaign: <a href="<?= site_url('donate'); ?>/${data[i].campaign_id}">click this for go to the campaign link</a>.</li>
                                    <li>Reward: <b>${reward}</b>.</li>
                                    <li>Reward status: <b>${rewardStatus}</b>.</li>
                                </ul>
                            </li>`);
                        }

                        $('#reward-notification').append(`</ul>`);
                    }
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
    });
</script>