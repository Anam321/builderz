 <?php if (!defined('BASEPATH')) exit('No direct script access allowed');

    // function visitors()
    // {
    //     $ci = get_instance();
    //     $ip = $ci->input->ip_address();
    //     $date = date("Y-m-d");
    //     $time = time(); //
    //     $timeinsert = date("Y-m-d H:i:s");


    //     $s = $ci->db->query("SELECT * FROM visitors WHERE ip='" . $ip . "' AND date='" . $date . "'")->num_rows();
    //     $ss = isset($s) ? ($s) : 0;

    //     if ($ss == 0) {
    //         $ci->db->query("INSERT INTO visitors(ip, date, hits, online, time) VALUES('" . $ip . "','" . $date . "','1','" . $time . "','" . $timeinsert . "')");

    //         $cv = $ci->db->query("SELECT * FROM visitors_chart WHERE date='" . $date . "'")->num_rows();
    //         if ($cv == 0) {
    //             $ci->db->query("INSERT INTO visitors_chart(date, hits, online) VALUES('" . $date . "','1','" . $time . "')");
    //         } else {
    //             $ci->db->query("UPDATE visitors_chart SET hits=hits+1, online='" . $time . "' WHERE date='" . $date . "'");
    //         }
    //     } else {
    //         $ci->db->query("UPDATE visitors SET hits=hits+1, online='" . $time . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
    //     }
    // }

    function visitors()
    {
        $ci = get_instance();
        $ip = $ci->input->ip_address();
        $user_agent = $ci->input->user_agent();
        $date = date('Y-m-d');
        $time = time();
        $timeinsert = date("Y-m-d H:i:s");

        // Periksa apakah pengunjung sudah terdaftar hari ini
        if (!check_visitor($ip, $user_agent, $date)) {
            // Tambahkan pengunjung ke database
            $ci->db->query("INSERT INTO visitors(ip, date, hits, online, time, user_agent) VALUES('" . $ip . "','" . $date . "','1','" . $time . "','" . $timeinsert . "','" . $user_agent . "')");
            $cv = $ci->db->query("SELECT * FROM visitors_chart WHERE date='" . $date . "'")->num_rows();
            if ($cv == 0) {
                $ci->db->query("INSERT INTO visitors_chart(date, hits, online) VALUES('" . $date . "','1','" . $time . "')");
            } else {
                $ci->db->query("UPDATE visitors_chart SET hits=hits+1, online='" . $time . "' WHERE date='" . $date . "'");
            }
        } else {
            $ci->db->query("UPDATE visitors SET hits=hits+1, online='" . $time . "' WHERE ip='" . $ip . "' AND date='" . $date . "'");
        }

        // Tampilkan jumlah pengunjung unik hari ini
        // $data['unique_visitors'] = $ci->get_unique_visitors_count($date);

        // return $data;
    }


    function check_visitor($ip, $user_agent, $date)
    {
        $ci = get_instance();
        $ci->db->where('ip', $ip);
        $ci->db->where('user_agent', $user_agent);
        $ci->db->where('date', $date);
        $query = $ci->db->get('visitors');

        return $query->num_rows() > 0;
    }
