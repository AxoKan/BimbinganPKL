<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_lelang;


class Home extends BaseController
{

    public function login()
    {
        $model= new M_lelang();
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);

    echo view('Login', $data);

    }
    public function dashboard()
    {
        $userLevel = session()->get('Level');
    $allowedLevels = ['Siswa', 'Pembimbing1', 'admin','Pembimbing2'];

    if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
        $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
      
        $model->logActivity($user_id, 'View', 'User view Dashboard.');
        echo view('header', $data);
        echo view('menu',  $data);
        echo view('dashboard', $data); // Make sure to pass $data if needed in the view
        echo view('footer');
    } else {
        return redirect()->to('notfound');
    }
    }
    public function aksi_login() {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');
        $backupCaptcha = $this->request->getPost('backup_captcha');
    
        // Check if the server is online
        if ($this->isOnline()) {
            $secretKey = '6LeAgCAqAAAAACi34dd-ob9stqzW69GDXnxPpLr7'; // Your secret key
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
            $responseKeys = json_decode($response, true);
    
            if (intval($responseKeys["success"]) !== 1) {
                session()->setFlashdata('error', 'Please complete the reCAPTCHA.');
                return redirect()->to('home');
            }
        } else {
            // Validate offline CAPTCHA
            if (!empty($backupCaptcha)) {
                if (!$this->validateOfflineCaptcha($backupCaptcha)) {
                    session()->setFlashdata('error', 'Offline CAPTCHA validation failed.');
                    return redirect()->to('login');
                }
            } else {
                session()->setFlashdata('error', 'Please complete the offline CAPTCHA.');
                return redirect()->to('login');
            }
        }
        $model = new M_lelang();
            $where = array(
                'username' => $username,
                'password' => md5($password)
            );
        
            $cek = $model->getWhere('user', $where);
        if ($cek > 0) {
            session()->set('Username', $cek->Username);
            session()->set('id_user', $cek->id_user);
            session()->set('NamaA', $cek->NamaA);
            session()->set('Level', $cek->Level);
            session()->set('Jurusan', $cek->Jurusan);
            
                    // Log the login activity
                  
                    return redirect()->to('dashboard');
                } else {
                    return redirect()->to('login');
                }
    }
    
    // Function to check network connectivity
    private function isOnline() {
        $connected = @fsockopen("www.google.com", 80); 
        // Check if a connection is made
        if ($connected) {
            fclose($connected);
            return true;
        } else {
            return false;
        }
    }
        private function validateOfflineCaptcha($captchaInput)
        {
            // Ambil CAPTCHA yang disimpan di session
            $storedCaptcha = session()->get('captcha_code');
    
            // Bandingkan input pengguna dengan CAPTCHA yang disimpan (peka huruf besar/kecil)
            return $captchaInput === $storedCaptcha;
        }
        public function generateCaptcha()
        {
            $code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);
    
            // Store the CAPTCHA code in the session
            session()->set('captcha_code', $code);
    
            // Generate the image
            $image = imagecreatetruecolor(120, 40);
            $bgColor = imagecolorallocate($image, 255, 255, 255);
            $textColor = imagecolorallocate($image, 0, 0, 0);
    
            imagefilledrectangle($image, 0, 0, 120, 40, $bgColor);
            imagestring($image, 5, 10, 10, $code, $textColor);
    
            // Set the content type header - in this case image/png
            header('Content-Type: image/png');
    
            // Output the image
            imagepng($image);
    
            // Free up memory
            imagedestroy($image);

    }
    
   

    
	public function logout() {
        $user_id = session()->get('id_user');

            // Log the logout activity
            $model = new M_lelang();        

        session()->destroy();
        return redirect()->to('http://localhost:8080/home');
    }
    public function setting()
    {
     $userLevel = session()->get('Level');
     $allowedLevels = ['admin'];
 
     if (in_array($userLevel, $allowedLevels)) {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
        $where = array('id_logo' => $id);
        $data['sa'] = $model->getwhere('logo', $where);
        $where=array('id_user'=>session()->get('id_user'));
 $data['user']=$model->getWhere('user', $where);
 $model->logActivity($user_id, 'View', 'User view Setting.');
       
        echo view('header', $data);
        echo view('menu', $data);
        echo view('setting', $data);
        echo view('footer');
     } else {
         return redirect()->to('notfound');
     }
    }


    public function aksi_setting()
    {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $a = $this->request->getPost('nama');
        $icon = $this->request->getFile('image2');
        $dash = $this->request->getFile('image');
    
        // Debugging: Log received data
        log_message('debug', 'Website Name: ' . $a);
        log_message('debug', 'Tab Icon: ' . ($icon ? $icon->getName() : 'None'));
        log_message('debug', 'Dashboard Icon: ' . ($dash ? $dash->getName() : 'None'));
    
        $data = ['nama_logo' => $a];
        $uploadPath = ROOTPATH . 'public/assets/img/custom/';
    
        if ($icon && $icon->isValid() && !$icon->hasMoved()) {
            if (!file_exists($uploadPath . $icon->getName())) {
                $icon->move($uploadPath, $icon->getName());
            }
            $data['icon'] = $icon->getName();
        }
    
        if ($dash && $dash->isValid() && !$dash->hasMoved()) {
            if (!file_exists($uploadPath . $dash->getName())) {
                $dash->move($uploadPath, $dash->getName());
            }
            $data['logos'] = $dash->getName();
        }
    
    
        $where = ['id_logo' => 1];
        $model->edit('logo', $data, $where);
    
        return redirect()->to('setting/1');
    }
    public function PKL()
    {
        $userLevel = session()->get('Jurusan');
        $allowedLevels = ['RPL'];
    
        if (in_array($userLevel, $allowedLevels)) {
        $userLevel = session()->get('Level');
        $allowedLevels = ['Pembimbing1'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);

    $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $data['sa'] = $model->joinThreeTables('bimbingan_1',
        'siswa',
        'guru',
        'bimbingan_1.Siswa = siswa.id_siswa',
        'bimbingan_1.Pembimbing1 = guru.id_guru', []);
    $data['s'] = $model->tampil('user', 'id_user');
    $data['t'] = $model->tampil('siswa', 'id_siswa');
    echo view('header', $data);
    echo view('menu',$data);
    echo view('RPL1',$data);
    echo view('footer');
  
} 
       
    $userLevel = session()->get('Level');
    $allowedLevels = ['Pembimbing2'];

    if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);

    $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $data['sa'] = $model->joinThreeTables('bimbingan_2',
        'siswa',
        'guru',
        'bimbingan_2.Siswa = siswa.id_siswa',
        'bimbingan_2.Pembimbing1 = guru.id_guru', []);
    $data['s'] = $model->tampil('user', 'id_user');
    $data['t'] = $model->tampil('siswa', 'id_siswa');
