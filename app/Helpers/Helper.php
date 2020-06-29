<?php
namespace App\Helpers;

class Helper
{
    
     /**
    * Session data in for show alert in index page
    * @param $status store/update
    * @param $result result from store/update (baseRepository)
    * @return alert with class and text reserved
    */
    public static function alertStatus($status, $result){
        $alert = [];
        $alert['alert'] = $result === true ? 'alert-success' : 'alert-danger';
        
        if($status == 'store' && $result === true)
        {
            $alert['alert-text'] = \Lang::get('db.saved');    
        } 
        elseif($status == 'store' && $result !== true) 
        {
            $alert['alert-text'] = \Lang::get('db.failed_saved');
        } 
        elseif($status == 'update' && $result === true) 
        {
            $alert['alert-text'] = \Lang::get('db.updated');
        } 
        elseif ($status == 'update' && $result !== true) 
        {
            $alert['alert-text'] = \Lang::get('db.failed_updated');
        }

        return $alert;
    }
    
    /**
    * Format timestamp without timestamp date into
    * dd mm yyyy with month name using indonesian lang
    *
    * @param $tanggal
    * @return indonesian date with format dd mm yyyy
    */
    public static function tglIndo($tanggal){
        if($tanggal != null){
            $bulan = array (
                1 =>   'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            );
            $pecahkan = explode('-', $tanggal);

            // check if $tanggal has jam menit detik
            if ( preg_match('/\s/',$tanggal)){
                $waktu    = explode(' ', $tanggal);
                $tanggal  = $waktu[0]; // tanggal bulan tahun
                $jam      = $waktu[1]; // jam menit detik
                $pecahkanWaktu = explode('-', $tanggal);

                return $pecahkanWaktu[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkanWaktu[0].' '. $jam;
            } else {
                return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
            }
        } else {
            return null;
        }
    }
    
}