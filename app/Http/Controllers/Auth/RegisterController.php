<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'sex' => ['required', 'string', 'max:10'],
            'city' => ['required', 'string', 'max:225'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function register(Request $request)
    {
        $emails = $this->checkEmail($request->get('email'),'boolean');

        if(!$emails['success']){
            return redirect()->back() ->with('fail', 'Your google could not be found.');  
        }


        $user = New User([
            'firstname' => $request->get('firstname'),
            'lastname' => $request->get('lastname'),
            'sex' => $request->get('sex'),
            'city' => $request->get('city'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
        $user->save();
        $credentials = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );
        
        if (Auth::attempt($credentials)) {
            return redirect('/exploreEvents');
        }
    }

    // ----------------------------- Email checker  ---------------------------------------------------//

    public $domian;

    public $details;

    public $result = '';

    public $email_from = '';

    // Spit email
    private function splitEmail($email)
    {
        return substr(strrchr($email, "@"), 1);
    }

    // Connect to domain
    private function goCurl($domain)
    {
        $init = curl_init($domain);
        curl_setopt($init, CURLOPT_TIMEOUT, 5);
        curl_setopt($init, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($init, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($init, CURLOPT_MAXREDIRS, 3);
        curl_exec($init);
        $httpcode = curl_getinfo($init, CURLINFO_HTTP_CODE);
        curl_close($init);
        return $httpcode;
    }

   
    public function checkMxAndDnsRecord($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Get the domain of the email recipient
            $detailsDesc = '';
            $email_arr = explode('@', $email);
            $domain = array_slice($email_arr, -1);
            $domain = $domain[0];

            // Trim [ and ] from beginning and end of domain string, respectively
            $domain = ltrim($domain, '[');
            $domain = rtrim($domain, ']');
            if ('IPv6:' == substr($domain, 0, strlen('IPv6:'))) {
                $domain = substr($domain, strlen('IPv6') + 1);
            }
            $mxhosts = array();

            // Check if the domain has an IP address assigned to it
            if (filter_var($domain, FILTER_VALIDATE_IP)) {
                $mx_ip = $domain;
            } else {
                // If no IP assigned, get the MX records for the host name
                getmxrr($domain, $mxhosts, $mxweight);
            }
            if (!empty($mxhosts)) {
                $mx_ip = $mxhosts[array_search(min($mxweight), $mxhosts)];
            } else {
                // If MX records not found, get the A DNS records for the host
                if (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $record_a = dns_get_record($domain, DNS_A);
                    // else get the AAAA IPv6 address record
                } elseif (filter_var($domain, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                    $record_a = dns_get_record($domain, DNS_AAAA);
                }
                if (!empty($record_a)) {
                    $mx_ip = $record_a[0]['ip'];
                } else {
                    // Exit the program if no MX records are found for the domain host
                    $result = 'invalid';
                    $details = 'No suitable MX records found.';
                    return array($result, $details);
                }
            }
            // Open a socket connection with the hostname, smtp port 25
            try {
                if ($connect = @fsockopen($mx_ip, 25, $errno, $errstr, 5)) {
                    // Initiate the Mail Sending SMTP transaction
                    if (preg_match('/^220/i', $out = fgets($connect, 1024))) {
                        // Send the HELO command to the SMTP server
                        fputs($connect, "HELO $mx_ip\r\n");
                        $out = fgets($connect, 1024);
                        $detailsDesc .= $out . "\n";
                        // Send an SMTP Mail command from the sender's email address
                        fputs($connect, "MAIL FROM: <" . $this->email_from . ">\r\n");
                        $from = fgets($connect, 1024);
                        $detailsDesc .= $from . "\n";
                        // Send the SCPT command with the recepient's email address
                        fputs($connect, "RCPT TO: <$email>\r\n");
                        $to = fgets($connect, 1024);
                        $detailsDesc .= $to . "\n";
                        // Close the socket connection with QUIT command to the SMTP server
                        fputs($connect, 'QUIT');
                        fclose($connect);
                        // The expected response is 250 if the email is valid
                        if (!preg_match('/^250/i', $from) || !preg_match('/^250/i', $to)) {
                            $result = 'invalid';
                            $details = 'Invalid email address';
                        } else {
                            $result = 'valid';
                            $details = 'Valid email address';
                        }
                    } else {
                        $result = 'valid';
                        $details = 'MX record found but could not connect to server';
                    }
                } else {
                    $result = 'valid';
                    $details = 'MX record found but could not connect to server';
                }
            } catch (Exception $e) {
                $result = 'valid';
                $details = 'MX record found but could not connect to server';
            }
            return array($result, $details);
        } else {
            $result = 'invalid';
            $details = 'Validation error email address.';
            return array($result, $details);
        }
    }

    public function checkEmail($email, $deepCheck = false)
    {
        $disposable = $mxrecord = $domain = array();

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            $verify = $this->checkMxAndDnsRecord($email);
            if ($verify[0] !== 'valid') {
                return [
                    'success' => false,
                    'error' => 'Entered email address has no MX and DNS record.',
                ];
            } else {
                $mxrecord = [
                    'success' => true,
                    'detail' => $verify[1],
                ];
            }
            if ($this->checkDomain($email) === false) {
                return [
                    'success' => false,
                    'error' => 'Unable to verify email address.',
                ];
            } else {
                $domain = [
                    'success' => true,
                    'detail' => 'Domain is exist.',
                ];
            }
            return [
                'success' => true,
                'dispossable' => $disposable,
                'mxrecord' => $mxrecord,
                'domain' => $domain,
            ];
        } else {
            return [
                'success' => false,
                'error' => 'Please enter valid email address',
            ];
        }
    }

    public function checkDomain($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $domain = 'http://' . $this->splitEmail($email);
            $httpcode = $this->goCurl($domain);
            if( $domain ==='http://student.passerellesnumeriques.org'){
                return true;
            }
            if( $domain ==='http://passerellesnumeriques.org'){
                return true;
            }
            if($domain != 'http://example.com'){
                if ($httpcode === 301) {
                    $domain = 'https://' . $this->splitEmail($email);
                    $httpcode = $this->goCurl($domain);
                }
                if ($httpcode >= 200 && $httpcode < 300) {
                    return true;
                } else {
                    return false;
                }
            }else {
                return false;
            }
        } else {
            return false;
        }
    }
}
   
