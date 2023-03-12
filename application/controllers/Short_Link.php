<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Short_link extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
	}

    public function index($param)
    {
        switch ($param) {
            case '1': // api docs
                redirect("https://documenter.getpostman.com/view/8546369/2s93JowkfT");
                break;
            case '2': // original repo frontend
                redirect("https://github.com/ZihxS/thecloud-ci");
                break;
            case '3': // original repo backend
                redirect("https://github.com/ZihxS/thecloud-go");
                break;
            case '4': // public repo frontend
                redirect("https://github.com/WeAreAmazingTeam/tcd-frontend");
                break;
            case '5': // public repo backend
                redirect("https://github.com/WeAreAmazingTeam/tcd-backend");
                break;
            case '6': // proof using alibaba cloud polardb
                redirect("assets/img/proof/polardb.png");
                break;
            case '7': // proof using alibaba cloud simple application server
                redirect("assets/img/proof/sas.png");
                break;
            case '8': // proof using alibaba cloud dms
                redirect("assets/img/proof/dms.png");
                break;
            case '9': // proof using alibaba cloud domain
                redirect("assets/img/proof/domain.png");
                break;
            case '10': // proof using alibaba cloud direct mail
                redirect("assets/img/proof/dm.png");
                break;
            case '11': // midtrans payment simulator sandbox
                redirect("https://simulator.sandbox.midtrans.com/assets/index.html");
                break;
            case '12': // struct db xls file
                redirect("assets/UVRelXPqQIBmVIFFlGDv.xls");
                break;
            case '13': // yt register
                redirect("https://youtu.be/lVuyXBixJ6o");
                break;
            case '14': // yt forgot password
                redirect("https://youtu.be/wZ40o_80qMs");
                break;
            case '15': // yt login
                redirect("https://youtu.be/FZYCCRTz1fg");
                break;
            case '16': // yt change name and change password
                redirect("https://youtu.be/z5aipdYTnB8");
                break;
            case '17': // yt logout
                redirect("https://youtu.be/PcHDnc0ANAk");
                break;
            case '18': // yt admin check summary
                redirect("https://youtu.be/V25ZKQQJN1w");
                break;
            case '19': // yt manage users
                redirect("https://youtu.be/E80Kv11ok-I");
                break;
            case '20': // yt manage categories
                redirect("https://youtu.be/_MO0c22Cnzs");
                break;
            case '21': // yt manage campaigns
                redirect("https://youtu.be/kdnM-LM5Ofg");
                break;
            case '22': // yt manage winners exclusive campaigns
                redirect("https://youtu.be/l_hPhQxhnfU");
                break;
            case '23': // yt manage transactions
                redirect("https://youtu.be/QTeTEJ8zD1U");
                break;
            case '24': // yt company cash flow
                redirect("https://youtu.be/ybsPQq3yRUc");
                break;
            case '25': // yt withdrawal requests
                redirect("https://youtu.be/RgsE910k-8o");
                break;
            case '26': // yt check activity logs
                redirect("https://youtu.be/Ncv-MUFoNIc");
                break;
            case '27': // yt donate with payment gateway
                redirect("https://youtu.be/UeD48Vo6Tao");
                break;
            case '28': // yt donate with emoney
                redirect("https://youtu.be/Qt9NXhEJbBQ");
                break;
            case '29': // yt donate to exclusive campaign
                redirect("https://youtu.be/lMbiqf1oAkk");
                break;
            case '30': // yt user create own campaign
                redirect("https://youtu.be/7WteSy9BOJU");
                break;
            case '31': // yt check emoney balance
                redirect("https://youtu.be/eH4Wq-2EA6M");
                break;
            case '32': // yt check emoney flow
                redirect("https://youtu.be/CZvkExV1GjI");
                break;
            case '33': // yt withdraw and check withdrawal requests
                redirect("https://youtu.be/zTOQ1A6toag");
                break;
            case '34': // yt transactions history
                redirect("https://youtu.be/iQVC-bfcmlk");
                break;
            case '35': // yt check reward
                redirect("https://youtu.be/6lWBfpqiDhg");
                break;
            default:
                echo "<script>
                    alert(`Link not found or broken! please contact to this whatsapp: +628974842870 for report this potential broken link.`);
                    window.location.href = `".site_url()."`;
                </script>";
                break;
        }
    }
}