echo view('header', $data);
echo view('menu',$data);
echo view('RPL2',$data);
echo view('footer');

}
}  
$userLevel = session()->get('Jurusan');
$allowedLevels = ['BDP'];

if (in_array($userLevel, $allowedLevels)) {
$userLevel = session()->get('Level');
$allowedLevels = ['Pembimbing1'];

if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);

$where=array('id_user'=>session()->get('id_user'));
$data['user']=$model->getWhere('user', $where);
$data['sa'] = $model->joinThreeTables('bimbingan_1',
'siswa',
'guru',
'bimbingan_1.Siswa = siswa.id_siswa',
'bimbingan_1.Pembimbing1 = guru.id_guru', []);
$data['s'] = $model->tampil('user', 'id_user');
$data['t'] = $model->tampil('siswa', 'id_siswa');
echo view('header', $data);
echo view('menu',$data);
echo view('BDP1',$data);
echo view('footer');

} 

$userLevel = session()->get('Level');
$allowedLevels = ['Pembimbing2'];

if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);

$where=array('id_user'=>session()->get('id_user'));
$data['user']=$model->getWhere('user', $where);
$data['sa'] = $model->joinThreeTables('bimbingan_2',
'siswa',
'guru',
'bimbingan_2.Siswa = siswa.id_siswa',
'bimbingan_2.Pembimbing1 = guru.id_guru', []);
$data['s'] = $model->tampil('user', 'id_user');
$data['t'] = $model->tampil('siswa', 'id_siswa');
echo view('header', $data);
echo view('menu',$data);
echo view('BDP2',$data);
echo view('footer');

}
        }
        $userLevel = session()->get('Jurusan');
        $allowedLevels = ['AKL'];
        
        if (in_array($userLevel, $allowedLevels)) {
        $userLevel = session()->get('Level');
        $allowedLevels = ['Pembimbing1'];
        
        if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
        
        $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $data['sa'] = $model->joinThreeTables('bimbingan_1',
        'siswa',
        'guru',
        'bimbingan_1.Siswa = siswa.id_siswa',
        'bimbingan_1.Pembimbing1 = guru.id_guru', []);
        $data['s'] = $model->tampil('user', 'id_user');
        $data['t'] = $model->tampil('siswa', 'id_siswa');
        echo view('header', $data);
        echo view('menu',$data);
        echo view('AKL1',$data);
        echo view('footer');
        
        } 
        
        $userLevel = session()->get('Level');
        $allowedLevels = ['Pembimbing2'];
        
        if (in_array($userLevel, $allowedLevels)) {
        $model= new M_lelang();
        $user_id = session()->get('id_user');
        $logoData = $model->tampil('logo'); // Fetch all logos
        $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
        });
        $data['satu'] = reset($filteredLogo);
        
        $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $data['sa'] = $model->joinThreeTables('bimbingan_2',
        'siswa',
        'guru',
        'bimbingan_2.Siswa = siswa.id_siswa',
        'bimbingan_2.Pembimbing1 = guru.id_guru', []);
        $data['s'] = $model->tampil('user', 'id_user');
        $data['t'] = $model->tampil('siswa', 'id_siswa');
        echo view('header', $data);
        echo view('menu',$data);
        echo view('AKL2',$data);
        echo view('footer');
    }        

        }
}
public function Terima1($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Terima');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_1', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "RPL"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Tolak1($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Tolak');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_1', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "RPL"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Terima2($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Terima');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_2', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "RPL"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Tolak2($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Tolak');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_2', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "RPL"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Terima3($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Terima');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_1', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "BDP"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Tolak3($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Tolak');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_1', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "BDP"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Terima4($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Terima');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_2', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "BDP"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Tolak4($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Tolak');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_2', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "BDP"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Terima5($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Terima');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_1', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "AKL"
    );
    print_r($isi1);
    print_r($isi);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Tolak5($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Tolak');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_1', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "AKL"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Terima6($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Terima');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_2', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "AKL"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function Tolak6($id)
{

    $model= new M_lelang();
    $user_id = session()->get('id_user');    
    // Data to be updated
    $isi = array('siap_bimbing1' => 'Tolak');

    // Condition for update
    $where = array('id_bimbingan' => $id);

    // Call the edit function from the model
    $model->edit('bimbingan_2', $isi, $where);
    $isi1 = array(
        'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
        'nama' => session()->get('NamaA'), // Get the 'nama' from user session
        'kehadiran' => "hadir",
        'Jurusan' => "AKL"
    );
    print_r($isi1);
    $model->tambah('absensi_guru', $isi1);
    return redirect()->to('PKL');
    // // Redirect or do whatever you need after update

}
public function AbsensiGuru()
    {
        $userLevel = session()->get('Level');
        $allowedLevels = ['Pembimbing1','Pembimbing2','admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
    $data['user']=$model->getWhere('user', $where);
    $data['axo'] = $model->tampil('absensi_guru','id_absensi2');
    echo view('header', $data);
    echo view('menu',$data);
    echo view('absenGuru',$data);
    echo view('footer');
} else {
    return redirect()->to('notfound');
}
    }
    public function AbsensiGuru2()
    {
        $userLevel = session()->get('Level');
        $allowedLevels = ['Pembimbing1','Pembimbing2','admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
    $data['user']=$model->getWhere('user', $where);
    $data['axo'] = $model->tampil('absensi_guru','id_absensi2');
    echo view('header', $data);
    echo view('menu',$data);
    echo view('absenGuru2',$data);
    echo view('footer');
} else {
    return redirect()->to('notfound');
}
    }
    public function Bimbingan1()
    {
        
        $userLevel = session()->get('Level');
        $allowedLevels = ['Siswa'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);

    $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $data['sa'] = $model->joinThreeTables('bimbingan_1',
        'siswa',
        'guru',
        'bimbingan_1.Siswa = siswa.id_siswa',
        'bimbingan_1.Pembimbing1 = guru.id_guru', []);
    $data['s'] = $model->tampil('user', 'id_user');
    $data['t'] = $model->tampil('siswa', 'id_siswa');
    echo view('header', $data);
    echo view('menu',$data);
    echo view('RPLS1',$data);
    echo view('footer');
  
} 
    }
public function Bimbingan2()
    {
        
        $userLevel = session()->get('Level');
        $allowedLevels = ['Siswa'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);

    $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $data['sa'] = $model->joinThreeTables('bimbingan_2',
        'siswa',
        'guru',
        'bimbingan_2.Siswa = siswa.id_siswa',
        'bimbingan_2.Pembimbing1 = guru.id_guru', []);
    $data['s'] = $model->tampil('user', 'id_user');
    $data['t'] = $model->tampil('siswa', 'id_siswa');
    echo view('header', $data);
    echo view('menu',$data);
    echo view('RPLS2',$data);
    echo view('footer');
  
}  
 

}
public function tambah1()
    {
        $userLevel = session()->get('Level');
        $allowedLevels = ['Siswa'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model= new M_lelang();
            $user_id = session()->get('id_user');
            $logoData = $model->tampil('logo'); // Fetch all logos
            $filteredLogo = array_filter($logoData, function($item) {
            return $item->id_logo == 1; // Adjust this condition as needed
            });
            $data['satu'] = reset($filteredLogo);
            
            $where=array('id_user'=>session()->get('id_user'));
            $data['user']=$model->getWhere('user', $where);
            $data['sa'] = $model->joinThreeTables('bimbingan_1',
            'siswa',
            'guru',
            'bimbingan_1.Siswa = siswa.id_siswa',
            'bimbingan_1.Pembimbing1 = guru.id_guru', []);
            $data['s'] = $model->tampil('user', 'id_user');
            $data['s2'] = $model->tampil('guru', 'id_guru');
            $data['t'] = $model->tampil('siswa', 'id_siswa');
    echo view('header', $data);
    echo view('menu',$data);
    echo view('tambah1',$data);
    echo view('footer');
    
} else {
    return redirect()->to('notfound');
}
}
public function aksi_t_Bimbingan1()
    {
        $model = new M_lelang();
        $user_id = session()->get('id_user');
        $a = $this->request->getPost('jenis1');
        $ab = $this->request->getPost('topic');
        


                $isi = array(
                'tanggal' => date('Y-m-d'), // Set the current date in 'YYYY-MM-DD' format
                'Siswa' => session()->get('id_user'),
                'Jurusan' => session()->get('Jurusan'),
                'Pembimbing1' => $a,
                'topik' => $ab,
                'siap_bimbing1' => "Pending"
                
                );
                
                print_r($isi);
              
                $model->tambah('bimbingan_1', $isi);
            
        
//  Redirect to 'inprogress' page
        return redirect()->to(base_url('home/bimbingan1'));
       
    }
    public function AbsensiSiswa()
    {
        $userLevel = session()->get('Level');
        $allowedLevels = ['Siswa','admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
    $data['user']=$model->getWhere('user', $where);
    $data['axo'] = $model->tampil('absensi_siswa','id_absensi1');
    echo view('header', $data);
    echo view('menu',$data);
    echo view('absenSiswa',$data);
    echo view('footer');
} else {
    return redirect()->to('notfound');
}
    }
    public function AbsensiSiswa2()
    {
        $userLevel = session()->get('Level');
        $allowedLevels = ['Siswa','admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
    $model= new M_lelang();
    $user_id = session()->get('id_user');
    $logoData = $model->tampil('logo'); // Fetch all logos
    $filteredLogo = array_filter($logoData, function($item) {
        return $item->id_logo == 1; // Adjust this condition as needed
    });
    $data['satu'] = reset($filteredLogo);
    $where=array('id_user'=>session()->get('id_user'));
    $data['user']=$model->getWhere('user', $where);
    $data['axo'] = $model->tampil('absensi_siswa','id_absensi1');
    echo view('header', $data);
    echo view('menu',$data);
    echo view('absenSiswa2',$data);
    echo view('footer');
} else {
    return redirect()->to('notfound');
}
    }
    public function user()
{
    $userLevel = session()->get('Level');
        $allowedLevels = ['admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);

$data['s'] = $model->tampil('user', 'id_user');

 echo view('header', $data);
echo view('menu',$data);
echo view('User',$data);
echo view('footer');
} else {
    return redirect()->to('notfound');
}
}
public function user1()
{
    $userLevel = session()->get('Level');
        $allowedLevels = ['admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);

$data['s'] = $model->tampil('user', 'id_user');

 echo view('header', $data);
echo view('menu',$data);
echo view('User1',$data);
echo view('footer');
} else {
    return redirect()->to('notfound');
}
}
public function Siswa()
{
    $userLevel = session()->get('Level');
        $allowedLevels = ['admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
$model= new M_lelang();
$user_id = session()->get('id_user');
$logoData = $model->tampil('logo'); // Fetch all logos
$filteredLogo = array_filter($logoData, function($item) {
    return $item->id_logo == 1; // Adjust this condition as needed
});
$data['satu'] = reset($filteredLogo);
$where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);

$data['s'] = $model->tampil('user', 'id_user');

 echo view('header', $data);
echo view('menu',$data);
echo view('Siswa',$data);
echo view('footer');
} else {
    return redirect()->to('notfound');
}
}
public function t_user()
    {
        $userLevel = session()->get('Level');
        $allowedLevels = ['admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
         $model= new M_lelang();
         $user_id = session()->get('id_user');
         $logoData = $model->tampil('logo'); // Fetch all logos
         $filteredLogo = array_filter($logoData, function($item) {
             return $item->id_logo == 1; // Adjust this condition as needed
         });
         $data['satu'] = reset($filteredLogo);
         $where=array('id_user'=>session()->get('id_user'));
        $data['user']=$model->getWhere('user', $where);
        $data['sa'] = $model->joinThreeTables('bimbingan_1',
        'siswa',
        'guru',
        'bimbingan_1.Siswa = siswa.id_siswa',
        'bimbingan_1.Pembimbing1 = guru.id_guru', []);
        $data['s2'] = $model->tampil('guru', 'id_guru');
        $data['t'] = $model->tampil('siswa', 'id_siswa');
            echo view('header', $data);
            echo view('menu', $data);
              echo view('t_user');
            echo view('footer');
        } else {
            return redirect()->to('home/notfound');
        }
    }
    public function aksi_t_user()
    {
        $userLevel = session()->get('Level');
        $allowedLevels = ['admin'];
    
        if (in_array($userLevel, $allowedLevels)) {
            $model = new M_lelang(); // Assuming you instantiate the model like this
           
            $a = $this->request->getPost('level');
            $b = $this->request->getPost('jenis1');
            $c = $this->request->getPost('username');
            $d = $this->request->getPost('level1');
            
            // Set password based on level
            if ($d == 'admin') {
                $password = md5("admin");
            } elseif ($d == 'Pembimbing1') {
                $password = md5("Pembimbing1");
            } elseif ($d == 'Pembimbing2') {
                $password = md5("Pembimbing2"); // Example password for manager
            } elseif ($d == 'Siswa') {
                $password = md5("Siswa"); // Example password for manager
            } else {
                $password = md5("default137"); // Default password if level is not recognized
            }
    
            $isi = array(
                'Jursan' => $a,
                'Username' => $c,
                'Level' => $d,
                'Password' => $password,
                'NamaA' => $b,
                'foto' => "download.jpeg"
            );
    
            // Print the data for debugging purposes
            print_r($isi);
    
            // Perform the insert operation
         
            $model->tambah('user', $isi);
    
            // // Redirect to the desired page
            // return redirect()->to('t_user');
        } else {
            return redirect()->to('notfound');
        }
    }
}