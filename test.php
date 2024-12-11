

<?php

class Auth extends BaseController
{
    protected $redis;
    protected $session;
    
    public function __construct()
    {
        // Initialize Redis connection in constructor
        $this->redis = new \Predis\Client([
            'scheme' => 'tcp',
            'host' => '127.0.0.1',
            'port' => 6379,
            'timeout' => 30,
            'read_timeout' => 30,
            'retry_interval' => 100
        ]);
        
        // Initialize session
        $this->session = \Config\Services::session();
    }

    public function authenticate()
    {
        try {
            $name = $this->request->getVar('name');
            $password = $this->request->getVar('password');
            
            if (empty($name) || empty($password)) {
                return redirect()->to('/login')
                    ->with('error', 'Username and password are required');
            }

            // Admin authentication
            if ($name === 'admin' && $password === '1234') {
                $sessionData = [
                    'name' => $name,
                    'isAdmin' => true,
                    'isLoggedIn' => true
                ];
                
                // Store in Redis with expiration (e.g., 24 hours)
                $this->redis->setex('session:' . session_id(), 86400, json_encode($sessionData));
                
                // Store in CodeIgniter session
                $this->session->set($sessionData);
                
                return redirect()->to('/dashboard');
            }

            // Regular user authentication
            $response = $this->authenticateWithAPI($name, $password);
            
            if ($response === 'true' || $response === '1') {
                $sessionData = [
                    'name' => $name,
                    'isAdmin' => false,
                    'isLoggedIn' => true
                ];
                
                // Store in Redis with expiration
                $this->redis->setex('session:' . session_id(), 86400, json_encode($sessionData));
                
                // Store in CodeIgniter session
                $this->session->set($sessionData);
                
                return redirect()->to('/dashboard');
            }

            return redirect()->to('/login')
                ->with('error', 'Invalid credentials');
                
        } catch (\Exception $e) {
            log_message('error', 'Authentication error: ' . $e->getMessage());
            return redirect()->to('/login')
                ->with('error', 'An error occurred during authentication');
        }
    }

    private function authenticateWithAPI($name, $password)
    {
        $url = "http://localhost:5000/home/authentication";
        $data = [
            "name" => $name,
            "password" => $password
        ];

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_SSL_VERIFYPEER => false
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            throw new \Exception('API Authentication failed: ' . $error);
        }

        return $response;
    }

    public function getData()
    {
        try {
            // Check if user is logged in using CodeIgniter session
            if (!$this->session->get('isLoggedIn')) {
                return redirect()->to('/login')
                    ->with('error', 'Please login to continue');
            }

            // Verify Redis session
            $redisSession = $this->redis->get('session:' . session_id());
            if (!$redisSession) {
                // Clear CI session if Redis session is expired
                $this->session->destroy();
                return redirect()->to('/login')
                    ->with('error', 'Session expired, please login again');
            }

            // Fetch MongoDB data
            $query = $this->collection->find();
            $mongoData = iterator_to_array($query);

            return view('home_page', ['mongoData' => $mongoData]);

        } catch (\Exception $e) {
            log_message('error', 'getData error: ' . $e->getMessage());
            return redirect()->to('/login')
                ->with('error', 'An error occurred while fetching data');
        }
    }

    public function logout()
    {
        // Clear Redis session
        $this->redis->del('session:' . session_id());
        
        // Clear CodeIgniter session
        $this->session->destroy();
        
        return redirect()->to('/login')
            ->with('message', 'Successfully logged out');
    }
}